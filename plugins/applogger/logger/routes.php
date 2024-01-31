<?php

use AppLogger\Logger\Http\Controllers\LogsController;


Route::group(['prefix' => 'applogger/logger'], function () {
    Route::post('/logs', [LogsController::class, 'create'])->middleware('userAutheticate');
    Route::get('/logs', [LogsController::class, 'getAllLogs'])->middleware('userAutheticate');
    Route::get('/logs/{username}', [LogsController::class, 'getLogByUsername']);
});
