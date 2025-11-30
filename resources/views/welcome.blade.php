@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Welcome to Hotel Booking System</h1>
    <p class="lead">Manage rooms and bookings efficiently</p>
    <hr class="my-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Room Management</h5>
                    <p class="card-text">Add, edit, and manage hotel rooms</p>
                    <a href="{{ route('rooms.index') }}" class="btn btn-primary">Manage Rooms</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bookings</h5>
                    <p class="card-text">View and manage room bookings</p>
                    <a href="{{ route('bookings.index') }}" class="btn btn-primary">View Bookings</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Admin Panel</h5>
                    <p class="card-text">Administrative functions</p>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Admin Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection