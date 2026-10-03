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
use App\Models\CustomerRecord;

class AdminSeatAllocationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_release_allocation_to_offline_reserved_pool()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $trek = Trek::factory()->create();
        $departure = Departure::factory()->create([
            'trek_id' => $trek->id,
            'total_capacity' => 20,
            'unused_offline_reserved_capacity' => 5,
        ]);
        
        $customer = CustomerRecord::create(['name' => 'Offline']);
        $reservation = Reservation::create([
            'customer_record_id' => $customer->id,
            'departure_id' => $departure->id,
            'status' => 'Confirmed',
            'payment_status' => 'Paid',
            'booking_source' => 'offline',
            'price_snapshot' => 100,
        ]);

        $allocation = SeatAllocation::create([
            'reservation_id' => $reservation->id,
            'departure_id' => $departure->id,
            'allocation_type' => 'OfflineAllocated',
            'source_pool' => 'offline_reserved',
        ]);

        $response = $this->actingAs($admin)->post('/admin/seat-allocations/' . $allocation->id . '/release', [
            'destination_pool' => 'offline_reserved',
        ]);

        $response->assertRedirect();
        
        $allocation->refresh();
        $this->assertNotNull($allocation->released_at);
        
        $departure->refresh();
        $this->assertEquals(6, $departure->unused_offline_reserved_capacity);
        
        $this->assertDatabaseHas('audit_logs', ['action' => 'seat_allocation_released', 'record_id' => $allocation->id]);
    }

    public function test_admin_can_release_allocation_to_general_pool()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $trek = Trek::factory()->create();
        $departure = Departure::factory()->create([
            'trek_id' => $trek->id,
            'total_capacity' => 20,
            'unused_offline_reserved_capacity' => 5,
        ]);
        
        $customer = CustomerRecord::create(['name' => 'Offline']);
        $reservation = Reservation::create([
            'customer_record_id' => $customer->id,
            'departure_id' => $departure->id,
            'status' => 'Confirmed',
            'payment_status' => 'Paid',
            'booking_source' => 'offline',
            'price_snapshot' => 100,
        ]);

        $allocation = SeatAllocation::create([
            'reservation_id' => $reservation->id,
            'departure_id' => $departure->id,
            'allocation_type' => 'OfflineAllocated',
            'source_pool' => 'offline_reserved',
        ]);

        $response = $this->actingAs($admin)->post('/admin/seat-allocations/' . $allocation->id . '/release', [
            'destination_pool' => 'general',
        ]);

        $response->assertRedirect();
        
        $allocation->refresh();
        $this->assertNotNull($allocation->released_at);
        
        $departure->refresh();
        // General pool destination doesn't increment offline reserve pool
        $this->assertEquals(5, $departure->unused_offline_reserved_capacity);
    }
}
