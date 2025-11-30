@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Bookings</h2>
    <a href="{{ route('bookings.create') }}" class="btn btn-primary">New Booking</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Room</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->customer_name }}</td>
                <td>{{ $booking->customer_email }}</td>
                <td>{{ $booking->room->room_number }} ({{ $booking->room->type }})</td>
                <td>{{ $booking->check_in_date->format('M d, Y') }}</td>
                <td>{{ $booking->check_out_date->format('M d, Y') }}</td>
                <td>
                    <span class="badge bg-{{ $booking->status == 'Confirmed' ? 'success' : 'danger' }}">
                        {{ $booking->status }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Cancel this booking?')">Cancel</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection