<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traventure - Customer Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bg-base text-text-primary flex flex-col min-h-screen font-sans antialiased">
    
    {{-- Header --}}
    <header class="bg-bg-base border-b border-border-subtle sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                {{-- Desktop Logo --}}
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-brand-primary tracking-tight">Traventure</a>
                    </div>
                </div>

                {{-- Desktop User Nav --}}
                <div class="hidden sm:flex sm:items-center sm:space-x-4">
                    <span class="text-text-primary text-sm font-medium px-3">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-text-secondary hover:text-brand-primary text-sm font-medium transition-colors">Log out</button>
                    </form>
                </div>

                {{-- Mobile Menu Button --}}
                <div class="flex items-center sm:hidden">
                    <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="inline-flex items-center justify-center p-2 rounded-md text-text-secondary hover:text-brand-primary hover:bg-bg-subtle focus:outline-none focus:ring-2 focus:ring-inset focus:ring-brand-primary" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div class="sm:hidden hidden bg-bg-base border-t border-border-subtle" id="mobile-menu">
            <div class="pt-4 pb-3 border-t border-border-subtle">
                <div class="px-4 py-2">
                    <div class="text-base font-medium text-text-primary">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-text-muted">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('account.dashboard') }}" class="block px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">Dashboard</a>
                    <a href="{{ route('customer.trips') }}" class="block px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">My Trips</a>
                    <a href="{{ route('account.profile') }}" class="block px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">Profile</a>
                    <a href="{{ route('account.security') }}" class="block px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">Account Security</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">Log out</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    {{-- Sub Navigation (Desktop) --}}
    <div class="hidden sm:block bg-bg-subtle border-b border-border-subtle">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex space-x-8 h-12 items-center text-sm font-medium">
                <a href="{{ route('account.dashboard') }}" class="px-1 py-3 h-full border-b-2 {{ request()->routeIs('account.dashboard') ? 'border-brand-primary text-brand-primary' : 'border-transparent text-text-secondary hover:text-text-primary hover:border-border-subtle' }}">
                    Dashboard
                </a>
                <a href="{{ route('customer.trips') }}" class="px-1 py-3 h-full border-b-2 {{ request()->routeIs('customer.trips') ? 'border-brand-primary text-brand-primary' : 'border-transparent text-text-secondary hover:text-text-primary hover:border-border-subtle' }}">
                    My Trips
                </a>
                <a href="{{ route('account.profile') }}" class="px-1 py-3 h-full border-b-2 {{ request()->routeIs('account.profile') ? 'border-brand-primary text-brand-primary' : 'border-transparent text-text-secondary hover:text-text-primary hover:border-border-subtle' }}">
                    Profile
                </a>
                <a href="{{ route('account.security') }}" class="px-1 py-3 h-full border-b-2 {{ request()->routeIs('account.security') ? 'border-brand-primary text-brand-primary' : 'border-transparent text-text-secondary hover:text-text-primary hover:border-border-subtle' }}">
                    Account Security
                </a>
            </nav>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="flex-grow w-full py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-bg-subtle border-t border-border-subtle mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-center">
            <p class="text-sm text-text-muted">
                &copy; {{ date('Y') }} Traventure. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
