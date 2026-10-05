@props(['title', 'description' => null])

<div {{ $attributes->merge(['class' => 'md:flex md:items-center md:justify-between mb-8']) }}>
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-text-primary sm:truncate sm:text-3xl sm:tracking-tight">
            {{ $title }}
        </h2>
        @if($description)
            <p class="mt-1 text-sm text-text-secondary">
                {{ $description }}
            </p>
        @endif
    </div>
    @if (isset($actions))
        <div class="mt-4 flex md:ml-4 md:mt-0 space-x-3">
            {{ $actions }}
        </div>
    @endif
</div>
