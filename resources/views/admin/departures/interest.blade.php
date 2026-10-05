@extends('layouts.admin')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.departures.index') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Back to Departures</a>
    <h1 class="text-3xl font-bold text-gray-900">Expressions of Interest</h1>
</div>

<div class="bg-white shadow rounded-lg p-6 mb-6">
    <h2 class="text-xl font-semibold mb-2">{{ $departure->trek->title }}</h2>
    <p class="text-gray-600">Departure: {{ $departure->start_time->format('M d, Y') }} - {{ $departure->end_time->format('M d, Y') }}</p>
    <p class="text-gray-600 mt-2">Total Expressions of Interest: <strong>{{ $interests->total() }}</strong></p>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Submitted</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($interests as $interest)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $interest->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $interest->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $interest->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $interest->phone ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 whitespace-nowrap text-sm text-gray-500 text-center">
                            No expressions of interest recorded yet for this departure.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($interests->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $interests->links() }}
        </div>
    @endif
</div>
@endsection
