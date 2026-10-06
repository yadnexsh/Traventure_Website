@extends('layouts.public')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <x-page-header title="Participant Details" description="Tell us who is going on this trek." />
    
    <x-booking-progress currentStep="2" />

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-text-primary">Trekmate Information</h2>
        <div class="text-sm font-medium text-brand-primary">Hold expires at: {{ $allocation->expires_at->format('H:i') }}</div>
    </div>

    <form method="POST" action="{{ route('booking.trekmates.store', $allocation) }}" class="space-y-6">
        @csrf
        
        <x-card class="p-6">
            <h3 class="text-md font-semibold text-text-primary mb-4 border-b border-border-subtle pb-2">Participant #1</h3>
            
            @php
                $existingTrekmate = $allocation->reservation->trekmates->first();
            @endphp
            
            <div class="space-y-4">
                <div>
                    <label for="trekmate_name" class="block text-sm font-medium text-text-secondary mb-1">Full Name</label>
                    <x-input id="trekmate_name" name="trekmate_name" type="text" required value="{{ old('trekmate_name', $existingTrekmate->name ?? Auth::user()->name) }}" />
                    @error('trekmate_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="trekmate_email" class="block text-sm font-medium text-text-secondary mb-1">Email Address</label>
                    <p class="text-xs text-text-muted mb-2">We'll use this to share relevant trip information and updates.</p>
                    <x-input id="trekmate_email" name="trekmate_email" type="email" required value="{{ old('trekmate_email', $existingTrekmate->email ?? Auth::user()->email) }}" />
                    @error('trekmate_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="trekmate_emergency" class="block text-sm font-medium text-text-secondary mb-1">Emergency Contact Information</label>
                    <p class="text-xs text-text-muted mb-2">Please provide a name, relationship, and phone number of someone not on this trek.</p>
                    <x-textarea id="trekmate_emergency" name="trekmate_emergency" rows="3" required>{{ old('trekmate_emergency', $existingTrekmate->emergency_contact_info ?? '') }}</x-textarea>
                    @error('trekmate_emergency')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </x-card>

        <div class="flex justify-end">
            <x-button type="submit" variant="primary" class="w-full sm:w-auto">
                Continue to Add-ons
            </x-button>
        </div>
    </form>
</div>
@endsection
