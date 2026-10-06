<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trek;

class PublicTrekController extends Controller
{
    public function home()
    {
        $featuredTreks = Trek::where('published_status', 'published')->limit(3)->get();
        return view('home', compact('featuredTreks'));
    }

    public function index()
    {
        $treks = Trek::where('published_status', 'published')->get();
        return view('treks.index', compact('treks'));
    }

    public function upcoming()
    {
        $departures = \App\Models\Departure::with('trek')
            ->whereHas('trek', function ($query) {
                $query->where('published_status', 'published');
            })
            ->where('status', 'scheduled')
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->get();
            
        return view('treks.upcoming', compact('departures'));
    }

    public function show(Trek $trek)
    {
        if ($trek->published_status !== 'published') {
            abort(404);
        }

        $departures = $trek->departures()
            ->where('status', 'scheduled')
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->get();

        return view('treks.show', compact('trek', 'departures'));
    }
}
