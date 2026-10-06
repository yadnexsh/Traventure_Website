@extends('layouts.admin')

@section('content')
<div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <div class="mb-2">
            <a href="{{ route('admin.departures.index') }}" class="inline-flex items-center text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Departures
            </a>
        </div>
        <h1 class="text-2xl font-bold text-text-primary tracking-tight">Expressions of Interest</h1>
        <p class="text-sm text-text-secondary mt-1">Review customers interested in this departure.</p>
    </div>
</div>

<div class="bg-bg-base shadow-sm border border-border-subtle rounded-xl p-6 mb-8 flex flex-col md:flex-row md:justify-between md:items-center">
    <div>
        <h2 class="text-lg font-bold text-text-primary">{{ $departure->trek->title }}</h2>
        <p class="text-sm text-text-secondary mt-1">Departure: {{ $departure->start_time->format('M d, Y') }} &mdash; {{ $departure->end_time->format('M d, Y') }}</p>
    </div>
    <div class="mt-4 md:mt-0 bg-brand-primary/10 border border-brand-primary/20 px-4 py-3 rounded-lg text-center">
        <div class="text-xs font-bold text-brand-primary uppercase tracking-wider mb-1">Total EOI</div>
        <div class="text-2xl font-black text-brand-primary">{{ $interests->total() }}</div>
    </div>
</div>

<div class="bg-bg-base shadow-sm border border-border-subtle rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border-subtle">
            <thead class="bg-bg-subtle">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Date Submitted</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-text-muted uppercase tracking-wider">Phone</th>
                </tr>
            </thead>
            <tbody class="bg-bg-base divide-y divide-border-subtle">
                @forelse($interests as $interest)
                    <tr class="hover:bg-bg-subtle/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">
                            {{ $interest->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-text-primary">
                            {{ $interest->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-primary">
                            {{ $interest->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary">
                            {{ $interest->phone ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 whitespace-nowrap text-center">
                            <svg class="mx-auto h-12 w-12 text-text-muted mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <p class="text-sm font-medium text-text-primary mb-1">No expressions of interest recorded yet.</p>
                            <p class="text-sm text-text-secondary">When customers register interest for a full departure, they will appear here.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($interests->hasPages())
        <div class="px-6 py-4 border-t border-border-subtle bg-bg-surface">
            {{ $interests->links() }}
        </div>
    @endif
</div>
@endsection
