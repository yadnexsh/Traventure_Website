@extends('layouts.admin')
@section('content')
<h1>Reservation {{ $reservation->id }}</h1>
<div>Customer: {{ $reservation->customerRecord->name }}</div>
<div>Status: {{ $reservation->status }}</div>
<div>Payment: {{ $reservation->payment_status }}</div>
<h2>Allocations</h2>
@foreach($reservation->seatAllocations as $allocation)
  <div>{{ $allocation->allocation_type }} ({{ $allocation->source_pool }})
  @if($allocation->released_at)
    Released at {{ $allocation->released_at }}
  @else
    <form method="POST" action="{{ route('admin.seat-allocations.release', $allocation) }}">
      @csrf
      <select name="destination_pool"><option value="offline_reserved">Offline Reserved</option><option value="general">General Online</option></select>
      <button type="submit">Release</button>
    </form>
  @endif
  </div>
@endforeach
@endsection
