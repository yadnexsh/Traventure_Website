<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trek;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departure>
 */
class DepartureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('next month', '+6 months');
        $end = (clone $start)->modify('+7 days');
        
        return [
            'trek_id' => Trek::factory(),
            'start_time' => $start,
            'end_time' => $end,
            'total_capacity' => 20,
            'unused_offline_reserved_capacity' => 0,
            'status' => 'scheduled',
        ];
    }
}
