@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Room Management</h2>
    <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add New Room</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Room Number</th>
                <th>Type</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td>{{ $room->room_number }}</td>
                <td>{{ $room->type }}</td>
                <td>${{ number_format($room->price, 2) }}</td>
                <td>
                    <span class="badge bg-{{ $room->availability_status == 'Available' ? 'success' : ($room->availability_status == 'Occupied' ? 'danger' : 'warning') }}">
                        {{ $room->availability_status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('rooms.edit', $room) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection