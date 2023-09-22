<?php

use App\Http\Controllers\Admin\FieldListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.home');
});

Route::get('/jadwal-lapangan', function () {
    return view('user.fieldSchedule.index');
});

Route::get('/admin', function () {
    return view('admin.home');
});

Route::get('/admin/daftar-lapangan', [FieldListController::class, 'index']);
Route::post('/admin/daftar-lapangan/create', [FieldListController::class, 'store']);
Route::get('/admin/daftar-lapangan/hapus/{id}', [FieldListController::class, 'destroy']);
