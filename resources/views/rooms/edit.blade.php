@extends('layouts.app')

@section('content')
<h2>Edit Room</h2>

<form action="{{ route('rooms.update', $room) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="room_number" class="form-label">Room Number</label>
        <input type="text" class="form-control" id="room_number" name="room_number" value="{{ $room->room_number }}" required>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Room Type</label>
        <select class="form-control" id="type" name="type" required>
            <option value="Single" {{ $room->type == 'Single' ? 'selected' : '' }}>Single</option>
            <option value="Double" {{ $room->type == 'Double' ? 'selected' : '' }}>Double</option>
            <option value="Suite" {{ $room->type == 'Suite' ? 'selected' : '' }}>Suite</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $room->price }}" required>
    </div>
    <div class="mb-3">
        <label for="availability_status" class="form-label">Status</label>
        <select class="form-control" id="availability_status" name="availability_status" required>
            <option value="Available" {{ $room->availability_status == 'Available' ? 'selected' : '' }}>Available</option>
            <option value="Occupied" {{ $room->availability_status == 'Occupied' ? 'selected' : '' }}>Occupied</option>
            <option value="Maintenance" {{ $room->availability_status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Room</button>
    <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection