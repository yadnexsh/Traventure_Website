@extends('layouts.public')

@section('content')

{{-- 5. CINEMATIC HERO --}}
<div class="relative w-full h-[65vh] md:h-[70vh] lg:h-[76vh] bg-black overflow-hidden" id="cinematic-hero">
    
    {{-- Slide 01: Himalayan --}}
    <div class="carousel-slide absolute inset-0 transition-opacity duration-[1500ms] ease-in-out opacity-100 z-10">
        <div class="absolute inset-0 overflow-hidden">
            <img src="{{ asset('media/header/header (1).jpg') }}" alt="Himalayan Base Camp" class="ken-burns absolute inset-0 w-full h-full object-cover opacity-70" loading="eager">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-end pb-24 md:pb-32 px-6 sm:px-12 lg:px-24 max-w-7xl mx-auto w-full">
            <div class="flex items-center space-x-4 mb-6 opacity-80">
                <span class="text-white text-sm tracking-[0.2em] font-medium">01</span>
                <span class="h-px w-12 bg-white/50"></span>
                <span class="text-white/60 text-sm tracking-[0.2em]">03</span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.05] mb-6 max-w-3xl tracking-tight uppercase">Himalayan<br>Base Camp</h1>
            <p class="text-lg md:text-2xl text-white/90 mb-10 max-w-2xl font-light">High-altitude journeys. Long trails. Bigger stories.</p>
            <div class="flex">
                <a href="{{ route('treks.index') }}" class="inline-flex items-center justify-center font-bold text-sm tracking-widest uppercase pb-2 border-b-2 border-white text-white hover:text-brand-primary hover:border-brand-primary transition-colors focus:outline-none focus:ring-2 focus:ring-brand-primary focus:ring-offset-4 focus:ring-offset-black">
                    View the journey
                </a>
            </div>
        </div>
    </div>

    {{-- Slide 02: Sahyadris --}}
    <div class="carousel-slide absolute inset-0 transition-opacity duration-[1500ms] ease-in-out opacity-0 z-0">
        <div class="absolute inset-0 overflow-hidden">
            <img src="{{ asset('media/header/header (2).jpg') }}" alt="Monsoon in the Sahyadris" class="ken-burns absolute inset-0 w-full h-full object-cover opacity-70" loading="lazy">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-end pb-24 md:pb-32 px-6 sm:px-12 lg:px-24 max-w-7xl mx-auto w-full">
            <div class="flex items-center space-x-4 mb-6 opacity-80">
                <span class="text-white text-sm tracking-[0.2em] font-medium">02</span>
                <span class="h-px w-12 bg-white/50"></span>
                <span class="text-white/60 text-sm tracking-[0.2em]">03</span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.05] mb-6 max-w-3xl tracking-tight uppercase">Monsoon in<br>the Sahyadris</h1>
            <p class="text-lg md:text-2xl text-white/90 mb-10 max-w-2xl font-light">Green trails. Waterfalls. A different side of the mountains.</p>
            <div class="flex">
                <a href="{{ route('treks.index') }}" class="inline-flex items-center justify-center font-bold text-sm tracking-widest uppercase pb-2 border-b-2 border-white text-white hover:text-brand-primary hover:border-brand-primary transition-colors focus:outline-none focus:ring-2 focus:ring-brand-primary focus:ring-offset-4 focus:ring-offset-black">
                    Explore treks
                </a>
            </div>
        </div>
    </div>

    {{-- Slide 03: Weekend Escapes --}}
    <div class="carousel-slide absolute inset-0 transition-opacity duration-[1500ms] ease-in-out opacity-0 z-0">
        <div class="absolute inset-0 overflow-hidden">
            <img src="{{ asset('media/header/header (3).jpg') }}" alt="Weekend Escapes" class="ken-burns absolute inset-0 w-full h-full object-cover opacity-70" loading="lazy">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-end pb-24 md:pb-32 px-6 sm:px-12 lg:px-24 max-w-7xl mx-auto w-full">
            <div class="flex items-center space-x-4 mb-6 opacity-80">
                <span class="text-white text-sm tracking-[0.2em] font-medium">03</span>
                <span class="h-px w-12 bg-white/50"></span>
                <span class="text-white/60 text-sm tracking-[0.2em]">03</span>
            </div>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.05] mb-6 max-w-3xl tracking-tight uppercase">Weekend<br>Escapes</h1>
            <p class="text-lg md:text-2xl text-white/90 mb-10 max-w-2xl font-light">Sometimes you don't need a week. You just need a trail.</p>
            <div class="flex">
                <a href="{{ route('treks.index') }}" class="inline-flex items-center justify-center font-bold text-sm tracking-widest uppercase pb-2 border-b-2 border-white text-white hover:text-brand-primary hover:border-brand-primary transition-colors focus:outline-none focus:ring-2 focus:ring-brand-primary focus:ring-offset-4 focus:ring-offset-black">
                    Find your next trek
                </a>
            </div>
        </div>
    </div>

    {{-- Minimal Controls --}}
    <div class="absolute bottom-10 right-6 sm:right-12 lg:right-24 flex items-center gap-8 z-20">
        <button id="cinematic-prev" class="text-white/70 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black rounded-full p-2" aria-label="Previous journey">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button id="cinematic-next" class="text-white/70 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black rounded-full p-2" aria-label="Next journey">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>
