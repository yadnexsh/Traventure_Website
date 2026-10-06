@extends('layouts.customer')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-text-primary">Welcome back, {{ Auth::user()->name }}</h1>
        <p class="text-text-secondary mt-1">Here is an overview of your adventures.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <section>
                <div class="flex justify-between items-end mb-4">
                    <h2 class="text-xl font-bold text-text-primary">Upcoming Trips</h2>
                    @if($upcomingTrips->count() > 0)
                        <a href="{{ route('customer.trips') }}" class="text-sm font-medium text-brand-primary hover:underline">View all</a>
                    @endif
                </div>

                @if($upcomingTrips->count() > 0)
                    <div class="space-y-4">
                        @foreach($upcomingTrips as $reservation)
                            <x-card class="p-5 flex flex-col sm:flex-row sm:justify-between sm:items-center hover:shadow-md transition-shadow">
                                <div class="mb-4 sm:mb-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="text-lg font-bold text-text-primary">{{ $reservation->departure->trek->title }}</h3>
                                    </div>
                                    <p class="text-text-secondary text-sm">{{ $reservation->departure->start_time->format('d M Y') }} &bull; {{ $reservation->status }}</p>
                                </div>
                                
                                <div>
                                    <x-button href="{{ route('customer.trip.show', $reservation) }}" variant="primary" class="w-full sm:w-auto text-sm">
                                        View Trip
                                    </x-button>
                                </div>
                            </x-card>
                        @endforeach
                    </div>
                @else
                    <x-card class="p-8 text-center bg-bg-subtle border-dashed border-2 border-border-subtle">
                        <p class="text-text-secondary mb-4">You have no upcoming trips.</p>
                        <x-button href="{{ route('treks.index') }}" variant="primary">Explore Treks</x-button>
                    </x-card>
                @endif
            </section>

            <section>
                <div class="flex justify-between items-end mb-4">
                    <h2 class="text-lg font-bold text-text-primary">Recent History</h2>
                </div>

                @if($pastTrips->count() > 0)
                    <div class="space-y-4">
                        @foreach($pastTrips as $reservation)
                            <x-card class="p-4 flex flex-col sm:flex-row sm:justify-between sm:items-center bg-bg-subtle opacity-90">
                                <div>
                                    <h3 class="font-bold text-text-primary text-sm">{{ $reservation->departure->trek->title }}</h3>
                                    <p class="text-text-muted text-xs mt-1">{{ $reservation->departure->start_time->format('d M Y') }} &bull; {{ $reservation->status === 'Cancelled' ? 'Cancelled' : 'Completed' }}</p>
                                </div>
                                <div class="mt-3 sm:mt-0">
                                    <a href="{{ route('customer.trip.show', $reservation) }}" class="text-sm font-medium text-brand-primary hover:underline">View</a>
                                </div>
                            </x-card>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-text-muted">No past trips yet.</p>
                @endif
            </section>
        </div>

        <div class="lg:col-span-1">
            <x-card class="p-6 bg-bg-subtle border-border-subtle sticky top-24">
                <h3 class="text-sm font-bold text-text-primary uppercase tracking-wider mb-4 border-b border-border-subtle pb-2">Account Links</h3>
                <nav class="space-y-2">
                    <a href="{{ route('account.profile') }}" class="flex items-center justify-between text-text-secondary hover:text-brand-primary p-2 rounded hover:bg-white transition-colors">
                        <span class="font-medium text-sm">My Profile</span>
                        <span class="text-text-muted">&rarr;</span>
                    </a>
                    <a href="{{ route('account.security') }}" class="flex items-center justify-between text-text-secondary hover:text-brand-primary p-2 rounded hover:bg-white transition-colors">
                        <span class="font-medium text-sm">Account Security</span>
                        <span class="text-text-muted">&rarr;</span>
                    </a>
                    <a href="{{ route('customer.trips') }}" class="flex items-center justify-between text-text-secondary hover:text-brand-primary p-2 rounded hover:bg-white transition-colors">
                        <span class="font-medium text-sm">All My Trips</span>
                        <span class="text-text-muted">&rarr;</span>
                    </a>
                </nav>
            </x-card>
        </div>
    </div>
@endsection
