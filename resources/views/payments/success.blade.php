@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">Payment Successful</div>
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 48px;"></i>
                </div>
                <h4>Thank You for Your Payment!</h4>
                <p>Your booking has been confirmed.</p>
                
                <div class="booking-details mt-4">
                    <p><strong>Booking Reference:</strong> #{{ $booking->id }}</p>
                    <p><strong>Room:</strong> {{ $booking->room->room_number }}</p>
                    <p><strong>Amount Paid:</strong> ${{ number_format($booking->room->price, 2) }}</p>
                </div>
                
                <a href="{{ route('bookings.index') }}" class="btn btn-primary mt-3">View My Bookings</a>
            </div>
        </div>
    </div>
</div>
@endsection