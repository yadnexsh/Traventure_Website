@props([
    'variant' => 'primary',
    'type' => 'button',
    'href' => null,
    'disabled' => false
])

@php
    $baseClasses = 'inline-flex items-center justify-center h-11 px-6 font-semibold rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

    $variants = [
        'primary' => 'bg-brand-primary text-white hover:bg-brand-primary/90 focus:ring-brand-primary',
        'accent' => 'bg-brand-accent text-white hover:bg-brand-accent/90 focus:ring-brand-accent',
        'secondary' => 'bg-brand-secondary text-white hover:bg-brand-secondary/90 focus:ring-brand-secondary',
        'outline' => 'bg-transparent border-2 border-brand-primary text-brand-primary hover:bg-brand-primary/10 focus:ring-brand-primary',
        'ghost' => 'bg-transparent text-text-secondary hover:bg-bg-subtle hover:text-text-primary focus:ring-border-strong',
        'destructive' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-600',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href && !$disabled)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
