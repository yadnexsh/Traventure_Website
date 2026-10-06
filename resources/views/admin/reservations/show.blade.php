@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.reservations.index') }}" class="inline-flex items-center text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Reservations
    </a>
</div>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-text-primary tracking-tight">Reservation #{{ $reservation->id }}</h1>
        <p class="text-sm text-text-secondary mt-1">Manage booking details and seat allocations.</p>
    </div>
    
    <div class="flex space-x-2">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $reservation->status === 'Confirmed' ? 'bg-status-success/10 text-status-success border border-status-success/20' : 'bg-bg-surface text-text-secondary border border-border-strong' }}">
            {{ $reservation->status }}
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $reservation->payment_status === 'Paid' ? 'bg-status-success/10 text-status-success border border-status-success/20' : 'bg-status-warning/10 text-status-warning border border-status-warning/20' }}">
            {{ $reservation->payment_status }}
        </span>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    {{-- Customer Info --}}
    <div class="bg-bg-base shadow-sm border border-border-subtle rounded-xl p-6">
        <h2 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-4 border-b border-border-subtle pb-2">Customer Details</h2>
        <dl class="space-y-4">
            <div>
                <dt class="text-xs font-medium text-text-secondary uppercase">Name</dt>
                <dd class="mt-1 text-sm font-bold text-text-primary">{{ $reservation->customerRecord->name }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-text-secondary uppercase">Contact Phone</dt>
                <dd class="mt-1 text-sm text-text-primary">{{ $reservation->customerRecord->phone ?? 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-text-secondary uppercase">Emergency Contact</dt>
                <dd class="mt-1 text-sm text-text-primary">{{ $reservation->customerRecord->emergency_contact_info ?? 'N/A' }}</dd>
            </div>
        </dl>
    </div>
    
    {{-- Trip Info --}}
    <div class="bg-bg-base shadow-sm border border-border-subtle rounded-xl p-6">
        <h2 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-4 border-b border-border-subtle pb-2">Trip Details</h2>
        <dl class="space-y-4">
            <div>
                <dt class="text-xs font-medium text-text-secondary uppercase">Trek</dt>
                <dd class="mt-1 text-sm font-bold text-text-primary">{{ $reservation->departure->trek->title }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-text-secondary uppercase">Departure Dates</dt>
                <dd class="mt-1 text-sm text-text-primary">{{ optional($reservation->departure->start_time)->format('M d, Y') }} &mdash; {{ optional($reservation->departure->end_time)->format('M d, Y') }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium text-text-secondary uppercase">Booking Source</dt>
                <dd class="mt-1">
                    @if($reservation->booking_source === 'online')
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-700 uppercase tracking-wide">Online</span>
                    @else
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-brand-primary/10 text-brand-primary uppercase tracking-wide">Offline</span>
                    @endif
                </dd>
            </div>
        </dl>
    </div>
</div>

<div class="mb-6">
    <h2 class="text-lg font-bold text-text-primary">Seat Allocations</h2>
    <p class="text-sm text-text-secondary">Seats reserved or held for this booking.</p>
</div>

<div class="bg-bg-base shadow-sm border border-border-subtle rounded-xl overflow-hidden mb-8">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border-subtle">
            <thead class="bg-bg-subtle">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Type</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Source Pool</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-text-muted uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-bg-base divide-y divide-border-subtle">
                @foreach($reservation->seatAllocations as $allocation)
                <tr class="hover:bg-bg-subtle/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-text-primary">{{ $allocation->allocation_type }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">
                        {{ $allocation->source_pool ?? 'general' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($allocation->released_at)
                            <span class="text-status-danger font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Released at {{ $allocation->released_at->format('M d, Y H:i') }}
                            </span>
                        @else
                            <span class="text-status-success font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Active
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-medium">
                        @if(!$allocation->released_at)
                        <form method="POST" action="{{ route('admin.seat-allocations.release', $allocation) }}" onsubmit="return confirm('Are you sure you want to release this seat? This will change the available capacity.');" class="inline-flex flex-col items-end gap-2">
                            @csrf
                            <select name="destination_pool" class="w-full text-sm border-border-subtle rounded-md shadow-sm focus:border-brand-primary focus:ring focus:ring-brand-primary focus:ring-opacity-50" required>
                                <option value="offline_reserved">Return to Offline Reserve</option>
                                <option value="general">Return to General Online</option>
                            </select>
                            <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-status-danger hover:bg-status-danger/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-status-danger transition-colors">
                                Release Seat
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
