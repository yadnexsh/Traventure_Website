<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Departure;
use App\Models\Trek;
use App\Models\Reservation;
use App\Models\SeatAllocation;
use App\Models\AuditLog;

class AdminReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_offline_booking_from_offline_pool()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $trek = Trek::factory()->create(['price' => 5000]);
        $departure = Departure::factory()->create([
            'trek_id' => $trek->id,
            'total_capacity' => 20,
            'unused_offline_reserved_capacity' => 5,
        ]);

        $response = $this->actingAs($admin)->post('/admin/reservations', [
            'departure_id' => $departure->id,
            'name' => 'Offline Guest',
            'seats' => 2,
            'source_pool' => 'offline_reserved',
            'payment_status' => 'Paid',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        
        $reservation = Reservation::where('booking_source', 'offline')->first();
        $this->assertNotNull($reservation);
        $this->assertEquals(5000, $reservation->price_snapshot);

        // Verify capacity is updated
        $departure->refresh();
        $this->assertEquals(3, $departure->unused_offline_reserved_capacity);
        $this->assertEquals(15, $departure->online_availability); // 20 - 3 (offline) - 2 (active allocs) = 15

        // Verify Audit Log
        $this->assertDatabaseHas('audit_logs', ['action' => 'offline_booking_created', 'record_id' => $reservation->id]);
    }

    public function test_admin_can_create_offline_booking_from_general_pool()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $trek = Trek::factory()->create();
        $departure = Departure::factory()->create([
            'trek_id' => $trek->id,
            'total_capacity' => 20,
            'unused_offline_reserved_capacity' => 5,
        ]);

        $response = $this->actingAs($admin)->post('/admin/reservations', [
            'departure_id' => $departure->id,
            'name' => 'General Guest',
            'seats' => 3,
            'source_pool' => 'general',
            'payment_status' => 'Unpaid',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        
        $departure->refresh();
        $this->assertEquals(5, $departure->unused_offline_reserved_capacity);
        $this->assertEquals(12, $departure->online_availability); // 20 - 5 (offline) - 3 (active) = 12
    }

    public function test_offline_booking_fails_when_not_enough_capacity()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $trek = Trek::factory()->create();
        $departure = Departure::factory()->create([
            'trek_id' => $trek->id,
            'total_capacity' => 10,
            'unused_offline_reserved_capacity' => 2,
        ]);

        // General pool availability is 10 - 2 = 8
        $response = $this->actingAs($admin)->post('/admin/reservations', [
            'departure_id' => $departure->id,
            'name' => 'General Guest',
            'seats' => 10,
            'source_pool' => 'general',
            'payment_status' => 'Unpaid',
        ]);

        $response->assertSessionHasErrors('booking');
        
        $departure->refresh();
        $this->assertEquals(8, $departure->online_availability);
    }
}
