@extends('layouts.public')

@section('content')
<div class="max-w-md mx-auto mt-16 px-4 sm:px-6">
    <x-card class="p-8">
        <div class="text-center mb-6">
            <svg class="mx-auto h-12 w-12 text-brand-primary mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
            </svg>
            <h2 class="text-2xl font-bold text-text-primary">Verify Your Email Address</h2>
        </div>
        
        <div class="mb-6 text-sm text-text-secondary text-center">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        @if (session('status') == 'verification-link-sent')
            <x-alert type="success" class="mb-6">
                A new verification link has been sent to the email address you provided during registration.
            </x-alert>
        @endif

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                @csrf
                <x-button type="submit" variant="primary" class="w-full">
                    Resend Verification Email
                </x-button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="text-sm font-medium text-text-secondary hover:text-brand-primary underline transition-colors w-full text-center">
                    Log Out
                </button>
            </form>
        </div>
    </x-card>
</div>
@endsection
