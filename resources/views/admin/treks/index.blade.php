@extends('layouts.admin')
@section('content')
<h1>Treks</h1>
<a href="{{ route('admin.treks.create') }}">Create Trek</a>
@foreach($treks as $trek)
  <div>{{ $trek->title }} ({{ $trek->published_status }}) <a href="{{ route('admin.treks.edit', $trek) }}">Edit</a></div>
@endforeach
@endsection
