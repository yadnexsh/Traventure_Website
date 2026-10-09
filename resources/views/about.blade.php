@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Cinematic Hero Banner --}}
    <div class="relative w-full aspect-[16/7] md:aspect-[21/9] min-h-[260px] rounded-sm overflow-hidden mb-16 border border-border-subtle">
        <img src="{{ asset('media/team/team_banner.jpg') }}" alt="Traventure Expedition Team" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/60 to-transparent"></div>
        <div class="absolute inset-0 p-8 md:p-16 flex flex-col justify-end text-white">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-brand-primary mb-3">Expedition Ethos & Standards</span>
            <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tight text-white mb-3">ABOUT TRAVENTURE</h1>
            <p class="text-white/80 text-sm md:text-lg font-light max-w-2xl uppercase tracking-wider">
                PURPOSE. DISCIPLINE. THE UNCOMPROMISED TRAIL.
            </p>
        </div>
    </div>

    {{-- Purpose & Ethos --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-24 items-center">
        <div class="lg:col-span-5">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-text-muted block mb-3">Our Core Philosophy</span>
            <h2 class="text-3xl md:text-5xl font-black text-text-primary tracking-tight uppercase leading-tight mb-6">
                Where Travel Meets True Adventure
            </h2>
            <div class="w-16 h-1 bg-brand-primary mb-6"></div>
        </div>
        <div class="lg:col-span-7 space-y-6 text-text-secondary text-base md:text-lg leading-relaxed font-light">
            <p>
                Traventure was established on a single principle: real adventure begins where comfort zones end. We reject superficial tourism in favor of authentic mountain expeditions that test endurance, demand humility, and reward focus.
            </p>
            <p>
                Every trail we curate is designed to cultivate genuine respect for the environment and build lasting camaraderie among those who choose to walk it.
            </p>
        </div>
    </div>

    {{-- The Terrains --}}
    <div class="mb-24">
        <div class="mb-12">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-text-muted block mb-2">Two Distinct Worlds</span>
            <h2 class="text-3xl md:text-4xl font-black text-text-primary uppercase tracking-tight">The Terrains of India</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Sahyadris --}}
            <div class="relative overflow-hidden rounded-sm border border-border-strong group min-h-[380px] flex flex-col justify-end p-8 md:p-10">
                <img src="{{ asset('media/header/header (3).jpg') }}" alt="Sahyadri Ranges" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/60 to-black/20"></div>
                <div class="relative z-10 text-white">
                    <span class="text-xs font-bold tracking-[0.2em] uppercase text-brand-primary mb-2 block">Western Ghats</span>
                    <h3 class="text-2xl md:text-3xl font-extrabold uppercase tracking-tight mb-3">The Sahyadri Ramparts</h3>
                    <p class="text-white/80 font-light text-sm md:text-base mb-6 leading-relaxed">
                        Centuries-old basalt fortresses, sheer vertical precipices, and monsoon-washed valleys. The Sahyadris demand technical agility, surefootedness, and stamina through steep rocky ascents.
                    </p>
                    <a href="{{ route('treks.region', 'sahyadri') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-brand-primary transition-colors">
                        Explore Sahyadri Treks &rarr;
                    </a>
                </div>
            </div>

            {{-- Himalayas --}}
            <div class="relative overflow-hidden rounded-sm border border-border-strong group min-h-[380px] flex flex-col justify-end p-8 md:p-10">
                <img src="{{ asset('media/header/header (1).jpg') }}" alt="Himalayan Mountain Range" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/60 to-black/20"></div>
                <div class="relative z-10 text-white">
                    <span class="text-xs font-bold tracking-[0.2em] uppercase text-brand-primary mb-2 block">High Altitude</span>
                    <h3 class="text-2xl md:text-3xl font-extrabold uppercase tracking-tight mb-3">The Himalayan Ranges</h3>
                    <p class="text-white/80 font-light text-sm md:text-base mb-6 leading-relaxed">
                        Vast alpine passes, glacial streams, and high-altitude wilderness beneath snow-clad giants. The Himalayas challenge your mental resolve, physical conditioning, and acclimatization discipline.
                    </p>
                    <a href="{{ route('treks.region', 'himalayan') }}" class="inline-flex items-center text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-brand-primary transition-colors">
                        Explore Himalayan Treks &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- The Expedition Standard --}}
    <div class="bg-bg-subtle p-8 md:p-16 border border-border-subtle rounded-sm mb-24">
        <div class="max-w-4xl">
            <span class="text-xs font-bold uppercase tracking-[0.2em] text-text-muted block mb-3">Standards & Ethics</span>
            <h2 class="text-3xl md:text-4xl font-black text-text-primary tracking-tight uppercase mb-8">The Expedition Standard</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="text-base font-bold uppercase tracking-wider text-text-primary mb-3">01 / Preparation</h4>
                    <p class="text-text-secondary text-sm font-light leading-relaxed">
                        Comprehensive gear guides, fitness benchmarks, and elevation profiles provided before departure. Preparation is your first duty to the mountain.
                    </p>
                </div>
                <div>
                    <h4 class="text-base font-bold uppercase tracking-wider text-text-primary mb-3">02 / Leave No Trace</h4>
                    <p class="text-text-secondary text-sm font-light leading-relaxed">
                        Strict zero-waste stewardship. All trails, campsites, and water sources are left cleaner than we found them, protecting biodiversity.
                    </p>
                </div>
                <div>
                    <h4 class="text-base font-bold uppercase tracking-wider text-text-primary mb-3">03 / Shared Resolve</h4>
                    <p class="text-text-secondary text-sm font-light leading-relaxed">
                        Small team formations that prioritize mutual support, shared campsite responsibilities, and genuine connection around the evening fire.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Final CTA --}}
    <div class="text-center py-12 border-t border-border-subtle">
        <h2 class="text-3xl md:text-4xl font-black text-text-primary tracking-tight uppercase mb-4">READY FOR THE TRAIL?</h2>
        <p class="text-text-secondary font-light text-base md:text-lg mb-8 max-w-xl mx-auto">Discover expeditions curated across every season and difficulty.</p>
        <div class="flex flex-wrap justify-center gap-6">
            <a href="{{ route('treks.index') }}" class="inline-flex items-center justify-center font-bold text-xs tracking-[0.2em] uppercase px-10 py-4 bg-text-primary text-bg-base hover:bg-brand-primary transition-all rounded-sm">
                Explore All Treks
            </a>
            <a href="{{ route('treks.region', 'sahyadri') }}" class="inline-flex items-center justify-center font-bold text-xs tracking-[0.2em] uppercase px-10 py-4 border border-border-strong text-text-primary hover:bg-bg-subtle transition-all rounded-sm">
                Sahyadri Treks
            </a>
            <a href="{{ route('treks.region', 'himalayan') }}" class="inline-flex items-center justify-center font-bold text-xs tracking-[0.2em] uppercase px-10 py-4 border border-border-strong text-text-primary hover:bg-bg-subtle transition-all rounded-sm">
                Himalayan Treks
            </a>
        </div>
    </div>

</div>
@endsection
