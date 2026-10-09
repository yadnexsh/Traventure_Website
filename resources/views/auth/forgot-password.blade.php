@extends('layouts.public')

@section('content')
<div class="max-w-md mx-auto mt-16 px-4 sm:px-6">
    <x-card>
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-text-primary">Reset Password</h2>
            <p class="text-sm text-text-secondary mt-1">We'll send you a link to reset your password.</p>
        </div>
        
        <div class="mb-6 text-sm text-text-secondary">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        @if (session('status'))
            <x-alert type="success" class="mb-6">
                {{ session('status') }}
            </x-alert>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-medium text-text-secondary mb-1">Email Address</label>
                <x-input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" />
                @error('email')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <x-button type="submit" variant="primary" class="w-full">
                    Email Password Reset Link
                </x-button>
            </div>
            
            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-sm text-brand-primary font-medium hover:underline">Back to login</a>
            </div>
        </form>
    </x-card>
</div>
@endsection
