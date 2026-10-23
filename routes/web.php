<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporBanjirController;
use Illuminate\Support\Facades\Route;

// 1. HALAMAN PUBLIK (Bisa diakses warga tanpa login)
Route::get('/', function () {
    return redirect()->route('lapor-banjir.form');
});

Route::get('/form', [LaporBanjirController::class, 'form'])->name('lapor-banjir.form');
Route::post('/process', [LaporBanjirController::class, 'store'])->name('lapor-banjir.store');
Route::get('/konfirmasi', [LaporBanjirController::class, 'konfirmasi'])->name('lapor-banjir.konfirmasi');

// 2. AUTHENTICATION ROUTES (Manual)
Route::middleware('guest')->group(function (): void {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// 3. PROTECTED ROUTES (Hanya untuk Petugas yang sudah LOGIN)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

    // Halaman daftar laporan yang diproteksi (wajib login)
    Route::get('/laporan', [LaporBanjirController::class, 'index'])->name('lapor-banjir.index');
});
