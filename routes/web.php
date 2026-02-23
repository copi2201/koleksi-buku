<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Auth;

// 1. Redirect halaman utama ke login
Route::get('/', function () {
    return redirect('/login');
});

// 2. Auth Routes (Login, Register, Logout Laravel)
Auth::routes();

// 3. Google Login Routes (SSO)
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');


// =======================
// 4. OTP Routes (SETELAH LOGIN GOOGLE)
// =======================
// User SUDAH login sementara → harus pakai middleware auth
Route::get('/otp-verification', [OtpController::class, 'showOtpForm'])->name('otp.view');
Route::post('/otp-verification', [OtpController::class, 'verifyOtp'])->name('otp.verify');


// =======================
// 5. Protected Routes (Setelah OTP berhasil)
// =======================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Read untuk semua user
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

    Route::middleware(['role:admin'])->group(function () {
    Route::resource('kategori', KategoriController::class)->except(['index']);
    Route::resource('buku', BukuController::class)->except(['index']);

    // Route PDF di dalam akses Admin agar sesuai role
    Route::get('/cetak-sertifikat', [PdfController::class, 'generateSertifikat'])->name('sertifikat.cetak');
    Route::get('/cetak-undangan', [PdfController::class, 'generateUndangan'])->name('undangan.cetak');
    }); 
});