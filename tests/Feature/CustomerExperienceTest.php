<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Trek;
use App\Models\Departure;
use App\Models\CustomerRecord;
use App\Models\Reservation;
use App\Models\SeatAllocation;

class CustomerExperienceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->trek = Trek::factory()->create(['published_status' => 'published']);
        $this->departure = Departure::factory()->create([
            'trek_id' => $this->trek->id,
            'start_time' => now()->addDays(10),
            'total_capacity' => 20
        ]);

        $this->user = User::factory()->create(['email_verified_at' => now(), 'role' => 'Customer']);
        $this->customerRecord = CustomerRecord::create([
            'user_id' => $this->user->id,
            'name' => $this->user->name
        ]);
        
        $this->otherUser = User::factory()->create(['email_verified_at' => now(), 'role' => 'Customer']);
        $this->otherCustomerRecord = CustomerRecord::create([
            'user_id' => $this->otherUser->id,
            'name' => $this->otherUser->name
        ]);
    }

    public function test_guest_cannot_access_customer_pages()
    {
        $this->get(route('account.dashboard'))->assertRedirect(route('login'));
        $this->get(route('customer.trips'))->assertRedirect(route('login'));
        $this->get(route('account.profile'))->assertRedirect(route('login'));
    }

    public function test_customer_can_access_dashboard_and_trips()
    {
        $this->actingAs($this->user)
             ->get(route('account.dashboard'))
             ->assertStatus(200)
             ->assertSee('Welcome back');
             
        $this->actingAs($this->user)
             ->get(route('customer.trips'))
             ->assertStatus(200)
             ->assertSee('My Trips');
    }

    public function test_customer_receives_empty_state_without_trips()
    {
        $this->actingAs($this->user)
             ->get(route('customer.trips'))
             ->assertSee('No trips yet');
    }

    public function test_customer_can_view_own_trip_but_not_others()
    {
        $reservation = Reservation::create([
            'customer_record_id' => $this->customerRecord->id,
            'departure_id' => $this->departure->id,
            'status' => 'Confirmed',
            'price_snapshot' => 10000
        ]);

        // Can view own trip
        $this->actingAs($this->user)
             ->get(route('customer.trip.show', $reservation))
             ->assertStatus(200)
             ->assertSee($this->trek->title);

        // Cannot view other's trip
        $this->actingAs($this->otherUser)
             ->get(route('customer.trip.show', $reservation))
             ->assertStatus(403);
    }

    public function test_customer_can_update_profile_safely()
    {
        $response = $this->actingAs($this->user)
                         ->put(route('account.profile.update'), [
                             'name' => 'Updated Name',
                             'phone' => '1234567890',
                             'emergency_contact_info' => 'Jane - 9876543210'
                         ]);
                         
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', ['id' => $this->user->id, 'name' => 'Updated Name']);
        $this->assertDatabaseHas('customer_records', [
            'id' => $this->customerRecord->id,
            'name' => 'Updated Name',
            'phone' => '1234567890',
            'emergency_contact_info' => 'Jane - 9876543210'
        ]);
        
        // Ensure email isn't mass-assigned via profile
        $this->actingAs($this->user)
             ->put(route('account.profile.update'), [
                 'name' => 'Hacker',
                 'email' => 'hacked@example.com' // Should be ignored
             ]);
        
        $this->assertDatabaseMissing('users', ['email' => 'hacked@example.com']);
    }

    public function test_customer_cannot_promote_to_admin()
    {
        $this->actingAs($this->user)
             ->put(route('account.profile.update'), [
                 'name' => 'Hacker Name',
                 'role' => 'admin' // Attempt privilege escalation
             ]);
             
        $this->assertEquals('Customer', $this->user->fresh()->role);
    }
}