</div>

<style>
    /* Ken Burns Effect */
    @keyframes kenburns {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }
    .carousel-slide.opacity-100 .ken-burns {
        animation: kenburns 8s ease-out forwards;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.carousel-slide');
        const prevBtn = document.getElementById('cinematic-prev');
        const nextBtn = document.getElementById('cinematic-next');
        const carousel = document.getElementById('cinematic-hero');
        let currentSlide = 0;
        let slideInterval;
        const intervalTime = 7000;

        // Respect reduced motion
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        function goToSlide(n) {
            slides[currentSlide].classList.remove('opacity-100', 'z-10');
            slides[currentSlide].classList.add('opacity-0', 'z-0');
            
            currentSlide = (n + slides.length) % slides.length;
            
            slides[currentSlide].classList.remove('opacity-0', 'z-0');
            slides[currentSlide].classList.add('opacity-100', 'z-10');
        }

        function nextSlide() { goToSlide(currentSlide + 1); }
        function prevSlide() { goToSlide(currentSlide - 1); }

        function startSlideShow() {
            if (!prefersReducedMotion) {
                slideInterval = setInterval(nextSlide, intervalTime);
            }
        }

        function stopSlideShow() {
            clearInterval(slideInterval);
        }

        nextBtn.addEventListener('click', () => { nextSlide(); stopSlideShow(); startSlideShow(); });
        prevBtn.addEventListener('click', () => { prevSlide(); stopSlideShow(); startSlideShow(); });

        carousel.addEventListener('mouseenter', stopSlideShow);
        carousel.addEventListener('mouseleave', startSlideShow);
        carousel.addEventListener('focusin', stopSlideShow);
        carousel.addEventListener('focusout', startSlideShow);

        startSlideShow();
    });
</script>

