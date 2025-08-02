<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Customer\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Authentication routes
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->prefix('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Protected API routes
Route::middleware('auth:sanctum')->group(function () {

    // Customer routes
    Route::apiResource('customers', CustomerController::class);

});
