<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Trek;
use App\Models\Departure;
use App\Models\ExpressionOfInterest;

class ExpressionOfInterestTest extends TestCase
{
    use RefreshDatabase;

    private function createSoldOutDeparture()
    {
        $trek = Trek::factory()->create(['published_status' => 'published']);
        return Departure::factory()->create([
            'trek_id' => $trek->id,
            'total_capacity' => 10,
            'unused_offline_reserved_capacity' => 10, // Available = 10 - 10 = 0
            'status' => 'scheduled'
        ]);
    }

    private function createAvailableDeparture()
    {
        $trek = Trek::factory()->create(['published_status' => 'published']);
        return Departure::factory()->create([
            'trek_id' => $trek->id,
            'total_capacity' => 10,
            'unused_offline_reserved_capacity' => 0, // Available = 10 - 0 = 10
            'status' => 'scheduled'
        ]);
    }

    public function test_can_view_interest_form_for_sold_out_departure()
    {
        $departure = $this->createSoldOutDeparture();

        $response = $this->get(route('interest.create', $departure));
        $response->assertOk();
        $response->assertViewIs('treks.interest');
    }

    public function test_cannot_view_interest_form_if_departure_is_available()
    {
        $departure = $this->createAvailableDeparture();

        $response = $this->get(route('interest.create', $departure));
        $response->assertRedirect(route('treks.show', $departure->trek->slug));
        $response->assertSessionHas('error');
    }

    public function test_cannot_view_interest_form_for_past_departure()
    {
        $departure = $this->createSoldOutDeparture();
        $departure->update(['start_time' => now()->subDay()]);

        $this->get(route('interest.create', $departure))->assertNotFound();
        $this->post(route('interest.store', $departure), [])->assertNotFound();
    }

    public function test_cannot_view_interest_form_for_draft_trek()
    {
        $departure = $this->createSoldOutDeparture();
        $departure->trek->update(['published_status' => 'draft']);

        $this->get(route('interest.create', $departure))->assertNotFound();
        $this->post(route('interest.store', $departure), [])->assertNotFound();
    }

    public function test_valid_eoi_submission_persists_correct_data()
    {
        $departure = $this->createSoldOutDeparture();

        $response = $this->post(route('interest.store', $departure), [
            'name' => 'John Doe',
            'email' => '  JOHN@example.com ',
            'phone' => '1234567890',
            'consent_status' => '1',
        ]);

        $response->assertRedirect(route('treks.show', $departure->trek->slug));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('expression_of_interests', [
            'departure_id' => $departure->id,
            'name' => 'John Doe',
            'email' => 'john@example.com', // normalized
            'phone' => '1234567890',
            'consent_status' => true,
        ]);

        // Verify capacity is unchanged
        $this->assertEquals(0, $departure->fresh()->online_availability);
        $this->assertDatabaseCount('seat_allocations', 0);
        $this->assertDatabaseCount('reservations', 0);
    }

    public function test_missing_consent_is_rejected()
    {
        $departure = $this->createSoldOutDeparture();

        $response = $this->post(route('interest.store', $departure), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors(['consent_status']);
        $this->assertDatabaseCount('expression_of_interests', 0);
    }

    public function test_invalid_or_oversized_input_is_rejected()
    {
        $departure = $this->createSoldOutDeparture();

        $response = $this->post(route('interest.store', $departure), [
            'name' => str_repeat('A', 256),
            'email' => 'not-an-email',
            'phone' => str_repeat('1', 256),
            'consent_status' => '1',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'phone']);
        $this->assertDatabaseCount('expression_of_interests', 0);
    }

    public function test_interest_cannot_be_submitted_for_available_departure()
    {
        $departure = $this->createAvailableDeparture();

        $response = $this->post(route('interest.store', $departure), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'consent_status' => '1',
        ]);

        $response->assertRedirect(route('treks.show', $departure->trek->slug));
        $this->assertDatabaseCount('expression_of_interests', 0);
    }

    public function test_duplicate_submissions_do_not_create_duplicate_records_and_do_not_overwrite()
    {
        $departure = $this->createSoldOutDeparture();

        ExpressionOfInterest::create([
            'departure_id' => $departure->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'consent_status' => true,
        ]);

        $response = $this->post(route('interest.store', $departure), [
            'name' => 'Johnathan Doe', // Changed name
            'email' => ' JOHN@example.com ', // Same email, different case
            'consent_status' => '1',
        ]);

        $response->assertSessionHas('success');
        
        $this->assertDatabaseCount('expression_of_interests', 1);
        $this->assertDatabaseHas('expression_of_interests', [
            'name' => 'John Doe', // Should NOT be updated
            'email' => 'john@example.com'
        ]);
    }

    public function test_rate_limiting_works()
    {
        $departure = $this->createSoldOutDeparture();

        // Send 5 requests
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('interest.store', $departure), [
                'name' => "User $i",
                'email' => "user$i@example.com",
                'consent_status' => '1',
            ])->assertRedirect();
        }

        // 6th request should be rate limited
        $response = $this->post(route('interest.store', $departure), [
            'name' => 'User 6',
            'email' => 'user6@example.com',
            'consent_status' => '1',
        ]);
        
        $response->assertStatus(429);
    }

    public function test_admins_can_view_eoi_counts_and_contact_details()
    {
        $admin = User::factory()->create(['role' => 'Admin']);
        $departure = $this->createSoldOutDeparture();
        ExpressionOfInterest::create([
            'departure_id' => $departure->id,
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'consent_status' => true,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.departures.interest', $departure));
        $response->assertOk();
        $response->assertSee('Jane Smith');
        $response->assertSee('jane@example.com');
        $response->assertSee('Total Expressions of Interest: <strong>1</strong>', false);
    }

    public function test_guests_and_customers_cannot_access_admin_eoi_data()
    {
        $customer = User::factory()->create(['role' => 'Customer']);
        $departure = $this->createSoldOutDeparture();

        $this->get(route('admin.departures.interest', $departure))->assertRedirect('/login');
        $this->actingAs($customer)->get(route('admin.departures.interest', $departure))->assertForbidden();
    }
}
