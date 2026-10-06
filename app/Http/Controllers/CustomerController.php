<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function myTrips()
    {
        $customerRecord = Auth::user()->customerRecords()->first();
        if (!$customerRecord) {
            $reservations = collect();
        } else {
            $reservations = $customerRecord->reservations()->with(['departure.trek'])->latest()->get();
        }
        return view('customer.trips.index', compact('reservations'));
    }

    public function showTrip(Reservation $reservation)
    {
        $customerRecord = Auth::user()->customerRecords()->first();
        if (!$customerRecord || $reservation->customer_record_id !== $customerRecord->id) {
            abort(403, 'Unauthorized access to reservation.');
        }

        $reservation->load(['departure.trek', 'trekmates', 'seatAllocations']);
        return view('customer.trips.show', compact('reservation'));
    }
}
