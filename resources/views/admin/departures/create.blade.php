@extends('layouts.admin')
@section('content')
<h1>Create Departure</h1>
@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('admin.departures.store') }}">
  @csrf
  <select name="trek_id" required>
    @foreach($treks as $trek)
      <option value="{{ $trek->id }}">{{ $trek->title }}</option>
    @endforeach
  </select>
  <input type="datetime-local" name="start_time" required>
  <input type="datetime-local" name="end_time" required>
  <input type="number" name="total_capacity" value="20" required>
  <input type="number" name="unused_offline_reserved_capacity" value="0" required>
  <select name="status"><option value="scheduled">Scheduled</option></select>
  <button type="submit">Save</button>
</form>
@endsection
