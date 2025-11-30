@extends('layouts.app')

@section('content')
<h2>Admin Dashboard</h2>

<div class="row mt-4">
    <div class="col-md-8">
        <h4>All Bookings</h4>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Room</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->customer_name }}<br><small>{{ $booking->customer_email }}</small></td>
                        <td>{{ $booking->room->room_number }}</td>
                        <td>{{ $booking->check_in_date->format('M d, Y') }}</td>
                        <td>{{ $booking->check_out_date->format('M d, Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $booking->status == 'Confirmed' ? 'success' : 'danger' }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <h4>Room Availability</h4>
        @foreach($rooms as $room)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $room->room_number }} ({{ $room->type }})</h5>
                <p class="card-text">${{ number_format($room->price, 2) }}/night</p>
                <form action="{{ route('admin.rooms.update-status', $room) }}" method="POST">
                    @csrf
                    <select name="availability_status" class="form-select" onchange="this.form.submit()">
                        <option value="Available" {{ $room->availability_status == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Occupied" {{ $room->availability_status == 'Occupied' ? 'selected' : '' }}>Occupied</option>
                        <option value="Maintenance" {{ $room->availability_status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection