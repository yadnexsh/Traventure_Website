@extends('layouts.public')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <x-page-header title="Secure Payment" description="Complete your booking securely." />
    
    <x-booking-progress currentStep="5" />

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-text-primary">Payment Details</h2>
        <div class="text-sm font-medium text-brand-primary">Hold expires at: {{ $allocation->expires_at->format('H:i') }}</div>
    </div>

    @if(session('error'))
        <x-alert type="error" class="mb-6">
            {{ session('error') }}
        </x-alert>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Payment Form Column --}}
        <div class="md:col-span-2">
            <x-card class="p-8 border-2 border-brand-primary/20 bg-bg-surface relative overflow-hidden">
                {{-- Decorative overlay for placeholder --}}
                <div class="absolute inset-0 bg-white/60 backdrop-blur-[1px] flex items-center justify-center z-10 flex-col px-6 text-center">
                    <svg class="h-12 w-12 text-brand-primary mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <h3 class="text-lg font-bold text-text-primary mb-2">Payment Integration Pending</h3>
                    <p class="text-sm text-text-secondary">Live payments are currently disabled in this local demo environment. This step will connect to the Razorpay gateway in M11.</p>
                </div>

                {{-- Faux Payment Form underneath --}}
                <div class="opacity-30 space-y-4 pointer-events-none filter grayscale">
                    <div class="h-10 bg-border-subtle rounded w-full"></div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="h-10 bg-border-subtle rounded w-full"></div>
                        <div class="h-10 bg-border-subtle rounded w-full"></div>
                    </div>
                    <div class="h-10 bg-border-subtle rounded w-full mt-4"></div>
                </div>
            </x-card>

            <form method="POST" action="{{ route('booking.payment.process', $allocation) }}" class="mt-8">
                @csrf
                <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:items-center gap-4">
                    <a href="{{ route('booking.review', $allocation) }}" class="text-text-secondary hover:text-text-primary font-medium text-center sm:text-left transition-colors">
                        &larr; Back to Review
                    </a>
                    
                    {{-- Dummy pay button --}}
                    <x-button type="submit" variant="primary" class="w-full sm:w-auto text-lg px-8 flex items-center justify-center gap-2">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Pay ₹{{ number_format($allocation->reservation->price_snapshot / 100) }}
                    </x-button>
                </div>
            </form>
        </div>

        {{-- Order Summary Sidebar --}}
        <div class="md:col-span-1">
            <x-card class="p-6 sticky top-24 bg-bg-subtle border-border-subtle shadow-sm">
                <h3 class="text-sm font-bold text-text-primary uppercase tracking-wider mb-4 border-b border-border-subtle pb-2">Order Summary</h3>
                <div class="space-y-3 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-text-secondary">Base Price (1)</span>
                        <span class="font-medium text-text-primary">₹{{ number_format($allocation->departure->trek->price / 100) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-text-secondary">Add-ons</span>
                        <span class="font-medium text-text-primary">₹0</span>
                    </div>
                </div>
                <div class="flex justify-between items-center border-t border-border-subtle pt-4">
                    <span class="font-bold text-text-primary">Total</span>
                    <span class="text-xl font-extrabold text-brand-primary">₹{{ number_format($allocation->reservation->price_snapshot / 100) }}</span>
                </div>
            </x-card>
        </div>
    </div>
</div>
@endsection
