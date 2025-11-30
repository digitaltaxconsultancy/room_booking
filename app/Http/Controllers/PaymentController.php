<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class PaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function showPaymentForm(Booking $booking): View
    {
        return view('payments.create', compact('booking'));
    }

    public function processPayment(Request $request, Booking $booking): RedirectResponse
    {
        try {
            $totalAmount = $booking->room->price * 100; // Convert to cents

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Room Booking - ' . $booking->room->room_number,
                            'description' => 'Booking from ' . $booking->check_in_date . ' to ' . $booking->check_out_date,
                        ],
                        'unit_amount' => $totalAmount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success', ['booking' => $booking->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel', ['booking' => $booking->id]),
                'metadata' => [
                    'booking_id' => $booking->id
                ]
            ]);

            // Store pending payment
            Payment::create([
                'booking_id' => $booking->id,
                'payment_id' => $session->id,
                'amount' => $booking->room->price,
                'status' => 'pending'
            ]);

            return redirect($session->url);

        } catch (ApiErrorException $e) {
            return back()->with('error', 'Payment processing error: ' . $e->getMessage());
        }
    }

    public function paymentSuccess(Request $request, Booking $booking): View
    {
        $sessionId = $request->get('session_id');
        
        try {
            $session = Session::retrieve($sessionId);
            
            if ($session->payment_status === 'paid') {
                // Update payment status
                $payment = Payment::where('payment_id', $sessionId)->first();
                if ($payment) {
                    $payment->update(['status' => 'completed']);
                }

                // Update booking status
                $booking->update(['status' => 'Confirmed']);

                return view('payments.success', compact('booking', 'payment'));
            }

        } catch (ApiErrorException $e) {
            // Log error
        }

        return view('payments.success', compact('booking'));
    }

    public function paymentCancel(Booking $booking): RedirectResponse
    {
        // Update payment status to failed
        $payment = Payment::where('booking_id', $booking->id)->first();
        if ($payment) {
            $payment->update(['status' => 'failed']);
        }

        return redirect()->route('bookings.index')->with('error', 'Payment was cancelled.');
    }
}