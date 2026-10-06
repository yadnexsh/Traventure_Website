<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traventure - Trekking & Outdoors</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bg-base text-text-primary flex flex-col min-h-screen font-sans antialiased">
    
    {{-- Navigation --}}
    <header class="bg-bg-base border-b border-border-subtle sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                {{-- Desktop Logo & Main Nav --}}
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-brand-primary tracking-tight">Traventure</a>
                    </div>
                    <nav class="hidden sm:ml-8 sm:flex sm:space-x-6 items-center">
                        {{-- Treks Dropdown --}}
                        <div class="relative group h-16 flex items-center">
                            <button class="text-text-secondary hover:text-brand-primary px-3 py-2 text-sm font-medium transition-colors inline-flex items-center gap-1 {{ request()->routeIs('treks.*') ? 'text-brand-primary font-semibold' : '' }}">
                                Treks
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div class="absolute top-16 left-0 w-48 bg-bg-base border border-border-subtle rounded-md shadow-lg hidden group-hover:block z-50">
                                <div class="py-1">
                                    <a href="{{ route('treks.index') }}" class="block px-4 py-2 text-sm text-text-primary hover:bg-bg-subtle hover:text-brand-primary">All Treks</a>
                                    {{-- Deferred Categories (visually represented but linking to All Treks or placeholder for now) --}}
                                    <a href="{{ route('treks.index') }}" class="block px-4 py-2 text-sm text-text-secondary hover:bg-bg-subtle hover:text-brand-primary" title="Deferred">Sahyadri Treks</a>
                                    <a href="{{ route('treks.index') }}" class="block px-4 py-2 text-sm text-text-secondary hover:bg-bg-subtle hover:text-brand-primary" title="Deferred">Himalayan Treks</a>
                                    <a href="{{ route('treks.index') }}" class="block px-4 py-2 text-sm text-text-secondary hover:bg-bg-subtle hover:text-brand-primary" title="Deferred">Day Treks</a>
                                    <a href="{{ route('treks.index') }}" class="block px-4 py-2 text-sm text-text-secondary hover:bg-bg-subtle hover:text-brand-primary" title="Deferred">Multi-Day Treks</a>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('treks.upcoming') }}" class="text-text-secondary hover:text-brand-primary px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('treks.upcoming') ? 'text-brand-primary font-semibold' : '' }}">Upcoming Treks</a>
                        
                        <a href="#" class="text-text-secondary hover:text-brand-primary px-3 py-2 text-sm font-medium transition-colors cursor-not-allowed" title="Deferred">Leisure Trips</a>

                        {{-- Destinations Dropdown --}}
                        <div class="relative group h-16 flex items-center">
                            <button class="text-text-secondary hover:text-brand-primary px-3 py-2 text-sm font-medium transition-colors inline-flex items-center gap-1 cursor-not-allowed">
                                Destinations
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div class="absolute top-16 left-0 w-48 bg-bg-base border border-border-subtle rounded-md shadow-lg hidden group-hover:block z-50">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-text-secondary hover:bg-bg-subtle hover:text-brand-primary cursor-not-allowed" title="Deferred">Sahyadri</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-text-secondary hover:bg-bg-subtle hover:text-brand-primary cursor-not-allowed" title="Deferred">Himalayas</a>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('about') }}" class="text-text-secondary hover:text-brand-primary px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'text-brand-primary font-semibold' : '' }}">About Us</a>
                    </nav>
                </div>

                {{-- Desktop Auth/User Nav --}}
                <div class="hidden sm:flex sm:items-center sm:space-x-4">
                    @auth
                        <div class="relative group h-16 flex items-center ml-2">
                            <button class="flex items-center gap-2 text-text-secondary hover:text-brand-primary text-sm font-medium transition-colors">
                                <div class="w-8 h-8 rounded-full bg-brand-primary/10 text-brand-primary flex items-center justify-center font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span>My Profile</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div class="absolute top-16 right-0 w-48 bg-bg-base border border-border-subtle rounded-md shadow-lg hidden group-hover:block z-50">
                                <div class="py-1">
                                    <a href="{{ route('account.dashboard') }}" class="block px-4 py-2 text-sm text-text-primary hover:bg-bg-subtle hover:text-brand-primary">Dashboard</a>
                                    <a href="{{ route('customer.trips') }}" class="block px-4 py-2 text-sm text-text-secondary hover:bg-bg-subtle hover:text-brand-primary">My Trips</a>
                                    <a href="{{ route('account.profile') }}" class="block px-4 py-2 text-sm text-text-secondary hover:bg-bg-subtle hover:text-brand-primary">Profile</a>
                                    <a href="{{ route('account.security') }}" class="block px-4 py-2 text-sm text-text-secondary hover:bg-bg-subtle hover:text-brand-primary">Security</a>
                                    <div class="border-t border-border-subtle mt-1 pt-1">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-text-secondary hover:bg-bg-subtle hover:text-brand-primary">Log out</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-text-secondary hover:text-brand-primary text-sm font-medium transition-colors">Log in</a>
                        <x-button href="{{ route('register') }}" variant="primary">Sign up</x-button>
                    @endauth
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
        <div class="sm:hidden hidden bg-bg-base border-t border-border-subtle overflow-y-auto max-h-[calc(100vh-4rem)]" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <div class="px-4 py-2">
                    <span class="text-sm font-bold text-text-muted uppercase tracking-wider">Treks</span>
                </div>
                <a href="{{ route('treks.index') }}" class="block pl-8 pr-4 py-2 text-base font-medium text-text-primary hover:bg-bg-subtle hover:text-brand-primary">All Treks</a>
                <a href="#" class="block pl-8 pr-4 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary" title="Deferred">Sahyadri Treks</a>
                <a href="#" class="block pl-8 pr-4 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary" title="Deferred">Himalayan Treks</a>
                <a href="#" class="block pl-8 pr-4 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary" title="Deferred">Day Treks</a>
                <a href="#" class="block pl-8 pr-4 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary" title="Deferred">Multi-Day Treks</a>

                <a href="{{ route('treks.upcoming') }}" class="block px-4 py-2 text-base font-medium text-text-primary hover:bg-bg-subtle hover:text-brand-primary mt-2">Upcoming Treks</a>
                <a href="#" class="block px-4 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary" title="Deferred">Leisure Trips</a>
                
                <div class="px-4 py-2 mt-2">
                    <span class="text-sm font-bold text-text-muted uppercase tracking-wider">Destinations</span>
                </div>
                <a href="#" class="block pl-8 pr-4 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary" title="Deferred">Sahyadri</a>
                <a href="#" class="block pl-8 pr-4 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary" title="Deferred">Himalayas</a>

                <a href="{{ route('about') }}" class="block px-4 py-2 text-base font-medium text-text-primary hover:bg-bg-subtle hover:text-brand-primary mt-2">About Us</a>
            </div>
            
            <div class="pt-4 pb-3 border-t border-border-subtle">
                @auth
                    <div class="px-4 py-2">
                        <div class="text-base font-medium text-text-primary">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-text-muted">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('account.dashboard') }}" class="block px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">Dashboard</a>
                        <a href="{{ route('customer.trips') }}" class="block px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">My Trips</a>
                        <a href="{{ route('account.profile') }}" class="block px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">Profile</a>
                        <a href="{{ route('account.security') }}" class="block px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">Security</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">Log out</button>
                        </form>
                    </div>
                @else
                    <div class="space-y-1 px-4">
                        <a href="{{ route('login') }}" class="block py-2 text-base font-medium text-text-secondary hover:text-brand-primary">Log in</a>
                        <a href="{{ route('register') }}" class="block py-2 text-base font-medium text-brand-primary">Sign up</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-grow w-full">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-bg-subtle border-t border-border-subtle mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:justify-start mb-6 md:mb-0">
                    <span class="text-xl font-bold text-brand-primary">Traventure</span>
                </div>
                <div class="flex justify-center space-x-6 md:order-2 text-sm text-text-secondary">
                    <a href="{{ route('treks.index') }}" class="hover:text-brand-primary transition-colors">Explore Treks</a>
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-brand-primary transition-colors">Log out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-brand-primary transition-colors">Log in</a>
                    @endauth
                </div>
            </div>
            <div class="mt-8 border-t border-border-subtle pt-8 md:flex md:items-center md:justify-between">
                <p class="text-sm text-text-muted text-center md:text-left">
                    &copy; {{ date('Y') }} Traventure. All rights reserved.
                </p>
                <p class="mt-4 md:mt-0 text-sm text-text-muted text-center md:text-right">
                    Built for adventure.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
