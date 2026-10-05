@extends('layouts.public')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
    <div class="px-4 py-5 sm:px-6">
        <h1 class="text-2xl leading-6 font-bold text-gray-900">{{ $trek->title }}</h1>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Trek details and upcoming departures.</p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Difficulty</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $trek->difficulty }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Duration</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $trek->duration }} days</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Summary</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $trek->summary }}</dd>
            </div>
        </dl>
    </div>
</div>

<h2 class="text-xl font-bold mb-4">Upcoming Departures</h2>
@if($departures->count() > 0)
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200">
            @foreach($departures as $departure)
                <li>
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-blue-600 truncate">
                                {{ $departure->start_time->format('M d, Y H:i') }} - {{ $departure->end_time->format('M d, Y H:i') }}
                            </p>
                            <div class="ml-2 flex-shrink-0 flex">
                                @if($departure->online_availability > 0)
                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $departure->online_availability }} seats available
                                    </p>
                                @else
                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 mb-2">
                                        Sold out
                                    </p>
                                    <a href="{{ route('interest.create', $departure) }}" class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                        I'm interested
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="mt-2 sm:flex sm:justify-between">
                            <div class="sm:flex">
                                <p class="flex items-center text-sm text-gray-500">
                                    Total Capacity: {{ $departure->total_capacity }}
                                </p>
                            </div>
                            <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@else
    <p class="text-gray-500">No upcoming departures scheduled for this trek.</p>
@endif
@endsection
