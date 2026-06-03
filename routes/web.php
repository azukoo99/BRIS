<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\AuthController;
use App\Models\Produk;

// ---- Auth Routes ----
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile & History (General Auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // History Pesanan Pelanggan
    Route::get('/history', [\App\Http\Controllers\HistoryController::class, 'index'])->name('history.index');

    // Checkout & Pembayaran
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
});

Route::post('/payment/notification', [\App\Http\Controllers\CheckoutController::class, 'notification'])->name('payment.notification');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('password.email');

Route::get('/verify-otp', [AuthController::class, 'showVerifyOtpForm'])->name('password.verify');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// ---- Beranda ----
Route::get('/', function () {
    $produks = Produk::where('is_active', 'yes')->get();
    $role = Auth::check() ? Auth::user()->role : 'guest';
    return view('beranda', ['role' => $role, 'produks' => $produks]);
});

// ---- Katalog Produk ----
Route::get('/produk', function () {
    $produks = Produk::where('is_active', 'yes')->get();
    $role = Auth::check() ? Auth::user()->role : 'guest';
    return view('produk.produk', ['role' => $role, 'produks' => $produks]);
});

// ---- Checkout ----
// Hanya pelanggan yang bisa akses checkout
Route::get('/checkout', function () {
    if (!Auth::check() || Auth::user()->role !== 'pelanggan') {
        return redirect('/login');
    }

    return view('produk.checkout', ['role' => 'pelanggan']);
})->middleware('auth');

// ---- Laporan Keuangan ----
// Hanya admin dan investor yang bisa akses laporan keuangan
Route::get('/laporan', [\App\Http\Controllers\LaporanKeuanganController::class, 'index'])->name('admin.laporan.index')->middleware('auth');

// ---- Admin Routes ----
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('produk', ProdukController::class);

    // Kasir
    Route::get('/kasir', [\App\Http\Controllers\Admin\KasirController::class, 'index'])->name('kasir.index');
    Route::post('/kasir/checkout', [\App\Http\Controllers\Admin\KasirController::class, 'checkout'])->name('kasir.checkout');

    // Kelola User
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::put('/users/{id}/role', [\App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('users.role.update');

    // Kelola Pesanan
    Route::get('/pesanan', [\App\Http\Controllers\Admin\PesananController::class, 'index'])->name('pesanan.index');
    Route::put('/pesanan/{id}/status', [\App\Http\Controllers\Admin\PesananController::class, 'updateStatus'])->name('pesanan.status.update');

    // Laporan Keuangan (Admin Only Routes)
    Route::post('/laporan', [\App\Http\Controllers\LaporanKeuanganController::class, 'store'])->name('laporan.store');
    Route::delete('/laporan/{id}', [\App\Http\Controllers\LaporanKeuanganController::class, 'destroy'])->name('laporan.destroy');
});
