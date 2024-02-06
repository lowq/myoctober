<?php

use AppAuth\Auth\Http\Controllers\AuthController;

Route::group(['prefix' => 'appauth/auth'], function () {
    Route::get('google', [AuthController::class, 'redirectToGoogle']);
    Route::get('google/callback', [AuthController::class, 'handleGoogleCallback']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});
