<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departure;
use App\Models\SeatAllocation;
use App\Services\Booking\BookingService;
use Exception;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    // Step 1: Details (Overview)
    public function details(Departure $departure)
    {
        $departure->load('trek');
        return view('booking.details', compact('departure'));
    }

    // Create online hold
    public function createHold(Departure $departure)
    {
        try {
            $allocation = $this->bookingService->createOnlineHold(Auth::user(), $departure->id);
            return redirect()->route('booking.trekmates', $allocation);
        } catch (Exception $e) {
            return back()->with('error', 'This departure is no longer available. Please choose another departure.');
        }
    }

    // Helper to verify ownership
    protected function checkAllocationOwnership(SeatAllocation $allocation)
    {
        $customerRecord = Auth::user()->customerRecords()->first();
        if (!$customerRecord || $allocation->reservation->customer_record_id !== $customerRecord->id) {
            abort(403, 'Unauthorized access to booking.');
        }
    }

    // Step 2: Trekmates
    public function trekmates(SeatAllocation $allocation)
    {
        $this->checkAllocationOwnership($allocation);
        $allocation->load('reservation.trekmates', 'departure.trek');
        
        return view('booking.trekmates', compact('allocation'));
    }

    public function storeTrekmates(Request $request, SeatAllocation $allocation)
    {
        $this->checkAllocationOwnership($allocation);
        
        $request->validate([
            'trekmate_name' => 'required|string|max:255',
            'trekmate_email' => 'required|email|max:255',
            'trekmate_emergency' => 'required|string|max:1000',
        ]);

        $allocation->reservation->trekmates()->delete();

        $allocation->reservation->trekmates()->create([
            'name' => $request->trekmate_name,
            'email' => $request->trekmate_email,
            'emergency_contact_info' => $request->trekmate_emergency,
        ]);

        return redirect()->route('booking.addons', $allocation);
    }

    // Step 3: Addons (Placeholder)
    public function addons(SeatAllocation $allocation)
    {
        $this->checkAllocationOwnership($allocation);
        $allocation->load('departure.trek');
        return view('booking.addons', compact('allocation'));
    }

    public function storeAddons(Request $request, SeatAllocation $allocation)
    {
        $this->checkAllocationOwnership($allocation);
        return redirect()->route('booking.review', $allocation);
    }

    // Step 4: Review and T&C
    public function review(SeatAllocation $allocation)
    {
        $this->checkAllocationOwnership($allocation);
        $allocation->load('departure.trek', 'reservation.trekmates');
        return view('booking.review', compact('allocation'));
    }

    public function confirm(Request $request, SeatAllocation $allocation)
    {
        $this->checkAllocationOwnership($allocation);
        $request->validate(['terms' => 'accepted']);
        return redirect()->route('booking.payment', $allocation);
    }

    // Step 5: Payment Placeholder
    public function payment(SeatAllocation $allocation)
    {
        $this->checkAllocationOwnership($allocation);
        $allocation->load('departure.trek');
        return view('booking.payment', compact('allocation'));
    }

    public function processPayment(Request $request, SeatAllocation $allocation)
    {
        $this->checkAllocationOwnership($allocation);
        // We do NOT process payments in M10.5.
        // Returning back with an error ensures we don't fabricate a confirmed booking.
        return back()->with('error', 'Payment integration is deferred to M11. Live payments are not currently active.');
    }

    // Step 6: Confirmation
    public function confirmation(SeatAllocation $allocation)
    {
        $this->checkAllocationOwnership($allocation);
        $allocation->load('departure.trek', 'reservation.trekmates');
        return view('booking.confirmation', compact('allocation'));
    }
}
