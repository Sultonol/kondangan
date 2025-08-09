<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Channel untuk chat room - semua orang bisa akses
Broadcast::channel('chat.{eventId}', function ($user, $eventId) {
    // Return true untuk mengizinkan semua orang join channel chat
    // Atau bisa tambahkan logic authorization jika diperlukan
    return true;
});
