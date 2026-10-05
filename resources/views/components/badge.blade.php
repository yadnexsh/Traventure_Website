@props(['variant' => 'default'])

@php
    $variants = [
        'default' => 'bg-gray-100 text-gray-800',
        'primary' => 'bg-brand-primary/10 text-brand-primary',
        'accent' => 'bg-brand-accent/10 text-brand-accent',
        'success' => 'bg-green-100 text-green-800',
        'warning' => 'bg-yellow-100 text-yellow-800',
        'error' => 'bg-red-100 text-red-800',
        // Specific statuses
        'available' => 'bg-green-100 text-green-800',
        'limited' => 'bg-yellow-100 text-yellow-800',
        'full' => 'bg-red-100 text-red-800',
        'past' => 'bg-gray-100 text-gray-600',
    ];

    $classes = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ' . ($variants[$variant] ?? $variants['default']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
