<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Redirect root ke dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// Group route dengan middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/produk', ProdukController::class);
    Route::resource('/pelanggan', PelangganController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/penjualan', TransactionController::class);
    Route::get('/penjualan/{id}/struk', [PenjualanController::class, 'struk'])->name('penjualan.struk');
    Route::get('/penjualan/{id}/struk-pdf', [PenjualanController::class, 'strukPdf'])->name('penjualan.struk-pdf');

    Route::get('/penjualan/{penjualan}/receipt', [TransactionController::class, 'printReceipt'])->name('penjualan.receipt');

    Route::resource('detail-penjualan', DetailPenjualanController::class);
    Route::get('/detail-penjualan/{id}/download', [DetailPenjualanController::class, 'downloadPdf'])->name('detail-penjualan.download');

    Route::resource('/orders', OrderController::class);
    Route::resource('/transactions', OrderController::class);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::get('/laporan/struk/tampilkan', [LaporanController::class, 'struk'])->name('laporan.struk');
    Route::get('/laporan/struk/download', [LaporanController::class, 'downloadPdf'])->name('laporan.struk.download');

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});