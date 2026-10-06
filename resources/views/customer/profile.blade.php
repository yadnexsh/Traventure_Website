@extends('layouts.customer')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-text-primary">My Profile</h1>
        <p class="text-text-secondary mt-1">Manage your personal information.</p>
    </div>

    <div class="max-w-3xl">
        <x-card class="p-6 md:p-8">
            
            @if(session('status') === 'profile-updated')
                <x-alert type="success" class="mb-6">
                    Your profile information has been successfully updated.
                </x-alert>
            @endif

            <form method="POST" action="{{ route('account.profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <h3 class="text-lg font-medium text-text-primary mb-1">Personal Details</h3>
                    <p class="text-sm text-text-muted mb-4 border-b border-border-subtle pb-4">Update your basic profile information.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-text-secondary mb-1">Full Name</label>
                        <x-input id="name" name="name" type="text" required value="{{ old('name', $user->name) }}" />
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-text-secondary mb-1">Email Address</label>
                        <x-input id="email" name="email" type="email" value="{{ $user->email }}" disabled class="bg-bg-subtle cursor-not-allowed" />
                        <p class="mt-1 text-xs text-text-muted">Email address cannot be changed currently.</p>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-text-secondary mb-1">Phone Number</label>
                        <x-input id="phone" name="phone" type="tel" value="{{ old('phone', $customerRecord->phone ?? '') }}" />
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4 mt-6 border-t border-border-subtle">
                    <x-button type="submit" variant="primary">
                        Save Changes
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
