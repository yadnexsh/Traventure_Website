@extends('layouts.admin')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Reservations & Offline Bookings</h1>
    <a href="{{ route('admin.reservations.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">Create Offline Booking</a>
</div>

<div class="bg-white shadow rounded-lg overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trek / Departure</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Source</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($reservations as $reservation)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    #{{ $reservation->id }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ $reservation->customerRecord->name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $reservation->departure->trek->title }}<br>
                    <span class="text-xs text-gray-400">{{ optional($reservation->departure->start_time)->format('M d, Y') }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $reservation->status === 'Confirmed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $reservation->status }}
                    </span>
                    <br>
                    <span class="text-xs {{ $reservation->payment_status === 'Paid' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $reservation->payment_status }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $reservation->booking_source === 'online' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                        {{ ucfirst($reservation->booking_source) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('admin.reservations.show', $reservation) }}" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No reservations found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
