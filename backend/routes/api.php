<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KotaController;
use App\Http\Controllers\Api\PropinsiController;
use App\Http\Controllers\Api\PekerjaanController;
use App\Http\Controllers\Api\PendudukController;

// 1. Route Public (Bisa diakses tanpa token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route Public untuk testing (tanpa auth)
Route::apiResource('pekerjaan', PekerjaanController::class);
Route::apiResource('penduduk', PendudukController::class);
Route::get('/propinsi', [PropinsiController::class, 'index']);
Route::resource('kota', KotaController::class);

// Route Tambahan Soal No.6 - Endpoint Khusus Penduduk
Route::get('/penduduk-laki-laki', [PendudukController::class, 'lakilaki']);
Route::get('/penduduk-karyawan-swasta', [PendudukController::class, 'karyawanSwasta']);

// 2. Route Protected (Harus pakai Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
