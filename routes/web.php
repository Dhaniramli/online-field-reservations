<?php

use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FieldListController;
use App\Http\Controllers\Admin\FieldScheduleController as AdminFieldScheduleController;
use App\Http\Controllers\Admin\HowTocancelController;
use App\Http\Controllers\Admin\HowToorderController;
use App\Http\Controllers\Admin\HowTopayController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\User\FieldScheduleController as UserFieldScheduleController;
use App\Http\Controllers\Admin\RequestCancelledController;
use App\Http\Controllers\Admin\SocmedLinksController;
use App\Http\Controllers\Admin\TransactionDataController;
use App\Http\Controllers\Admin\UsersDataController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\FooterItemsController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\PaymentConfirmationController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\QueueListController;
use Illuminate\Support\Facades\Route;

//route home
Route::get('/', [HomeController::class, 'index'])->name('home');

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

Route::middleware(['auth', 'onlyAdmin'])->group(function () {
    //route dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');
    //route data pengguna
    Route::get('/admin/pengguna', [UsersDataController::class, 'index'])->name('index-pengguna');
    Route::get('/admin/pengguna/hapus/{id}', [UsersDataController::class, 'destroy'])->name('destroy-pengguna');
    //route list lapangan
    Route::get('/admin/lapangan', [FieldListController::class, 'index'])->name('index-lapangan');
    Route::post('/admin/lapangan/store', [FieldListController::class, 'store'])->name('store-lapangan');
    Route::put('/admin/lapangan/update/{id}', [FieldListController::class, 'update'])->name('update-lapangan');
    Route::get('/admin/lapangan/hapus/{id}', [FieldListController::class, 'destroy'])->name('destroy-lapangan');
    //route jadwal lapangan
    Route::get('/admin/lapangan/{id}/jadwal', [AdminFieldScheduleController::class, 'index'])->name('index-jadwalLapangan');
    Route::post('/admin/lapangan/store/jadwal', [AdminFieldScheduleController::class, 'store'])->name('store-jadwalLapangan');
    Route::put('/admin/lapangan/update/jadwal/{id}', [AdminFieldScheduleController::class, 'update'])->name('update-jadwalLapangan');
    Route::get('/admin/lapangan/hapus/jadwal/{id}', [AdminFieldScheduleController::class, 'destroy'])->name('destroy-jadwalLapangan');
    //route pembatalan
    Route::get('/admin/permintaan-pembatalan', [RequestCancelledController::class, 'index'])->name('index-cancel');
    Route::get('/admin/permintaan-pembatalan/hapus/{id}', [RequestCancelledController::class, 'destroy']);
    Route::get('/admin/permintaan-pembatalan/konfir/{id}', [RequestCancelledController::class, 'confirm']);
    Route::get('/admin/permintaan-pembatalan/tolak/{id}', [RequestCancelledController::class, 'reject']);
    //route cara tautan
    Route::get('/admin/data-transaksi', [TransactionDataController::class, 'index'])->name('index-transaksi');
    Route::post('/admin/data-transaksi', [TransactionDataController::class, 'index'])->name('index-transaksi');
    Route::get('/admin/data-transaksi/show/{id}', [TransactionDataController::class, 'show'])->name('show-transaksi');
    Route::get('/admin/data-transaksi/hapus/{id}', [TransactionDataController::class, 'destroy'])->name('destroy-transaksi');
    Route::get('/admin/data-transaksi/export', [TransactionDataController::class, 'export_excel'])->name('export-excel');
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
    //route cara pembatalan
    Route::get('/admin/pembatalan', [HowTocancelController::class, 'index'])->name('index-howTocancel');
    Route::post('/admin/pembatalan', [HowTocancelController::class, 'store'])->name('store-howTocancel');
    Route::put('/admin/pembatalan/update', [HowTocancelController::class, 'update'])->name('update-howTocancel');
    Route::get('/admin/pembatalan/hapus/{id}', [HowTocancelController::class, 'destroy'])->name('destroy-howTocancel');
    //route cara tautan
    Route::get('/admin/tautan', [SocmedLinksController::class, 'index'])->name('index-tautan');
    Route::post('/admin/tautan', [SocmedLinksController::class, 'store'])->name('store-tautan');
    Route::put('/admin/tautan/update/{id}', [SocmedLinksController::class, 'update'])->name('update-tautan');
    Route::get('/admin/tautan/hapus/{id}', [SocmedLinksController::class, 'destroy'])->name('destroy-tautan');
});

Route::middleware(['auth', 'onlyPengguna'])->group(function () {
    Route::get('/payment-confirmation/{ids}', [PaymentConfirmationController::class, 'index'])->name('index-paymentConfirmation');
    Route::get('/payment/{ids}', [PaymentConfirmationController::class, 'paymentDetail'])->name('paymentDetail');
    Route::post('/pay', [PaymentConfirmationController::class, 'payNow'])->name('payNow');
    Route::get('/deleteTransaction/{id}', [PaymentConfirmationController::class, 'destroy']);
    Route::get('/payment-queue/{ids}', [PaymentConfirmationController::class, 'paymentQueue'])->name('paymentQueue');
    Route::post('/submit-payment', [PaymentConfirmationController::class, 'submitPayment'])->name('submitPayment');
    
    Route::put('/generate-snap-token/{id}', [PaymentConfirmationController::class, 'generateSnapToken']);
    
    Route::get('/pembelian', [InvoiceController::class, 'index'])->name('pembelian');
    Route::get('/pembelian/{id}', [InvoiceController::class, 'show'])->name('show-pembelian');
    Route::post('/cancel/{id}', [InvoiceController::class, 'cancel'])->name('cancel-pembelian');

    //route profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('index-profile');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('update-profile');
    
    //route jadwal lapangan
    Route::get('/sewa-lapangan/{id}/jadwal', [UserFieldScheduleController::class, 'index'])->name('index-jadwal');
    Route::post('/sewa-lapangan/{id}/jadwal', [UserFieldScheduleController::class, 'index'])->name('index-jadwal');
    
    // route antrian
    Route::post('/antrian/store', [QueueListController::class, 'store'])->name('store-antrian');
    Route::get('/deleteQueue/{id}', [QueueListController::class, 'destroy']);
});

Route::get('/kontak-kami', [FooterItemsController::class, 'contact_us'])->name('contact-us');
Route::get('/kebijakan-privasi', [FooterItemsController::class, 'privacy_policy'])->name('privacy-policy');
Route::get('/cara-booking', [FooterItemsController::class, 'cara_booking'])->name('cara-booking');
Route::get('/pembayaran', [FooterItemsController::class, 'pembayaran'])->name('pembayaran');
Route::get('/pembatalan', [FooterItemsController::class, 'pembatalan'])->name('pembatalan');
