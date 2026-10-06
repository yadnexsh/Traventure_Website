@extends('layouts.public')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-6">
        <a href="{{ route('customer.trips') }}" class="text-brand-primary hover:underline text-sm font-medium">&larr; Back to My Trips</a>
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-text-primary">{{ $reservation->departure->trek->title }}</h1>
            <p class="text-text-secondary mt-1">Ref: TRV-{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <x-badge variant="{{ $reservation->status === 'Confirmed' ? 'success' : 'warning' }}" class="text-sm px-3 py-1">{{ $reservation->status }}</x-badge>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 space-y-6">
            <x-card class="p-6">
                <h2 class="text-lg font-bold text-text-primary mb-4 border-b border-border-subtle pb-2">Trip Details</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-text-muted">Departure Date</p>
                        <p class="font-medium text-text-primary">{{ $reservation->departure->start_time->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-text-muted">Duration</p>
                        <p class="font-medium text-text-primary">{{ $reservation->departure->trek->duration }} days</p>
                    </div>
                    <div>
                        <p class="text-sm text-text-muted">Payment Status</p>
                        <p class="font-medium {{ $reservation->payment_status === 'Paid' ? 'text-green-600' : 'text-red-600' }}">{{ $reservation->payment_status }}</p>
                    </div>
                </div>
            </x-card>

            <x-card class="p-6">
                <h2 class="text-lg font-bold text-text-primary mb-4 border-b border-border-subtle pb-2">Participants</h2>
                <ul class="space-y-4">
                    @forelse($reservation->trekmates as $index => $trekmate)
                        <li class="bg-bg-subtle p-4 rounded border border-border-subtle">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-text-primary">{{ $trekmate->name }}</h3>
                                <span class="text-xs bg-white text-text-muted px-2 py-1 rounded-full border border-border-subtle">Participant #{{ $index + 1 }}</span>
                            </div>
                            <div class="text-sm text-text-secondary mb-2">
                                <p><span class="text-text-muted">Email:</span> {{ $trekmate->email }}</p>
                            </div>
                            <div class="text-sm text-text-secondary pt-2 border-t border-border-subtle">
                                <p class="text-text-muted mb-1 text-xs uppercase tracking-wider font-semibold">Emergency Contact</p>
                                <p>{{ $trekmate->emergency_contact_info }}</p>
                            </div>
                        </li>
                    @empty
                        <li class="text-text-secondary text-sm">No participant information available.</li>
                    @endforelse
                </ul>
            </x-card>
        </div>

        <div class="md:col-span-1">
            <x-card class="p-6 bg-bg-subtle border-border-subtle">
                <h2 class="text-sm font-bold text-text-primary uppercase tracking-wider mb-4 border-b border-border-subtle pb-2">Need Help?</h2>
                <p class="text-sm text-text-secondary mb-4">If you need to change your booking or have questions about the trek, please contact support.</p>
                <a href="#" class="text-brand-primary text-sm font-medium hover:underline">Contact Support &rarr;</a>
            </x-card>
            
            @if($reservation->payment_status === 'Unpaid' && $reservation->status !== 'Cancelled')
                <div class="mt-6">
                    <x-card class="p-6 border-red-200 bg-red-50">
                        <h2 class="text-sm font-bold text-red-800 uppercase tracking-wider mb-2">Payment Required</h2>
                        <p class="text-sm text-red-600 mb-4">Your booking is not fully confirmed until payment is received.</p>
                        <x-button href="#" variant="primary" class="w-full">Complete Payment</x-button>
                    </x-card>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
