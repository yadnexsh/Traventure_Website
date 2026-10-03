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
}
