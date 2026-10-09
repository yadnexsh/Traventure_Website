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
<div class="bg-bg-base pt-24 pb-32 border-b border-border-subtle" x-data="trekDiscovery()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-12">
            <h2 class="text-4xl md:text-5xl font-bold text-text-primary tracking-tight">Your Next Adventure</h2>
            <p class="text-xl text-text-secondary mt-4 font-light">Find the trail that fits your time, your season and your spirit.</p>
        </div>

        {{-- FILTERS --}}
        <div class="mb-16">
            <div class="flex items-center justify-between border-b border-border-subtle pb-4">
                <span class="text-sm font-bold uppercase tracking-widest text-text-muted">Filter Treks</span>
                <button @click="clearFilters()" x-show="activeMonth || activeSeason || activeDifficulty" style="display: none;" class="text-sm font-medium text-brand-primary hover:text-brand-secondary transition-colors">
                    Clear all
                </button>
            </div>

            {{-- Contr{{-- By Month --}}
            <div class="mb-10 mt-6">
                <h3 class="text-xs font-semibold text-text-muted uppercase tracking-wider mb-6 text-center">Treks by Month</h3>
                <div class="flex overflow-x-auto pb-4 gap-2 md:justify-center scrollbar-hide snap-x px-2">
                    @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                        <button @click="toggleMonth('{{ strtoupper($month) }}')" 
                            :class="activeMonth === '{{ strtoupper($month) }}' ? 'bg-text-primary text-bg-base border-text-primary shadow-sm' : 'bg-transparent text-text-secondary border-border-strong hover:border-text-muted'"
                            class="snap-start flex-none px-5 py-2.5 text-sm border rounded-full transition-all focus:outline-none font-medium">
                            {{ $month }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Controls Container (Season & Difficulty) --}}
            <div class="flex flex-col lg:flex-row justify-center gap-8 lg:gap-16 pt-8 border-t border-border-subtle">
                
                {{-- By Season --}}
                <div class="flex-1 lg:max-w-md">
                    <h3 class="text-xs font-semibold text-text-muted uppercase tracking-wider mb-5 text-center lg:text-left">By Season</h3>
                    <div class="flex flex-wrap justify-center lg:justify-start gap-3">
                        @foreach([
                            'Winter' => 'Snow possible on selected high-altitude routes',
                            'Summer' => 'Seasonal high-altitude adventures',
                            'Monsoon' => 'Lush landscapes and rainfall',
                            'Spring' => 'Blooming landscapes on suitable routes',
                            'Autumn' => 'Clearer skies and seasonal trekking'
                        ] as $season => $desc)
                            <button @click="toggleSeason('{{ $season }}')" 
                                :class="activeSeason === '{{ $season }}' ? 'bg-text-primary text-bg-base border-text-primary shadow-sm' : 'bg-transparent text-text-secondary border-border-strong hover:border-text-muted'"
                                class="flex flex-col items-start px-4 py-3 text-left border rounded-xl transition-all focus:outline-none flex-1 min-w-[160px]">
                                <span class="font-semibold text-sm mb-1">{{ $season }}</span>
                                <span class="text-[10px] leading-tight opacity-80" :class="activeSeason === '{{ $season }}' ? 'text-bg-base' : 'text-text-muted'">{{ $desc }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- By Difficulty --}}
                <div class="flex-1 lg:max-w-md">
                    <h3 class="text-xs font-semibold text-text-muted uppercase tracking-wider mb-5 text-center lg:text-left">By Difficulty</h3>
                    <div class="flex flex-wrap justify-center lg:justify-start gap-3">
                        @foreach([
                            'Easy' => 'Suitable for beginners',
                            'Moderate' => 'Requires basic fitness',
                            'Hard' => 'For experienced trekkers',
                            'Expert' => 'Technical climbing skills needed'
                        ] as $difficulty => $desc)
                            <button @click="toggleDifficulty('{{ $difficulty }}')" 
                                :class="activeDifficulty === '{{ $difficulty }}' ? 'bg-text-primary text-bg-base border-text-primary shadow-sm' : 'bg-transparent text-text-secondary border-border-strong hover:border-text-muted'"
                                class="flex flex-col items-start px-4 py-3 text-left border rounded-xl transition-all focus:outline-none flex-1 min-w-[140px]">
                                <span class="font-semibold text-sm mb-1">{{ $difficulty }}</span>
                                <span class="text-[10px] leading-tight opacity-80" :class="activeDifficulty === '{{ $difficulty }}' ? 'text-bg-base' : 'text-text-muted'">{{ $desc }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        ING TREKS RESULTS --}}
        <div>
            <div class="flex items-end justify-between mb-8">
                <h3 class="text-2xl font-bold text-text-primary tracking-tight" x-text="filteredTreks.length > 0 ? 'Matching Treks' : ''"></h3>
                <span class="text-sm text-text-muted" x-show="filteredTreks.length > 0" x-text="filteredTreks.length + (filteredTreks.length === 1 ? ' Trek' : ' Treks')"></span>
            </div>

            {{-- Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" x-show="filteredTreks.length > 0">
                <template x-for="trek in filteredTreks" :key="trek.id">
                    <div class="group relative flex flex-col bg-bg-base border border-border-subtle overflow-hidden h-full">
                        {{-- Image Area --}}
                        <div class="relative aspect-[4/3] bg-bg-subtle overflow-hidden">
                            <img :src="trek.image_url || '/media/placeholder.jpg'" :alt="trek.title" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" onerror="this.src='/media/header/header (2).jpg'">
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-500"></div>
                            
                            {{-- Difficulty Badge --}}
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 bg-white/90 backdrop-blur-sm text-xs font-bold uppercase tracking-wider text-text-primary shadow-sm" x-text="trek.difficulty"></span>
                            </div>
                        </div>

                        {{-- Content Area --}}
                        <div class="flex flex-col flex-grow p-6">
                            <h3 class="text-2xl font-bold text-text-primary mb-2 leading-tight tracking-tight group-hover:text-brand-primary transition-colors" x-text="trek.title"></h3>
                            
                            <div class="flex flex-wrap items-center text-sm text-text-muted mb-4 gap-4">
                                <span class="flex items-center" x-show="trek.region">
                                    <svg class="w-4 h-4 mr-1.5 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span x-text="trek.region"></span>
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span x-text="trek.duration + ' Days'"></span>
                                </span>
                            </div>

                            <p class="text-text-secondary text-base leading-relaxed font-light mb-6 flex-grow line-clamp-3" x-text="trek.summary"></p>
                            
                            {{-- Best Months preview if available --}}
                            <div x-show="trek.best_months && trek.best_months.length > 0" class="mb-4">
                                <span class="text-xs text-text-muted uppercase tracking-wider block mb-1">Best Time:</span>
                                <span class="text-sm text-text-primary font-medium" x-text="trek.best_months ? (trek.best_months.length > 2 ? trek.best_months.slice(0,2).map(m => m.substring(0,3)).join(', ') + ' +' + (trek.best_months.length - 2) : trek.best_months.map(m => m.substring(0,3)).join(', ')) : ''"></span>
                            </div>

                            <div class="pt-4 border-t border-border-subtle mt-auto flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-xs text-text-muted uppercase tracking-wider">Starting from</span>
                                    <span class="text-lg font-bold text-text-primary" x-text="'₹' + (trek.price / 100).toLocaleString()"></span>
                                </div>
                                <a :href="'/treks/' + trek.slug" class="inline-flex items-center text-sm font-bold text-brand-primary hover:text-brand-secondary transition-colors">
                                    View Trek <span aria-hidden="true" class="ml-1">&rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Empty State --}}
            <div x-show="filteredTreks.length === 0" style="display: none;" class="py-24 text-center border border-border-subtle bg-bg-subtle shadow-sm flex flex-col items-center justify-center">
                <svg class="w-12 h-12 text-text-muted mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <p class="text-xl text-text-primary font-medium mb-2">No treks match this selection yet.</p>
                <p class="text-text-secondary font-light mb-6">Try adjusting your filters or clearing them to see more.</p>
                <button @click="clearFilters()" class="inline-flex items-center justify-center px-6 py-3 border border-border-strong rounded-md text-sm font-medium text-text-primary bg-bg-base hover:bg-bg-subtle transition-colors">
                    Clear Filters
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('trekDiscovery', () => ({
            treks: @json($allTreks),
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
        
        <div class="max-w-4xl mx-auto aspect-[2/1] bg-bg-subtle relative overflow-hidden flex flex-col items-center justify-center border border-border-subtle shadow-sm group">
            <img src="{{ asset('media/team/team_banner.jpg') }}" alt="Traventure Team" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 opacity-90">
            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition-colors duration-500"></div>
            <div class="relative z-10 text-center flex flex-col items-center justify-center">
                <span class="text-sm font-bold uppercase tracking-widest text-white mb-2">Team profiles</span>
                <span class="text-2xl text-white/90 font-light">Coming Soon</span>
            </div>
        </div>
        
        <div class="mt-12">
            <button disabled class="text-lg px-8 py-4 bg-bg-subtle text-text-muted border border-border-strong cursor-not-allowed">Meet the team</button>
        </div>
    </div>
</div>

{{-- 15. STORIES FROM THE TRAIL --}}
<div class="bg-bg-subtle py-32 border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-text-primary tracking-tight">Stories from the trail</h2>
            <p class="text-xl text-text-secondary mt-4 font-light">People who went trekking with us.</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="relative aspect-[4/3] bg-bg-subtle overflow-hidden group border border-border-subtle shadow-sm">
                <img src="{{ asset('media/header/header (2).jpg') }}" alt="Trekker experience" class="absolute inset-0 w-full h-full object-cover opacity-90 transition-transform duration-1000 group-hover:scale-105" loading="lazy">
                <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors duration-500"></div>
            </div>
            <div class="px-8 lg:px-12 py-12 bg-bg-base border border-border-subtle shadow-sm relative">
                <div class="text-brand-primary mb-6">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                </div>
                <p class="text-xl md:text-2xl text-text-primary font-light leading-relaxed italic mb-8">
                    "I had never done a multi-day trek before. The team at Traventure made sure I was prepared mentally and physically. Standing at the peak, watching the sunrise over the Sahyadris, all the exhaustion just melted away. It was deeply emotional—a journey I'll never forget."
                </p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-brand-primary flex items-center justify-center text-white font-bold text-lg">
                        S
                    </div>
                    <div>
                        <div class="font-bold text-text-primary">Surendra J</div>
                        <div class="text-sm text-text-muted">Kalsubai Sunrise Trek</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 16. TRAVENTURE JOURNAL --}}
<div class="bg-bg-base py-32 border-b border-border-subtle">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div>
                <h2 class="text-4xl md:text-5xl font-bold text-text-primary tracking-tight">From the Journal</h2>
                <p class="text-xl text-text-secondary mt-4 font-light">Knowledge and articles published by Traventure.</p>
            </div>
            <a href="{{ route('journal.index') }}" class="inline-flex items-center text-brand-primary font-bold hover:text-brand-secondary transition-colors">
                View all articles <span class="ml-2">&rarr;</span>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            {{-- Article 1 --}}
            <a href="{{ route('journal.show', 'the-ultimate-winter-trekking-packing-list') }}" class="group flex flex-col h-full bg-bg-base border border-border-subtle overflow-hidden hover:shadow-md transition-all">
                <div class="relative aspect-[16/9] overflow-hidden bg-bg-subtle">
                    <img src="{{ asset('media/header/header (3).jpg') }}" alt="Winter Packing Guide" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-xs font-bold uppercase tracking-wider text-brand-primary mb-3">Preparation</div>
                    <h3 class="text-xl font-bold text-text-primary mb-3 leading-tight group-hover:text-brand-primary transition-colors">The Ultimate Winter Trekking Packing List</h3>
                    <p class="text-text-secondary line-clamp-3 mb-6 font-light">Layering is an art in the Himalayas. Discover exactly what you need to stay warm without overpacking your rucksack on your next winter expedition.</p>
                    <div class="mt-auto flex items-center justify-between pt-4 border-t border-border-subtle text-sm text-text-muted">
                        <span>Traventure Team</span>
                        <span>Oct 12, 2026</span>
                    </div>
                </div>
            </a>
            
            {{-- Article 2 --}}
            <a href="{{ route('journal.show', 'understanding-acute-mountain-sickness') }}" class="group flex flex-col h-full bg-bg-base border border-border-subtle overflow-hidden hover:shadow-md transition-all">
                <div class="relative aspect-[16/9] overflow-hidden bg-bg-subtle">
                    <img src="{{ asset('media/header/header (1).jpg') }}" alt="Preventing AMS" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-xs font-bold uppercase tracking-wider text-brand-primary mb-3">Safety & Health</div>
                    <h3 class="text-xl font-bold text-text-primary mb-3 leading-tight group-hover:text-brand-primary transition-colors">Understanding Acute Mountain Sickness (AMS)</h3>
                    <p class="text-text-secondary line-clamp-3 mb-6 font-light">Altitude affects everyone differently, regardless of fitness. Learn the early signs of AMS, how to acclimatize properly, and when to descend safely.</p>
                    <div class="mt-auto flex items-center justify-between pt-4 border-t border-border-subtle text-sm text-text-muted">
                        <span>Traventure Guides</span>
                        <span>Sep 28, 2026</span>
                    </div>
                </div>
            </a>

            {{-- Article 3 --}}
            <a href="{{ route('journal.show', 'why-the-sahyadris-come-alive-in-the-monsoon') }}" class="group flex flex-col h-full bg-bg-base border border-border-subtle overflow-hidden hover:shadow-md transition-all hidden lg:flex">
                <div class="relative aspect-[16/9] overflow-hidden bg-bg-subtle">
                    <img src="{{ asset('media/header/header (2).jpg') }}" alt="Monsoon Trekking" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-xs font-bold uppercase tracking-wider text-brand-primary mb-3">Destinations</div>
                    <h3 class="text-xl font-bold text-text-primary mb-3 leading-tight group-hover:text-brand-primary transition-colors">Why the Sahyadris Come Alive in the Monsoon</h3>
                    <p class="text-text-secondary line-clamp-3 mb-6 font-light">When it rains, the Western Ghats transform into a vivid green paradise. We explore the best trails to experience the magic of the Indian monsoon.</p>
                    <div class="mt-auto flex items-center justify-between pt-4 border-t border-border-subtle text-sm text-text-muted">
                        <span>Traventure Editorial</span>
                        <span>Jul 15, 2026</span>
                    </div>
                </div>
            </a>
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
