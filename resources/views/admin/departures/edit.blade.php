@extends('layouts.admin')
@section('content')
<h1>Edit Departure</h1>
@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('admin.departures.update', $departure) }}">
  @csrf @method('PUT')
  <select name="trek_id" required>
    @foreach($treks as $trek)
      <option value="{{ $trek->id }}" @if($trek->id == $departure->trek_id) selected @endif>{{ $trek->title }}</option>
    @endforeach
  </select>
  <input type="datetime-local" name="start_time" value="{{ \Carbon\Carbon::parse($departure->start_time)->format('Y-m-d\TH:i') }}" required>
  <input type="datetime-local" name="end_time" value="{{ \Carbon\Carbon::parse($departure->end_time)->format('Y-m-d\TH:i') }}" required>
  <input type="number" name="total_capacity" value="{{ $departure->total_capacity }}" required>
  <input type="number" name="unused_offline_reserved_capacity" value="{{ $departure->unused_offline_reserved_capacity }}" required>
  <select name="status">
    <option value="scheduled" @if($departure->status == 'scheduled') selected @endif>Scheduled</option>
    <option value="completed" @if($departure->status == 'completed') selected @endif>Completed</option>
    <option value="cancelled" @if($departure->status == 'cancelled') selected @endif>Cancelled</option>
  </select>
  <button type="submit">Save</button>
</form>
@endsection
