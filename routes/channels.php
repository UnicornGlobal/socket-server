<?php

use App\PrivateRoom;
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
Broadcast::routes( [ 'middleware' => [ 'api', 'jwt.auth' ] ] );

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('private.{room}', function ($user, App\PrivateRoom $room) {
    // return whether or not this current user is authorized to visit this chat room
    return $user->id === $room->created_by;
});
