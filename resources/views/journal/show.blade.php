@extends('layouts.public')

@section('content')
<nav class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-4" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2 text-sm text-text-secondary">
        <li>
            <a href="{{ route('home') }}" class="hover:text-brand-primary">Home</a>
        </li>
        <li><span class="text-text-muted">/</span></li>
        <li>
            <a href="{{ route('journal.index') }}" class="hover:text-brand-primary">Journal</a>
        </li>
        <li><span class="text-text-muted">/</span></li>
        <li class="font-medium text-text-primary" aria-current="page">{{ $article['title'] }}</li>
    </ol>
</nav>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-10 text-center">
        <div class="text-sm font-bold uppercase tracking-[0.2em] text-brand-primary mb-4">{{ $article['category'] }}</div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-text-primary mb-6 tracking-tight leading-tight">{{ $article['title'] }}</h1>
        <div class="flex items-center justify-center space-x-4 text-text-muted text-sm">
            <span>By {{ $article['author'] }}</span>
            <span>&bull;</span>
            <span>{{ $article['date'] }}</span>
        </div>
    </div>

    <div class="relative w-full aspect-video mb-12 rounded-xl overflow-hidden shadow-sm">
        <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}" class="w-full h-full object-cover">
    </div>

    <div class="prose prose-brand prose-lg max-w-none text-text-secondary leading-relaxed">
        {!! $article['body'] !!}
    </div>
</div>
@endsection
