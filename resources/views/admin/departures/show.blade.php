@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.departures.index') }}" class="inline-flex items-center text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Departures
    </a>
</div>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-text-primary tracking-tight">{{ $departure->trek->title }}</h1>
        <p class="text-sm text-text-secondary mt-1">
            {{ $departure->start_time->format('M d, Y') }} &mdash; {{ $departure->end_time->format('M d, Y') }}
        </p>
    </div>
    <div class="flex space-x-3">
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.departures.edit', $departure) }}" class="inline-flex items-center px-4 py-2 bg-bg-base border border-border-subtle shadow-sm text-sm font-medium rounded-lg text-text-primary hover:bg-bg-subtle focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">
                Edit Departure
            </a>
        @endif
        <a href="{{ route('admin.departures.interest', $departure) }}" class="inline-flex items-center px-4 py-2 bg-bg-base border border-border-subtle shadow-sm text-sm font-medium rounded-lg text-text-primary hover:bg-bg-subtle focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">
            View EOI
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    {{-- Status Card --}}
    <div class="bg-bg-base shadow-sm border border-border-subtle rounded-xl p-6">
        <h2 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-4">Departure Status</h2>
        <div class="mb-4">
            @if($departure->status === 'scheduled')
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-status-success/10 text-status-success border border-status-success/20">
                    <span class="w-2 h-2 rounded-full bg-status-success mr-2"></span>
                    Scheduled
                </span>
            @elseif($departure->status === 'completed')
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-bg-surface text-text-secondary border border-border-strong">
                    <span class="w-2 h-2 rounded-full bg-text-muted mr-2"></span>
                    Completed
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-status-danger/10 text-status-danger border border-status-danger/20">
                    <span class="w-2 h-2 rounded-full bg-status-danger mr-2"></span>
                    Cancelled
                </span>
            @endif
        </div>
        <div class="text-sm text-text-secondary">
            <strong>Trek Status:</strong> {{ ucfirst($departure->trek->published_status) }}
        </div>
    </div>

    {{-- Capacity Breakdown --}}
    <div class="lg:col-span-2 bg-bg-base shadow-sm border border-border-subtle rounded-xl p-6">
        <h2 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-4">Capacity Breakdown</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="flex flex-col">
                <span class="text-xs font-bold text-text-muted uppercase">Total Capacity</span>
                <span class="text-2xl font-black text-text-primary mt-1">{{ $departure->total_capacity }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xs font-bold text-text-muted uppercase">Online Avail</span>
                <span class="text-2xl font-black {{ $departure->online_availability > 0 ? 'text-status-success' : 'text-status-danger' }} mt-1">{{ $departure->online_availability }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xs font-bold text-text-muted uppercase">Offline Rsv</span>
                <span class="text-2xl font-black text-text-primary mt-1">{{ $departure->unused_offline_reserved_capacity }}</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xs font-bold text-text-muted uppercase">Active Alloc</span>
                <span class="text-2xl font-black text-status-warning mt-1">{{ $activeAllocationsCount }}</span>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-border-subtle text-xs text-text-secondary">
            <p><strong>Note:</strong> Public availability is calculated as (Total - Offline Reserved - Active Allocations).</p>
        </div>
    </div>
</div>
@endsection
