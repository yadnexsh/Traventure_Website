@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.treks.index') }}" class="inline-flex items-center text-sm font-medium text-text-secondary hover:text-brand-primary transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Treks
    </a>
</div>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl font-bold text-text-primary tracking-tight">{{ $trek->title }}</h1>
        <p class="text-sm text-text-secondary mt-1">View trek details and metadata.</p>
    </div>
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('admin.treks.edit', $trek) }}" class="inline-flex items-center px-4 py-2 bg-brand-primary text-white font-medium rounded-lg shadow-sm hover:bg-brand-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
        Edit Trek
    </a>
    @endif
</div>

<div class="bg-bg-base shadow-sm border border-border-subtle rounded-xl overflow-hidden max-w-4xl">
    <div class="px-6 py-5 border-b border-border-subtle bg-bg-subtle/50">
        <h3 class="text-lg leading-6 font-bold text-text-primary">
            Trek Information
        </h3>
    </div>
    <div class="px-6 py-5">
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
            <div class="sm:col-span-2 md:col-span-1">
                <dt class="text-xs font-bold text-text-muted uppercase tracking-wider mb-1">Title</dt>
                <dd class="text-sm font-medium text-text-primary">{{ $trek->title }}</dd>
            </div>
            
            <div class="sm:col-span-2 md:col-span-1">
                <dt class="text-xs font-bold text-text-muted uppercase tracking-wider mb-1">Status</dt>
                <dd class="mt-1">
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
                </dd>
            </div>

            <div class="sm:col-span-2 md:col-span-1">
                <dt class="text-xs font-bold text-text-muted uppercase tracking-wider mb-1">Slug</dt>
                <dd class="text-sm text-text-secondary font-mono">{{ $trek->slug }}</dd>
            </div>
            
            <div class="sm:col-span-2 md:col-span-1">
                <dt class="text-xs font-bold text-text-muted uppercase tracking-wider mb-1">Price (INR)</dt>
                <dd class="text-sm font-medium text-text-primary">₹{{ number_format($trek->price) }}</dd>
            </div>
            
            <div class="sm:col-span-2 md:col-span-1">
                <dt class="text-xs font-bold text-text-muted uppercase tracking-wider mb-1">Difficulty</dt>
                <dd class="text-sm font-medium text-text-primary capitalize">{{ $trek->difficulty ?? 'N/A' }}</dd>
            </div>
            
            <div class="sm:col-span-2 md:col-span-1">
                <dt class="text-xs font-bold text-text-muted uppercase tracking-wider mb-1">Duration (Days)</dt>
                <dd class="text-sm font-medium text-text-primary">{{ $trek->duration ?? 'N/A' }}</dd>
            </div>
            
            <div class="sm:col-span-2">
                <dt class="text-xs font-bold text-text-muted uppercase tracking-wider mb-2">Summary</dt>
                <dd class="text-sm text-text-secondary leading-relaxed bg-bg-subtle rounded-lg p-4 whitespace-pre-wrap">{{ $trek->summary ?? 'No summary provided.' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection
