@extends('layouts.public')

@section('content')
<div class="max-w-md mx-auto mt-16 px-4 sm:px-6">
    <x-card class="p-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-text-primary">Choose New Password</h2>
            <p class="text-sm text-text-secondary mt-1">Please enter your new password below.</p>
        </div>
        
        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div>
                <label for="email" class="block text-sm font-medium text-text-secondary mb-1">Email</label>
                <x-input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" />
                @error('email')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-text-secondary mb-1">New Password</label>
                <x-input id="password" type="password" name="password" required autocomplete="new-password" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" />
                @error('password')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-text-secondary mb-1">Confirm New Password</label>
                <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="pt-4">
                <x-button type="submit" variant="primary" class="w-full">
                    Reset Password
                </x-button>
            </div>
        </form>
    </x-card>
</div>
@endsection
