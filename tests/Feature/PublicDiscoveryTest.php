<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Trek;
use App\Models\Departure;
use App\Models\Reservation;
use App\Models\SeatAllocation;
use App\Models\CustomerRecord;

class PublicDiscoveryTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_responds_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_trek_listing_responds_successfully(): void
    {
        $response = $this->get('/treks');
        $response->assertStatus(200);
    }

    public function test_trek_detail_responds_successfully_for_valid_trek(): void
    {
        $trek = Trek::factory()->create(['published_status' => 'published']);
        
        $response = $this->get('/treks/' . $trek->slug);
        $response->assertStatus(200);
        $response->assertSee($trek->title);
    }

    public function test_unknown_trek_returns_404(): void
    {
        $response = $this->get('/treks/non-existent-trek');
        $response->assertStatus(404);
    }
    
    public function test_unpublished_trek_returns_404(): void
    {
        $trek = Trek::factory()->create(['published_status' => 'draft']);
        
        $response = $this->get('/treks/' . $trek->slug);
        $response->assertStatus(404);
    }

    public function test_upcoming_departures_are_displayed_correctly(): void
    {
        $trek = Trek::factory()->create(['published_status' => 'published']);
        $departure = Departure::factory()->create([
            'trek_id' => $trek->id,
            'start_time' => now()->addDays(5),
            'status' => 'scheduled'
        ]);

        $response = $this->get('/treks/' . $trek->slug);
        $response->assertStatus(200);
        $response->assertSee($departure->start_time->format('M d, Y H:i'));
    }

    public function test_public_availability_follows_documented_rules(): void
    {
        $trek = Trek::factory()->create(['published_status' => 'published']);
        
        // total capacity: 20, unused offline reserved: 5 => initial online available: 15
        $departure = Departure::factory()->create([
            'trek_id' => $trek->id,
            'total_capacity' => 20,
            'unused_offline_reserved_capacity' => 5,
            'start_time' => now()->addDays(5),
            'status' => 'scheduled'
        ]);
        
        $customer = CustomerRecord::create(['name' => 'John Doe']);
        
        $reservation = Reservation::create([
            'departure_id' => $departure->id,
            'customer_record_id' => $customer->id,
            'price_snapshot' => 5000,
        ]);
        
        // Active hold
        SeatAllocation::create([
            'departure_id' => $departure->id,
            'reservation_id' => $reservation->id,
            'allocation_type' => 'OnlineHold',
            'expires_at' => now()->addMinutes(10),
        ]);
        
        // Expired hold (should not affect capacity)
        SeatAllocation::create([
            'departure_id' => $departure->id,
            'reservation_id' => $reservation->id,
            'allocation_type' => 'OnlineHold',
            'expires_at' => now()->subMinutes(10),
        ]);
        
        $this->assertEquals(14, $departure->online_availability);

        $response = $this->get('/treks/' . $trek->slug);
        $response->assertStatus(200);
        $response->assertSee('14 seats available');
    }
}
