@props(['title', 'description' => null, 'icon' => null])

<div {{ $attributes->merge(['class' => 'text-center py-12 px-4 border-2 border-dashed border-border-strong rounded-lg bg-bg-subtle/50']) }}>
    @if ($icon)
        <div class="mx-auto h-12 w-12 text-text-muted mb-4">
            {{ $icon }}
        </div>
    @else
        <svg class="mx-auto h-12 w-12 text-text-muted mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
        </svg>
    @endif
    
    <h3 class="mt-2 text-sm font-semibold text-text-primary">{{ $title }}</h3>
    
    @if($description)
        <p class="mt-1 text-sm text-text-secondary">{{ $description }}</p>
    @endif
    
    @if (isset($action))
        <div class="mt-6">
            {{ $action }}
        </div>
    @endif
</div>
