<?php

namespace App\Http\Controllers;

use App\Models\Departure;
use App\Models\ExpressionOfInterest;
use Illuminate\Http\Request;

class ExpressionOfInterestController extends Controller
{
    public function create(Departure $departure)
    {
        $departure->load('trek');

        if ($departure->trek->published_status !== 'published' || $departure->start_time < now()) {
            abort(404);
        }

        if ($departure->online_availability > 0) {
            return redirect()->route('treks.show', $departure->trek->slug)
                ->with('error', 'This departure has seats available. You can book online.');
        }

        return view('treks.interest', compact('departure'));
    }

    public function store(Request $request, Departure $departure)
    {
        $departure->load('trek');

        if ($departure->trek->published_status !== 'published' || $departure->start_time < now()) {
            abort(404);
        }

        if ($departure->online_availability > 0) {
            return redirect()->route('treks.show', $departure->trek->slug)
                ->with('error', 'This departure has seats available. You can book online.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'consent_status' => 'accepted',
        ]);

        $normalizedEmail = strtolower(trim($validated['email']));

        ExpressionOfInterest::firstOrCreate(
            ['departure_id' => $departure->id, 'email' => $normalizedEmail],
            [
                'name' => $validated['name'],
                'phone' => $validated['phone'] ?? null,
                'consent_status' => true,
            ]
        );

        return redirect()->route('treks.show', $departure->trek->slug)
            ->with('success', 'Thank you! We have recorded your interest in this departure.');
    }
}
