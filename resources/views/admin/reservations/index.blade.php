@extends('layouts.admin')
@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-text-primary tracking-tight">Reservations & Offline Bookings</h1>
        <p class="text-sm text-text-secondary mt-1">Manage all bookings, allocations, and customer payments.</p>
    </div>
    <a href="{{ route('admin.reservations.create') }}" class="inline-flex items-center px-4 py-2 bg-brand-primary text-white font-medium rounded-lg shadow-sm hover:bg-brand-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">
        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Create Offline Booking
    </a>
</div>

<div class="bg-bg-base shadow-sm border border-border-subtle rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border-subtle">
            <thead class="bg-bg-subtle">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">ID / Source</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Customer</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Trek & Departure</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-text-muted uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-bg-base divide-y divide-border-subtle">
                @forelse($reservations as $reservation)
                <tr class="hover:bg-bg-subtle/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-text-primary">#{{ $reservation->id }}</div>
                        <div class="mt-1">
                            @if($reservation->booking_source === 'online')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-700 uppercase tracking-wide">Online</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-brand-primary/10 text-brand-primary uppercase tracking-wide">Offline</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-text-primary">{{ $reservation->customerRecord->name }}</div>
                        <div class="text-xs text-text-secondary">{{ $reservation->customerRecord->phone ?? 'No phone' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-text-primary">{{ $reservation->departure->trek->title }}</div>
                        <div class="text-xs text-text-secondary">{{ optional($reservation->departure->start_time)->format('M d, Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col gap-1">
                            @if($reservation->status === 'Confirmed')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-status-success/10 text-status-success border border-status-success/20 w-max">
                                    {{ $reservation->status }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-bg-surface text-text-secondary border border-border-strong w-max">
                                    {{ $reservation->status }}
                                </span>
                            @endif
                            
                            @if($reservation->payment_status === 'Paid')
                                <span class="text-xs font-medium text-status-success flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Paid
                                </span>
                            @else
                                <span class="text-xs font-medium text-status-warning flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $reservation->payment_status }}
                                </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.reservations.show', $reservation) }}" class="text-brand-primary hover:text-brand-primary/80 transition-colors">Manage</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 whitespace-nowrap text-center">
                        <svg class="mx-auto h-12 w-12 text-text-muted mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        <p class="text-sm font-medium text-text-primary mb-1">No reservations found.</p>
                        <p class="text-sm text-text-secondary mb-4">You can manually create an offline booking for customers.</p>
                        <a href="{{ route('admin.reservations.create') }}" class="inline-flex items-center px-4 py-2 border border-border-subtle shadow-sm text-sm font-medium rounded-lg text-text-primary bg-bg-base hover:bg-bg-subtle focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">
                            Create Offline Booking
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
