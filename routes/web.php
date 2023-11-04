<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DayDateController;
use App\Http\Controllers\Admin\FieldListController;
use App\Http\Controllers\Admin\FieldScheduleController as AdminFieldScheduleController;
use App\Http\Controllers\User\FieldScheduleController as UserFieldScheduleController;
use App\Http\Controllers\Admin\PlayingTimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\User\PaymentConfirmationController;
use App\Http\Controllers\User\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.home');
})->name('home');

Route::get('/login', [AuthController::class, 'indexLogin'])->name('login');
Route::get('/register', [AuthController::class, 'indexRegister'])->name('register');

Route::middleware(['guest'])->group(function () {
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    // Route::post('/booking/store', [BookingController::class, 'store']);
});

Route::get('/sewa-lapangan', [UserBookingController::class, 'index'])->name('index-booking');

Route::get('/sewa-lapangan/{id}/jadwal', [UserFieldScheduleController::class, 'index'])->name('index-jadwal');


// Route::post('/check-id', 'BookingController@checkId');
// Route::post('/get-price', [BookingController::class, 'getPrice'])->name('get-price');

Route::get('/jadwal-lapangan/{id}', [UserAdminFieldScheduleController::class, 'index']);

Route::get('/admin', function () {
    return view('admin.home');
});

Route::get('/admin/hari-tanggal', [DayDateController::class, 'index']);
Route::post('/admin/hari-tanggal/create', [DayDateController::class, 'store']);

// Route::get('/admin/jadwal-lapangan', [AdminFieldScheduleController::class, 'index']);

//route sewa lapangan
Route::get('/admin/lapangan', [FieldListController::class, 'index'])->name('index-lapangan');
Route::post('/admin/lapangan/store', [FieldListController::class, 'store'])->name('store-lapangan');

Route::get('/admin/lapangan/{id}/jadwal', [AdminFieldScheduleController::class, 'index'])->name('index-jadwalLapangan');
Route::post('/admin/lapangan/store/jadwal', [AdminFieldScheduleController::class, 'store'])->name('store-jadwalLapangan');

Route::get('/payment-confirmation/{ids}', [PaymentConfirmationController::class, 'index'])->name('index-paymentConfirmation');
Route::get('/payment/{ids}', [PaymentConfirmationController::class, 'mount'])->name('bayar');

Route::get('/invoice', [PaymentConfirmationController::class, 'invoice'])->name('invoice');
Route::get('/invoice/{id}', [PaymentConfirmationController::class, 'invoiceDetail'])->name('invoiceDetail');
Route::put('/generate-snap-token/{id}', [PaymentConfirmationController::class, 'generateSnapToken']);

Route::put('/updateSchedule/{ids}', [PaymentConfirmationController::class, 'updateTrue']);
Route::put('/updateScheduleFalse/{ids}', [PaymentConfirmationController::class, 'updateFalse']);
Route::post('/transaction/pending', [PaymentConfirmationController::class, 'onPending']);
