@extends('layouts.public')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <div class="bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Welcome back</h2>
        
        <div class="mb-6">
            <a href="{{ route('google.redirect') }}" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                Continue with Google
            </a>
        </div>
        
        <div class="relative mb-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">OR</span>
            </div>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                @error('email')
                    <p class="text-red-500 text-xs mt-1" id="email-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                @error('password')
                    <p class="text-red-500 text-xs mt-1" id="password-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="block mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-between mb-4">
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    Sign in
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:underline">Don't have an account? Register</a>
        </div>
    </div>
</div>
@endsection
