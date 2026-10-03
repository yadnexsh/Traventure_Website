<?php

namespace Tests\Feature;

use App\Models\Departure;
use App\Models\Reservation;
use App\Models\SeatAllocation;
use App\Models\Trek;
use App\Models\User;
use App\Services\Booking\BookingService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BookingEngineTest extends TestCase
{
    use RefreshDatabase;

    protected BookingService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new BookingService();
    }

    private function createVerifiedCustomer()
    {
        $user = User::factory()->create(['role' => 'Customer', 'email_verified_at' => now()]);
        $user->customerRecords()->create(['name' => $user->name]);
        return $user;
    }

    private function createUnverifiedCustomer()
    {
        $user = User::factory()->create(['role' => 'Customer', 'email_verified_at' => null]);
        $user->customerRecords()->create(['name' => $user->name]);
        return $user;
    }

    private function createDeparture($capacity = 10, $unusedOffline = 0, $price = 5000)
    {
        $trek = Trek::create([
            'slug' => 'test-trek-'.uniqid(),
            'title' => 'Test Trek',
            'price' => $price
        ]);
        return Departure::create([
            'trek_id' => $trek->id,
            'start_time' => now()->addDays(10),
            'end_time' => now()->addDays(15),
            'total_capacity' => $capacity,
            'unused_offline_reserved_capacity' => $unusedOffline,
            'status' => 'scheduled'
        ]);
    }

    public function test_verified_customer_can_start_online_hold()
    {
        $user = $this->createVerifiedCustomer();
        $departure = $this->createDeparture();

        $allocation = $this->service->createOnlineHold($user, $departure->id);

        $this->assertNotNull($allocation);
        $this->assertEquals('OnlineHold', $allocation->allocation_type);
        $this->assertEquals(15, round(now()->diffInMinutes($allocation->expires_at, true)));
        
        // Assert availability reduced
        $this->assertEquals(9, $departure->fresh()->online_availability);
    }

    public function test_unverified_customer_cannot_start_online_hold()
    {
        $user = $this->createUnverifiedCustomer();
        $departure = $this->createDeparture();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Email verification required");

        $this->service->createOnlineHold($user, $departure->id);
    }

    public function test_full_departure_rejects_hold()
    {
        $user = $this->createVerifiedCustomer();
        $departure = $this->createDeparture(0);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("No available capacity.");

        $this->service->createOnlineHold($user, $departure->id);
    }

    public function test_one_remaining_seat_allows_exactly_one_allocation()
    {
        // Documented Limitation: Since SQLite memory DB is used for testing,
        // true parallel database execution for lockForUpdate() cannot be perfectly modeled.
        // We test this sequentially to prove boundary logic. PostgreSQL handles the row-lock in production.
        $user1 = $this->createVerifiedCustomer();
        $user2 = $this->createVerifiedCustomer();
        $departure = $this->createDeparture(1);

        $allocation1 = $this->service->createOnlineHold($user1, $departure->id);
        $this->assertNotNull($allocation1);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("No available capacity.");
        $this->service->createOnlineHold($user2, $departure->id);
    }

    public function test_active_online_hold_reduces_availability()
    {
        $user = $this->createVerifiedCustomer();
        $departure = $this->createDeparture(5);

        $this->service->createOnlineHold($user, $departure->id);
        $this->assertEquals(4, $departure->fresh()->online_availability);
    }

    public function test_expired_online_hold_does_not_reduce_availability()
    {
        $user = $this->createVerifiedCustomer();
        $departure = $this->createDeparture(5);

        $allocation = $this->service->createOnlineHold($user, $departure->id);
        $allocation->update(['expires_at' => now()->subMinutes(1)]);

        $this->assertEquals(5, $departure->fresh()->online_availability);
        
        // Historical hold remains
        $this->assertDatabaseHas('seat_allocations', ['id' => $allocation->id]);
    }

    public function test_active_offline_allocation_reduces_availability()
    {
        $departure = $this->createDeparture(5);
        $reservation = Reservation::create([
            'customer_record_id' => $this->createVerifiedCustomer()->customerRecords->first()->id,
            'departure_id' => $departure->id,
            'status' => 'Confirmed',
            'payment_status' => 'Paid',
            'price_snapshot' => 100
        ]);
        SeatAllocation::create([
            'reservation_id' => $reservation->id,
            'departure_id' => $departure->id,
            'allocation_type' => 'OfflineAllocated',
            'expires_at' => null
        ]);

        $this->assertEquals(4, $departure->fresh()->online_availability);
    }

    public function test_expired_or_released_allocation_does_not_reduce_availability()
    {
        $departure = $this->createDeparture(5);
        $reservation = Reservation::create([
            'customer_record_id' => $this->createVerifiedCustomer()->customerRecords->first()->id,
            'departure_id' => $departure->id,
            'status' => 'Draft',
            'payment_status' => 'Unpaid',
            'price_snapshot' => 100
        ]);
        SeatAllocation::create([
            'reservation_id' => $reservation->id,
            'departure_id' => $departure->id,
            'allocation_type' => 'OnlineHold',
            'expires_at' => now()->addMinutes(15),
            'released_at' => now() // explicit release
        ]);

        $this->assertEquals(5, $departure->fresh()->online_availability);
    }

    public function test_offline_reserved_capacity_included_correctly()
    {
        $departure = $this->createDeparture(10, 3); // 10 total, 3 unused offline
        $this->assertEquals(7, $departure->fresh()->online_availability);
    }

    public function test_availability_never_becomes_negative_publicly()
    {
        $departure = $this->createDeparture(1, 2); // Error in setup logically, but should return 0 not -1
        $this->assertEquals(0, $departure->fresh()->online_availability);
    }

    public function test_expired_hold_cannot_be_confirmed()
    {
        $user = $this->createVerifiedCustomer();
        $departure = $this->createDeparture();
        $allocation = $this->service->createOnlineHold($user, $departure->id);
        
        $allocation->update(['expires_at' => now()->subMinutes(1)]);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Hold has expired");

        $this->service->confirmReservation($user, $allocation->id);
    }

    public function test_active_hold_can_be_confirmed()
    {
        $user = $this->createVerifiedCustomer();
        $departure = $this->createDeparture();
        $allocation = $this->service->createOnlineHold($user, $departure->id);

        $confirmed = $this->service->confirmReservation($user, $allocation->id);

        $this->assertEquals('Confirmed', $confirmed->allocation_type);
        $this->assertNull($confirmed->expires_at);
        $this->assertEquals('Confirmed', $confirmed->reservation->status);
    }

    public function test_hold_belonging_to_another_customer_cannot_be_confirmed()
    {
        $user1 = $this->createVerifiedCustomer();
        $user2 = $this->createVerifiedCustomer();
        $departure = $this->createDeparture();
        
        $allocation = $this->service->createOnlineHold($user1, $departure->id);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Unauthorized access");

        $this->service->confirmReservation($user2, $allocation->id);
    }

    public function test_reservation_stores_correct_price_snapshot()
    {
        $user = $this->createVerifiedCustomer();
        $departure = $this->createDeparture(10, 0, 7500);
        
        $allocation = $this->service->createOnlineHold($user, $departure->id);
        
        $this->assertEquals(7500, $allocation->reservation->price_snapshot);
    }

    public function test_failed_booking_transaction_leaves_no_partial_state()
    {
        $user = $this->createVerifiedCustomer();
        $departure = $this->createDeparture(0);

        try {
            $this->service->createOnlineHold($user, $departure->id);
        } catch (\Exception $e) {
            // Expected
        }

        $this->assertEquals(0, Reservation::count());
        $this->assertEquals(0, SeatAllocation::count());
    }
}
