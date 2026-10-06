@props(['departure', 'trekPrice' => null])

@php
    $isFull = $departure->online_availability <= 0;
    $hasLowAvailability = $departure->online_availability > 0 && $departure->online_availability <= 5; 
@endphp

<div class="bg-bg-base border border-border-subtle rounded-lg shadow-sm hover:border-border-strong hover:shadow-md transition-all mb-4 overflow-hidden">
    <div class="p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div class="flex-grow">
            <div class="flex flex-wrap items-baseline gap-2 mb-3">
                <h4 class="text-lg font-bold text-text-primary">
                    {{ $departure->start_time->format('d M Y') }}
                </h4>
                @if($departure->end_time)
                    <span class="text-text-muted text-sm px-1">to</span>
                    <span class="text-base font-semibold text-text-secondary">
                        {{ $departure->end_time->format('d M Y') }}
                    </span>
                @endif
            </div>
            
            <div class="flex flex-wrap items-center gap-4">
                @if($trekPrice)
                    <div class="font-bold text-text-primary text-lg">
                        ₹{{ number_format($trekPrice / 100) }}
                    </div>
                    <div class="h-4 w-px bg-border-strong hidden sm:block"></div>
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
        
        <div class="flex-shrink-0 flex flex-col items-stretch sm:items-end w-full sm:w-auto">
            @if($isFull)
                <x-button href="{{ route('interest.create', $departure) }}" variant="secondary" class="w-full sm:w-auto whitespace-nowrap">
                    Notify Me
                </x-button>
            @else
                <x-button href="{{ route('booking.details', $departure) }}" variant="primary" class="w-full sm:w-auto whitespace-nowrap">
                    Choose Departure
                </x-button>
            @endif
        </div>
    </div>
</div>
