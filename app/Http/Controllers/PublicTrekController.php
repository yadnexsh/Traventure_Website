<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trek;

class PublicTrekController extends Controller
{
    private $regionMap = [
        'sahyadri' => [
            'name' => 'Sahyadri Treks',
            'slug' => 'sahyadri',
            'db_name' => 'Sahyadris',
            'intro' => 'Ancient fortresses, rugged basalt cliffs, lush monsoon valleys, and historic trails forged through the Western Ghats.',
            'banner' => 'media/header/header (3).jpg',
        ],
        'sahyadris' => [
            'name' => 'Sahyadri Treks',
            'slug' => 'sahyadri',
            'db_name' => 'Sahyadris',
            'intro' => 'Ancient fortresses, rugged basalt cliffs, lush monsoon valleys, and historic trails forged through the Western Ghats.',
            'banner' => 'media/header/header (3).jpg',
        ],
        'himalayan' => [
            'name' => 'Himalayan Treks',
            'slug' => 'himalayan',
            'db_name' => 'Himalayas',
            'intro' => 'Towering snow-clad peaks, high-altitude alpine passes, glacial lakes, and vast celestial horizons across the northern ranges.',
            'banner' => 'media/header/header (1).jpg',
        ],
        'himalayas' => [
            'name' => 'Himalayan Treks',
            'slug' => 'himalayan',
            'db_name' => 'Himalayas',
            'intro' => 'Towering snow-clad peaks, high-altitude alpine passes, glacial lakes, and vast celestial horizons across the northern ranges.',
            'banner' => 'media/header/header (1).jpg',
        ],
    ];

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

    public function index(Request $request, ?string $region = null)
    {
        $regionSlug = $region ?? $request->query('region');
        $regionData = null;
        $activeRegionDb = null;

        if ($regionSlug) {
            $normalizedSlug = strtolower(trim($regionSlug));
            if (isset($this->regionMap[$normalizedSlug])) {
                $regionData = $this->regionMap[$normalizedSlug];
                $activeRegionDb = $regionData['db_name'];
            } else {
                if ($region !== null) {
                    abort(404);
                }
            }
        }

        $query = Trek::where('published_status', 'published');

        if ($activeRegionDb) {
            $query->where('region', $activeRegionDb);
        }

        if ($request->filled('search')) {
            $search = strtolower(trim($request->search));
            $query->whereRaw('LOWER(title) like ?', ["%{$search}%"]);
        }

        if ($request->filled('month')) {
            $month = strtoupper(trim($request->month));
            $query->whereJsonContains('best_months', $month);
        }

        if ($request->filled('season')) {
            $season = trim($request->season);
            $query->whereJsonContains('season', $season);
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', trim($request->difficulty));
        }

        $treks = $query->orderBy('title')->get();

        return view('treks.index', compact('treks', 'regionData'));
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

    public function about()
    {
        return view('about');
    }
}
