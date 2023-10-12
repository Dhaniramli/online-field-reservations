<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DayDateController;
use App\Http\Controllers\Admin\FieldListController;
use App\Http\Controllers\Admin\FieldScheduleController;
use App\Http\Controllers\Admin\PlayingTimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\User\FieldScheduleController as UserFieldScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.home');
})->name('home');


Route::middleware(['guest'])->group(function () {
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    // Route::post('/booking/store', [BookingController::class, 'store']);
});

Route::get('/sewa-lapangan', [UserBookingController::class, 'index'])->name('index-booking');


// Route::post('/check-id', 'BookingController@checkId');
// Route::post('/get-price', [BookingController::class, 'getPrice'])->name('get-price');

Route::get('/jadwal-lapangan/{id}', [UserFieldScheduleController::class, 'index']);

Route::get('/admin', function () {
    return view('admin.home');
});

Route::get('/admin/hari-tanggal', [DayDateController::class, 'index']);
Route::post('/admin/hari-tanggal/create', [DayDateController::class, 'store']);

Route::get('/admin/jadwal-lapangan', [FieldScheduleController::class, 'index']);

//route sewa lapangan
Route::get('/admin/lapangan', [FieldListController::class, 'index'])->name('index-lapangan');
Route::post('/admin/lapangan/store', [FieldListController::class, 'store'])->name('store-lapangan');

Route::get('/admin/lapangan/{id}/jadwal', [FieldScheduleController::class, 'index'])->name('index-jadwalLapangan');
Route::post('/admin/lapangan/store/jadwal', [FieldScheduleController::class, 'store'])->name('store-jadwalLapangan');