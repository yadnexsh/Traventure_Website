@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <x-page-header 
        title="Explore Treks" 
        description="Discover your next adventure from our curated list of high-quality expeditions."
    />

    @if($treks->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($treks as $trek)
                <x-trek-card :trek="$trek" />
            @endforeach
        </div>
    @else
        <div class="max-w-2xl mx-auto mt-12">
            <x-empty-state 
                title="No treks available" 
                description="We don't have any treks published right now. Please check back soon as we finalize our upcoming season!" 
            />
        </div>
    @endif
    
</div>
@endsection
