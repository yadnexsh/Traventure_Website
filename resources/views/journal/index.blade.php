@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-text-primary mb-4 tracking-tight">From the trail</h1>
        <p class="text-xl text-text-secondary font-light">Stories, guides, and inspiration from our trekking community.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($articles as $article)
        <a href="{{ route('journal.show', $article['slug']) }}" class="group flex flex-col h-full bg-bg-base border border-border-subtle overflow-hidden hover:shadow-md transition-all">
            <div class="relative aspect-[16/9] overflow-hidden">
                <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
            </div>
            <div class="p-8 flex flex-col flex-grow">
                <div class="text-[10px] font-bold uppercase tracking-[0.2em] text-brand-primary mb-3">{{ $article['category'] }}</div>
                <h3 class="text-xl font-bold text-text-primary mb-3 leading-tight group-hover:text-brand-primary transition-colors">{{ $article['title'] }}</h3>
                <p class="text-text-secondary line-clamp-3 mb-6 font-light">{{ $article['excerpt'] }}</p>
                <div class="mt-auto flex items-center justify-between pt-4 border-t border-border-subtle text-sm text-text-muted">
                    <span>{{ $article['author'] }}</span>
                    <span>{{ $article['date'] }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
