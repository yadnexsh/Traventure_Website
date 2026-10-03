<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trek>
 */
class TrekFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->words(3, true);
        return [
            'title' => ucwords($title),
            'slug' => Str::slug($title),
            'summary' => $this->faker->paragraph(),
            'difficulty' => $this->faker->randomElement(['Easy', 'Moderate', 'Hard']),
            'duration' => $this->faker->numberBetween(3, 14),
            'published_status' => 'published',
        ];
    }
}
