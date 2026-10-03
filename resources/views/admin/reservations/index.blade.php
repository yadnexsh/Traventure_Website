@extends('layouts.admin')
@section('content')
<h1>Reservations</h1>
<a href="{{ route('admin.reservations.create') }}">Create Offline Booking</a>
@foreach($reservations as $reservation)
  <div>{{ $reservation->id }} - {{ $reservation->customerRecord->name }} - {{ $reservation->departure->trek->title }} <a href="{{ route('admin.reservations.show', $reservation) }}">View</a></div>
@endforeach
@endsection
