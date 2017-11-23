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
Broadcast::routes([ 'middleware' => [ 'api', 'jwt.auth' ]]);

Broadcast::channel('private.{room}', function ($user, $id) {
    // return whether or not this current user is authorized to visit this chat room
    $room = PrivateRoom::where('_id', $id)->first();
    return $room->isParticipant($user->id);
});
