<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departure;
use Illuminate\Http\Request;

class DepartureController extends Controller
{
    public function index()
    {
        $departures = Departure::with('trek')->orderBy('start_time', 'desc')->get();
        return view('admin.departures.index', compact('departures'));
    }

    public function create()
    {
        $treks = \App\Models\Trek::orderBy('title')->get();
        return view('admin.departures.create', compact('treks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'trek_id' => 'required|exists:treks,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'total_capacity' => 'required|integer|min:1',
            'unused_offline_reserved_capacity' => 'required|integer|min:0|lte:total_capacity',
            'status' => 'required|in:scheduled,completed,cancelled',
        ]);

        Departure::create($validated);
        return redirect()->route('admin.departures.index')->with('success', 'Departure created successfully.');
    }

    public function show(Departure $departure)
    {
        $activeAllocationsCount = \App\Models\SeatAllocation::where('departure_id', $departure->id)
            ->whereNull('released_at')
            ->where(function($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            })->count();
        
        return view('admin.departures.show', compact('departure', 'activeAllocationsCount'));
    }

    public function edit(Departure $departure)
    {
        $treks = \App\Models\Trek::orderBy('title')->get();
        return view('admin.departures.edit', compact('departure', 'treks'));
    }

    public function update(Request $request, Departure $departure)
    {
        $validated = $request->validate([
            'trek_id' => 'required|exists:treks,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'total_capacity' => 'required|integer|min:1',
            'unused_offline_reserved_capacity' => 'required|integer|min:0',
            'status' => 'required|in:scheduled,completed,cancelled',
        ]);

        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $departure) {
                // Lock departure for update to prevent concurrent capacity changes
                $lockedDeparture = Departure::where('id', $departure->id)->lockForUpdate()->first();
                
                $activeAllocations = \App\Models\SeatAllocation::where('departure_id', $lockedDeparture->id)
                    ->whereNull('released_at')
                    ->where(function($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                    })->count();

                if ($validated['total_capacity'] < $validated['unused_offline_reserved_capacity'] + $activeAllocations) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'total_capacity' => "Cannot reduce capacity. The minimum required total capacity to support current unused offline reserves ({$validated['unused_offline_reserved_capacity']}) and active allocations ({$activeAllocations}) is " . ($validated['unused_offline_reserved_capacity'] + $activeAllocations) . ".",
                    ]);
                }

                $lockedDeparture->update($validated);
            });
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        }

        return redirect()->route('admin.departures.index')->with('success', 'Departure updated successfully.');
    }

    public function destroy(Departure $departure)
    {
        return back()->with('error', 'Deleting departures is forbidden to preserve audit history. Please update status to cancelled instead.');
    }
}
