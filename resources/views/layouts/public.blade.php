<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traventure</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 flex flex-col min-h-screen">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">Traventure</a>
                    </div>
                    <div class="ml-6 flex items-center space-x-4">
                        <a href="{{ route('treks.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Treks</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-gray-700 text-sm font-medium">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Sign in</a>
                        <a href="{{ route('register') }}" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; {{ date('Y') }} Traventure. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
