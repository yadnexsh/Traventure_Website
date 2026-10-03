@extends('layouts.admin')
@section('content')
<h1>Departure Details</h1>
<div>Total Capacity: {{ $departure->total_capacity }}</div>
<div>Unused Offline Reserved: {{ $departure->unused_offline_reserved_capacity }}</div>
<div>Active Allocations: {{ $activeAllocationsCount }}</div>
<div>Online Availability: {{ $departure->online_availability }}</div>
@endsection
