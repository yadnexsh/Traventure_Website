@props(['trek'])

@php
    // Temporary image mapping for development visuals
    $imageMap = [
        'himalayan-base-camp' => 'test_image (1).jpg',
        'valley-of-flowers' => 'test_image (2).jpg',
        'weekend-forest-trail' => 'test_image (3).jpg',
        'easy-day-trek' => 'test_image (4).jpg',
        'moderate-weekend' => 'test_image (5).jpg',
        'hard-multi-day' => 'test_image (6).jpg',
        'camping-oriented' => 'test_image (7).jpg',
    ];
    $image = $imageMap[$trek->slug] ?? 'test_image (1).jpg';
@endphp

<div class="group flex flex-col h-full bg-bg-base border border-border-subtle hover:border-border-strong transition-colors rounded-lg overflow-hidden">
    {{-- Image Placeholder with temporary image --}}
    <div class="h-56 bg-bg-subtle relative overflow-hidden">
        <img src="{{ asset('media/' . $image) }}" alt="{{ $trek->title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
        <div class="absolute inset-0 bg-brand-dark/10 group-hover:bg-transparent transition-colors z-10"></div>
    </div>

    <div class="p-6 flex-grow flex flex-col">
        <h3 class="text-xl font-bold text-text-primary mb-2 group-hover:text-brand-primary transition-colors">
            <a href="{{ route('treks.show', $trek) }}">
                <span class="absolute inset-0"></span>
                {{ $trek->title }}
            </a>
        </h3>

        <div class="flex items-center gap-3 text-sm text-text-secondary mb-4">
            @if($trek->duration)
                <span>{{ $trek->duration }} Days</span>
            @endif
            @if($trek->difficulty && $trek->duration)
                <span class="w-1 h-1 rounded-full bg-border-strong"></span>
            @endif
            @if($trek->difficulty)
                <span>{{ $trek->difficulty }}</span>
            @endif
        </div>

        <p class="text-text-secondary text-sm line-clamp-3 mb-6 flex-grow">
            {{ $trek->summary }}
        </p>

        <div class="flex items-end justify-between mt-auto pt-4 border-t border-border-subtle">
            <div>
                <span class="block text-xs font-medium text-text-muted uppercase tracking-wider mb-1">Starting from</span>
                <span class="font-bold text-text-primary text-lg">₹{{ number_format($trek->price / 100) }}</span>
            </div>
            <span class="text-brand-primary font-medium text-sm group-hover:underline">Explore trek &rarr;</span>
        </div>
    </div>
</div>
