<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Operations - Traventure</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bg-subtle font-sans antialiased text-text-primary flex flex-col min-h-screen">
    <header class="bg-bg-base border-b border-border-subtle shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="font-bold text-xl text-brand-primary tracking-tight">Traventure <span class="text-text-muted font-normal text-sm ml-1">Operations</span></a>
                <nav class="ml-10 hidden md:flex space-x-1">
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-brand-primary/10 text-brand-primary' : 'text-text-secondary hover:text-brand-primary hover:bg-bg-subtle' }}">Dashboard</a>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.treks.index') }}" class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('admin.treks.*') ? 'bg-brand-primary/10 text-brand-primary' : 'text-text-secondary hover:text-brand-primary hover:bg-bg-subtle' }}">Treks</a>
                    @endif
                    <a href="{{ route('admin.departures.index') }}" class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('admin.departures.*') ? 'bg-brand-primary/10 text-brand-primary' : 'text-text-secondary hover:text-brand-primary hover:bg-bg-subtle' }}">Departures</a>
                    <a href="{{ route('admin.reservations.index') }}" class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('admin.reservations.*') ? 'bg-brand-primary/10 text-brand-primary' : 'text-text-secondary hover:text-brand-primary hover:bg-bg-subtle' }}">Reservations</a>
                    <a href="{{ route('admin.reservations.create') }}" class="px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('admin.reservations.create') ? 'bg-brand-primary/10 text-brand-primary' : 'text-text-secondary hover:text-brand-primary hover:bg-bg-subtle' }}">Offline Booking</a>
                </nav>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="hidden sm:flex items-center text-sm font-medium text-text-secondary">
                    <div class="w-8 h-8 rounded-full bg-brand-primary/10 text-brand-primary flex items-center justify-center font-bold mr-2">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    {{ auth()->user()->name }}
                    <span class="ml-2 px-2 py-0.5 rounded text-xs font-bold {{ auth()->user()->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }} uppercase">
                        {{ auth()->user()->role }}
                    </span>
                </div>
                
                <a href="{{ url('/') }}" class="text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">Public Site</a>
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-text-secondary hover:text-status-danger transition-colors">Log out</button>
                </form>
            </div>
        </div>
    </header>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        @if (session('success'))
            <div class="bg-status-success/10 border border-status-success text-status-success px-4 py-3 rounded-lg mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-status-danger/10 border border-status-danger text-status-danger p-4 rounded-lg mb-6">
                <div class="flex">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="text-sm font-bold">There were errors with your submission</h3>
                        <div class="mt-2 text-sm">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
