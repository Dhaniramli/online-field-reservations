<?php

use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\FieldListController;
use App\Http\Controllers\Admin\FieldScheduleController as AdminFieldScheduleController;
use App\Http\Controllers\Admin\HowToorderController;
use App\Http\Controllers\Admin\HowTopayController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\User\FieldScheduleController as UserFieldScheduleController;
use App\Http\Controllers\Admin\RequestCancelledController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\PaymentConfirmationController;
use App\Http\Controllers\User\ProfileController;
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
});

Route::get('/sewa-lapangan', [UserFieldScheduleController::class, 'field'])->name('index-booking');

Route::get('/sewa-lapangan/{id}/jadwal', [UserFieldScheduleController::class, 'index'])->name('index-jadwal');
Route::post('/sewa-lapangan/{id}/jadwal', [UserFieldScheduleController::class, 'index'])->name('index-jadwal');

Route::middleware(['auth', 'onlyAdmin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.home');
    });

    Route::get('/admin/lapangan', [FieldListController::class, 'index'])->name('index-lapangan');
    Route::post('/admin/lapangan/store', [FieldListController::class, 'store'])->name('store-lapangan');

    Route::get('/admin/lapangan/{id}/jadwal', [AdminFieldScheduleController::class, 'index'])->name('index-jadwalLapangan');
    Route::post('/admin/lapangan/store/jadwal', [AdminFieldScheduleController::class, 'store'])->name('store-jadwalLapangan');

    Route::get('/admin/permintaan-pembatalan', [RequestCancelledController::class, 'index'])->name('index-cancel');
    Route::get('/admin/permintaan-pembatalan/hapus/{id}', [RequestCancelledController::class, 'destroy']);
    Route::get('/admin/permintaan-pembatalan/konfir/{id}', [RequestCancelledController::class, 'confirm']);
    Route::get('/admin/permintaan-pembatalan/tolak/{id}', [RequestCancelledController::class, 'reject']);
    
    //route kontak kami
    Route::get('/admin/kontak-kami', [ContactUsController::class, 'index'])->name('index-contact');
    Route::post('/admin/kontak-kami', [ContactUsController::class, 'store'])->name('store-contact');
    Route::put('/admin/kontak-kami/update', [ContactUsController::class, 'update'])->name('update-contact');
    Route::get('/admin/kontak-kami/hapus/{id}', [ContactUsController::class, 'destroy'])->name('destroy-contact');
    //route kebijakan privasi
    Route::get('/admin/kebijakan-privasi', [PrivacyPolicyController::class, 'index'])->name('index-privasi');
    Route::post('/admin/kebijakan-privasi', [PrivacyPolicyController::class, 'store'])->name('store-privasi');
    Route::put('/admin/kebijakan-privasi/update', [PrivacyPolicyController::class, 'update'])->name('update-privasi');
    Route::get('/admin/kebijakan-privasi/hapus/{id}', [PrivacyPolicyController::class, 'destroy'])->name('destroy-privasi');
    //route cara booking
    Route::get('/admin/cara-booking', [HowToorderController::class, 'index'])->name('index-howToorder');
    Route::post('/admin/cara-booking', [HowToorderController::class, 'store'])->name('store-howToorder');
    Route::put('/admin/cara-booking/update', [HowToorderController::class, 'update'])->name('update-howToorder');
    Route::get('/admin/cara-booking/hapus/{id}', [HowToorderController::class, 'destroy'])->name('destroy-howToorder');
    //route cara pembayaran
    Route::get('/admin/pembayaran', [HowTopayController::class, 'index'])->name('index-howTopay');
    Route::post('/admin/pembayaran', [HowTopayController::class, 'store'])->name('store-howTopay');
    Route::put('/admin/pembayaran/update', [HowTopayController::class, 'update'])->name('update-howTopay');
    Route::get('/admin/pembayaran/hapus/{id}', [HowTopayController::class, 'destroy'])->name('destroy-howTopay');

});

Route::middleware(['auth', 'onlyPengguna'])->group(function () {
    Route::get('/payment-confirmation/{ids}', [PaymentConfirmationController::class, 'index'])->name('index-paymentConfirmation');
    Route::get('/payment/{ids}', [PaymentConfirmationController::class, 'paymentDetail'])->name('paymentDetail');
    Route::post('/pay', [PaymentConfirmationController::class, 'payNow'])->name('payNow');
    Route::get('/deleteTransaction/{id}', [PaymentConfirmationController::class, 'destroy']);

    Route::put('/generate-snap-token/{id}', [PaymentConfirmationController::class, 'generateSnapToken']);

    Route::get('/pembelian', [InvoiceController::class, 'index'])->name('pembelian');
    Route::get('/pembelian/{id}', [InvoiceController::class, 'show'])->name('show-pembelian');
    Route::post('/cancel/{id}', [InvoiceController::class, 'cancel'])->name('cancel-pembelian');

    //route profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('index-profile');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('update-profile');
});
