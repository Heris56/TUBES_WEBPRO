<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UmkmController;

Route::prefix("/umkm/api")->group(function () {
    Route::get('/', [UmkmController::class, 'showAll']);
    Route::get('/{id}', [UmkmController::class, 'show']);
    Route::post('/registrasi-umkm', [UmkmController::class, 'register']);
    Route::post('/masuk-umkm', [UmkmController::class, 'login']);
    Route::post('/forgot-password', [UmkmController::class, 'forgotPassword']);
    Route::post('/reset-password', [UmkmController::class, 'resetPassword']);
    Route::post('/verifikasi-otp', [UmkmController::class, 'verifikasiOtp']);
    Route::post('/kirim-ulang-otp', [UmkmController::class, 'kirimUlangOtp']);
});
