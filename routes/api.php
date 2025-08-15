<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UmkmController;

Route::prefix("/api/umkm")->group(function () {
    Route::get('/', [UmkmController::class, 'getAll']);
    Route::get('/{id}', [UmkmController::class, 'getById']);
    Route::post('/registrasi-umkm', [UmkmController::class, 'register']);
    Route::post('/masuk-umkm', [UmkmController::class, 'login']);
    Route::post('/forgot-password', [UmkmController::class, 'forgotPassword']);
    Route::post('/reset-password', [UmkmController::class, 'resetPassword']);
    Route::post('/verifikasi-otp', [UmkmController::class, 'verifikasiOtp']);
    Route::post('/kirim-ulang-otp', [UmkmController::class, 'kirimUlangOtp']);
});

Route::prefix("/api/ulasans")->group(function () {
    Route::get('/', [UmkmController::class, 'getAll']);
    Route::get('produk/{id}', [UmkmController::class, 'getByIdProduk']);
    Route::get('/umkm/{id}', [UmkmController::class, 'getByIdUmkm']);
    Route::post('/', [UmkmController::class, 'create']);
    Route::put('/{id}', [UmkmController::class, 'update']);
    Route::delete('/{id}', [UmkmController::class, 'destroy']);
});
