<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trek;

class PublicTrekController extends Controller
{
    public function home()
    {
        $allTreks = Trek::where('published_status', 'published')
            ->with(['departures' => function($q) {
                $q->where('status', 'scheduled')
                  ->where('start_time', '>=', now())
                  ->orderBy('start_time');
            }])
            ->get();
            
        return view('home', compact('allTreks'));
    }

        public function index(Request $request)
    {
        $query = Trek::where('published_status', 'published');

        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->whereRaw('LOWER(title) like ?', ["%{$search}%"]);
        }

        if ($request->filled('month')) {
            $month = strtoupper($request->month);
            $query->whereJsonContains('best_months', $month);
        }

        if ($request->filled('season')) {
            $season = $request->season;
            $query->whereJsonContains('season', $season);
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        $treks = $query->get();

        return view('treks.index', compact('treks'));
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
