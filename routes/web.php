<?php

use App\Http\Controllers\Admin\DayDateController;
use App\Http\Controllers\Admin\FieldListController;
use App\Http\Controllers\Admin\FieldScheduleController;
use App\Http\Controllers\Admin\PlayingTimeController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\FieldScheduleController as UserFieldScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.home');
});

Route::post('/booking/store', [BookingController::class, 'store']);

Route::get('/jadwal-lapangan/{id}', [UserFieldScheduleController::class, 'index']);

Route::get('/admin', function () {
    return view('admin.home');
});

Route::get('/admin/daftar-lapangan', [FieldListController::class, 'index']);
Route::get('/admin/daftar-lapangan/create', [FieldListController::class, 'create']);
Route::post('/admin/daftar-lapangan/store', [FieldListController::class, 'store']);
Route::get('/admin/daftar-lapangan/edit/{id}', [FieldListController::class, 'edit']);
Route::put('/admin/daftar-lapangan/update/{id}', [FieldListController::class, 'update']);
Route::get('/admin/daftar-lapangan/hapus/{id}', [FieldListController::class, 'destroy']);

Route::get('/admin/jam-main', [PlayingTimeController::class, 'index']);
Route::post('/admin/jam-main/create', [PlayingTimeController::class, 'store']);
Route::get('/admin/jam-main/hapus/{id}', [PlayingTimeController::class, 'destroy']);
Route::post('/admin/jam-main/edit/{id}', [PlayingTimeController::class, 'update']);

Route::get('/admin/hari-tanggal', [DayDateController::class, 'index']);
Route::post('/admin/hari-tanggal/create', [DayDateController::class, 'store']);

Route::get('/admin/jadwal-lapangan', [FieldScheduleController::class, 'index']);