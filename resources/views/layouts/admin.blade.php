<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Traventure</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900 flex flex-col min-h-screen">
    <header class="bg-blue-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="font-bold text-xl tracking-wide">Traventure Admin</a>
                <nav class="ml-10 hidden md:flex space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-800 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-800' : '' }}">Dashboard</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 cursor-not-allowed" title="Not yet implemented">Treks</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 cursor-not-allowed" title="Not yet implemented">Departures</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 cursor-not-allowed" title="Not yet implemented">Offline Bookings</a>
                    <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 cursor-not-allowed" title="Not yet implemented">Reservations</a>
                </nav>
            </div>
            <div>
                <span class="text-sm mr-4">{{ auth()->user()->name }}</span>
                <a href="{{ url('/') }}" class="text-sm bg-blue-700 hover:bg-blue-600 px-3 py-2 rounded text-white mr-2">Public Site</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm bg-red-600 hover:bg-red-700 px-3 py-2 rounded text-white">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        @yield('content')
    </main>
</body>
</html>
