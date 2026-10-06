@extends('layouts.customer')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-text-primary">Account Security</h1>
        <p class="text-text-secondary mt-1">Manage your password and authentication methods.</p>
    </div>

    <div class="max-w-3xl space-y-8">
        
        @if(session('status') === 'password-updated')
            <x-alert type="success">
                Your password has been successfully updated.
            </x-alert>
        @endif

        {{-- Authentication State --}}
        <x-card class="p-6 md:p-8">
            <h3 class="text-lg font-medium text-text-primary mb-1">Authentication State</h3>
            <p class="text-sm text-text-muted mb-4 border-b border-border-subtle pb-4">View your current authentication methods.</p>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-bg-subtle rounded border border-border-subtle">
                    <div class="flex items-center gap-3">
                        <svg class="h-6 w-6 text-brand-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <p class="font-medium text-text-primary">Email Address</p>
                            <p class="text-sm text-text-secondary">{{ $user->email }}</p>
                        </div>
                    </div>
                    @if($user->hasVerifiedEmail())
                        <x-badge variant="success">Verified</x-badge>
                    @else
                        <x-badge variant="warning">Unverified</x-badge>
                    @endif
                </div>

                <div class="flex items-center justify-between p-4 bg-bg-subtle rounded border border-border-subtle">
                    <div class="flex items-center gap-3">
                        <svg class="h-6 w-6 text-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <div>
                            <p class="font-medium text-text-primary">Google Account</p>
                            <p class="text-sm text-text-secondary">Sign in with Google</p>
                        </div>
                    </div>
                    @if($hasGoogle)
                        <x-badge variant="success">Connected</x-badge>
                    @else
                        <x-badge variant="neutral">Not Connected</x-badge>
                    @endif
                </div>
            </div>
        </x-card>

        {{-- Change Password --}}
        <x-card class="p-6 md:p-8">
            <h3 class="text-lg font-medium text-text-primary mb-1">Update Password</h3>
            <p class="text-sm text-text-muted mb-4 border-b border-border-subtle pb-4">Ensure your account is using a long, random password to stay secure.</p>
            
            <form method="POST" action="{{ route('account.security.update') }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="max-w-md space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-text-secondary mb-1">Current Password</label>
                        <x-input id="current_password" name="current_password" type="password" required autocomplete="current-password" />
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-text-secondary mb-1">New Password</label>
                        <x-input id="password" name="password" type="password" required autocomplete="new-password" />
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-text-secondary mb-1">Confirm New Password</label>
                        <x-input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" />
                    </div>
                </div>

                <div class="flex justify-start pt-4 mt-6 border-t border-border-subtle">
                    <x-button type="submit" variant="primary">
                        Update Password
                    </x-button>
                </div>
            </form>
        </x-card>

    </div>
@endsection
