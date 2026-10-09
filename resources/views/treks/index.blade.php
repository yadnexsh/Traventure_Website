@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-text-primary mb-4 tracking-tight uppercase">Explore Treks</h1>
        <p class="text-xl text-text-secondary font-light">Discover your next adventure from our curated list of high-quality expeditions.</p>
    </div>

    {{-- Filters --}}
    <div class="bg-bg-subtle p-8 rounded-sm border border-border-subtle mb-16">
        <form action="{{ route('treks.index') }}" method="GET" id="filter-form" class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            {{-- Search --}}
            <div>
                <label for="search" class="block text-xs font-bold text-text-muted uppercase tracking-[0.1em] mb-3">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Trek name..." class="w-full bg-bg-base border border-border-strong rounded-sm px-4 py-3 focus:outline-none focus:ring-2 focus:ring-brand-primary text-sm font-light">
            </div>

            {{-- Month --}}
            <div>
                <label for="month" class="block text-xs font-bold text-text-muted uppercase tracking-[0.1em] mb-3">Month</label>
                <select name="month" id="month" class="w-full bg-bg-base border border-border-strong rounded-sm px-4 py-3 focus:outline-none focus:ring-2 focus:ring-brand-primary text-sm font-light" onchange="this.form.submit()">
                    <option value="">Any Month</option>
                    @foreach(['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'] as $m)
                        <option value="{{ $m }}" {{ request('month') === $m ? 'selected' : '' }}>{{ ucfirst(strtolower($m)) }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Season --}}
            <div>
                <label for="season" class="block text-xs font-bold text-text-muted uppercase tracking-[0.1em] mb-3">Season</label>
                <select name="season" id="season" class="w-full bg-bg-base border border-border-strong rounded-sm px-4 py-3 focus:outline-none focus:ring-2 focus:ring-brand-primary text-sm font-light" onchange="this.form.submit()">
                    <option value="">Any Season</option>
                    @foreach(['Winter', 'Summer', 'Monsoon', 'Spring', 'Autumn'] as $s)
                        <option value="{{ $s }}" {{ request('season') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Difficulty --}}
            <div>
                <label for="difficulty" class="block text-xs font-bold text-text-muted uppercase tracking-[0.1em] mb-3">Difficulty</label>
                <select name="difficulty" id="difficulty" class="w-full bg-bg-base border border-border-strong rounded-sm px-4 py-3 focus:outline-none focus:ring-2 focus:ring-brand-primary text-sm font-light" onchange="this.form.submit()">
                    <option value="">Any Difficulty</option>
                    @foreach(['Easy', 'Moderate', 'Hard', 'Expert'] as $d)
                        <option value="{{ $d }}" {{ request('difficulty') === $d ? 'selected' : '' }}>{{ $d }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="md:col-span-4 flex flex-col md:flex-row justify-between items-center mt-4 border-t border-border-subtle pt-8 gap-6">
                <div class="text-sm font-bold text-text-primary tracking-widest uppercase">
                    {{ $treks->count() }} {{ $treks->count() === 1 ? 'Trek' : 'Treks' }} Found
                </div>
                <div class="flex gap-6 w-full md:w-auto">
                    @if(request()->anyFilled(['search', 'month', 'season', 'difficulty']))
                        <a href="{{ route('treks.index') }}" class="flex-1 md:flex-none inline-flex items-center justify-center font-bold text-xs tracking-widest uppercase text-text-muted hover:text-text-primary transition-colors px-4 py-3">
                            Clear Filters
                        </a>
                    @endif
                    <button type="submit" class="flex-1 md:flex-none inline-flex items-center justify-center font-bold text-xs tracking-[0.2em] uppercase px-10 py-3 bg-brand-primary text-white hover:bg-brand-secondary transition-colors focus:outline-none rounded-sm">
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if($treks->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($treks as $trek)
                <x-trek-card :trek="$trek" />
            @endforeach
        </div>
    @else
        <div class="py-32 text-center border border-border-subtle bg-bg-subtle/30 rounded-sm">
            <h3 class="text-3xl font-bold text-text-primary mb-4 tracking-tight uppercase">No treks found</h3>
            <p class="text-text-secondary font-light text-xl mb-10">Try adjusting your filters or clearing them to see more.</p>
            <a href="{{ route('treks.index') }}" class="inline-flex items-center justify-center font-bold text-sm tracking-[0.2em] uppercase px-12 py-4 bg-text-primary text-bg-base hover:bg-text-secondary transition-colors focus:outline-none">
                Clear All Filters
            </a>
        </div>
    @endif
    
</div>
@endsection
