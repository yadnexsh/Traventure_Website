<?php

namespace App\Services\Booking;

use App\Models\Departure;
use App\Models\Reservation;
use App\Models\SeatAllocation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class BookingService
{
    /**
     * Attempts to create an online hold for a verified user.
     *
     * @param User $user
     * @param int $departureId
     * @return SeatAllocation
     * @throws Exception
     */
    public function createOnlineHold(User $user, int $departureId): SeatAllocation
    {
        if (!$user->hasVerifiedEmail()) {
            throw new Exception("Email verification required to book online.");
        }

        $customerRecord = $user->customerRecords()->first();
        if (!$customerRecord) {
            throw new Exception("Customer record missing.");
        }

        return DB::transaction(function () use ($customerRecord, $departureId) {
            // Lock the departure
            $departure = Departure::where('id', $departureId)->lockForUpdate()->firstOrFail();

            // Check availability - Departure's getOnlineAvailabilityAttribute uses activeAllocations
            // which dynamically queries the DB. Since we are inside a transaction and have locked
            // the Departure, this count will reflect the true current state across concurrent requests.
            if ($departure->online_availability <= 0) {
                throw new Exception("No available capacity.");
            }

            // Create Reservation
            $reservation = Reservation::create([
                'customer_record_id' => $customerRecord->id,
                'departure_id' => $departure->id,
                'status' => 'Draft',
                'payment_status' => 'Unpaid',
                'price_snapshot' => $departure->trek->price ?? 0,
            ]);

            // Create SeatAllocation
            $allocation = SeatAllocation::create([
                'reservation_id' => $reservation->id,
                'departure_id' => $departure->id,
                'allocation_type' => 'OnlineHold',
                'expires_at' => now()->addMinutes(15),
            ]);

            return $allocation;
        });
    }

    /**
     * Attempts to create an offline booking.
     *
     * @param int $departureId
     * @param array $customerData
     * @param int $seats
     * @param string $sourcePool ('offline_reserved' or 'general')
     * @param string $paymentStatus ('Unpaid', 'Paid')
     * @param int $adminUserId
     * @return Reservation
     * @throws Exception
     */
    public function createOfflineBooking(int $departureId, array $customerData, int $seats, string $sourcePool, string $paymentStatus, int $adminUserId): Reservation
    {
        if ($seats <= 0) {
            throw new Exception("Number of seats must be at least 1.");
        }
        if (!in_array($sourcePool, ['offline_reserved', 'general'])) {
            throw new Exception("Invalid source pool.");
        }

        return DB::transaction(function () use ($departureId, $customerData, $seats, $sourcePool, $paymentStatus, $adminUserId) {
            // Lock the departure
            $departure = Departure::where('id', $departureId)->lockForUpdate()->firstOrFail();

            if ($sourcePool === 'offline_reserved') {
                if ($departure->unused_offline_reserved_capacity < $seats) {
                    throw new Exception("Not enough unused offline-reserved capacity.");
                }
                // Decrement the offline reserved pool
                $departure->unused_offline_reserved_capacity -= $seats;
                $departure->save();
            } else {
                // 'general' pool means it consumes public online availability
                if ($departure->online_availability < $seats) {
                    throw new Exception("Not enough general online availability.");
                }
            }

            // Find or create CustomerRecord
            $customerRecordQuery = \App\Models\CustomerRecord::where('name', $customerData['name']);
            if (!empty($customerData['phone'])) {
                $customerRecordQuery->where('phone', $customerData['phone']);
            }
            $customerRecord = $customerRecordQuery->first();

            if (!$customerRecord) {
                $customerRecord = \App\Models\CustomerRecord::create([
                    'name' => $customerData['name'],
                    'phone' => $customerData['phone'] ?? null,
                    'emergency_contact_info' => $customerData['emergency_contact_info'] ?? null,
                ]);
            }

            // Create Reservation
            $reservation = Reservation::create([
                'customer_record_id' => $customerRecord->id,
                'departure_id' => $departure->id,
                'status' => 'Confirmed', // Offline bookings go straight to confirmed
                'payment_status' => $paymentStatus,
                'booking_source' => 'offline',
                'price_snapshot' => $departure->trek->price ?? 0,
            ]);

            // Create SeatAllocations
            for ($i = 0; $i < $seats; $i++) {
                SeatAllocation::create([
                    'reservation_id' => $reservation->id,
                    'departure_id' => $departure->id,
                    'allocation_type' => 'OfflineAllocated',
                    'source_pool' => $sourcePool,
                    'expires_at' => null,
                ]);
            }

            // Audit Log
            \App\Models\AuditLog::create([
                'actor_id' => $adminUserId,
                'action' => 'offline_booking_created',
                'table_name' => 'reservations',
                'record_id' => $reservation->id,
                'changes' => [
                    'seats' => $seats,
                    'source_pool' => $sourcePool,
                    'payment_status' => $paymentStatus,
                ]
            ]);

            return $reservation;
        });
    }

    /**
     * Confirms an active online hold.
     *
     * @param User $user
     * @param int $allocationId
     * @return SeatAllocation
     * @throws Exception
     */
    public function confirmReservation(User $user, int $allocationId): SeatAllocation
    {
        return DB::transaction(function () use ($user, $allocationId) {
            // We fetch the allocation to find the departure, but don't lock it yet
            // to avoid deadlocks. We should always lock Departure first, then Allocation.
            $initialAllocation = SeatAllocation::findOrFail($allocationId);

            // Lock the Departure
            $departure = Departure::where('id', $initialAllocation->departure_id)->lockForUpdate()->firstOrFail();

            // Lock the Allocation
            $allocation = SeatAllocation::where('id', $allocationId)->lockForUpdate()->firstOrFail();

            // Load relations to check ownership
            $reservation = $allocation->reservation;
            $customerRecord = $reservation->customerRecord;

            if ($customerRecord->user_id !== $user->id) {
                throw new Exception("Unauthorized access to reservation.");
            }

            // Check validity
            if ($allocation->released_at !== null) {
                throw new Exception("Hold has already been released.");
            }
            if ($allocation->expires_at !== null && $allocation->expires_at <= now()) {
                throw new Exception("Hold has expired and cannot be confirmed.");
            }
            if ($allocation->allocation_type !== 'OnlineHold') {
                throw new Exception("Only online holds can be confirmed through this flow.");
            }

            // Confirm Reservation
            $reservation->update(['status' => 'Confirmed']);

            // Update SeatAllocation
            $allocation->update([
                'allocation_type' => 'Confirmed',
                'expires_at' => null,
            ]);

            return $allocation;
        });
    }

    /**
     * Releases an allocation and optionally returns capacity to the offline-reserved pool.
     *
     * @param int $allocationId
     * @param string $destinationPool ('offline_reserved' or 'general')
     * @param int $adminUserId
     * @return SeatAllocation
     * @throws Exception
     */
    public function releaseAllocation(int $allocationId, string $destinationPool, int $adminUserId): SeatAllocation
    {
        if (!in_array($destinationPool, ['offline_reserved', 'general'])) {
            throw new Exception("Invalid destination pool.");
        }

        return DB::transaction(function () use ($allocationId, $destinationPool, $adminUserId) {
            $initialAllocation = SeatAllocation::findOrFail($allocationId);

            $departure = Departure::where('id', $initialAllocation->departure_id)->lockForUpdate()->firstOrFail();
            $allocation = SeatAllocation::where('id', $allocationId)->lockForUpdate()->firstOrFail();

            if ($allocation->released_at !== null) {
                throw new Exception("Allocation is already released.");
            }

            // If it's an online hold that naturally expired, releasing it explicitly is fine but maybe redundant. 
            // We'll allow explicit release anyway to clean up UI state.

            if ($destinationPool === 'offline_reserved') {
                $departure->unused_offline_reserved_capacity += 1;
                $departure->save();
            }

            $allocation->update([
                'released_at' => now(),
            ]);

            // Audit Log
            \App\Models\AuditLog::create([
                'actor_id' => $adminUserId,
                'action' => 'seat_allocation_released',
                'table_name' => 'seat_allocations',
                'record_id' => $allocation->id,
                'changes' => [
                    'destination_pool' => $destinationPool,
                    'previous_source_pool' => $allocation->source_pool,
                    'allocation_type' => $allocation->allocation_type,
                ]
            ]);

            // If all allocations for this reservation are released, we might want to update reservation status? 
            // The prompt says: "Never delete the allocation record... Preserve the reservation and allocation history." 
            // "Do not introduce undocumented cancellation, refund, or payment-settlement behavior. If a status transition is ambiguous, consult the source-of-truth documentation and report the ambiguity rather than inventing a rule."
            // So I will not change the reservation status here automatically.

            return $allocation;
        });
    }
}
