@props(['trek'])

<x-card class="flex flex-col h-full group hover:shadow-md transition-shadow">
    {{-- Optional Image Placeholder --}}
    <div class="h-48 bg-bg-subtle flex items-center justify-center border-b border-border-subtle -mt-6 -mx-6 mb-4 overflow-hidden relative group">
        <img src="{{ !empty($trek->image_url) ? asset($trek->image_url) : asset('media/placeholder.jpg') }}" alt="{{ $trek->title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" onerror="this.src='{{ asset('media/header/header (2).jpg') }}'">
        <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-500"></div>
    </div>

    <div class="flex-grow flex flex-col">
        <div class="flex justify-between items-start mb-2">
            <h3 class="text-xl font-bold text-text-primary group-hover:text-brand-primary transition-colors">
                <a href="{{ route('treks.show', $trek) }}">
                    <span class="absolute inset-0"></span>
                    {{ $trek->title }}
                </a>
            </h3>
        </div>

        <p class="text-text-secondary text-sm line-clamp-3 mb-4 flex-grow">
            {{ $trek->summary }}
        </p>

        <div class="space-y-3 mt-auto">
            <div class="flex flex-wrap gap-2">
                @if($trek->difficulty)
                    <x-badge variant="default">{{ $trek->difficulty }}</x-badge>
                @endif
                @if($trek->duration)
                    <x-badge variant="default">{{ $trek->duration }} Days</x-badge>
                @endif
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-border-subtle">
                <div class="text-sm">
                    <span class="text-text-muted">From</span>
                    <span class="font-bold text-text-primary text-lg ml-1">₹{{ number_format($trek->price / 100) }}</span>
                </div>
                <span class="text-brand-primary font-medium text-sm group-hover:underline">Explore →</span>
            </div>
        </div>
    </div>
</x-card>

