<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
  /*  public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store']);
    }*/

    public function index(): View
    {
        if (Auth::user()->isAdmin()) {
            $bookings = Booking::with(['room', 'user'])->latest()->get();
        } else {
            $bookings = Booking::with(['room', 'user'])
                ->where('user_id', Auth::id())
                ->latest()
                ->get();
        }
        
        return view('bookings.index', compact('bookings'));
    }

    public function create(): View
    {
        $rooms = Room::where('availability_status', 'Available')->get();
        return view('bookings.create', compact('rooms'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date'
        ]);

        $room = Room::findOrFail($request->room_id);

        if (!$room->isAvailableForDates($request->check_in_date, $request->check_out_date)) {
            return back()->with('error', 'Selected room is not available for the chosen dates.');
        }

        // Calculate total amount
        $totalNights = \Carbon\Carbon::parse($request->check_in_date)
            ->diffInDays($request->check_out_date);
        $totalAmount = $totalNights * $room->price;

        $booking = Booking::create([
            'room_id' => $request->room_id,
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'status' => 'Pending'
        ]);

        return redirect()->route('payment.show', $booking)->with('success', 'Booking created. Please complete payment.');
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        if (Auth::user()->isAdmin() || $booking->user_id === Auth::id()) {
            $booking->delete();
            return redirect()->route('bookings.index')->with('success', 'Booking cancelled successfully.');
        }
        
        return redirect()->route('bookings.index')->with('error', 'Unauthorized action.');
    }
}