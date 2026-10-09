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
                'summary' => 'A short, easy hike perfect for beginners.',
                'difficulty' => 'Easy',
                'duration' => 2,
                'price' => 3000,
                'published_status' => 'draft'
            ]
        );


         = [
            ['title' => 'Bhrigu Lake Trek', 'summary' => 'A short but steep trek near Manali leading to a high-altitude glacial lake surrounded by alpine meadows.', 'difficulty' => 'Moderate', 'duration' => 4, 'price' => 7500, 'published_status' => 'published', 'region' => 'Himalayas', 'season' => ['Summer', 'Monsoon'], 'best_months' => ['MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER']],
            ['title' => 'Harishchandragad Night Trek', 'summary' => 'Experience the thrill of ascending in the dark to reach the Konkan Kada cliff right before sunrise.', 'difficulty' => 'Moderate', 'duration' => 2, 'price' => 1500, 'published_status' => 'published', 'region' => 'Sahyadris', 'season' => ['Winter', 'Summer'], 'best_months' => ['NOVEMBER', 'DECEMBER', 'JANUARY', 'FEBRUARY', 'MARCH']],
            ['title' => 'Sandhan Valley Descent', 'summary' => 'Also known as the Valley of Shadows, this thrilling descent requires rappelling and navigating giant boulders.', 'difficulty' => 'Hard', 'duration' => 2, 'price' => 2200, 'published_status' => 'published', 'region' => 'Sahyadris', 'season' => ['Winter'], 'best_months' => ['NOVEMBER', 'DECEMBER', 'JANUARY', 'FEBRUARY']],
            ['title' => 'Kashmir Great Lakes', 'summary' => 'A visually stunning route passing through multiple high-altitude pristine alpine lakes in Kashmir.', 'difficulty' => 'Hard', 'duration' => 7, 'price' => 16500, 'published_status' => 'published', 'region' => 'Himalayas', 'season' => ['Summer', 'Monsoon'], 'best_months' => ['JULY', 'AUGUST', 'SEPTEMBER']],
            ['title' => 'Hampta Pass', 'summary' => 'A dramatic crossover trek connecting the lush green Kullu valley with the barren landscapes of Lahaul.', 'difficulty' => 'Moderate', 'duration' => 5, 'price' => 9500, 'published_status' => 'published', 'region' => 'Himalayas', 'season' => ['Monsoon'], 'best_months' => ['JULY', 'AUGUST', 'SEPTEMBER']],
            ['title' => 'Rajmachi Fort Trek', 'summary' => 'An easy monsoon getaway through lush forests and waterfalls, ending at twin historical forts.', 'difficulty' => 'Easy', 'duration' => 2, 'price' => 1800, 'published_status' => 'published', 'region' => 'Sahyadris', 'season' => ['Monsoon'], 'best_months' => ['JULY', 'AUGUST', 'SEPTEMBER']],
            ['title' => 'Kudremukh Peak', 'summary' => 'Trek up the horse-face peak in Karnataka surrounded by rolling green hills and thick shola forests.', 'difficulty' => 'Moderate', 'duration' => 2, 'price' => 3500, 'published_status' => 'published', 'region' => 'Western Ghats', 'season' => ['Monsoon', 'Autumn'], 'best_months' => ['JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER']],
            ['title' => 'Kumara Parvatha', 'summary' => 'One of the toughest treks in the Western Ghats, taking you through dense forests and steep volcanic rocks.', 'difficulty' => 'Hard', 'duration' => 3, 'price' => 4200, 'published_status' => 'published', 'region' => 'Western Ghats', 'season' => ['Winter', 'Autumn'], 'best_months' => ['OCTOBER', 'NOVEMBER', 'DECEMBER', 'JANUARY', 'FEBRUARY']],
            ['title' => 'Roopkund Trek', 'summary' => 'The famous mystery lake trek offering deep forests, sweeping meadows, and thrilling snow climbs.', 'difficulty' => 'Expert', 'duration' => 8, 'price' => 18000, 'published_status' => 'published', 'region' => 'Himalayas', 'season' => ['Summer', 'Autumn'], 'best_months' => ['MAY', 'JUNE', 'SEPTEMBER', 'OCTOBER']],
            ['title' => 'Andharban Forest Trek', 'summary' => 'A mesmerizing descent through a dark, dense jungle with continuous rain and multiple stream crossings.', 'difficulty' => 'Easy', 'duration' => 1, 'price' => 1200, 'published_status' => 'published', 'region' => 'Local Forests', 'season' => ['Monsoon'], 'best_months' => ['JULY', 'AUGUST', 'SEPTEMBER']],
            ['title' => 'Tarsar Marsar', 'summary' => 'Explore the twin glacial lakes of Kashmir on a relatively gentle but endlessly picturesque trail.', 'difficulty' => 'Moderate', 'duration' => 7, 'price' => 15500, 'published_status' => 'published', 'region' => 'Himalayas', 'season' => ['Summer', 'Monsoon'], 'best_months' => ['JULY', 'AUGUST', 'SEPTEMBER']],
            ['title' => 'Chembra Peak', 'summary' => 'A short day hike to the highest peak in Wayanad, famous for its heart-shaped lake.', 'difficulty' => 'Easy', 'duration' => 1, 'price' => 800, 'published_status' => 'published', 'region' => 'Western Ghats', 'season' => ['Winter', 'Spring'], 'best_months' => ['SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER', 'JANUARY', 'FEBRUARY']],
            ['title' => 'Kalsubai Sunrise Trek', 'summary' => 'Climb to the highest point in Maharashtra for a breathtaking sunrise above the clouds.', 'difficulty' => 'Moderate', 'duration' => 1, 'price' => 1100, 'published_status' => 'published', 'region' => 'Sahyadris', 'season' => ['Winter'], 'best_months' => ['OCTOBER', 'NOVEMBER', 'DECEMBER', 'JANUARY', 'FEBRUARY']],
            ['title' => 'Gokarna Beach Trek', 'summary' => 'Walk across five stunning beaches separated by rocky hillocks on this relaxing coastal trail.', 'difficulty' => 'Easy', 'duration' => 2, 'price' => 2500, 'published_status' => 'published', 'region' => 'Western Ghats', 'season' => ['Winter', 'Spring'], 'best_months' => ['NOVEMBER', 'DECEMBER', 'JANUARY', 'FEBRUARY']],
            ['title' => 'Kedarkantha Trek', 'summary' => 'India\'s most popular winter trek, offering magical snowy trails and a thrilling summit climb.', 'difficulty' => 'Moderate', 'duration' => 6, 'price' => 10500, 'published_status' => 'published', 'region' => 'Himalayas', 'season' => ['Winter'], 'best_months' => ['DECEMBER', 'JANUARY', 'FEBRUARY', 'MARCH']],
            ['title' => 'Brahmatal Trek', 'summary' => 'A classic winter trek known for its frozen alpine lake and close-up views of Mt. Trishul.', 'difficulty' => 'Moderate', 'duration' => 6, 'price' => 10500, 'published_status' => 'published', 'region' => 'Himalayas', 'season' => ['Winter'], 'best_months' => ['DECEMBER', 'JANUARY', 'FEBRUARY']],
            ['title' => 'Devkund Waterfall Trek', 'summary' => 'A scenic trail through dense woods ending at a spectacular hidden plunge waterfall.', 'difficulty' => 'Easy', 'duration' => 1, 'price' => 1300, 'published_status' => 'published', 'region' => 'Local Forests', 'season' => ['Monsoon'], 'best_months' => ['JULY', 'AUGUST', 'SEPTEMBER']],
            ['title' => 'Nanda Devi East Base Camp', 'summary' => 'A challenging expedition-style trek taking you close to India\'s second highest mountain.', 'difficulty' => 'Expert', 'duration' => 12, 'price' => 24000, 'published_status' => 'published', 'region' => 'Himalayas', 'season' => ['Autumn'], 'best_months' => ['SEPTEMBER', 'OCTOBER']],
            ['title' => 'Agumbe Rainforest Trek', 'summary' => 'Explore the deep, misty rainforests of Karnataka, home to king cobras and hidden falls.', 'difficulty' => 'Moderate', 'duration' => 3, 'price' => 4500, 'published_status' => 'published', 'region' => 'Western Ghats', 'season' => ['Monsoon', 'Winter'], 'best_months' => ['SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER']],
            ['title' => 'Prashar Lake Trek', 'summary' => 'A beautiful weekend hike in Himachal leading to a mysterious floating island lake.', 'difficulty' => 'Easy', 'duration' => 2, 'price' => 4000, 'published_status' => 'published', 'region' => 'Himalayas', 'season' => ['Winter'], 'best_months' => ['DECEMBER', 'JANUARY', 'FEBRUARY']]
        ];

        foreach ( as ) {
            Trek::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug(['title'])],
                
            );
        }

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
