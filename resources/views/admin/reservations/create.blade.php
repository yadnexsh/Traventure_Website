@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.reservations.index') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Back to Reservations</a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden max-w-3xl mx-auto">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Create Offline Booking
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            Manually allocate seats for a customer.
        </p>
    </div>

    <div class="px-4 py-5 sm:p-6">
        <form method="POST" action="{{ route('admin.reservations.store') }}" class="space-y-6">
            @csrf
            
            <div>
                <label for="departure_id" class="block text-sm font-medium text-gray-700">Departure</label>
                <select name="departure_id" id="departure_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="" disabled selected>Select a departure...</option>
                    @foreach($departures as $departure)
                        <option value="{{ $departure->id }}">{{ $departure->trek->title }} ({{ $departure->start_time->format('M d, Y') }}) - Available: {{ $departure->online_availability }}, Reserved: {{ $departure->unused_offline_reserved_capacity }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Customer Name</label>
                    <input type="text" name="name" id="name" required class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ old('name') }}">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ old('phone') }}">
                </div>
            </div>

            <div>
                <label for="emergency_contact_info" class="block text-sm font-medium text-gray-700">Emergency Contact Info</label>
                <textarea name="emergency_contact_info" id="emergency_contact_info" rows="2" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md">{{ old('emergency_contact_info') }}</textarea>
            </div>

            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-3">
                <div>
                    <label for="seats" class="block text-sm font-medium text-gray-700">Number of Seats</label>
                    <input type="number" name="seats" id="seats" value="{{ old('seats', 1) }}" required min="1" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                </div>

                <div>
                    <label for="source_pool" class="block text-sm font-medium text-gray-700">Source Pool</label>
                    <select name="source_pool" id="source_pool" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="general" {{ old('source_pool') === 'general' ? 'selected' : '' }}>General Online Capacity</option>
                        <option value="offline_reserved" {{ old('source_pool') === 'offline_reserved' ? 'selected' : '' }}>Offline Reserved Pool</option>
                    </select>
                </div>

                <div>
                    <label for="payment_status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                    <select name="payment_status" id="payment_status" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="Unpaid" {{ old('payment_status') === 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="Paid" {{ old('payment_status') === 'Paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>
            </div>

            <div class="pt-5 border-t border-gray-200 flex justify-end">
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create Booking
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
