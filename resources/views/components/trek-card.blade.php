@props(['trek'])

<x-card class="flex flex-col h-full group hover:shadow-md transition-shadow">
    {{-- Optional Image Placeholder --}}
    <div class="h-48 bg-bg-subtle flex items-center justify-center border-b border-border-subtle -mt-6 -mx-6 mb-4 overflow-hidden">
        <svg class="h-12 w-12 text-text-muted group-hover:scale-110 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
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
