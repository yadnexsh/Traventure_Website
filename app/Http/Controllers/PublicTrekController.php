<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trek;

class PublicTrekController extends Controller
{
    public function home()
    {
        $allTreks = Trek::where('published_status', 'published')->with(['departures' => function($q) { $q->where('status', 'scheduled')->where('start_time', '>=', now())->orderBy('start_time'); }])->get(); return view('home', compact('allTreks'));
    }

    public function index()
    {
        $treks = Trek::where('published_status', 'published')->get();
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

