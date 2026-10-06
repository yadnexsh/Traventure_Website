<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $customerRecord = Auth::user()->customerRecords()->first();
        if (!$customerRecord) {
            $upcomingTrips = collect();
            $pastTrips = collect();
        } else {
            $reservations = $customerRecord->reservations()->with(['departure.trek'])->latest()->get();
            $upcomingTrips = $reservations->filter(function($r) {
                return $r->departure->start_time > now() && $r->status !== 'Cancelled';
            })->take(2);
            $pastTrips = $reservations->filter(function($r) {
                return $r->departure->start_time <= now() || $r->status === 'Cancelled';
            })->take(3);
        }
        return view('customer.dashboard', compact('upcomingTrips', 'pastTrips'));
    }

    public function myTrips()
    {
        $customerRecord = Auth::user()->customerRecords()->first();
        if (!$customerRecord) {
            $upcomingTrips = collect();
            $pastTrips = collect();
        } else {
            $reservations = $customerRecord->reservations()->with(['departure.trek'])->latest()->get();
            $upcomingTrips = $reservations->filter(function($r) {
                return $r->departure->start_time > now() && $r->status !== 'Cancelled';
            });
            $pastTrips = $reservations->filter(function($r) {
                return $r->departure->start_time <= now() || $r->status === 'Cancelled';
            });
        }
        return view('customer.trips.index', compact('upcomingTrips', 'pastTrips'));
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

    public function profile()
    {
        $user = Auth::user();
        $customerRecord = $user->customerRecords()->firstOrCreate(
            ['user_id' => $user->id],
            ['name' => $user->name]
        );
        return view('customer.profile', compact('user', 'customerRecord'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20'
        ]);

        $user = Auth::user();
        $user->update(['name' => $request->name]);

        $customerRecord = $user->customerRecords()->firstOrCreate(
            ['user_id' => $user->id],
            ['name' => $user->name]
        );
        
        $customerRecord->update([
            'name' => $request->name,
            'phone' => $request->phone
        ]);

        return back()->with('status', 'profile-updated');
    }

    public function security()
    {
        $user = Auth::user();
        $hasGoogle = $user->externalIdentities()->where('provider', 'google')->exists();
        return view('customer.security', compact('user', 'hasGoogle'));
    }

    public function updateSecurity(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password)
        ]);

        return back()->with('status', 'password-updated');
    }
}
