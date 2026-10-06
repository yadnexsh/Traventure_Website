@extends('layouts.public')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <x-page-header title="Booking Details" description="You are about to book your next adventure." />
    
    <x-booking-progress currentStep="1" />

    <x-card class="p-6 mb-8">
        <h3 class="text-xl font-bold text-text-primary mb-4">{{ $departure->trek->title }}</h3>
        
        <div class="space-y-4">
            <div class="flex justify-between border-b border-border-subtle pb-2">
                <span class="text-text-secondary">Departure Date</span>
                <span class="font-medium text-text-primary">{{ $departure->start_time->format('d M Y') }}</span>
            </div>
            
            <div class="flex justify-between border-b border-border-subtle pb-2">
                <span class="text-text-secondary">Duration</span>
                <span class="font-medium text-text-primary">{{ $departure->trek->duration }} days</span>
            </div>
            
            <div class="flex justify-between border-b border-border-subtle pb-2">
                <span class="text-text-secondary">Price per seat</span>
                <span class="font-bold text-brand-primary">₹{{ number_format($departure->trek->price / 100) }}</span>
            </div>
            
            <div class="flex justify-between pb-2">
                <span class="text-text-secondary">Available Seats</span>
                <span class="font-medium text-text-primary">{{ $departure->online_availability }}</span>
            </div>
        </div>
    </x-card>

    @if(session('error'))
        <x-alert type="error" class="mb-6">
            {{ session('error') }}
        </x-alert>
    @endif

    <div class="bg-bg-subtle border border-border-subtle rounded-lg p-4 mb-8 text-sm text-text-secondary">
        <p class="font-medium text-text-primary mb-1">Important:</p>
        <p>Continuing will place a temporary 15-minute hold on your seat while you complete your booking. If you do not complete the booking within this time, the seat will be released.</p>
    </div>

    <form method="POST" action="{{ route('booking.hold', $departure) }}">
        @csrf
        <div class="flex justify-end">
            <x-button type="submit" variant="primary" class="w-full sm:w-auto">
                Continue
            </x-button>
        </div>
    </form>
</div>
@endsection
