<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Trek;
use App\Models\Departure;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DemoDataSeeder::class,
        ]);
    }
}
