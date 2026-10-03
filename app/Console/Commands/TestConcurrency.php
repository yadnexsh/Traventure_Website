<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('test:concurrency {userId} {departureId}')]
#[Description('Attempts to book a seat. Used for testing concurrency.')]
class TestConcurrency extends Command
{
    public function handle()
    {
        $userId = $this->argument('userId');
        $departureId = $this->argument('departureId');

        $user = \App\Models\User::find($userId);
        if (!$user) {
            $this->error('USER_NOT_FOUND');
            return;
        }

        $service = new \App\Services\Booking\BookingService();

        try {
            $service->createOnlineHold($user, $departureId);
            $this->info('SUCCESS');
        } catch (\Exception $e) {
            $this->error('FAILED: ' . $e->getMessage());
        }
    }
}
