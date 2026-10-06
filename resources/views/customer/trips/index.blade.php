@extends('layouts.customer')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-text-primary">My Trips</h1>
    </div>

    @if($upcomingTrips->count() > 0 || $pastTrips->count() > 0)
        
        @if($upcomingTrips->count() > 0)
            <h2 class="text-xl font-bold text-text-primary mb-4">Upcoming Trips</h2>
            <div class="space-y-6 mb-12">
                @foreach($upcomingTrips as $reservation)
                    <x-card class="p-6 flex flex-col sm:flex-row sm:justify-between sm:items-center hover:shadow-md transition-shadow">
                        <div class="mb-4 sm:mb-0">
                            <div class="flex items-center gap-3 mb-1">
                                <h3 class="text-lg font-bold text-text-primary">{{ $reservation->departure->trek->title }}</h3>
                                <x-badge variant="{{ $reservation->status === 'Confirmed' ? 'success' : ($reservation->status === 'Cancelled' ? 'danger' : 'warning') }}">{{ $reservation->status }}</x-badge>
                            </div>
                            <p class="text-text-secondary text-sm">{{ $reservation->departure->start_time->format('d M Y') }} &bull; {{ $reservation->departure->trek->duration }} days</p>
                            <div class="text-text-muted text-xs mt-2 flex items-center gap-4">
                                <span>Ref: TRV-{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</span>
                                <span>{{ $reservation->trekmates()->count() }} Participant(s)</span>
                                <span class="{{ $reservation->payment_status === 'Paid' ? 'text-green-600' : 'text-red-600' }} font-medium">{{ $reservation->payment_status }}</span>
                            </div>
                        </div>
                        
                        <div>
                            <x-button href="{{ route('customer.trip.show', $reservation) }}" variant="secondary">
                                View Details
                            </x-button>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif

        @if($pastTrips->count() > 0)
            <h2 class="text-xl font-bold text-text-primary mb-4">Past & Cancelled Trips</h2>
            <div class="space-y-6">
                @foreach($pastTrips as $reservation)
                    <x-card class="p-6 flex flex-col sm:flex-row sm:justify-between sm:items-center bg-bg-subtle opacity-90 border-border-subtle">
                        <div class="mb-4 sm:mb-0">
                            <div class="flex items-center gap-3 mb-1">
                                <h3 class="text-lg font-bold text-text-primary">{{ $reservation->departure->trek->title }}</h3>
                                <x-badge variant="{{ $reservation->status === 'Cancelled' ? 'danger' : 'neutral' }}">{{ $reservation->status === 'Cancelled' ? 'Cancelled' : 'Completed' }}</x-badge>
                            </div>
                            <p class="text-text-secondary text-sm">{{ $reservation->departure->start_time->format('d M Y') }}</p>
                            <p class="text-text-muted text-xs mt-2">Ref: TRV-{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        
                        <div>
                            <x-button href="{{ route('customer.trip.show', $reservation) }}" variant="secondary" class="text-sm">
                                View Details
                            </x-button>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif

    @else
        <div class="max-w-2xl mx-auto mt-12">
            <x-empty-state 
                title="No trips yet" 
                description="You haven't booked any adventures with us yet. Ready to start exploring?"
            />
            <div class="text-center mt-6">
                <x-button href="{{ route('treks.index') }}" variant="primary">Explore Treks</x-button>
            </div>
        </div>
    @endif
@endsection
