@props(['disabled' => false, 'hasError' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'h-11 rounded-md shadow-sm focus:ring-2 focus:ring-offset-0 transition-colors sm:text-sm ' . 
    ($hasError 
        ? 'border-red-300 text-red-900 focus:border-red-500 focus:ring-red-500' 
        : 'border-border-strong text-text-primary focus:border-brand-primary focus:ring-brand-primary/20')
]) !!}>
    {{ $slot }}
</select>
