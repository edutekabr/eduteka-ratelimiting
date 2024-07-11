<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthenticationController::class, 'login']);


Route::middleware(['throttle:api'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
});
