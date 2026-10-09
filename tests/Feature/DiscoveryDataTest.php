<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Trek;

class DiscoveryDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_provides_treks_with_discovery_metadata(): void
    {
        $trek = Trek::factory()->create([
            'published_status' => 'published',
            'difficulty' => 'Moderate',
            'season' => ['Summer', 'Autumn'],
            'best_months' => ['MAY', 'JUNE', 'JULY'],
        ]);

        $response = $this->get('/');
        
        $response->assertStatus(200);
        $response->assertViewHas('allTreks');
        
        $allTreks = $response->viewData('allTreks');
        $this->assertCount(1, $allTreks);
        
        $firstTrek = $allTreks->first();
        $this->assertEquals('Moderate', $firstTrek->difficulty);
        $this->assertEquals(['Summer', 'Autumn'], $firstTrek->season);
        $this->assertEquals(['MAY', 'JUNE', 'JULY'], $firstTrek->best_months);
    }
}
