<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Room Management (Admin only)
    Route::resource('rooms', RoomController::class)->middleware('admin');
    
    // Booking Management
    Route::resource('bookings', BookingController::class);
    
    // Payment Routes
    Route::prefix('payment')->group(function () {
        Route::get('/booking/{booking}', [PaymentController::class, 'showPaymentForm'])->name('payment.show');
        Route::post('/process/{booking}', [PaymentController::class, 'processPayment'])->name('payment.process');
        Route::get('/success/{booking}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('/cancel/{booking}', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
    });

    // Admin Panel
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/rooms/{room}/update-status', [AdminController::class, 'updateRoomStatus'])->name('admin.rooms.update-status');
    });
});

// Public booking creation (without auth)
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');