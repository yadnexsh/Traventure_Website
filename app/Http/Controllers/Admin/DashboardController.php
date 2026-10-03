<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departure;
use App\Models\SeatAllocation;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $publishedTreksCount = \App\Models\Trek::where('published_status', 'published')->count();
        $upcomingDeparturesCount = Departure::where('start_time', '>', now())->count();
        $totalReservationsCount = Reservation::count();
        $activeHoldsCount = SeatAllocation::where('allocation_type', 'OnlineHold')
            ->whereNull('released_at')
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })->count();

        return view('admin.dashboard', compact(
            'publishedTreksCount',
            'upcomingDeparturesCount',
            'totalReservationsCount',
            'activeHoldsCount'
        ));
    }
}
