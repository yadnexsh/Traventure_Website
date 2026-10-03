@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.reservations.index') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Back to Reservations</a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden mb-8">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Reservation #{{ $reservation->id }}
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            Details and seat allocations.
        </p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Customer Name</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $reservation->customerRecord->name }}</dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Contact Details</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    Phone: {{ $reservation->customerRecord->phone ?? 'N/A' }} <br>
                    Emergency: {{ $reservation->customerRecord->emergency_contact_info ?? 'N/A' }}
                </dd>
            </div>
            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $reservation->status === 'Confirmed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $reservation->status }}
                    </span>
                    -
                    <span class="{{ $reservation->payment_status === 'Paid' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $reservation->payment_status }}
                    </span>
                </dd>
            </div>
        </dl>
    </div>
</div>

<h2 class="text-xl font-bold text-gray-900 mb-4">Seat Allocations</h2>
<div class="bg-white shadow rounded-lg overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Source Pool</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($reservation->seatAllocations as $allocation)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $allocation->allocation_type }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $allocation->source_pool ?? 'online' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    @if($allocation->released_at)
                        <span class="text-red-600 font-semibold">Released at {{ $allocation->released_at->format('M d, Y H:i') }}</span>
                    @else
                        <span class="text-green-600 font-semibold">Active</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-sm font-medium">
                    @if(!$allocation->released_at)
                    <form method="POST" action="{{ route('admin.seat-allocations.release', $allocation) }}" onsubmit="return confirm('Are you sure you want to release this seat? This will change the available capacity.');">
                        @csrf
                        <div class="flex items-center space-x-2">
                            <select name="destination_pool" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                                <option value="offline_reserved">Offline Reserved (Returns to offline reserve)</option>
                                <option value="general">General Online (Returns to public capacity)</option>
                            </select>
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow">Release</button>
                        </div>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
