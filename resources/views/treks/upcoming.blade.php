@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-10 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-text-primary tracking-tight">Upcoming Treks</h1>
        <p class="mt-4 text-lg text-text-secondary max-w-2xl mx-auto">
            Find your next adventure from our scheduled departures.
        </p>
    </div>

    @if($departures->count() > 0)
        <div class="space-y-6 max-w-4xl mx-auto">
            @foreach($departures as $departure)
                <div class="bg-bg-base border border-border-subtle rounded-xl shadow-sm hover:border-brand-primary/50 transition-colors overflow-hidden flex flex-col md:flex-row">
                    {{-- Trek Info side --}}
                    <div class="p-6 md:w-1/3 bg-bg-subtle border-b md:border-b-0 md:border-r border-border-subtle flex flex-col justify-center">
                        <h3 class="text-xl font-bold text-text-primary mb-2">
                            <a href="{{ route('treks.show', $departure->trek->slug) }}" class="hover:text-brand-primary transition-colors">
                                {{ $departure->trek->title }}
                            </a>
                        </h3>
                        <div class="text-sm text-text-secondary flex flex-col gap-1">
                            <span class="inline-flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $departure->trek->duration }} days
                            </span>
                            <span class="inline-flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                {{ $departure->trek->difficulty }}
                            </span>
                        </div>
                    </div>
                    
                    {{-- Departure Card side --}}
                    <div class="p-4 md:p-6 md:w-2/3 flex items-center">
                        <div class="w-full">
                            <x-departure-card :departure="$departure" :trekPrice="$departure->trek->price" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-bg-subtle rounded-xl border border-border-subtle">
            <h3 class="text-lg font-medium text-text-primary mb-2">No upcoming departures</h3>
            <p class="text-text-secondary">Check back later for new dates, or explore our treks to register your interest.</p>
            <div class="mt-6">
                <x-button href="{{ route('treks.index') }}" variant="primary">
                    Explore All Treks
                </x-button>
            </div>
        </div>
    @endif
</div>
@endsection
