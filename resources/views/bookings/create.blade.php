@extends('layouts.app')

@section('content')
<h2>Create Booking</h2>

<form action="{{ route('bookings.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="room_id" class="form-label">Room</label>
        <select class="form-control" id="room_id" name="room_id" required>
            <option value="">Select a room</option>
            @foreach($rooms as $room)
            <option value="{{ $room->id }}">{{ $room->room_number }} ({{ $room->type }}) - ${{ number_format($room->price, 2) }}/night</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="customer_name" class="form-label">Customer Name</label>
        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
    </div>
    <div class="mb-3">
        <label for="customer_email" class="form-label">Email</label>
        <input type="email" class="form-control" id="customer_email" name="customer_email" required>
    </div>
    <div class="mb-3">
        <label for="check_in_date" class="form-label">Check-in Date</label>
        <input type="date" class="form-control" id="check_in_date" name="check_in_date" required>
    </div>
    <div class="mb-3">
        <label for="check_out_date" class="form-label">Check-out Date</label>
        <input type="date" class="form-control" id="check_out_date" name="check_out_date" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Booking</button>
    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection