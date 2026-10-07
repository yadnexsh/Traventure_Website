@extends('layouts.public')

@section('content')

{{-- 5. HERO --}}
<div class="relative w-full h-[70vh] md:h-[75vh] lg:h-[90vh] bg-black overflow-hidden" id="hero-carousel">
    <div class="carousel-inner relative w-full h-full">
        
        {{-- Slide 1 --}}
        <div class="carousel-item absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-100 z-10">
            <img src="{{ asset('media/header/header (1).jpg') }}" alt="Himalayan Journeys" class="absolute inset-0 w-full h-full object-cover opacity-80" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-black/50"></div>
            <div class="absolute inset-0 flex flex-col justify-center px-6 sm:px-12 lg:px-24 max-w-7xl mx-auto w-full pt-16">
                <span class="text-white/80 font-bold tracking-widest text-xs sm:text-sm uppercase mb-4 sm:mb-6">Himalayan Journeys</span>
                <h1 class="text-5xl md:text-7xl lg:text-[5.5rem] font-bold text-white leading-[1.1] mb-6 max-w-4xl tracking-tight">Go farther.<br>Come back with stories.</h1>
                <p class="text-lg md:text-2xl text-white/90 mb-10 max-w-2xl font-light">Expertly guided trekking experiences designed for authentic connection with nature.</p>
                <div class="flex">
                    <a href="{{ route('treks.index') }}" class="inline-flex items-center justify-center font-bold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary text-lg px-8 py-4 bg-white text-black border-none hover:bg-gray-100 transition-colors">Explore Treks</a>
                </div>
            </div>
        </div>

        {{-- Slide 2 --}}
        <div class="carousel-item absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="{{ asset('media/header/header (2).jpg') }}" alt="Sahyadri" class="absolute inset-0 w-full h-full object-cover opacity-80" loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-black/50"></div>
            <div class="absolute inset-0 flex flex-col justify-center px-6 sm:px-12 lg:px-24 max-w-7xl mx-auto w-full pt-16">
                <span class="text-white/80 font-bold tracking-widest text-xs sm:text-sm uppercase mb-4 sm:mb-6">Sahyadri Trails</span>
                <h1 class="text-5xl md:text-7xl lg:text-[5.5rem] font-bold text-white leading-[1.1] mb-6 max-w-4xl tracking-tight">Into the mountains.</h1>
                <p class="text-lg md:text-2xl text-white/90 mb-10 max-w-2xl font-light">Monsoon paths, ancient forts, and journeys that test your endurance.</p>
                <div class="flex">
                    <a href="{{ route('treks.index') }}" class="inline-flex items-center justify-center font-bold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary text-lg px-8 py-4 bg-white text-black border-none hover:bg-gray-100 transition-colors">Find Your Trail</a>
                </div>
            </div>
        </div>

        {{-- Slide 3 --}}
        <div class="carousel-item absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="{{ asset('media/header/header (3).jpg') }}" alt="Find your trail" class="absolute inset-0 w-full h-full object-cover opacity-80" loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-black/50"></div>
            <div class="absolute inset-0 flex flex-col justify-center px-6 sm:px-12 lg:px-24 max-w-7xl mx-auto w-full pt-16">
                <span class="text-white/80 font-bold tracking-widest text-xs sm:text-sm uppercase mb-4 sm:mb-6">Getaways</span>
                <h1 class="text-5xl md:text-7xl lg:text-[5.5rem] font-bold text-white leading-[1.1] mb-6 max-w-4xl tracking-tight">Slow down.<br>Breathe deep.</h1>
                <p class="text-lg md:text-2xl text-white/90 mb-10 max-w-2xl font-light">Some journeys stay with you forever.</p>
                <div class="flex">
                    <a href="{{ route('treks.index') }}" class="inline-flex items-center justify-center font-bold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary text-lg px-8 py-4 bg-white text-black border-none hover:bg-gray-100 transition-colors">View Destinations</a>
                </div>
            </div>
        </div>

    </div>

    {{-- Carousel Controls --}}
    <div class="absolute bottom-10 right-6 sm:right-12 lg:right-24 flex items-center gap-6 z-20">
        <button id="carousel-prev" class="text-white hover:text-white/70 transition-colors focus:outline-none p-2 border border-white/30 rounded-full hover:border-white" aria-label="Previous slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <div class="flex gap-3" id="carousel-dots">
            <button class="w-1.5 h-1.5 rounded-full bg-white opacity-100 transition-all focus:outline-none" aria-label="Slide 1"></button>
            <button class="w-1.5 h-1.5 rounded-full bg-white opacity-40 hover:opacity-100 transition-all focus:outline-none" aria-label="Slide 2"></button>
            <button class="w-1.5 h-1.5 rounded-full bg-white opacity-40 hover:opacity-100 transition-all focus:outline-none" aria-label="Slide 3"></button>
        </div>
        <button id="carousel-next" class="text-white hover:text-white/70 transition-colors focus:outline-none p-2 border border-white/30 rounded-full hover:border-white" aria-label="Next slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.carousel-item');
        const dots = document.querySelectorAll('#carousel-dots button');
        const prevBtn = document.getElementById('carousel-prev');
        const nextBtn = document.getElementById('carousel-next');
        const carousel = document.getElementById('hero-carousel');
        let currentSlide = 0;
        let slideInterval;
        const intervalTime = 7000;

        function goToSlide(n) {
            slides[currentSlide].classList.remove('opacity-100', 'z-10');
            slides[currentSlide].classList.add('opacity-0', 'z-0');
            dots[currentSlide].classList.remove('opacity-100', 'scale-125');
            dots[currentSlide].classList.add('opacity-40');
            
            currentSlide = (n + slides.length) % slides.length;
            
            slides[currentSlide].classList.remove('opacity-0', 'z-0');
            slides[currentSlide].classList.add('opacity-100', 'z-10');
            dots[currentSlide].classList.remove('opacity-40');
            dots[currentSlide].classList.add('opacity-100', 'scale-125');
        }

        function nextSlide() { goToSlide(currentSlide + 1); }
        function prevSlide() { goToSlide(currentSlide - 1); }

        function startSlideShow() {
            slideInterval = setInterval(nextSlide, intervalTime);
        }

        function stopSlideShow() {
            clearInterval(slideInterval);
        }

        nextBtn.addEventListener('click', () => { nextSlide(); stopSlideShow(); startSlideShow(); });
        prevBtn.addEventListener('click', () => { prevSlide(); stopSlideShow(); startSlideShow(); });

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                goToSlide(index);
                stopSlideShow();
                startSlideShow();
            });
        });

        carousel.addEventListener('mouseenter', stopSlideShow);
        carousel.addEventListener('mouseleave', startSlideShow);
        carousel.addEventListener('focusin', stopSlideShow);
        carousel.addEventListener('focusout', startSlideShow);

        startSlideShow();
        dots[0].classList.add('scale-125');
    });
</script>


{{-- 7. TREK DISCOVERY / YOUR NEXT ADVENTURE --}}
<div class="bg-[#FDF2F7]/30 py-32 border-b border-border-subtle" x-data="trekDiscovery()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-20">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#000000] tracking-tight mb-4">Your Next Adventure</h2>
            <p class="text-xl text-[#98806F] font-light">Find something that feels right.</p>
        </div>

        {{-- COMPACT DISCOVERY CONTROLS --}}
        <div class="mb-24 relative bg-white p-8 md:p-12 border border-border-subtle shadow-sm flex flex-col gap-12">
            
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#98806F]">Filter Treks</span>
                <button @click="clearFilters()" x-show="activeMonth || activeSeason || activeDifficulty" style="display: none;" class="text-xs font-bold uppercase tracking-wider text-[#438D98] hover:text-[#31A8CC] transition-colors">
                    Clear Filters
                </button>
            </div>

            {{-- 1. Month Selector --}}
            <div>
                <div class="flex overflow-x-auto pb-4 gap-8 md:gap-12 scrollbar-hide snap-x justify-between">
                    @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                        <button @click="toggleMonth('{{ strtoupper($month) }}')" 
                            :class="activeMonth === '{{ strtoupper($month) }}' ? 'text-[#438D98] font-bold border-b-2 border-[#438D98]' : 'text-text-muted font-light border-b-2 border-transparent hover:text-[#438D98]'"
                            class="snap-start flex-none pb-2 text-xl md:text-2xl transition-all focus:outline-none uppercase tracking-widest">
                            {{ substr($month, 0, 3) }}
                        </button>
                    @endforeach
                </div>
            </div>
            
            <div class="w-full h-px bg-border-subtle"></div>

            {{-- 2. Season & Difficulty (Compact) --}}
            <div class="flex flex-col md:flex-row gap-12 md:gap-24">
                
                <div class="flex-1">
                    <h3 class="text-xs font-bold text-[#98806F] uppercase tracking-[0.2em] mb-6">Season</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['Winter', 'Summer', 'Monsoon', 'Spring', 'Autumn'] as $season)
                            <button @click="toggleSeason('{{ $season }}')" 
                                :class="activeSeason === '{{ $season }}' ? 'bg-[#438D98] text-white border-[#438D98]' : 'bg-transparent text-[#98806F] border-border-strong hover:border-[#438D98] hover:text-[#438D98]'"
                                class="px-5 py-2.5 text-xs font-bold uppercase tracking-widest border transition-all focus:outline-none">
                                {{ $season }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="flex-1">
                    <h3 class="text-xs font-bold text-[#98806F] uppercase tracking-[0.2em] mb-6">Difficulty</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['Easy', 'Moderate', 'Hard', 'Expert'] as $difficulty)
                            <button @click="toggleDifficulty('{{ $difficulty }}')" 
                                :class="activeDifficulty === '{{ $difficulty }}' ? 'bg-[#000000] text-white border-[#000000]' : 'bg-transparent text-[#98806F] border-border-strong hover:border-[#000000] hover:text-[#000000]'"
                                class="px-5 py-2.5 text-xs font-bold uppercase tracking-widest border transition-all focus:outline-none">
                                {{ $difficulty }}
                            </button>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        {{-- MATCHING TREKS RESULTS --}}
        <div>
            <div class="flex items-end justify-between mb-12 border-b border-border-subtle pb-6" x-show="filteredTreks.length > 0" style="display: none;">
                <h3 class="text-3xl font-bold text-[#000000] tracking-tight">Matching Adventures</h3>
                <span class="text-sm font-bold tracking-[0.2em] uppercase text-[#438D98]" x-text="filteredTreks.length + (filteredTreks.length === 1 ? ' Trek' : ' Treks')"></span>
            </div>

            {{-- Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" x-show="filteredTreks.length > 0" style="display: none;">
                <template x-for="trek in filteredTreks" :key="trek.id">
                    <a :href="'/treks/' + trek.slug" class="group block relative aspect-[4/5] bg-bg-subtle overflow-hidden border border-border-subtle shadow-sm">
                        <img :src="trek.image_url || '/media/placeholder.jpg'" :alt="trek.title" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-105 opacity-90" loading="lazy" onerror="this.src='/media/header/header (2).jpg'">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="absolute top-6 left-6">
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-white bg-black/60 backdrop-blur-md px-3 py-1.5" x-text="trek.difficulty"></span>
                        </div>

                        <div class="absolute inset-0 p-8 flex flex-col justify-end">
                            <h3 class="text-3xl font-bold text-white mb-3 leading-tight" x-text="trek.title"></h3>
                            
                            <div class="flex items-center text-[#FDF2F7]/80 text-xs tracking-[0.2em] uppercase mb-5 space-x-3">
                                <span x-show="trek.region" x-text="trek.region"></span>
                                <span x-show="trek.region">&bull;</span>
                                <span x-text="trek.duration + ' Days'"></span>
                                <span>&bull;</span>
                                <span x-text="'₹' + (trek.price / 100).toLocaleString()"></span>
                            </div>
                            
                            <div x-show="trek.best_months && trek.best_months.length > 0" class="mb-6">
                                <span class="text-white/50 text-[9px] font-bold uppercase tracking-[0.3em] block mb-2">Best Time</span>
                                <span class="text-white/90 font-light text-xs tracking-[0.2em] uppercase" x-text="trek.best_months ? (trek.best_months.length > 2 ? trek.best_months.slice(0,2).map(m => m.substring(0,3)).join(', ') + ' +' + (trek.best_months.length - 2) : trek.best_months.map(m => m.substring(0,3)).join(', ')) : ''"></span>
                            </div>

                            <p class="text-white text-sm font-bold tracking-[0.2em] uppercase flex items-center">Explore <span class="ml-2 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all">&rarr;</span></p>
                        </div>
                    </a>
                </template>
            </div>

            {{-- Empty State --}}
            <div x-show="filteredTreks.length === 0" style="display: none;" class="py-32 text-center flex flex-col items-center justify-center border border-border-subtle bg-white shadow-sm">
                <p class="text-3xl text-[#000000] font-bold mb-4 tracking-tight">No treks match this selection.</p>
                <p class="text-[#98806F] font-light text-xl mb-10">Try adjusting your filters to discover more trails.</p>
                <button @click="clearFilters()" class="inline-flex items-center justify-center font-bold text-sm tracking-[0.2em] uppercase px-10 py-4 bg-[#000000] text-white hover:bg-[#438D98] transition-all focus:outline-none">
                    Reset Filters
                </button>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('trekDiscovery', () => ({
            treks: @json($allTreks ?? []),
            activeMonth: null,
            activeSeason: null,
            activeDifficulty: null,
            
            toggleMonth(month) {
                this.activeMonth = this.activeMonth === month ? null : month;
            },
            
            toggleSeason(season) {
                this.activeSeason = this.activeSeason === season ? null : season;
            },
            
            toggleDifficulty(difficulty) {
                this.activeDifficulty = this.activeDifficulty === difficulty ? null : difficulty;
            },
            
            clearFilters() {
                this.activeMonth = null;
                this.activeSeason = null;
                this.activeDifficulty = null;
            },
            
            get filteredTreks() {
                return this.treks.filter(trek => {
                    let match = true;
                    
                    if (this.activeDifficulty && trek.difficulty !== this.activeDifficulty) {
                        match = false;
                    }
                    
                    if (this.activeMonth && match) {
                        if (!trek.best_months || !trek.best_months.includes(this.activeMonth)) {
                            match = false;
                        }
                    }

                    if (this.activeSeason && match) {
                        if (!trek.season || !trek.season.includes(this.activeSeason)) {
                            match = false;
                        }
                    }
                    
                    return match;
                });
            }
        }));
    });
