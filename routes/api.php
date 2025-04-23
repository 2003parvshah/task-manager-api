<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

Route::get('demo', function () {
    return "hello";
});

Route::get('/test-route', function () {
    return 'API route is working!';
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
