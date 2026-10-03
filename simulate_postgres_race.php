<?php
// Run this script using: php simulate_postgres_race.php
// This proves PostgreSQL row-level concurrency for BookingService.

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Process;
use App\Models\User;
use App\Models\Trek;
use App\Models\Departure;
use App\Models\SeatAllocation;

// 1. Setup Data in actual PostgreSQL DB
$trek = Trek::create(['title' => 'Concurrency Trek', 'slug' => 'concurrency-trek-'.uniqid(), 'price' => 5000]);
$departure = Departure::create([
    'trek_id' => $trek->id,
    'start_time' => now()->addDays(10),
    'end_time' => now()->addDays(15),
    'total_capacity' => 1,
    'unused_offline_reserved_capacity' => 0,
    'status' => 'scheduled'
]);

$user1 = User::factory()->create(['email_verified_at' => now(), 'role' => 'Customer']);
$user1->customerRecords()->create(['name' => $user1->name]);

$user2 = User::factory()->create(['email_verified_at' => now(), 'role' => 'Customer']);
$user2->customerRecords()->create(['name' => $user2->name]);

echo "Starting Race Condition for Departure ID: {$departure->id} with 1 seat available.\n";

// 2. Fire concurrent processes!
$results = Process::concurrently(function ($pool) use ($user1, $user2, $departure) {
    $pool->command("php artisan test:concurrency {$user1->id} {$departure->id}");
    $pool->command("php artisan test:concurrency {$user2->id} {$departure->id}");
});

echo "Process 1 Output:\n" . $results[0]->output() . $results[0]->errorOutput() . "\n";
echo "Process 2 Output:\n" . $results[1]->output() . $results[1]->errorOutput() . "\n";

// 3. Verify exactly one seat was taken
$allocations = SeatAllocation::where('departure_id', $departure->id)->count();
echo "Total Allocations in DB: {$allocations}\n";
if ($allocations === 1) {
    echo "✅ CONCURRENCY TEST PASSED! Only 1 seat was allocated.\n";
} else {
    echo "❌ CONCURRENCY TEST FAILED! Expected 1 allocation, found {$allocations}.\n";
}

// Cleanup
SeatAllocation::where('departure_id', $departure->id)->delete();
$departure->delete();
$trek->delete();
$user1->customerRecords()->delete();
$user1->delete();
$user2->customerRecords()->delete();
$user2->delete();
