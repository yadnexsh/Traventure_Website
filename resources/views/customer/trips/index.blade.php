@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <x-page-header title="My Trips" description="View and manage your bookings." />

    @if($reservations->count() > 0)
        <div class="space-y-6">
            @foreach($reservations as $reservation)
                <x-card class="p-6 flex flex-col sm:flex-row sm:justify-between sm:items-center hover:shadow-md transition-shadow">
                    <div class="mb-4 sm:mb-0">
                        <div class="flex items-center gap-3 mb-1">
                            <h3 class="text-lg font-bold text-text-primary">{{ $reservation->departure->trek->title }}</h3>
                            <x-badge variant="{{ $reservation->status === 'Confirmed' ? 'success' : 'warning' }}">{{ $reservation->status }}</x-badge>
                        </div>
                        <p class="text-text-secondary text-sm">{{ $reservation->departure->start_time->format('d M Y') }} &bull; {{ $reservation->departure->trek->duration }} days</p>
                        <p class="text-text-muted text-xs mt-1">Ref: TRV-{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    
                    <div>
                        <x-button href="{{ route('customer.trip.show', $reservation) }}" variant="secondary">
                            View Details
                        </x-button>
                    </div>
                </x-card>
            @endforeach
        </div>
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
</div>
@endsection
