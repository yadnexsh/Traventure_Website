@extends('layouts.public')

@section('content')
{{-- Breadcrumb --}}
<nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2 text-sm text-text-secondary">
        <li>
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Home</a>
        </li>
        <li><span class="text-text-muted">/</span></li>
        <li>
            <a href="{{ route('treks.index') }}" class="hover:text-brand-primary">Treks</a>
        </li>
        <li><span class="text-text-muted">/</span></li>
        <li class="font-medium text-text-primary" aria-current="page">{{ $trek->title }}</li>
    </ol>
</nav>

{{-- Trek Hero --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
    <div class="bg-bg-subtle rounded-xl overflow-hidden shadow-sm border border-border-subtle relative h-64 md:h-96 flex items-center justify-center">
        {{-- Visual Placeholder --}}
        <svg class="h-24 w-24 text-text-muted opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/70 to-transparent p-6 md:p-10">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight">{{ $trek->title }}</h1>
        </div>
    </div>
</div>

{{-- Main Content Grid --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24 grid grid-cols-1 lg:grid-cols-3 gap-12">
    
    {{-- Left Column (Overview & Info) --}}
    <div class="lg:col-span-2 space-y-12">
        
        {{-- Trek Information Grid (Only render if at least one exists) --}}
        @if($trek->difficulty || $trek->duration || $trek->price)
        <section aria-labelledby="trek-facts-heading">
            <h2 id="trek-facts-heading" class="sr-only">Trek Facts</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 bg-bg-surface p-6 rounded-lg border border-border-subtle">
                @if($trek->difficulty)
                <div>
                    <dt class="text-sm font-medium text-text-secondary mb-1">Difficulty</dt>
                    <dd class="text-base font-semibold text-text-primary">{{ $trek->difficulty }}</dd>
                </div>
                @endif
                
                @if($trek->duration)
                <div>
                    <dt class="text-sm font-medium text-text-secondary mb-1">Duration</dt>
                    <dd class="text-base font-semibold text-text-primary">{{ $trek->duration }} days</dd>
                </div>
                @endif

                @if($trek->price)
                <div>
                    <dt class="text-sm font-medium text-text-secondary mb-1">Price</dt>
                    <dd class="text-base font-semibold text-brand-primary">₹{{ number_format($trek->price / 100) }}</dd>
                </div>
                @endif
            </div>
        </section>
        @endif

        {{-- Overview --}}
        <section aria-labelledby="overview-heading">
            <h2 id="overview-heading" class="text-2xl font-bold text-text-primary mb-4 border-b border-border-subtle pb-2">Overview</h2>
            <div class="prose prose-brand max-w-none text-text-secondary text-lg leading-relaxed">
                {{ $trek->summary }}
            </div>
        </section>
        
        {{-- Additional Information (Placeholders for when schema expands) --}}
        {{-- E.g. Fitness Criteria, Accommodation --}}
        {{-- We do not render them since they don't exist in the current DB schema. --}}

    </div>

    {{-- Right Column (Departures Sticky Sidebar) --}}
    <div class="lg:col-span-1">
        <div class="sticky top-24 space-y-6">
            <section aria-labelledby="departures-heading" class="bg-bg-base border border-border-subtle shadow-sm rounded-xl overflow-hidden">
                <div class="bg-bg-subtle/50 px-6 py-4 border-b border-border-subtle">
                    <h2 id="departures-heading" class="text-xl font-bold text-text-primary">Upcoming Departures</h2>
                </div>
                
                <div class="p-6">
                    @if($departures->count() > 0)
                        <div class="space-y-4">
                            @foreach($departures as $departure)
                                <x-departure-card :departure="$departure" :trekPrice="$trek->price" />
                            @endforeach
                        </div>
                    @else
                        <x-empty-state 
                            title="No scheduled dates" 
                            description="We don't have any upcoming departures for this trek at the moment."
                        />
                    @endif
                </div>
            </section>
        </div>
    </div>

</div>
@endsection
