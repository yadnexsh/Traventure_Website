<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traventure - Trekking & Outdoors</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-bg-base text-text-primary flex flex-col min-h-screen font-sans antialiased">
    
    @php
        $isHome = request()->routeIs('home');
    @endphp

    {{-- Navigation --}}
    <header id="main-header" class="w-full z-50 transition-all duration-300 {{ $isHome ? 'fixed top-0 bg-transparent border-transparent' : 'sticky top-0 bg-bg-base border-b border-border-subtle text-text-primary' }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                {{-- Desktop Logo & Main Nav --}}
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center mr-8">
                        <a href="{{ route('home') }}" class="flex items-center relative block">
                            {{-- Invisible placeholder to maintain width --}}
                            <img src="{{ asset('media/logo/tot_white.png') }}" class="h-8 md:h-10 w-auto object-contain invisible" aria-hidden="true" alt="">
                            
                            {{-- White logo for transparent header --}}
                            <img src="{{ asset('media/logo/tot_white.png') }}" alt="Traventure" id="logo-white" class="absolute inset-0 h-full w-full object-contain transition-opacity duration-300 {{ $isHome ? 'opacity-100' : 'opacity-0' }}">
                            
                            {{-- Cyan logo for solid white header --}}
                            <img src="{{ asset('media/logo/tot_cyan.png') }}" alt="Traventure" id="logo-cyan" class="absolute inset-0 h-full w-full object-contain transition-opacity duration-300 {{ $isHome ? 'opacity-0' : 'opacity-100' }}">
                        </a>
                    </div>
                    <nav class="hidden lg:flex lg:space-x-8 items-center" id="desktop-nav">
                        
                        {{-- Treks Dropdown --}}
                        <div class="relative group">
                            <button class="nav-link flex items-center space-x-1 py-8 text-sm font-medium transition-colors {{ $isHome ? 'text-white/90 hover:text-white' : 'text-text-secondary hover:text-brand-primary' }}">
                                <span>Treks</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            
                            {{-- Dropdown Menu --}}
                            <div class="absolute left-0 top-full w-[600px] bg-bg-base border border-border-subtle shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform translate-y-2 group-hover:translate-y-0 z-50">
                                <div class="grid grid-cols-2 p-8 gap-8">
                                    {{-- Column 1 --}}
                                    <div class="space-y-6">
                                        <div>
                                            <h4 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-3">Explore</h4>
                                            <ul class="space-y-2">
                                                <li><a href="{{ route('treks.index') }}" class="text-sm font-medium text-text-primary hover:text-brand-primary">All Treks</a></li>
                                                <li><a href="{{ route('treks.index') }}" class="text-sm font-medium text-text-primary hover:text-brand-primary">Upcoming Treks</a></li>
                                            </ul>
                                        </div>
                                        <div>
                                            <h4 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-3">Find Your Trek</h4>
                                            <ul class="space-y-2">
                                                <li><a href="#" class="text-sm text-text-secondary hover:text-brand-primary">Treks by Month</a></li>
                                                <li><a href="#" class="text-sm text-text-secondary hover:text-brand-primary">Treks by Season</a></li>
                                                <li><a href="#" class="text-sm text-text-secondary hover:text-brand-primary">Treks by Difficulty</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- Column 2 --}}
                                    <div class="space-y-6">
                                        <div>
                                            <h4 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-3">Regions</h4>
                                            <ul class="space-y-2">
                                                <li><a href="#" class="text-sm text-text-secondary hover:text-brand-primary flex justify-between items-center">Sahyadri Treks <span class="text-[10px] bg-bg-subtle px-2 py-0.5 rounded text-text-muted uppercase">Soon</span></a></li>
                                                <li><a href="#" class="text-sm text-text-secondary hover:text-brand-primary flex justify-between items-center">Himalayan Treks <span class="text-[10px] bg-bg-subtle px-2 py-0.5 rounded text-text-muted uppercase">Soon</span></a></li>
                                            </ul>
                                        </div>
                                        <div>
                                            <h4 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-3">Trip Type</h4>
                                            <ul class="space-y-2">
                                                <li><a href="#" class="text-sm text-text-secondary hover:text-brand-primary flex justify-between items-center">Day Treks <span class="text-[10px] bg-bg-subtle px-2 py-0.5 rounded text-text-muted uppercase">Soon</span></a></li>
                                                <li><a href="#" class="text-sm text-text-secondary hover:text-brand-primary flex justify-between items-center">Multi-Day Treks <span class="text-[10px] bg-bg-subtle px-2 py-0.5 rounded text-text-muted uppercase">Soon</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-bg-subtle p-6 border-t border-border-subtle">
                                    <p class="text-sm text-text-secondary">Looking for something specific? <a href="{{ route('treks.index') }}" class="font-medium text-brand-primary hover:underline">View all upcoming departures &rarr;</a></p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('treks.index') }}" class="nav-link text-sm font-medium transition-colors {{ $isHome ? 'text-white/90 hover:text-white' : 'text-text-secondary hover:text-brand-primary' }}">Upcoming Treks</a>
                        <a href="#" class="nav-link text-sm font-medium transition-colors {{ $isHome ? 'text-white/90 hover:text-white' : 'text-text-secondary hover:text-brand-primary' }}">Leisure Trips</a>
                        <a href="#" class="nav-link text-sm font-medium transition-colors {{ $isHome ? 'text-white/90 hover:text-white' : 'text-text-secondary hover:text-brand-primary' }}">About Us</a>
                    </nav>
                </div>

                {{-- Desktop Auth/User Nav --}}
                <div class="hidden lg:flex lg:items-center lg:space-x-4">
                    @auth
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
                            <a href="{{ route('admin.dashboard') }}" class="nav-link text-sm font-medium transition-colors {{ $isHome ? 'text-white/90 hover:text-white' : 'text-text-secondary hover:text-brand-primary' }}">Dashboard</a>
                        @endif
                        <a href="{{ route('customer.trips') }}" class="nav-link text-sm font-medium transition-colors {{ $isHome ? 'text-white/90 hover:text-white' : 'text-text-secondary hover:text-brand-primary' }}">My Trips</a>
                        <span class="nav-link text-sm font-medium px-3 transition-colors {{ $isHome ? 'text-white' : 'text-text-primary' }}">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="nav-link text-sm font-medium transition-colors {{ $isHome ? 'text-white/90 hover:text-white' : 'text-text-secondary hover:text-brand-primary' }}">Log out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-link text-sm font-medium transition-colors {{ $isHome ? 'text-white/90 hover:text-white' : 'text-text-secondary hover:text-brand-primary' }}">Log in</a>
                        <x-button href="{{ route('register') }}" variant="{{ $isHome ? 'outline' : 'primary' }}" class="auth-btn transition-colors {{ $isHome ? 'text-white border-white hover:bg-white hover:text-black' : '' }}">Sign up</x-button>
                    @endauth
                </div>

                {{-- Mobile Menu Button --}}
                <div class="flex items-center lg:hidden">
                    <button type="button" id="mobile-menu-btn" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="inline-flex items-center justify-center p-2 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-inset focus:ring-brand-primary {{ $isHome ? 'text-white' : 'text-text-secondary hover:text-brand-primary hover:bg-bg-subtle' }}" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div class="lg:hidden hidden bg-bg-base border-t border-border-subtle max-h-[80vh] overflow-y-auto" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <div class="px-4 py-2 font-bold text-text-muted uppercase text-xs tracking-wider">Explore</div>
                <a href="{{ route('treks.index') }}" class="block px-6 py-2 text-base font-medium text-text-primary hover:bg-bg-subtle hover:text-brand-primary">All Treks</a>
                <a href="{{ route('treks.index') }}" class="block px-6 py-2 text-base font-medium text-text-primary hover:bg-bg-subtle hover:text-brand-primary">Upcoming Treks</a>
                
                <div class="px-4 py-2 mt-2 font-bold text-text-muted uppercase text-xs tracking-wider">Find Your Trek</div>
                <a href="#" class="block px-6 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary">Treks by Month</a>
                <a href="#" class="block px-6 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary">Treks by Season</a>
                <a href="#" class="block px-6 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary">Treks by Difficulty</a>
                
                <div class="px-4 py-2 mt-2 font-bold text-text-muted uppercase text-xs tracking-wider">Regions</div>
                <a href="#" class="block px-6 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary flex justify-between items-center">Sahyadri Treks <span class="text-[10px] bg-bg-subtle px-2 py-0.5 rounded text-text-muted uppercase">Soon</span></a>
                <a href="#" class="block px-6 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary flex justify-between items-center">Himalayan Treks <span class="text-[10px] bg-bg-subtle px-2 py-0.5 rounded text-text-muted uppercase">Soon</span></a>

                <div class="px-4 py-2 mt-2 font-bold text-text-muted uppercase text-xs tracking-wider">Trip Type</div>
                <a href="#" class="block px-6 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary flex justify-between items-center">Day Treks <span class="text-[10px] bg-bg-subtle px-2 py-0.5 rounded text-text-muted uppercase">Soon</span></a>
                <a href="#" class="block px-6 py-2 text-base font-medium text-text-secondary hover:bg-bg-subtle hover:text-brand-primary flex justify-between items-center">Multi-Day Treks <span class="text-[10px] bg-bg-subtle px-2 py-0.5 rounded text-text-muted uppercase">Soon</span></a>

            </div>
            <div class="pt-4 pb-3 border-t border-border-subtle">
                @auth
                    <div class="px-4 py-2">
                        <div class="text-base font-medium text-text-primary">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-text-muted">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('customer.trips') }}" class="block px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">My Trips</a>
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-text-secondary hover:text-brand-primary hover:bg-bg-subtle">Log out</button>
                        </form>
                    </div>
                @else
                    <div class="space-y-1 px-4 mb-4">
                        <a href="{{ route('login') }}" class="block py-2 text-base font-medium text-text-secondary hover:text-brand-primary">Log in</a>
                        <a href="{{ route('register') }}" class="block py-2 text-base font-medium text-brand-primary">Sign up</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    @if($isHome)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('main-header');
            const logoWhite = document.getElementById('logo-white');
            const logoCyan = document.getElementById('logo-cyan');
            const navLinks = document.querySelectorAll('.nav-link');
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const authBtn = document.querySelector('.auth-btn');

            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    // Solid State
                    header.classList.remove('bg-transparent', 'border-transparent');
                    header.classList.add('bg-bg-base', 'border-b', 'border-border-subtle', 'shadow-sm');
                    
                    if (logoWhite && logoCyan) {
                        logoWhite.classList.remove('opacity-100');
                        logoWhite.classList.add('opacity-0');
                        logoCyan.classList.remove('opacity-0');
                        logoCyan.classList.add('opacity-100');
                    }

                    navLinks.forEach(link => {
                        link.classList.remove('text-white/90', 'text-white', 'hover:text-white');
                        if (link.tagName === 'SPAN') {
                            link.classList.add('text-text-primary');
                        } else {
                            link.classList.add('text-text-secondary', 'hover:text-brand-primary');
                        }
                    });

                    mobileMenuBtn.classList.remove('text-white');
                    mobileMenuBtn.classList.add('text-text-secondary', 'hover:text-brand-primary', 'hover:bg-bg-subtle');

                    if (authBtn) {
                        authBtn.classList.remove('text-white', 'border-white', 'hover:bg-white', 'hover:text-black', 'bg-transparent');
                        authBtn.classList.add('bg-brand-primary', 'text-white', 'hover:bg-brand-primary/90', 'border-transparent');
                    }

                } else {
                    // Transparent State
                    header.classList.remove('bg-bg-base', 'border-b', 'border-border-subtle', 'shadow-sm');
                    header.classList.add('bg-transparent', 'border-transparent');
                    
                    if (logoWhite && logoCyan) {
                        logoWhite.classList.remove('opacity-0');
                        logoWhite.classList.add('opacity-100');
                        logoCyan.classList.remove('opacity-100');
                        logoCyan.classList.add('opacity-0');
                    }

                    navLinks.forEach(link => {
                        if (link.tagName === 'SPAN') {
                            link.classList.remove('text-text-primary');
                            link.classList.add('text-white');
                        } else {
                            link.classList.remove('text-text-secondary', 'hover:text-brand-primary');
                            link.classList.add('text-white/90', 'hover:text-white');
                        }
                    });

                    mobileMenuBtn.classList.remove('text-text-secondary', 'hover:text-brand-primary', 'hover:bg-bg-subtle');
                    mobileMenuBtn.classList.add('text-white');

                    if (authBtn) {
                        authBtn.classList.remove('bg-brand-primary', 'hover:bg-brand-primary/90', 'border-transparent');
                        authBtn.classList.add('bg-transparent', 'text-white', 'border-white', 'hover:bg-white', 'hover:text-black');
                    }
                }
            });
        });
    </script>
    @endif

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
