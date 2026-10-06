@extends('layouts.public')

@section('content')
{{-- Hero Section --}}
<div class="relative bg-bg-surface mt-0 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-20 lg:py-32 mb-16 overflow-hidden">
    <div class="max-w-7xl mx-auto relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-brand-dark tracking-tight leading-tight">
            Discover Your Next <span class="text-brand-primary">Adventure</span>
        </h1>
        <p class="mt-6 max-w-2xl mx-auto text-lg md:text-xl text-text-secondary leading-relaxed">
            Expertly guided trekking experiences designed for safety, sustainability, and unforgettable memories.
        </p>
        <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
            <x-button href="{{ route('treks.index') }}" variant="primary" class="text-lg px-8 py-4 h-auto">
                Explore Treks
            </x-button>
        </div>
    </div>
    
    {{-- Decorative background pattern --}}
    <div class="absolute inset-0 opacity-10 pointer-events-none" aria-hidden="true">
        <svg class="absolute left-full transform -translate-x-1/2 -translate-y-1/4" width="404" height="784" fill="none" viewBox="0 0 404 784">
            <defs>
                <pattern id="pattern-hero" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <rect x="0" y="0" width="4" height="4" class="text-brand-primary" fill="currentColor" />
                </pattern>
            </defs>
            <rect width="404" height="784" fill="url(#pattern-hero)" />
        </svg>
    </div>
</div>

{{-- Featured Treks Section --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
    <div class="flex items-baseline justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-text-primary">Featured Treks</h2>
            <p class="mt-2 text-text-secondary">Handpicked routes for your next journey.</p>
        </div>
        <a href="{{ route('treks.index') }}" class="hidden sm:inline-flex text-brand-primary hover:text-brand-primary/80 font-medium group">
            View all
            <span aria-hidden="true" class="ml-1 group-hover:translate-x-1 transition-transform">&rarr;</span>
        </a>
    </div>

    @if($featuredTreks->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredTreks as $trek)
                <x-trek-card :trek="$trek" />
            @endforeach
        </div>
    @else
        <x-empty-state 
            title="No treks available" 
            description="We're currently preparing our upcoming season. Check back soon!" />
    @endif
    
    <div class="mt-8 sm:hidden">
        <x-button href="{{ route('treks.index') }}" variant="secondary" class="w-full">
            View all treks
        </x-button>
    </div>
</div>

{{-- Experience/Trust Section --}}
<div class="bg-brand-primary text-white -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-16 lg:py-24 mb-16">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-3xl font-bold mb-6">Why Trek With Us?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
            <div class="space-y-4">
                <div class="mx-auto w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold">Safety First</h3>
                <p class="text-brand-soft/90">Experienced guides and strictly vetted safety protocols for every departure.</p>
            </div>
            <div class="space-y-4">
                <div class="mx-auto w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold">Breathtaking Routes</h3>
                <p class="text-brand-soft/90">Carefully curated trails that showcase the best landscapes away from the crowds.</p>
            </div>
            <div class="space-y-4">
                <div class="mx-auto w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold">Small Groups</h3>
                <p class="text-brand-soft/90">Intimate group sizes to ensure a personalized and environmentally conscious experience.</p>
            </div>
        </div>
    </div>
</div>

{{-- Final CTA --}}
<div class="max-w-4xl mx-auto text-center pb-24 px-4 sm:px-6">
    <h2 class="text-3xl font-bold text-text-primary mb-6">Ready to start planning?</h2>
    <p class="text-text-secondary mb-8 text-lg">Browse our upcoming scheduled departures and secure your spot today.</p>
    <x-button href="{{ route('treks.index') }}" variant="accent" class="text-lg px-8 py-3">
        Find Your Trek
    </x-button>
</div>
@endsection
