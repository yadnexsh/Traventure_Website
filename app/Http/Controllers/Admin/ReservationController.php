<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Departure;
use App\Services\Booking\BookingService;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['customerRecord', 'departure.trek'])->orderBy('created_at', 'desc');

        if ($request->filled('departure_id')) {
            $query->where('departure_id', $request->departure_id);
        }
        if ($request->filled('booking_source')) {
            $query->where('booking_source', $request->booking_source);
        }

        $reservations = $query->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['customerRecord', 'departure.trek', 'seatAllocations']);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function create()
    {
        $departures = Departure::with('trek')->where('status', 'scheduled')->get();
        return view('admin.reservations.create', compact('departures'));
    }

    public function store(Request $request, BookingService $bookingService)
    {
        $validated = $request->validate([
            'departure_id' => 'required|exists:departures,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'emergency_contact_info' => 'nullable|string',
            'seats' => 'required|integer|min:1',
            'source_pool' => 'required|in:offline_reserved,general',
            'payment_status' => 'required|in:Unpaid,Paid',
        ]);

        try {
            $reservation = $bookingService->createOfflineBooking(
                $validated['departure_id'],
                [
                    'name' => $validated['name'],
                    'phone' => $validated['phone'] ?? null,
                    'emergency_contact_info' => $validated['emergency_contact_info'] ?? null
                ],
                $validated['seats'],
                $validated['source_pool'],
                $validated['payment_status'],
                $request->user()->id
            );
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'booking' => $e->getMessage()
            ]);
        }

        return redirect()->route('admin.reservations.show', $reservation)->with('success', 'Offline booking created successfully.');
    }
}
