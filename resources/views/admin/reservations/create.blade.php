@extends('layouts.admin')
@section('content')
<h1>Create Offline Booking</h1>
@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('admin.reservations.store') }}">
  @csrf
  <select name="departure_id" required>
    @foreach($departures as $departure)
      <option value="{{ $departure->id }}">{{ $departure->trek->title }} ({{ $departure->start_time }})</option>
    @endforeach
  </select>
  <input name="name" required placeholder="Customer Name">
  <input name="phone" placeholder="Phone">
  <input name="emergency_contact_info" placeholder="Emergency Info">
  <input type="number" name="seats" value="1" required min="1">
  <select name="source_pool" required><option value="general">General</option><option value="offline_reserved">Offline Reserved</option></select>
  <select name="payment_status" required><option value="Unpaid">Unpaid</option><option value="Paid">Paid</option></select>
  <button type="submit">Save</button>
</form>
@endsection
