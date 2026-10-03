<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Trek;
use App\Models\Departure;
use App\Models\SeatAllocation;

class AdminDepartureTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_departure()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $trek = Trek::factory()->create();
        $response = $this->actingAs($admin)->post('/admin/departures', [
            'trek_id' => $trek->id,
            'start_time' => now()->addDays(5)->toDateTimeString(),
            'end_time' => now()->addDays(10)->toDateTimeString(),
            'total_capacity' => 20,
            'unused_offline_reserved_capacity' => 5,
            'status' => 'scheduled',
        ]);
        $response->assertRedirect('/admin/departures');
        $this->assertDatabaseHas('departures', ['trek_id' => $trek->id, 'total_capacity' => 20]);
    }

    public function test_admin_cannot_reduce_capacity_below_active_allocations_and_offline_reserve()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $departure = Departure::factory()->create([
            'total_capacity' => 20,
            'unused_offline_reserved_capacity' => 5
        ]);

        $customer = \App\Models\CustomerRecord::create([
            'name' => 'Test User',
            'phone' => '1234567890',
            'emergency_contact_info' => 'Mom: 0987654321'
        ]);

        // Add 10 active online allocations
        for ($i=0; $i<10; $i++) {
            $reservation = \App\Models\Reservation::create([
                'customer_record_id' => $customer->id,
                'departure_id' => $departure->id,
                'status' => 'Confirmed',
                'payment_status' => 'Paid',
                'price_snapshot' => 100,
            ]);
            SeatAllocation::create([
                'reservation_id' => $reservation->id,
                'departure_id' => $departure->id,
                'allocation_type' => 'OnlineHold',
                'expires_at' => now()->addMinutes(15),
                'source_pool' => 'online',
            ]);
        }

        // Total committed is 5 (offline reserve) + 10 (active allocations) = 15.
        // Try to reduce total capacity to 14
        $response = $this->actingAs($admin)->put('/admin/departures/' . $departure->id, [
            'trek_id' => $departure->trek_id,
            'start_time' => $departure->start_time,
            'end_time' => $departure->end_time,
            'total_capacity' => 14,
            'unused_offline_reserved_capacity' => 5,
            'status' => 'scheduled',
        ]);

        $response->assertSessionHasErrors('total_capacity');
        $this->assertDatabaseHas('departures', ['id' => $departure->id, 'total_capacity' => 20]);
    }

    public function test_admin_can_reduce_capacity_if_above_committed()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $departure = Departure::factory()->create([
            'total_capacity' => 20,
            'unused_offline_reserved_capacity' => 5
        ]);

        $customer = \App\Models\CustomerRecord::create([
            'name' => 'Test User',
            'phone' => '1234567890',
            'emergency_contact_info' => 'Mom: 0987654321'
        ]);

        // Add 10 active online allocations
        for ($i=0; $i<10; $i++) {
            $reservation = \App\Models\Reservation::create([
                'customer_record_id' => $customer->id,
                'departure_id' => $departure->id,
                'status' => 'Confirmed',
                'payment_status' => 'Paid',
                'price_snapshot' => 100,
            ]);
            SeatAllocation::create([
                'reservation_id' => $reservation->id,
                'departure_id' => $departure->id,
                'allocation_type' => 'OnlineHold',
                'expires_at' => now()->addMinutes(15),
                'source_pool' => 'online',
            ]);
        }

        // Total committed is 15. Reduce to 16.
        $response = $this->actingAs($admin)->put('/admin/departures/' . $departure->id, [
            'trek_id' => $departure->trek_id,
            'start_time' => $departure->start_time,
            'end_time' => $departure->end_time,
            'total_capacity' => 16,
            'unused_offline_reserved_capacity' => 5,
            'status' => 'scheduled',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/admin/departures');
        $this->assertDatabaseHas('departures', ['id' => $departure->id, 'total_capacity' => 16]);
    }
}
