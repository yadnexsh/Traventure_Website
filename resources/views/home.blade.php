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


{{-- 7. YOUR NEXT ADVENTURE --}}
<div class="bg-bg-base py-24 border-b border-border-subtle overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-20">
            <h2 class="text-4xl md:text-5xl font-bold text-text-primary tracking-tight">Your Next Adventure</h2>
            <p class="text-xl text-text-secondary mt-4 font-light">Find something that feels right.</p>
        </div>

        {{-- 8. TREKS BY MONTH --}}
        <div class="mb-24">
            <h3 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-6">Treks by Month</h3>
            <div class="flex overflow-x-auto pb-4 gap-4 scrollbar-hide snap-x">
                @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                    <a href="#" class="snap-start flex-none px-8 py-6 border border-border-strong text-text-primary text-lg hover:border-brand-primary hover:text-brand-primary transition-colors">
                        {{ $month }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- 9. TREKS BY SEASON & 10. TREKS BY DIFFICULTY --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
            <div>
                <h3 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-6">Treks by Season</h3>
                <div class="flex flex-wrap gap-4">
                    @foreach(['Winter', 'Summer', 'Monsoon', 'Autumn'] as $season)
                        <a href="#" class="px-6 py-4 border border-border-strong text-text-primary hover:border-brand-primary hover:bg-brand-primary hover:text-white transition-all">
                            {{ $season }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <div>
                <h3 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-6">Treks by Difficulty</h3>
                <div class="flex flex-wrap gap-4">
                    @foreach(['Easy', 'Moderate', 'Difficult', 'Expert'] as $difficulty)
                        <a href="#" class="px-6 py-4 border border-border-strong text-text-primary hover:border-brand-primary hover:bg-brand-primary hover:text-white transition-all">
                            {{ $difficulty }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

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