{{-- DISCOVERY INTRODUCTION --}}
<div class="bg-bg-base pt-20 pb-32 border-b border-border-subtle" x-data="trekDiscovery()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-24 text-center max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl lg:text-[40px] xl:text-[48px] font-bold text-text-primary tracking-tight mb-6 whitespace-normal md:whitespace-nowrap leading-tight">Where travel meets true adventure.</h2>
            <p class="text-xl md:text-2xl text-text-secondary font-light">Find the trail that fits your time, your season and your spirit.</p>
        </div>

        {{-- 1. Treks by Month --}}
        <div class="mb-32 relative">
            <div class="flex items-center justify-between mb-12">
                <h3 class="text-sm font-bold text-text-muted uppercase tracking-[0.2em]">Treks by Month</h3>
                <button @click="clearFilters()" x-show="activeMonth || activeSeason || activeDifficulty" style="display: none;" class="text-xs tracking-[0.2em] font-bold uppercase text-brand-primary hover:text-brand-secondary transition-colors">
                    Clear Filters
                </button>
            </div>
            <div class="flex overflow-x-auto pb-4 justify-between gap-8 scrollbar-hide snap-x">
                @foreach(['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'] as $month)
                    <button @click="toggleMonth('{{ $month }}')" 
                        :class="activeMonth === '{{ $month }}' ? 'text-brand-primary font-bold' : 'text-text-muted font-light'"
                        class="snap-start flex-none text-2xl md:text-3xl hover:text-brand-primary transition-colors focus:outline-none uppercase">
                        {{ substr($month, 0, 3) }}
                    </button>
                @endforeach
            </div>
            <div class="h-px w-full bg-border-subtle mt-4"></div>
        </div>
        
        {{-- Treks by Season & Difficulty --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mb-24">
            {{-- Treks by Season --}}
            <div>
                <h3 class="text-sm font-bold text-text-muted uppercase tracking-[0.2em] mb-12 text-center lg:text-left">Treks by Season</h3>
                <div class="grid grid-cols-2 gap-4">
                    @foreach(['Winter', 'Summer', 'Monsoon', 'Spring', 'Autumn'] as $season)
                        <button @click="toggleSeason('{{ $season }}')" 
                            :class="activeSeason === '{{ $season }}' ? 'bg-text-primary text-bg-base border-text-primary' : 'bg-transparent text-text-secondary border-border-strong hover:border-text-muted'"
                            class="py-6 px-4 text-center border border-border-strong transition-colors focus:outline-none uppercase tracking-widest font-medium text-sm">
                            {{ $season }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Treks by Difficulty --}}
            <div>
                <h3 class="text-sm font-bold text-text-muted uppercase tracking-[0.2em] mb-12 text-center lg:text-left">Treks by Difficulty</h3>
                <div class="grid grid-cols-2 gap-4">
                    @foreach(['Easy', 'Moderate', 'Hard', 'Expert'] as $difficulty)
                        <button @click="toggleDifficulty('{{ $difficulty }}')" 
                            :class="activeDifficulty === '{{ $difficulty }}' ? 'bg-text-primary text-bg-base' : 'bg-transparent text-text-secondary border-border-strong hover:bg-bg-subtle border'"
                            class="py-6 px-4 text-center border-border-strong transition-colors focus:outline-none uppercase tracking-widest font-medium text-sm">
                            {{ $difficulty }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- WHAT ARE YOU LOOKING FOR? --}}
<div class="bg-bg-base py-32 border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-24">
            <h2 class="text-4xl md:text-5xl font-bold text-text-primary tracking-tight">What are you looking for?</h2>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <a href="#" class="group block relative aspect-[4/5] bg-bg-subtle overflow-hidden">
                <img src="{{ asset('media/header/header (3).jpg') }}" alt="A quick escape" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-105 opacity-80" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute inset-0 p-10 flex flex-col justify-end">
                    <h3 class="text-3xl font-bold text-white mb-4 leading-tight">A quick escape</h3>
                    <p class="text-white/80 text-lg font-light">Day / short adventures</p>
                </div>
            </a>

            <a href="#" class="group block relative aspect-[4/5] bg-bg-subtle overflow-hidden">
                <img src="{{ asset('media/header/header (1).jpg') }}" alt="Something bigger" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-105 opacity-80" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute inset-0 p-10 flex flex-col justify-end">
                    <h3 class="text-3xl font-bold text-white mb-4 leading-tight">Something bigger</h3>
                    <p class="text-white/80 text-lg font-light">Multi-day / mountain journeys</p>
                </div>
            </a>

            <a href="#" class="group block relative aspect-[4/5] bg-bg-subtle overflow-hidden">
                <img src="{{ asset('media/header/header (2).jpg') }}" alt="Time to slow down" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-105 opacity-80" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute inset-0 p-10 flex flex-col justify-end">
                    <h3 class="text-3xl font-bold text-white mb-4 leading-tight">Time to slow down</h3>
                    <p class="text-white/80 text-lg font-light">Camping / leisure / getaways</p>
                </div>
            </a>
        </div>
    </div>
</div>

