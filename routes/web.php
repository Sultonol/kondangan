<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [EventController::class, 'showJoinForm'])->name('join.form');
Route::post('/join', [EventController::class, 'join'])->name('join');

Route::middleware(['participant'])->group(function () {
    Route::get('/chat/{event}', [ChatController::class, 'room'])->name('chat.room');
    Route::post('/chat/{event}/message', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/{event}/profile/{participant}', [ChatController::class, 'profile'])->name('chat.profile');
});
