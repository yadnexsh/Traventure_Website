@extends('layouts.public')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <x-page-header title="Add-ons" description="Enhance your trip" />
    
    <x-booking-progress currentStep="3" />

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-text-primary">Available Enhancements</h2>
        <div class="text-sm font-medium text-brand-primary">Hold expires at: {{ $allocation->expires_at->format('H:i') }}</div>
    </div>

    <form method="POST" action="{{ route('booking.addons.store', $allocation) }}">
        @csrf
        
        <x-card class="p-8 text-center mb-6 bg-bg-subtle border-dashed border-2 border-border-subtle">
            <svg class="mx-auto h-12 w-12 text-text-muted mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <h3 class="text-lg font-medium text-text-primary mb-1">No add-ons are currently available</h3>
            <p class="text-text-secondary text-sm">There are no optional enhancements available for this departure.</p>
        </x-card>

        <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:items-center gap-4 mt-8">
            <a href="{{ route('booking.trekmates', $allocation) }}" class="text-text-secondary hover:text-text-primary font-medium text-center sm:text-left transition-colors">
                &larr; Back to Trekmates
            </a>
            <x-button type="submit" variant="primary" class="w-full sm:w-auto">
                Continue to Review
            </x-button>
        </div>
    </form>
</div>
@endsection
