<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Trek;
use App\Models\Departure;
use App\Models\CustomerRecord;
use Illuminate\Support\Facades\Hash;
use App\Services\Booking\BookingService;
use App\Models\ExpressionOfInterest;
use Carbon\Carbon;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminUserSeeder::class);
        $admin = User::where('email', env('ADMIN_EMAIL', 'admin@traventure.local'))->first();

        // 1. Staff Account
        $staffEmail = env('STAFF_EMAIL', 'staff@traventure.local');
        $staffPass = env('STAFF_INITIAL_PASSWORD', 'staff123'); // Demo fallback
        if (!User::where('email', $staffEmail)->exists()) {
            User::create([
                'name' => 'Demo Staff',
                'email' => $staffEmail,
                'password' => Hash::make($staffPass),
                'email_verified_at' => now(),
                'role' => 'Staff'
            ]);
            $this->command->info("Staff user provisioned: {$staffEmail} / {$staffPass}");
        }

        // 2. Customer Account
        $customerEmail = 'customer@traventure.local';
        $customerPass = 'customer123';
        if (!User::where('email', $customerEmail)->exists()) {
            $customerUser = User::create([
                'name' => 'Demo Customer',
                'email' => $customerEmail,
                'password' => Hash::make($customerPass),
                'email_verified_at' => now(),
                'role' => 'Customer'
            ]);
            CustomerRecord::create([
                'user_id' => $customerUser->id,
                'name' => 'Demo Customer',
                'phone' => '+919876543210'
            ]);
            $this->command->info("Customer user provisioned: {$customerEmail} / {$customerPass}");
        }

        // 3. Treks
        $trek1 = Trek::firstOrCreate(
            ['slug' => 'himalayan-base-camp'],
            [
                'title' => 'Himalayan Base Camp',
                'summary' => 'A beautiful 10-day trek to the base camp of the mighty Himalayas.',
                'difficulty' => 'Hard',
                'duration' => 10,
                'price' => 25000,
                'published_status' => 'published'
            ]
        );

        $trek2 = Trek::firstOrCreate(
            ['slug' => 'valley-of-flowers'],
            [
                'title' => 'Valley of Flowers',
                'summary' => 'Explore the vibrant and lush Valley of Flowers during peak bloom.',
                'difficulty' => 'Moderate',
                'duration' => 6,
                'price' => 12000,
                'published_status' => 'published'
            ]
        );

        $trek3 = Trek::firstOrCreate(
            ['slug' => 'weekend-forest-trail'],
            [
                'title' => 'Weekend Forest Trail',
                'summary' => 'A short, easy hike perfect for beginners. Great way to spend your weekend in the woods.',
                'difficulty' => 'Easy',
                'duration' => 2,
                'price' => 3000,
                'published_status' => 'draft'
            ]
        );

        $trek4 = Trek::firstOrCreate(
            ['slug' => 'easy-day-trek'],
            [
                'title' => 'Sunrise Peak Day Hike',
                'summary' => 'An accessible 1-day trek starting before dawn to catch the sunrise over the local mountain ranges.',
                'difficulty' => 'Easy',
                'duration' => 1,
                'price' => 1500,
                'published_status' => 'published'
            ]
        );

        $trek5 = Trek::firstOrCreate(
            ['slug' => 'moderate-weekend'],
            [
                'title' => 'Riverside Camping Trek',
                'summary' => 'A moderate weekend trip featuring dense forests and riverside camping under the stars.',
                'difficulty' => 'Moderate',
                'duration' => 3,
                'price' => 5000,
                'published_status' => 'published'
            ]
        );

        $trek6 = Trek::firstOrCreate(
            ['slug' => 'hard-multi-day'],
            [
                'title' => 'Everest Advanced Base Camp',
                'summary' => 'A grueling but highly rewarding multi-day expedition into high altitudes. Prior experience mandatory.',
                'difficulty' => 'Hard',
                'duration' => 15,
                'price' => 65000,
                'published_status' => 'published'
            ]
        );

        $trek7 = Trek::firstOrCreate(
            ['slug' => 'camping-oriented'],
            [
                'title' => 'Lakeside Wilderness Retreat',
                'summary' => 'Focus on wilderness survival, pitching tents, and foraging while hiking around high-altitude alpine lakes.',
                'difficulty' => 'Moderate',
                'duration' => 5,
                'price' => 18000,
                'published_status' => 'published'
            ]
        );

        // 4. Departures
        $depPast = Departure::firstOrCreate(
            ['trek_id' => $trek1->id, 'start_time' => Carbon::now()->subDays(20)],
            [
                'end_time' => Carbon::now()->subDays(10),
                'total_capacity' => 15,
                'unused_offline_reserved_capacity' => 0,
                'status' => 'completed'
            ]
        );

        $depAvailable = Departure::firstOrCreate(
            ['trek_id' => $trek2->id, 'start_time' => Carbon::now()->addDays(30)],
            [
                'end_time' => Carbon::now()->addDays(36),
                'total_capacity' => 20,
                'unused_offline_reserved_capacity' => 5,
                'status' => 'scheduled'
            ]
        );

        // Multiple departures for moderate weekend trek
        Departure::firstOrCreate(
            ['trek_id' => $trek5->id, 'start_time' => Carbon::now()->addDays(14)],
            [
                'end_time' => Carbon::now()->addDays(17),
                'total_capacity' => 12,
                'unused_offline_reserved_capacity' => 2,
                'status' => 'scheduled'
            ]
        );
        Departure::firstOrCreate(
            ['trek_id' => $trek5->id, 'start_time' => Carbon::now()->addDays(28)],
            [
                'end_time' => Carbon::now()->addDays(31),
                'total_capacity' => 12,
                'unused_offline_reserved_capacity' => 0,
                'status' => 'scheduled'
            ]
        );

        // Departure for hard trek
        Departure::firstOrCreate(
            ['trek_id' => $trek6->id, 'start_time' => Carbon::now()->addDays(90)],
            [
                'end_time' => Carbon::now()->addDays(105),
                'total_capacity' => 8,
                'unused_offline_reserved_capacity' => 0,
                'status' => 'scheduled'
            ]
        );

        $depFull = Departure::firstOrCreate(
            ['trek_id' => $trek1->id, 'start_time' => Carbon::now()->addDays(45)],
            [
                'end_time' => Carbon::now()->addDays(55),
                'total_capacity' => 10,
                'unused_offline_reserved_capacity' => 0,
                'status' => 'scheduled'
            ]
        );

        // 5. Bookings & EOI
        $bookingService = new BookingService();

        // Fill up $depFull to capacity using offline booking
        if ($depFull->online_availability == 10) {
            $bookingService->createOfflineBooking(
                $depFull->id,
                ['name' => 'Group Booking', 'phone' => '1111111111'],
                10,
                'general',
                'Paid',
                $admin->id
            );
            $this->command->info("Filled up departure for EOI demonstration.");
        }

        // Create EOIs for the full departure
        ExpressionOfInterest::firstOrCreate(
            ['departure_id' => $depFull->id, 'email' => 'hopeful.trekker@example.com'],
            ['name' => 'Hopeful Trekker', 'phone' => '9999999999']
        );

        // Offline booking for the available one
        if ($depAvailable->online_availability == 20) {
            $bookingService->createOfflineBooking(
                $depAvailable->id,
                ['name' => 'Offline VIP', 'phone' => '8888888888'],
                2,
                'offline_reserved',
                'Unpaid',
                $admin->id
            );
            $this->command->info("Created demo offline bookings.");
        }
        
        $this->command->info("Demo data seeding completed.");
    }
}
