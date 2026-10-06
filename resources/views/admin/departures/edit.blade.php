@extends('layouts.admin')
@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.departures.index') }}" class="inline-flex items-center text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Departures
    </a>
</div>

<div class="mb-6">
    <h1 class="text-2xl font-bold text-text-primary tracking-tight">Edit Departure #{{ $departure->id }}</h1>
    <p class="text-sm text-text-secondary mt-1">Modify dates, capacity, or status for this departure.</p>
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
    <form method="POST" action="{{ route('admin.departures.update', $departure) }}" class="p-6">
        @csrf @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="trek_id" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Trek</label>
                <select name="trek_id" id="trek_id" required class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                    <option value="">Select a trek...</option>
                    @foreach($treks as $trek)
                        <option value="{{ $trek->id }}" {{ (old('trek_id') ?? $departure->trek_id) == $trek->id ? 'selected' : '' }}>{{ $trek->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="start_time" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Start Time</label>
                <input type="datetime-local" name="start_time" id="start_time" required value="{{ old('start_time', \Carbon\Carbon::parse($departure->start_time)->format('Y-m-d\TH:i')) }}" class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
            </div>

            <div>
                <label for="end_time" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">End Time</label>
                <input type="datetime-local" name="end_time" id="end_time" required value="{{ old('end_time', \Carbon\Carbon::parse($departure->end_time)->format('Y-m-d\TH:i')) }}" class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
            </div>

            <div>
                <label for="total_capacity" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Total Capacity</label>
                <input type="number" name="total_capacity" id="total_capacity" required value="{{ old('total_capacity', $departure->total_capacity) }}" min="1" class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                <p class="mt-2 text-xs text-text-secondary">Maximum number of participants.</p>
            </div>

            <div>
                <label for="unused_offline_reserved_capacity" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Offline Reserved Seats</label>
                <input type="number" name="unused_offline_reserved_capacity" id="unused_offline_reserved_capacity" required value="{{ old('unused_offline_reserved_capacity', $departure->unused_offline_reserved_capacity) }}" min="0" class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                <p class="mt-2 text-xs text-text-secondary">Seats withheld from online booking pool.</p>
            </div>

            <div>
                <label for="status" class="block text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Status</label>
                <select name="status" id="status" required class="block w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50">
                    <option value="scheduled" {{ (old('status') ?? $departure->status) === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="completed" {{ (old('status') ?? $departure->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ (old('status') ?? $departure->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <p class="mt-2 text-xs text-text-secondary">Cancelling a departure will affect related reservations.</p>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-border-subtle flex flex-col sm:flex-row justify-between items-center gap-4">
            <a href="{{ route('admin.departures.show', $departure) }}" class="text-sm font-medium text-brand-primary hover:text-brand-primary/80 transition-colors">Review Details</a>
            <div class="flex gap-3 w-full sm:w-auto">
                <a href="{{ route('admin.departures.index') }}" class="flex-1 sm:flex-none inline-flex justify-center px-4 py-2 border border-border-subtle shadow-sm text-sm font-medium rounded-lg text-text-primary bg-bg-base hover:bg-bg-subtle focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">Cancel</a>
                <button type="submit" class="flex-1 sm:flex-none inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-brand-primary hover:bg-brand-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">Save Changes</button>
            </div>
        </div>
    </form>
</div>
@endsection
