<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeatAllocation;
use App\Services\Booking\BookingService;
use Illuminate\Validation\ValidationException;

class SeatAllocationController extends Controller
{
    public function release(Request $request, SeatAllocation $seatAllocation, BookingService $bookingService)
    {
        $validated = $request->validate([
            'destination_pool' => 'required|in:offline_reserved,general',
        ]);

        try {
            $bookingService->releaseAllocation($seatAllocation->id, $validated['destination_pool'], $request->user()->id);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'release' => $e->getMessage()
            ]);
        }

        return back()->with('success', 'Seat released successfully.');
    }
}
