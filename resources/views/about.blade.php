@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Hero Section --}}
    <div class="relative w-full aspect-[16/7] md:aspect-[21/9] min-h-[260px] rounded-xl overflow-hidden mb-16 shadow-sm">
        <img src="{{ asset('media/team/team_banner.jpg') }}" alt="Traventure Community" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/45 to-transparent"></div>
        <div class="absolute inset-0 p-6 sm:p-10 md:p-14 flex flex-col justify-end text-white">
            <span class="text-xs uppercase tracking-widest text-brand-soft/90 font-semibold mb-2">Our Story & Ethos</span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight text-white mb-3">About Traventure</h1>
            <p class="text-white/90 text-sm sm:text-base md:text-lg max-w-2xl font-light">
                Where travel meets true adventure. Walking with purpose, respect, and community across the varied mountain trails of India.
            </p>
        </div>
    </div>

    {{-- Purpose & Philosophy --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-20 items-center">
        <div class="lg:col-span-5">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-primary block mb-2">Purpose & Approach</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-text-primary tracking-tight mb-4">
                Trekking with intention, humility, and heart.
            </h2>
            <div class="w-12 h-1 bg-brand-primary rounded mb-6"></div>
        </div>
        <div class="lg:col-span-7 space-y-4 text-text-secondary text-base sm:text-lg leading-relaxed font-light">
            <p>
                At Traventure, we believe that true trekking is never about conquering summits or checking destinations off a list. It is about slowing down, tuning into the rhythm of your own breath, and developing a genuine relationship with the land beneath your boots.
            </p>
            <p>
                We design thoughtful journeys that respect the mountains, value quiet contemplation as much as physical challenge, and bring people together to share authentic experiences in the wild.
            </p>
        </div>
    </div>

    {{-- Four Pillars of Traventure --}}
    <div class="mb-24">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-primary block mb-2">How We Walk</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-text-primary tracking-tight mb-3">The Pillars of Our Experience</h2>
            <p class="text-text-secondary text-base sm:text-lg font-light">Every expedition we undertake is guided by a commitment to the environment, thorough preparation, and shared connection.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Pillar 1 --}}
            <div class="bg-bg-subtle p-8 rounded-xl border border-border-subtle flex flex-col hover:border-brand-primary/40 transition-colors">
                <div class="w-12 h-12 rounded-lg bg-brand-primary/10 text-brand-primary flex items-center justify-center font-bold text-xl mb-6">
                    01
                </div>
                <h3 class="text-xl font-bold text-text-primary mb-3">Exploring India's Diverse Landscapes</h3>
                <p class="text-text-secondary font-light text-sm sm:text-base leading-relaxed">
                    India possesses an extraordinary topographical variety. From the ancient basalt escarpments and mist-shrouded forts of the Sahyadris to the snow-covered cols and alpine meadows of the Himalayas, each region offers distinct ecological character and cultural history that we encourage trekkers to appreciate deeply.
                </p>
            </div>

            {{-- Pillar 2 --}}
            <div class="bg-bg-subtle p-8 rounded-xl border border-border-subtle flex flex-col hover:border-brand-primary/40 transition-colors">
                <div class="w-12 h-12 rounded-lg bg-brand-primary/10 text-brand-primary flex items-center justify-center font-bold text-xl mb-6">
                    02
                </div>
                <h3 class="text-xl font-bold text-text-primary mb-3">Preparation & Trail Mindfulness</h3>
                <p class="text-text-secondary font-light text-sm sm:text-base leading-relaxed">
                    Sound preparation is the foundation of every safe and fulfilling trek. We prioritize physical readiness, climate awareness, and route clarity. By helping trekkers prepare thoroughly before they lace up, we turn potential adversity into confidence and self-discovery.
                </p>
            </div>

            {{-- Pillar 3 --}}
            <div class="bg-bg-subtle p-8 rounded-xl border border-border-subtle flex flex-col hover:border-brand-primary/40 transition-colors">
                <div class="w-12 h-12 rounded-lg bg-brand-primary/10 text-brand-primary flex items-center justify-center font-bold text-xl mb-6">
                    03
                </div>
                <h3 class="text-xl font-bold text-text-primary mb-3">Responsible Outdoor Travel</h3>
                <p class="text-text-secondary font-light text-sm sm:text-base leading-relaxed">
                    We strictly advocate Leave No Trace practices across all our journeys. Fragile mountain ecosystems, high-altitude passes, and forest streams require unwavering stewardship. We minimize waste, respect wildlife corridors, and honor local mountain communities along the route.
                </p>
            </div>

            {{-- Pillar 4 --}}
            <div class="bg-bg-subtle p-8 rounded-xl border border-border-subtle flex flex-col hover:border-brand-primary/40 transition-colors">
                <div class="w-12 h-12 rounded-lg bg-brand-primary/10 text-brand-primary flex items-center justify-center font-bold text-xl mb-6">
                    04
                </div>
                <h3 class="text-xl font-bold text-text-primary mb-3">Shared Community Experience</h3>
                <p class="text-text-secondary font-light text-sm sm:text-base leading-relaxed">
                    The wilderness has a unique power to dissolve everyday barriers. On the trail, strangers become companions who share meals, encourage each other through steep switchbacks, and exchange stories under night skies. That sense of supportive, humble community is what visitors remember longest.
                </p>
            </div>
        </div>
    </div>

    {{-- What Visitors Can Expect --}}
    <div class="bg-bg-surface p-8 sm:p-12 rounded-2xl border border-border-subtle mb-20">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-primary block mb-2">On The Trail</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-text-primary tracking-tight mb-4">What to Expect on a Traventure Trek</h2>
            <p class="text-text-secondary font-light text-base sm:text-lg mb-8 leading-relaxed">
                Whether you join an introductory weekend hike in the Western Ghats or a multi-day high-altitude trek in the northern valleys, here is what guides our experience:
            </p>
            <ul class="space-y-4 text-text-secondary font-light text-sm sm:text-base">
                <li class="flex items-start gap-3">
                    <span class="text-brand-primary font-bold text-lg mt-0.5">&check;</span>
                    <span><strong>Transparent difficulty ratings:</strong> Clear details on terrain, altitude profile, daily trekking hours, and fitness prerequisites so you can choose the trail that fits your readiness.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-brand-primary font-bold text-lg mt-0.5">&check;</span>
                    <span><strong>Safety-conscious planning:</strong> Thoughtful pacing, acclimatization schedules, and conservative decision-making in changing weather conditions.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-brand-primary font-bold text-lg mt-0.5">&check;</span>
                    <span><strong>Inclusive, welcoming atmosphere:</strong> A supportive environment where first-time trekkers and experienced trail walkers learn from one another without ego.</span>
                </li>
            </ul>
        </div>
    </div>

    {{-- CTA --}}
    <div class="text-center py-12 border-t border-border-subtle">
        <h2 class="text-2xl sm:text-3xl font-bold text-text-primary tracking-tight mb-3">Find the trail that fits your spirit</h2>
        <p class="text-text-secondary font-light text-base mb-8 max-w-xl mx-auto">Discover our upcoming journeys across the Sahyadris, the Himalayas, and beyond.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('treks.index') }}" class="inline-flex items-center justify-center font-medium text-sm px-8 py-3 bg-brand-primary text-white hover:bg-brand-primary/90 transition-colors rounded-lg shadow-sm">
                Explore All Treks
            </a>
            <a href="{{ route('treks.region', 'sahyadri') }}" class="inline-flex items-center justify-center font-medium text-sm px-8 py-3 border border-border-strong text-text-primary hover:bg-bg-subtle transition-colors rounded-lg">
                Sahyadri Treks
            </a>
            <a href="{{ route('treks.region', 'himalayan') }}" class="inline-flex items-center justify-center font-medium text-sm px-8 py-3 border border-border-strong text-text-primary hover:bg-bg-subtle transition-colors rounded-lg">
                Himalayan Treks
            </a>
        </div>
    </div>

</div>
@endsection
