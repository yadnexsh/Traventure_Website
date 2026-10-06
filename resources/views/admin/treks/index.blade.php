@extends('layouts.admin')
@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-text-primary tracking-tight">Treks</h1>
        <p class="text-sm text-text-secondary mt-1">Manage all available trekking itineraries.</p>
    </div>
    <a href="{{ route('admin.treks.create') }}" class="inline-flex items-center px-4 py-2 bg-brand-primary text-white font-medium rounded-lg shadow-sm hover:bg-brand-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">
        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Create Trek
    </a>
</div>

<div class="bg-bg-base shadow-sm border border-border-subtle rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border-subtle">
            <thead class="bg-bg-subtle">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Title</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Difficulty</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Duration</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Price</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-text-muted uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-bg-base divide-y divide-border-subtle">
                @forelse($treks as $trek)
                <tr class="hover:bg-bg-subtle/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-text-primary">{{ $trek->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-text-secondary">{{ ucfirst($trek->difficulty) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-text-secondary">{{ $trek->duration }} days</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-text-primary">₹{{ number_format($trek->price, 2) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($trek->published_status === 'published')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-status-success/10 text-status-success border border-status-success/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-status-success mr-1.5"></span>
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-status-warning/10 text-status-warning border border-status-warning/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-status-warning mr-1.5"></span>
                                Draft
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.treks.show', $trek) }}" class="text-text-secondary hover:text-brand-primary mr-4 transition-colors">View</a>
                        <a href="{{ route('admin.treks.edit', $trek) }}" class="text-brand-primary hover:text-brand-primary/80 transition-colors">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 whitespace-nowrap text-center">
                        <svg class="mx-auto h-12 w-12 text-text-muted mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <p class="text-sm font-medium text-text-primary mb-1">No treks found.</p>
                        <p class="text-sm text-text-secondary mb-4">Get started by creating a new trekking itinerary.</p>
                        <a href="{{ route('admin.treks.create') }}" class="inline-flex items-center px-4 py-2 border border-border-subtle shadow-sm text-sm font-medium rounded-lg text-text-primary bg-bg-base hover:bg-bg-subtle focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">
                            Create your first Trek
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
