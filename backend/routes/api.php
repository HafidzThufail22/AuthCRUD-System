<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KotaController;
use App\Http\Controllers\Api\PropinsiController;

// 1. Route Public (Bisa diakses tanpa token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']); // Sesuai permintaan PDF

// 2. Route Protected (Harus pakai Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Resource route otomatis membuat endpoint:
    // GET /api/kota (index), POST /api/kota (store)
    // GET /api/kota/{id} (show), PUT /api/kota/{id} (update)
    // DELETE /api/kota/{id} (destroy)
    Route::resource('kota', KotaController::class);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::resource('kota', KotaController::class);

        Route::get('/propinsi', [App\Http\Controllers\Api\PropinsiController::class, 'index']);
    });
});
