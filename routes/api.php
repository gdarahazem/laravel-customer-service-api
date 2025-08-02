<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Api\Service\ServiceController;
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

    // Service routes
    Route::apiResource('services', ServiceController::class);

    // Customer services route (nested)
    Route::get('customers/{customerId}/services', [ServiceController::class, 'getByCustomer']);

});
