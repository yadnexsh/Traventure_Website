@extends('layouts.public')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <x-page-header title="Review & Confirm" description="Review your booking details before proceeding to payment." />
    
    <x-booking-progress currentStep="4" />

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-text-primary">Booking Summary</h2>
        <div class="text-sm font-medium text-brand-primary">Hold expires at: {{ $allocation->expires_at->format('H:i') }}</div>
    </div>

    <div class="space-y-6 mb-8">
        {{-- Trek Summary --}}
        <x-card class="p-6">
            <h3 class="text-sm font-bold text-text-muted uppercase tracking-wider mb-4 border-b border-border-subtle pb-2">Trek Details</h3>
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">
                <div>
                    <h4 class="text-lg font-bold text-text-primary mb-1">{{ $allocation->departure->trek->title }}</h4>
                    <p class="text-text-secondary text-sm">{{ $allocation->departure->start_time->format('d M Y') }} &bull; {{ $allocation->departure->trek->duration }} days</p>
                </div>
                <div class="text-left sm:text-right">
                    <p class="text-lg font-bold text-brand-primary">₹{{ number_format($allocation->departure->trek->price / 100) }}</p>
                    <p class="text-xs text-text-muted">Base price (1 seat)</p>
                </div>
            </div>
        </x-card>

        {{-- Trekmates Summary --}}
        <x-card class="p-6">
            <div class="flex justify-between items-end border-b border-border-subtle pb-2 mb-4">
                <h3 class="text-sm font-bold text-text-muted uppercase tracking-wider">Participants</h3>
                <a href="{{ route('booking.trekmates', $allocation) }}" class="text-sm text-brand-primary font-medium hover:underline">Edit</a>
            </div>
            
            <ul class="space-y-3">
                @foreach($allocation->reservation->trekmates as $index => $trekmate)
                    <li class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                        <div>
                            <p class="text-sm font-medium text-text-primary">{{ $trekmate->name }}</p>
                            <p class="text-xs text-text-secondary">{{ $trekmate->email }}</p>
                        </div>
                        <span class="text-xs bg-bg-subtle text-text-muted px-2 py-1 rounded-full w-max">Participant #{{ $index + 1 }}</span>
                    </li>
                @endforeach
            </ul>
        </x-card>

        {{-- Add-ons Summary --}}
        <x-card class="p-6">
            <div class="flex justify-between items-end border-b border-border-subtle pb-2 mb-4">
                <h3 class="text-sm font-bold text-text-muted uppercase tracking-wider">Add-ons</h3>
                <a href="{{ route('booking.addons', $allocation) }}" class="text-sm text-brand-primary font-medium hover:underline">Edit</a>
            </div>
            
            <p class="text-sm text-text-secondary">No add-ons selected.</p>
        </x-card>

        {{-- Total --}}
        <x-card class="p-6 bg-brand-primary/5 border-brand-primary/20">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold text-text-primary">Total Amount</h3>
                <p class="text-2xl font-extrabold text-brand-primary">₹{{ number_format($allocation->reservation->price_snapshot / 100) }}</p>
            </div>
        </x-card>
    </div>

    {{-- Terms and Conditions --}}
    <form method="POST" action="{{ route('booking.confirm', $allocation) }}">
        @csrf
        
        <x-card class="p-6 mb-8">
            <h3 class="text-md font-bold text-text-primary mb-3">Terms & Conditions</h3>
            
            <div class="bg-bg-subtle border border-border-subtle rounded p-4 mb-4 h-32 overflow-y-auto text-sm text-text-secondary">
                <p class="italic text-text-muted mb-2">[Terms & Conditions content will be provided by Traventure.]</p>
                <p>This is a placeholder for the final legal terms regarding cancellations, refunds, behavioral expectations, and medical liability.</p>
            </div>
            
            <label class="flex items-start gap-3 cursor-pointer">
                <div class="flex items-center h-5">
                    <input type="checkbox" name="terms" required class="w-4 h-4 text-brand-primary bg-white border-border-subtle rounded focus:ring-brand-primary focus:ring-2">
                </div>
                <div class="text-sm text-text-primary">
                    I agree to the Traventure <a href="#" class="text-brand-primary hover:underline">Terms & Conditions</a> and <a href="#" class="text-brand-primary hover:underline">Privacy Policy</a>.
                </div>
            </label>
            @error('terms')
                <p class="mt-1 text-sm text-red-600 ml-7">{{ $message }}</p>
            @enderror
        </x-card>

        <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:items-center gap-4">
            <a href="{{ route('booking.addons', $allocation) }}" class="text-text-secondary hover:text-text-primary font-medium text-center sm:text-left transition-colors">
                &larr; Back to Add-ons
            </a>
            <x-button type="submit" variant="primary" class="w-full sm:w-auto text-lg px-8">
                Continue to Payment
            </x-button>
        </div>
    </form>
</div>
@endsection