{{-- TRUST SECTION --}}
<div class="bg-bg-subtle py-32 border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-20">
            <div class="lg:w-1/3">
                <h2 class="text-4xl md:text-5xl font-bold text-text-primary leading-[1.1] tracking-tight sticky top-32">Adventure,<br>thoughtfully<br>planned.</h2>
            </div>
            <div class="lg:w-2/3 space-y-16">
                <div class="pl-0 lg:pl-12 border-l-0 lg:border-l border-border-strong">
                    <span class="text-sm tracking-[0.2em] font-bold text-text-muted mb-4 block uppercase">01</span>
                    <h3 class="text-2xl font-bold text-text-primary mb-4">Know before you go</h3>
                    <p class="text-xl text-text-secondary leading-relaxed font-light">Clear trek information and expectations. We believe in transparency about what you'll encounter on the trail.</p>
                </div>
                <div class="pl-0 lg:pl-12 border-l-0 lg:border-l border-border-strong">
                    <span class="text-sm tracking-[0.2em] font-bold text-text-muted mb-4 block uppercase">02</span>
                    <h3 class="text-2xl font-bold text-text-primary mb-4">People behind the journey</h3>
                    <p class="text-xl text-text-secondary leading-relaxed font-light">Real people supporting each experience. Our trek leaders and local teams are the heart of every journey.</p>
                </div>
                <div class="pl-0 lg:pl-12 border-l-0 lg:border-l border-border-strong">
                    <span class="text-sm tracking-[0.2em] font-bold text-text-muted mb-4 block uppercase">03</span>
                    <h3 class="text-2xl font-bold text-text-primary mb-4">Come prepared</h3>
                    <p class="text-xl text-text-secondary leading-relaxed font-light">Useful information before you step onto the trail. We make sure you have the right gear and mindset.</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- STORIES, TEAM, JOURNAL GRID --}}
<div class="bg-bg-base">
    <div class="grid grid-cols-1 lg:grid-cols-2">
        
        {{-- STORIES --}}
        <div class="py-32 px-12 lg:px-24 border-b lg:border-b-0 lg:border-r border-border-subtle flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-text-primary mb-8 tracking-tight">Stories from the trail</h2>
            <p class="text-2xl text-text-secondary font-light italic mb-8">"The best stories happen out there."</p>
            <div class="mt-auto pt-8">
                <span class="text-sm font-bold uppercase tracking-[0.1em] text-text-muted">Trekker stories coming soon</span>
            </div>
        </div>

        {{-- TEAM & JOURNAL --}}
        <div class="flex flex-col">
            {{-- TEAM --}}
            <div class="py-24 px-12 lg:px-24 border-b border-border-subtle flex-1 flex flex-col justify-center relative overflow-hidden group">
                <img src="{{ asset('media/team/team_banner.jpg') }}" alt="Traventure Team" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-105 opacity-60">
                <div class="absolute inset-0 bg-black/60 group-hover:bg-black/50 transition-colors duration-500"></div>
                <div class="relative z-10 flex flex-col h-full">
                    <h2 class="text-3xl font-bold text-white mb-6 tracking-tight">The people behind the journeys</h2>
                    <p class="text-xl text-white/80 font-light mb-8 max-w-md">Meet the people who make each journey possible.</p>
                    <div class="mt-auto">
                        <span class="text-sm font-bold uppercase tracking-[0.1em] text-white/60">Team profiles coming soon</span>
                    </div>
                </div>
            </div>
            
            {{-- JOURNAL --}}
            <div class="py-24 px-12 lg:px-24 flex-1 flex flex-col justify-center bg-bg-subtle">
                <h2 class="text-3xl font-bold text-text-primary mb-6 tracking-tight">From the trail</h2>
                <p class="text-xl text-text-secondary font-light mb-8 max-w-md">Stories, guides and ideas from the trail.</p>
                <div class="mt-auto">
                    <span class="text-sm font-bold uppercase tracking-[0.1em] text-text-muted">Journal coming soon</span>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- FINAL CINEMATIC CTA --}}
<div class="relative w-full h-[60vh] md:h-[75vh] bg-black">
    <div class="absolute inset-0 overflow-hidden">
        <img src="{{ asset('media/header/header (1).jpg') }}" alt="There's a trail waiting for you" class="ken-burns absolute inset-0 w-full h-full object-cover opacity-60" loading="lazy">
    </div>
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-4 sm:px-6 z-10">
        <h2 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight tracking-tight uppercase">There's a trail<br>waiting for you.</h2>
        <p class="text-xl md:text-2xl text-white/90 mb-16 font-light">Where will you go next?</p>
        <a href="{{ route('treks.index') }}" class="inline-flex items-center justify-center font-bold text-sm tracking-[0.2em] uppercase px-12 py-5 bg-white text-black border-none hover:bg-white/90 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-black focus:ring-white">
            Explore Treks
        </a>
    </div>
</div>

@endsection
