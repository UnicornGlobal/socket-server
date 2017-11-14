<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivateRoom extends Model
{
    /**
     * Participants
     */
    public function participants()
    {
        return $this->belongsToMany('App\User', 'room_users')->withTimestamps();
    }

    public function isParticipant($userId)
    {
        return $this->participants->contains($userId);
    }
}
