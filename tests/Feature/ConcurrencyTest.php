<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Illuminate\Support\Facades\Process;
use App\Models\User;
use App\Models\Departure;
use App\Models\Trek;
use App\Models\Reservation;

class ConcurrencyTest extends TestCase
{
    use DatabaseTruncation;

    public function test_concurrent_offline_booking_prevents_overbooking()
    {
        // Skip if not using Postgres
        if (config('database.default') !== 'pgsql') {
            $this->markTestSkipped('Concurrency tests require PostgreSQL to test row-level locking.');
        }

        $admin = User::factory()->create(['role' => 'Admin']);
        $trek = Trek::factory()->create();
        $departure = Departure::factory()->create([
            'trek_id' => $trek->id,
            'total_capacity' => 10,
            'unused_offline_reserved_capacity' => 0,
        ]);
        
        $this->assertEquals(10, $departure->online_availability);

        // The command executes BookingService logic via tinker
        $code = escapeshellarg(
            "app(\App\Services\Booking\BookingService::class)->createOfflineBooking(" .
            $departure->id . ", ['name' => 'Concurrent Guest'], 1, 'general', 'Paid', " . $admin->id . ");"
        );
        $command = "php artisan tinker --execute=" . $code;

        $dbConnection = config('database.default');
        $dbDatabase = config('database.connections.'.$dbConnection.'.database');

        $results = Process::pool(function ($pool) use ($command) {
            for ($i = 0; $i < 15; $i++) {
                $pool->path(base_path())
                     ->env([
                         'DB_CONNECTION' => config('database.default'),
                         'DB_DATABASE' => config('database.connections.'.config('database.default').'.database'),
                         'DB_USERNAME' => config('database.connections.'.config('database.default').'.username'),
                         'DB_PASSWORD' => config('database.connections.'.config('database.default').'.password'),
                     ])
                     ->command($command);
            }
        })->start()->wait();
        
        if (Reservation::count() === 0) {
            dump($results[0]->output(), $results[0]->errorOutput());
        }
        
        // Assert reservations count is 10, not 15
        $this->assertEquals(10, Reservation::count());
    }
}
