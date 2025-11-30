@extends('layouts.app')

@section('content')
<h2>Add New Room</h2>

<form action="{{ route('rooms.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="room_number" class="form-label">Room Number</label>
        <input type="text" class="form-control" id="room_number" name="room_number" required>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Room Type</label>
        <select class="form-control" id="type" name="type" required>
            <option value="Single">Single</option>
            <option value="Double">Double</option>
            <option value="Suite">Suite</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
    </div>
    <div class="mb-3">
        <label for="availability_status" class="form-label">Status</label>
        <select class="form-control" id="availability_status" name="availability_status" required>
            <option value="Available">Available</option>
            <option value="Occupied">Occupied</option>
            <option value="Maintenance">Maintenance</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Create Room</button>
    <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection