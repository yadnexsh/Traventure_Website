@props(['departure', 'trekPrice' => null])

@php
    $isFull = $departure->online_availability <= 0;
    $hasLowAvailability = $departure->online_availability > 0 && $departure->online_availability <= 5; 
@endphp

<x-card class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-6 mb-4 hover:shadow-md transition-shadow">
    <div class="flex-grow">
        <div class="flex flex-wrap items-center gap-3 mb-2">
            <h4 class="text-xl font-bold text-text-primary">
                {{ $departure->start_time->format('d M Y') }}
            </h4>
            @if($departure->end_time)
                <span class="text-text-muted">to</span>
                <span class="text-lg font-semibold text-text-secondary">
                    {{ $departure->end_time->format('d M Y') }}
                </span>
            @endif
        </div>
        
        <div class="mt-2 flex flex-col sm:flex-row gap-4 sm:items-center">
            @if($trekPrice)
                <div class="font-bold text-text-primary text-lg">
                    ₹{{ number_format($trekPrice / 100) }}
                </div>
            @endif
            
            <div>
                @if($isFull)
                    <x-badge variant="full">Fully booked</x-badge>
                @elseif($hasLowAvailability)
                    <x-badge variant="limited">Only {{ $departure->online_availability }} seats left</x-badge>
                @else
                    <x-badge variant="available">{{ $departure->online_availability }} seats available</x-badge>
                @endif
            </div>
        </div>
    </div>
    
    <div class="mt-6 sm:mt-0 sm:ml-6 flex-shrink-0 flex flex-col items-stretch sm:items-end">
        @if($isFull)
            <x-button href="{{ route('interest.create', $departure) }}" variant="secondary" class="w-full sm:w-auto">
                Interested in this batch
            </x-button>
        @else
            <x-button href="#" variant="accent" class="w-full sm:w-auto" onclick="alert('Booking UX deferred to M10.5'); return false;">
                Choose Departure
            </x-button>
        @endif
    </div>
</x-card>
