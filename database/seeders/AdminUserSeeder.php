<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@traventure.local');

        if (User::where('email', $adminEmail)->exists()) {
            $this->command->info("Admin user {$adminEmail} already exists.");
            return;
        }

        $password = env('ADMIN_INITIAL_PASSWORD') ?: Str::password(16);

        $user = User::create([
            'name' => 'System Administrator',
            'email' => $adminEmail,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
            'role' => 'Admin'
        ]);

        $this->command->info("Admin provisioned successfully!");
        $this->command->info("Email: {$adminEmail}");
        if (!env('ADMIN_INITIAL_PASSWORD')) {
            $this->command->warn("Generated Password: {$password}");
            $this->command->warn("Please save this password immediately. It will not be shown again.");
        }
    }
}
