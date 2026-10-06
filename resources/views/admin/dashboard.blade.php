@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-text-primary tracking-tight">Overview</h1>
    <p class="text-text-secondary mt-1">Key operational metrics and current status.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-bg-base border border-border-subtle rounded-xl p-6 shadow-sm flex flex-col justify-between hover:border-brand-primary/30 transition-colors">
        <h2 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Published Treks</h2>
        <div class="text-4xl font-black text-text-primary">{{ $publishedTreksCount }}</div>
    </div>

    <div class="bg-bg-base border border-border-subtle rounded-xl p-6 shadow-sm flex flex-col justify-between hover:border-brand-primary/30 transition-colors">
        <h2 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Upcoming Departures</h2>
        <div class="text-4xl font-black text-text-primary">{{ $upcomingDeparturesCount }}</div>
    </div>

    <div class="bg-bg-base border border-border-subtle rounded-xl p-6 shadow-sm flex flex-col justify-between hover:border-brand-primary/30 transition-colors">
        <h2 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Total Reservations</h2>
        <div class="text-4xl font-black text-text-primary">{{ $totalReservationsCount }}</div>
    </div>

    <div class="bg-bg-base border border-border-subtle rounded-xl p-6 shadow-sm flex flex-col justify-between hover:border-status-warning/50 transition-colors relative overflow-hidden">
        <div class="absolute top-0 right-0 p-4 opacity-10">
            <svg class="w-16 h-16 text-status-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h2 class="text-xs font-bold text-text-muted uppercase tracking-wider mb-2 relative z-10">Active Online Holds</h2>
        <div class="text-4xl font-black {{ $activeHoldsCount > 0 ? 'text-status-warning' : 'text-text-primary' }} relative z-10">{{ $activeHoldsCount }}</div>
    </div>
</div>
@endsection
