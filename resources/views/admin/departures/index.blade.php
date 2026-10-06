@extends('layouts.admin')
@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-text-primary tracking-tight">Departures</h1>
        <p class="text-sm text-text-secondary mt-1">Manage departure schedules, status, and capacity.</p>
    </div>
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.departures.create') }}" class="inline-flex items-center px-4 py-2 bg-brand-primary text-white font-medium rounded-lg shadow-sm hover:bg-brand-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">
            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Create Departure
        </a>
    @endif
</div>

<div class="bg-bg-base shadow-sm border border-border-subtle rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border-subtle">
            <thead class="bg-bg-subtle">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Trek</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Dates</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Capacity Info</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-text-muted uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-bg-base divide-y divide-border-subtle">
                @forelse($departures as $departure)
                <tr class="hover:bg-bg-subtle/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-text-primary">{{ $departure->trek->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-text-primary">{{ $departure->start_time->format('M d, Y') }}</div>
                        <div class="text-xs text-text-secondary">{{ $departure->end_time->format('M d, Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-medium text-text-secondary">Total: <span class="text-text-primary">{{ $departure->total_capacity }}</span></span>
                            <span class="text-xs font-medium text-text-secondary">Offline Rsv: <span class="text-text-primary">{{ $departure->unused_offline_reserved_capacity }}</span></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($departure->status === 'scheduled')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-status-success/10 text-status-success border border-status-success/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-status-success mr-1.5"></span>
                                Scheduled
                            </span>
                        @elseif($departure->status === 'completed')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-bg-surface text-text-secondary border border-border-strong">
                                <span class="w-1.5 h-1.5 rounded-full bg-text-muted mr-1.5"></span>
                                Completed
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-status-danger/10 text-status-danger border border-status-danger/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-status-danger mr-1.5"></span>
                                Cancelled
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.departures.show', $departure) }}" class="text-brand-primary hover:text-brand-primary/80 mr-4 transition-colors">Manage</a>
                        <a href="{{ route('admin.departures.interest', $departure) }}" class="text-text-secondary hover:text-brand-primary mr-4 transition-colors">EOI</a>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.departures.edit', $departure) }}" class="text-text-secondary hover:text-brand-primary transition-colors">Edit</a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 whitespace-nowrap text-center">
                        <svg class="mx-auto h-12 w-12 text-text-muted mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-sm font-medium text-text-primary mb-1">No departures found.</p>
                        <p class="text-sm text-text-secondary mb-4">Start by creating a departure schedule for your treks.</p>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.departures.create') }}" class="inline-flex items-center px-4 py-2 border border-border-subtle shadow-sm text-sm font-medium rounded-lg text-text-primary bg-bg-base hover:bg-bg-subtle focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">
                                Create your first Departure
                            </a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
