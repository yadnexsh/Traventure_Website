@extends('layouts.public')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
    
    <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6">
        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
    </div>

    <h1 class="text-3xl font-extrabold text-text-primary mb-4">Booking Confirmed!</h1>
    <p class="text-lg text-text-secondary mb-8">Your adventure on the <strong>{{ $allocation->departure->trek->title }}</strong> is set. We've sent a confirmation email with all the details.</p>

    <x-card class="p-8 max-w-lg mx-auto text-left mb-8 shadow-md border-border-subtle">
        <h2 class="text-md font-bold text-text-primary mb-4 border-b border-border-subtle pb-2">Booking Details</h2>
        <dl class="space-y-3 text-sm">
            <div class="flex justify-between">
                <dt class="text-text-secondary">Booking Reference</dt>
                <dd class="font-medium text-text-primary">TRV-{{ str_pad($allocation->reservation->id, 6, '0', STR_PAD_LEFT) }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-text-secondary">Date</dt>
                <dd class="font-medium text-text-primary">{{ $allocation->departure->start_time->format('d M Y') }}</dd>
            </div>
            <div class="flex justify-between">
                <dt class="text-text-secondary">Participants</dt>
                <dd class="font-medium text-text-primary">{{ $allocation->reservation->trekmates->count() }}</dd>
            </div>
            <div class="flex justify-between pt-3 border-t border-border-subtle mt-3">
                <dt class="text-text-secondary font-bold">Total Paid</dt>
                <dd class="font-bold text-brand-primary">₹{{ number_format($allocation->reservation->price_snapshot / 100) }}</dd>
            </div>
        </dl>
    </x-card>

    <div class="flex flex-col sm:flex-row justify-center gap-4">
        <x-button href="{{ route('customer.trip.show', $allocation->reservation) }}" variant="primary">
            View My Trip
        </x-button>
        <x-button href="{{ route('home') }}" variant="secondary">
            Return Home
        </x-button>
    </div>
</div>
@endsection
