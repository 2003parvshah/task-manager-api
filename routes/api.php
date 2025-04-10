<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Routing\Route;

Route::get('demo', function () {
    return "hello";
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
