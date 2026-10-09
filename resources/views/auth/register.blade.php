@extends('layouts.public')

@section('content')
<div class="max-w-md mx-auto mt-16 px-4 sm:px-6">
    <x-card>
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-text-primary">Create your account</h2>
            <p class="text-sm text-text-secondary mt-1">Join Traventure and start booking your next adventure.</p>
        </div>

        <div class="mb-6">
            <a href="{{ route('google.redirect') }}" class="w-full flex justify-center items-center py-2 px-4 border border-border-subtle rounded shadow-sm bg-white text-sm font-medium text-text-primary hover:bg-bg-subtle transition-colors">
                <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                Continue with Google
            </a>
        </div>
        
        <div class="relative mb-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-border-subtle"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-bg-surface text-text-muted">OR</span>
            </div>
        </div>
        
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-medium text-text-secondary mb-1">Full Name</label>
                <x-input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}" />
                @error('name')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-text-secondary mb-1">Email</label>
                <x-input id="email" type="email" name="email" value="{{ old('email') }}" required aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" />
                @error('email')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-text-secondary mb-1">Password</label>
                <x-input id="password" type="password" name="password" required autocomplete="new-password" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" />
                @error('password')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-text-secondary mb-1">Confirm Password</label>
                <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="pt-4">
                <x-button type="submit" variant="primary" class="w-full">
                    Create Account
                </x-button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <span class="text-sm text-text-secondary">Already have an account?</span>
            <a href="{{ route('login') }}" class="text-sm text-brand-primary font-medium hover:underline ml-1">Sign in</a>
        </div>
    </x-card>
</div>
@endsection
