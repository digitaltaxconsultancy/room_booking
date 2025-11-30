@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Complete Payment</div>
            <div class="card-body">
                <div class="booking-details mb-4">
                    <h5>Booking Summary</h5>
                    <p><strong>Room:</strong> {{ $booking->room->room_number }} ({{ $booking->room->type }})</p>
                    <p><strong>Check-in:</strong> {{ $booking->check_in_date->format('M d, Y') }}</p>
                    <p><strong>Check-out:</strong> {{ $booking->check_out_date->format('M d, Y') }}</p>
                    <p><strong>Total Amount:</strong> ${{ number_format($booking->room->price, 2) }}</p>
                </div>
                
                <form action="{{ route('payment.process', $booking) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg w-100">
                        Pay with Stripe - ${{ number_format($booking->room->price, 2) }}
                    </button>
                </form>
                
                <a href="{{ route('bookings.index') }}" class="btn btn-secondary mt-3">Cancel</a>
            </div>
        </div>
    </div>
</div>
@endsection