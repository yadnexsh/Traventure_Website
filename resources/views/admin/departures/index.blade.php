@extends('layouts.admin')
@section('content')
<h1>Departures</h1>
<a href="{{ route('admin.departures.create') }}">Create Departure</a>
@foreach($departures as $departure)
  <div>{{ $departure->start_time }} - {{ $departure->trek->title }} <a href="{{ route('admin.departures.edit', $departure) }}">Edit</a></div>
@endforeach
@endsection
