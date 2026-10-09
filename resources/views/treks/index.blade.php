@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    {{-- Header or Regional Banner --}}
    @if(isset($regionData))
        <div class="relative w-full aspect-[16/7] md:aspect-[21/9] min-h-[220px] rounded-xl overflow-hidden mb-12 shadow-sm">
            <img src="{{ asset($regionData['banner']) }}" alt="{{ $regionData['name'] }}" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/45 to-transparent"></div>
            <div class="absolute inset-0 p-6 sm:p-10 md:p-12 flex flex-col justify-end text-white">
                <span class="text-xs uppercase tracking-widest text-brand-soft/90 font-semibold mb-1">Regional Expedition</span>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight text-white mb-2">{{ $regionData['name'] }}</h1>
                <p class="text-white/90 text-sm sm:text-base md:text-lg max-w-2xl font-light">{{ $regionData['intro'] }}</p>
            </div>
        </div>
    @else
        <x-page-header 
            title="Explore Treks" 
            description="Discover your next adventure from our curated list of high-quality expeditions."
        />
    @endif

    {{-- Filters Card --}}
    <div class="bg-bg-subtle p-6 sm:p-8 rounded-xl border border-border-subtle mb-12">
        <form action="{{ isset($regionData) ? route('treks.region', $regionData['slug']) : route('treks.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            {{-- Search --}}
            <div>
                <label for="search" class="block text-xs font-bold text-text-secondary uppercase tracking-wider mb-2">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search by trek name..." class="w-full bg-bg-base border border-border-strong rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-primary text-sm">
            </div>

            {{-- Month --}}
            <div>
                <label for="month" class="block text-xs font-bold text-text-secondary uppercase tracking-wider mb-2">Month</label>
                <select name="month" id="month" class="w-full bg-bg-base border border-border-strong rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-primary text-sm" onchange="this.form.submit()">
                    <option value="">Any Month</option>
                    @foreach(['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'] as $m)
                        <option value="{{ $m }}" {{ request('month') === $m ? 'selected' : '' }}>{{ ucfirst(strtolower($m)) }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Season --}}
            <div>
                <label for="season" class="block text-xs font-bold text-text-secondary uppercase tracking-wider mb-2">Season</label>
                <select name="season" id="season" class="w-full bg-bg-base border border-border-strong rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-primary text-sm" onchange="this.form.submit()">
                    <option value="">Any Season</option>
                    @foreach(['Winter', 'Summer', 'Monsoon', 'Spring', 'Autumn'] as $s)
                        <option value="{{ $s }}" {{ request('season') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Difficulty --}}
            <div>
                <label for="difficulty" class="block text-xs font-bold text-text-secondary uppercase tracking-wider mb-2">Difficulty</label>
                <select name="difficulty" id="difficulty" class="w-full bg-bg-base border border-border-strong rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-primary text-sm" onchange="this.form.submit()">
                    <option value="">Any Difficulty</option>
                    @foreach(['Easy', 'Moderate', 'Hard', 'Expert'] as $d)
                        <option value="{{ $d }}" {{ request('difficulty') === $d ? 'selected' : '' }}>{{ $d }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-2 lg:col-span-4 flex flex-col sm:flex-row justify-between items-center pt-4 border-t border-border-subtle gap-4">
                <span class="text-sm font-medium text-text-secondary">
                    Showing <strong class="text-text-primary">{{ $treks->count() }}</strong> {{ $treks->count() === 1 ? 'trek' : 'treks' }}
                    @if(isset($regionData)) in {{ $regionData['name'] }} @endif
                </span>
                <div class="flex items-center gap-4 w-full sm:w-auto justify-end">
                    @if(request()->anyFilled(['search', 'month', 'season', 'difficulty']))
                        <a href="{{ isset($regionData) ? route('treks.region', $regionData['slug']) : route('treks.index') }}" class="text-sm text-text-muted hover:text-brand-primary transition-colors px-2 py-2">
                            Clear Filters
                        </a>
                    @endif
                    <button type="submit" class="inline-flex items-center justify-center font-medium text-sm px-6 py-2.5 bg-brand-primary text-white hover:bg-brand-primary/90 transition-colors rounded-lg shadow-sm">
                        Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Trek Listing --}}
    @if($treks->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($treks as $trek)
                <x-trek-card :trek="$trek" />
            @endforeach
        </div>
    @else
        <div class="max-w-xl mx-auto my-12 text-center p-8 bg-bg-subtle rounded-xl border border-border-subtle">
            <h3 class="text-xl font-bold text-text-primary mb-2">No treks match your criteria</h3>
            <p class="text-text-secondary text-sm mb-6">Try adjusting your filters or search keywords to find available trails.</p>
            <a href="{{ isset($regionData) ? route('treks.region', $regionData['slug']) : route('treks.index') }}" class="inline-flex items-center justify-center font-medium text-sm px-6 py-2.5 bg-brand-primary text-white hover:bg-brand-primary/90 transition-colors rounded-lg">
                {{ isset($regionData) ? 'Reset ' . $regionData['name'] . ' Filters' : 'View All Treks' }}
            </a>
        </div>
    @endif
    
</div>
@endsection
