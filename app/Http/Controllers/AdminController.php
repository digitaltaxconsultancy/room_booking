<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $bookings = Booking::with('room')->latest()->get();
        $rooms = Room::all();
        return view('admin.dashboard', compact('bookings', 'rooms'));
    }

    public function updateRoomStatus(Request $request, Room $room): RedirectResponse
    {
        $request->validate([
            'availability_status' => 'required|in:Available,Occupied,Maintenance'
        ]);

        $room->update(['availability_status' => $request->availability_status]);

        return back()->with('success', 'Room status updated successfully.');
    }
}