</script>


{{-- 11. UPCOMING ADVENTURES --}}
<div class="bg-bg-subtle py-32 border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-16">
            <div>
                <h2 class="text-4xl md:text-5xl font-bold text-text-primary tracking-tight">Upcoming Adventures</h2>
                <p class="mt-4 text-xl text-text-secondary font-light">Trails worth getting out for.</p>
            </div>
            <a href="{{ route('treks.index') }}" class="hidden sm:inline-flex items-center text-text-primary hover:text-brand-primary font-medium text-lg mt-6 sm:mt-0 transition-colors group">
                View all treks <span aria-hidden="true" class="ml-2 transform group-hover:translate-x-1 transition-transform">&rarr;</span>
            </a>
        </div>

        @if($featuredTreks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($featuredTreks->take(3) as $trek)
                    <x-trek-card :trek="$trek" />
                @endforeach
            </div>
        @else
            <div class="py-24 text-center border border-border-subtle bg-bg-base shadow-sm">
                <p class="text-xl text-text-secondary font-light">We're currently preparing our upcoming season. Check back soon.</p>
            </div>
        @endif
        
        <div class="mt-12 sm:hidden text-center">
            <x-button href="{{ route('treks.index') }}" variant="outline" class="w-full text-lg py-5 border-border-strong hover:bg-border-subtle">
                View all treks
            </x-button>
        </div>

    </div>
</div>

{{-- 12. WHAT ARE YOU LOOKING FOR? --}}
<div class="bg-bg-base py-32 border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl md:text-5xl font-bold text-text-primary tracking-tight text-center mb-20">What are you looking for?</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <a href="#" class="group block relative aspect-[3/4] bg-bg-subtle overflow-hidden">
                <img src="{{ asset('media/header/header (2).jpg') }}" alt="Quick Escape" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 opacity-90" loading="lazy">
                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/20 transition-colors duration-500"></div>
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <h3 class="text-3xl font-bold text-white mb-2 leading-tight">I want a quick escape</h3>
                    <p class="text-white/90 text-lg font-light flex items-center">Day treks & short experiences <span class="ml-2 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all">&rarr;</span></p>
                </div>
            </a>

            <a href="#" class="group block relative aspect-[3/4] bg-bg-subtle overflow-hidden">
                <img src="{{ asset('media/header/header (1).jpg') }}" alt="Go Higher" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 opacity-90" loading="lazy">
                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/20 transition-colors duration-500"></div>
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <h3 class="text-3xl font-bold text-white mb-2 leading-tight">I want to go higher</h3>
                    <p class="text-white/90 text-lg font-light flex items-center">Himalayan adventures <span class="ml-2 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all">&rarr;</span></p>
                </div>
            </a>

            <a href="#" class="group block relative aspect-[3/4] bg-bg-subtle overflow-hidden">
                <img src="{{ asset('media/header/header (3).jpg') }}" alt="Slow Down" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 opacity-90" loading="lazy">
                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/20 transition-colors duration-500"></div>
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <h3 class="text-3xl font-bold text-white mb-2 leading-tight">I want to slow down</h3>
                    <p class="text-white/90 text-lg font-light flex items-center">Camping & getaways <span class="ml-2 opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all">&rarr;</span></p>
                </div>
            </a>

        </div>
    </div>
</div>

{{-- 13. TRUST / TRAVENTURE PHILOSOPHY --}}
<div class="bg-bg-subtle py-32 border-b border-border-subtle">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-text-primary leading-tight mb-20 tracking-tight">Adventure should feel exciting.<br>Planning it shouldn't.</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-16 text-left">
            <div>
                <h3 class="text-xl font-bold text-text-primary mb-4">Know before you go</h3>
                <p class="text-lg text-text-secondary leading-relaxed font-light">Clear information about your trek, dates, and what you're getting into before you ever pack a bag.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-text-primary mb-4">People behind the journey</h3>
                <p class="text-lg text-text-secondary leading-relaxed font-light">Real people, experienced trek leaders, and dedicated local support teams guiding every experience.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-text-primary mb-4">Come prepared</h3>
                <p class="text-lg text-text-secondary leading-relaxed font-light">Honest fitness requirements, detailed gear lists, and practical preparation advice. No surprises on the trail.</p>
            </div>
        </div>
    </div>
</div>

{{-- 14. MEET THE TEAM --}}
<div class="bg-bg-base py-32 border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-text-primary mb-6 tracking-tight">The people behind the journeys</h2>
        <p class="text-xl text-text-secondary max-w-2xl mx-auto mb-16 font-light">Meet the people who make each journey possible.</p>
        
        <div class="max-w-4xl mx-auto aspect-[2/1] bg-bg-subtle flex flex-col items-center justify-center border border-border-subtle shadow-sm">
            <span class="text-sm font-bold uppercase tracking-widest text-text-muted mb-2">Team profiles</span>
            <span class="text-2xl text-text-secondary font-light">Coming Soon</span>
        </div>
        
        <div class="mt-12">
            <button disabled class="text-lg px-8 py-4 bg-bg-subtle text-text-muted border border-border-strong cursor-not-allowed">Meet the team</button>
        </div>
    </div>
</div>

{{-- 15. STORIES FROM THE TRAIL --}}
<div class="bg-bg-subtle py-32 border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-text-primary mb-16 tracking-tight">Stories from the trail</h2>
        
        <div class="max-w-3xl mx-auto py-16 px-8 bg-bg-base border border-border-subtle shadow-sm relative">
            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-bg-subtle px-4 text-brand-primary">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            </div>
            <p class="text-2xl text-text-secondary font-light italic leading-relaxed mt-4">Stories from our trails are coming soon.</p>
        </div>
    </div>
</div>

{{-- 16. TRAVENTURE JOURNAL --}}
<div class="bg-bg-base py-32 border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl md:text-5xl font-bold text-text-primary mb-16 tracking-tight text-center md:text-left">From the trail</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="aspect-[4/3] bg-bg-subtle flex flex-col items-center justify-center border border-border-subtle">
                <span class="text-sm font-bold uppercase tracking-widest text-text-muted mb-2">Traventure Journal</span>
                <span class="text-xl text-text-secondary font-light">Coming Soon</span>
            </div>
            <div class="aspect-[4/3] bg-bg-subtle flex flex-col items-center justify-center border border-border-subtle">
                <span class="text-sm font-bold uppercase tracking-widest text-text-muted mb-2">Traventure Journal</span>
                <span class="text-xl text-text-secondary font-light">Coming Soon</span>
            </div>
        </div>
    </div>
</div>

{{-- 17. FINAL EMOTIONAL CTA --}}
<div class="relative w-full h-[60vh] md:h-[70vh] bg-black">
    <img src="{{ asset('media/header/header (3).jpg') }}" alt="Trail waiting for you" class="absolute inset-0 w-full h-full object-cover opacity-70" loading="lazy">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="absolute inset-0 flex flex-col justify-center items-center px-4 sm:px-6 text-center z-10">
        <h2 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight tracking-tight">There's a trail waiting for you.</h2>
        <p class="text-xl md:text-2xl text-white/90 mb-12 font-light">Where will you go next?</p>
        <a href="{{ route('treks.index') }}" class="inline-flex items-center justify-center font-bold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary text-lg px-10 py-5 bg-white text-black border-none hover:bg-gray-100 shadow-xl transition-all hover:scale-105">
            Explore Treks
        </a>
    </div>
</div>

@endsection
