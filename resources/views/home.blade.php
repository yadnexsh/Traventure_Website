@extends('layouts.public')

@section('content')
<div class="text-center py-16">
    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
        Discover Your Next <span class="text-blue-600">Adventure</span>
    </h1>
    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
        Explore the most beautiful treks with Traventure.
    </p>
    <div class="mt-8">
        <a href="{{ route('treks.index') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10">
            View All Treks
        </a>
    </div>
</div>

@if($featuredTreks->count() > 0)
<div class="mt-12">
    <h2 class="text-2xl font-bold mb-6">Featured Treks</h2>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($featuredTreks as $trek)
            <div class="bg-white overflow-hidden shadow rounded-lg flex flex-col">
                <div class="px-4 py-5 sm:p-6 flex-grow">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        <a href="{{ route('treks.show', $trek->slug) }}" class="hover:underline">
                            {{ $trek->title }}
                        </a>
                    </h3>
                    <p class="mt-2 max-w-2xl text-sm text-gray-500 line-clamp-3">
                        {{ $trek->summary }}
                    </p>
                    <div class="mt-4 text-sm text-gray-600">
                        <p><strong>Difficulty:</strong> {{ $trek->difficulty }}</p>
                        <p><strong>Duration:</strong> {{ $trek->duration }} days</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6 text-right">
                    <a href="{{ route('treks.show', $trek->slug) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">View Details &rarr;</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
@endsection
