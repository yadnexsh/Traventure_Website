@extends('layouts.public')

@section('content')
{{-- Hero Section --}}
<div class="relative bg-bg-base mt-0 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-20 lg:py-32 mb-16 border-b border-border-subtle">
    <div class="max-w-7xl mx-auto relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-text-primary tracking-tight leading-tight">
            Go farther. <br class="hidden sm:block" />
            <span class="text-brand-primary">Come back with stories.</span>
        </h1>
        <p class="mt-6 max-w-2xl mx-auto text-lg md:text-xl text-text-secondary leading-relaxed">
            Expertly guided trekking experiences designed for safety, sustainability, and authentic connection with nature.
        </p>
        <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
            <x-button href="{{ route('treks.index') }}" variant="primary" class="text-lg px-8 py-4 h-auto">
                Explore Treks
            </x-button>
        </div>
    </div>
</div>

{{-- Featured Treks Section --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
    <div class="flex items-baseline justify-between mb-8 border-b border-border-subtle pb-4">
        <div>
            <h2 class="text-2xl font-bold text-text-primary">Featured Treks</h2>
            <p class="mt-1 text-text-secondary">Handpicked routes for your next journey.</p>
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
        <x-button href="{{ route('treks.index') }}" variant="outline" class="w-full">
            View all treks
        </x-button>
    </div>
</div>

{{-- Experience/Trust Section --}}
<div class="bg-bg-subtle border-y border-border-subtle -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-16 lg:py-24 mb-16">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-text-primary">Why Trek With Us?</h2>
            <p class="mt-4 text-lg text-text-secondary">We are committed to delivering premium outdoor experiences.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mt-12">
            <div class="space-y-4 text-center md:text-left">
                <h3 class="text-xl font-bold text-text-primary border-l-4 border-brand-primary pl-4">Safety First</h3>
                <p class="text-text-secondary pl-5">Experienced guides and strictly vetted safety protocols for every departure. Your well-being is our highest priority.</p>
            </div>
            <div class="space-y-4 text-center md:text-left">
                <h3 class="text-xl font-bold text-text-primary border-l-4 border-brand-primary pl-4">Breathtaking Routes</h3>
                <p class="text-text-secondary pl-5">Carefully curated trails that showcase the best landscapes away from the crowds, providing authentic wilderness exposure.</p>
            </div>
            <div class="space-y-4 text-center md:text-left">
                <h3 class="text-xl font-bold text-text-primary border-l-4 border-brand-primary pl-4">Small Groups</h3>
                <p class="text-text-secondary pl-5">Intimate group sizes to ensure a personalized and environmentally conscious experience on the trail.</p>
            </div>
        </div>
    </div>
</div>

{{-- Final CTA --}}
<div class="max-w-4xl mx-auto text-center pb-24 px-4 sm:px-6">
    <h2 class="text-3xl font-bold text-text-primary mb-4">Ready to start planning?</h2>
    <p class="text-text-secondary mb-8 text-lg">Browse our upcoming scheduled departures and secure your spot today.</p>
    <x-button href="{{ route('treks.index') }}" variant="primary" class="text-lg px-8 py-3">
        Find Your Trek
    </x-button>
</div>
@endsection
