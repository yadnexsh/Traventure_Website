@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-600 mt-2">Welcome to the Traventure Admin Panel. Here is an overview of the operations.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Published Treks</h2>
        <div class="mt-2 text-4xl font-bold text-blue-900">{{ $publishedTreksCount }}</div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Upcoming Departures</h2>
        <div class="mt-2 text-4xl font-bold text-blue-900">{{ $upcomingDeparturesCount }}</div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Reservations</h2>
        <div class="mt-2 text-4xl font-bold text-blue-900">{{ $totalReservationsCount }}</div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Active Online Holds</h2>
        <div class="mt-2 text-4xl font-bold text-blue-900">{{ $activeHoldsCount }}</div>
    </div>
</div>
@endsection
