<div {{ $attributes->merge(['class' => 'bg-bg-base rounded-lg border border-border-subtle shadow-sm overflow-hidden']) }}>
    @if (isset($header))
        <div class="px-6 py-4 border-b border-border-subtle bg-bg-subtle/50">
            {{ $header }}
        </div>
    @endif
    
    <div class="p-6">
        {{ $slot }}
    </div>
    
    @if (isset($footer))
        <div class="px-6 py-4 border-t border-border-subtle bg-bg-subtle/50">
            {{ $footer }}
        </div>
    @endif
</div>
