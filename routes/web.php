<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Laporan;
use App\Http\Controllers\dashboardController as Dashboard;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // TRANSAKSI → ADMIN & KASIR
    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('transaksi', TransaksiController::class);
        Route::post('/cart/add/{product}', [TransaksiController::class, 'addToCart'])
            ->name('cart.add');

        Route::post('/cart/remove/{product}', [TransaksiController::class, 'removeFromCart'])
            ->name('cart.remove');

        Route::post('/cart/decrease/{id}', [TransaksiController::class, 'decrease'])
            ->name('cart.decrease');

        Route::post('/cart/clear', [TransaksiController::class, 'clearCart'])
            ->name('cart.clear');

        Route::post('/cart/payment-method', [TransaksiController::class, 'setPaymentMethod'])
            ->name('cart.setPaymentMethod');

        Route::post('/transaksi/bayar', [TransaksiController::class, 'bayar'])
            ->name('transaksi.bayar');

        Route::get('/riwayat-transaksi', [TransaksiController::class, 'riwayat'])
            ->name('transaksi.riwayat');
    });

    // PRODUK, KATEGORI, USER → ADMIN SAJA
    Route::middleware('role:admin')->group(function () {
        Route::resource('produk', ProdukController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('user', UserController::class);
        Route::get('/laporan', [Laporan::class, 'index'])->name('laporan.index');
        Route::get('/laporan/cetak', [Laporan::class, 'cetak'])->name('laporan.cetak');
        Route::get('/dashboard', [Dashboard::class, 'index'])
            ->name('dashboard');
    });

});

require __DIR__ . '/auth.php';
