@extends('layouts.public')

@section('content')
<div class="border-b border-gray-200 pb-5 mb-8">
    <h1 class="text-3xl leading-6 font-bold text-gray-900">All Treks</h1>
</div>

@if($treks->count() > 0)
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($treks as $trek)
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
@else
    <p class="text-gray-500">No treks are currently available.</p>
@endif
@endsection
