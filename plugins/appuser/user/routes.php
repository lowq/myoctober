<?php

use AppUser\User\Http\Controllers\UserController;


Route::group(['prefix' => 'appuser/user'], function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
});
