<?php

use AppChat\Chat\Http\Controllers\ChatController;
use AppChat\Chat\Http\Controllers\EmojiController;
use AppChat\Chat\Http\Controllers\MessageController;


Route::group(['prefix' => 'appchat/chat'], function () {
    Route::post('/chat', [ChatController::class, 'create'])->middleware('userAutheticate');
    Route::get('/chat', [ChatController::class, 'getAllChats'])->middleware('userAutheticate');

    Route::get('/emojis', [EmojiController::class, 'getAllEmojis'])->middleware('userAutheticate');
    Route::post('/setEmojiToMessage', [EmojiController::class, 'setEmojiToMessage'])->middleware('userAutheticate');
    Route::post('/removeEmojiToMessage', [EmojiController::class, 'removeOneEmojiToMessage'])->middleware('userAutheticate');

    Route::post('/message', [MessageController::class, 'create'])->middleware('userAutheticate');
    Route::get('/message/{chat_id}', [MessageController::class, 'getMessagesByChatId'])->middleware('userAutheticate');
    Route::get('/getFile', [MessageController::class, 'getFile'])->middleware('userAutheticate');
});
