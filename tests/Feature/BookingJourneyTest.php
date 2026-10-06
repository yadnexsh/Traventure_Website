<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Trek;
use App\Models\Departure;
use App\Models\CustomerRecord;
use App\Models\SeatAllocation;
use App\Models\Reservation;

class BookingJourneyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->trek = Trek::factory()->create([
            'published_status' => 'published',
            'price' => 10000
        ]);
        
        $this->departure = Departure::factory()->create([
            'trek_id' => $this->trek->id,
            'start_time' => now()->addDays(10),
            'end_time' => now()->addDays(15),
            'total_capacity' => 20,
            'unused_offline_reserved_capacity' => 0,
            'status' => 'scheduled'
        ]);

        $this->user = User::factory()->create(['email_verified_at' => now()]);
        $this->customerRecord = CustomerRecord::create([
            'user_id' => $this->user->id,
            'name' => $this->user->name
        ]);
    }

    public function test_guest_is_redirected_to_login()
    {
        $response = $this->get(route('booking.details', $this->departure));
        $response->assertRedirect(route('login'));
    }

    public function test_unverified_user_cannot_create_hold()
    {
        $unverifiedUser = User::factory()->create(['email_verified_at' => null]);
        
        $response = $this->actingAs($unverifiedUser)
                         ->post(route('booking.hold', $this->departure));
                         
        // Middleware should block it and redirect to verification notice
        $response->assertRedirect(route('verification.notice'));
    }

    public function test_verified_user_can_create_hold_and_access_trekmates()
    {
        $response = $this->actingAs($this->user)
                         ->post(route('booking.hold', $this->departure));

        $allocation = SeatAllocation::where('allocation_type', 'OnlineHold')->first();
        $this->assertNotNull($allocation);
        
        $response->assertRedirect(route('booking.trekmates', $allocation));
    }

    public function test_user_can_submit_trekmate_details()
    {
        $allocation = app(\App\Services\Booking\BookingService::class)->createOnlineHold($this->user, $this->departure->id);
        
        $response = $this->actingAs($this->user)
                         ->post(route('booking.trekmates.store', $allocation), [
                             'trekmate_name' => 'Jane Doe',
                             'trekmate_email' => 'jane@example.com',
                             'trekmate_emergency' => 'John Doe - 555-1234'
                         ]);
                         
        $response->assertRedirect(route('booking.addons', $allocation));
        
        $this->assertDatabaseHas('trekmates', [
            'reservation_id' => $allocation->reservation_id,
            'name' => 'Jane Doe',
            'email' => 'jane@example.com'
        ]);
    }

    public function test_cannot_access_other_users_booking()
    {
        $allocation = app(\App\Services\Booking\BookingService::class)->createOnlineHold($this->user, $this->departure->id);
        
        $otherUser = User::factory()->create(['email_verified_at' => now()]);
        CustomerRecord::create(['user_id' => $otherUser->id, 'name' => $otherUser->name]);
        
        $response = $this->actingAs($otherUser)
                         ->get(route('booking.trekmates', $allocation));
                         
        $response->assertStatus(403);
    }
}
