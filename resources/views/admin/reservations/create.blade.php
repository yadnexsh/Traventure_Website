@extends('layouts.admin')
@section('content')
<div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <div class="mb-2">
            <a href="{{ route('admin.reservations.index') }}" class="inline-flex items-center text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Reservations
            </a>
        </div>
        <h1 class="text-2xl font-bold text-text-primary tracking-tight">Create Offline Booking</h1>
        <p class="text-sm text-text-secondary mt-1">Manually allocate seats for a customer.</p>
    </div>
</div>

@if ($errors->any())
    <div class="mb-6 bg-status-danger/10 border-l-4 border-status-danger p-4 rounded-r-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-status-danger" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-status-danger">There were errors with your submission</h3>
                <div class="mt-2 text-sm text-status-danger">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="bg-bg-base shadow-sm border border-border-subtle rounded-xl overflow-hidden max-w-4xl">
    <form method="POST" action="{{ route('admin.reservations.store') }}" class="p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="departure_id" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Departure</label>
                <select name="departure_id" id="departure_id" required class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                    <option value="" disabled selected>Select a departure...</option>
                    @foreach($departures as $departure)
                        <option value="{{ $departure->id }}">{{ $departure->trek->title }} ({{ $departure->start_time->format('M d, Y') }}) - Available: {{ $departure->online_availability }}, Reserved: {{ $departure->unused_offline_reserved_capacity }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="name" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Customer Name</label>
                <input type="text" name="name" id="name" required class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50" value="{{ old('name') }}">
            </div>

            <div>
                <label for="phone" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Phone</label>
                <input type="text" name="phone" id="phone" class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50" value="{{ old('phone') }}">
            </div>

            <div class="md:col-span-2">
                <label for="emergency_contact_info" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Emergency Contact Info</label>
                <textarea name="emergency_contact_info" id="emergency_contact_info" rows="2" class="block w-full text-sm border border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">{{ old('emergency_contact_info') }}</textarea>
            </div>

            <div>
                <label for="seats" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Number of Seats</label>
                <input type="number" name="seats" id="seats" value="{{ old('seats', 1) }}" required min="1" class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
            </div>

            <div>
                <label for="source_pool" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Source Pool</label>
                <select name="source_pool" id="source_pool" required class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                    <option value="general" {{ old('source_pool') === 'general' ? 'selected' : '' }}>General Online Capacity</option>
                    <option value="offline_reserved" {{ old('source_pool') === 'offline_reserved' ? 'selected' : '' }}>Offline Reserved Pool</option>
                </select>
            </div>

            <div>
                <label for="payment_status" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Payment Status</label>
                <select name="payment_status" id="payment_status" required class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                    <option value="Unpaid" {{ old('payment_status') === 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="Paid" {{ old('payment_status') === 'Paid' ? 'selected' : '' }}>Paid</option>
                </select>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-border-subtle flex justify-end gap-3">
            <a href="{{ route('admin.reservations.index') }}" class="inline-flex justify-center px-4 py-2 border border-border-subtle shadow-sm text-sm font-medium rounded-lg text-text-primary bg-bg-base hover:bg-bg-subtle focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">Cancel</a>
            <button type="submit" class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-brand-primary hover:bg-brand-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">Create Booking</button>
        </div>
    </form>
</div>
@endsection
