<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $data;
    public $message;
    private $as;
    private $on;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $as = 'newMessage', $on = 'private.89b6a447-9e74-4515-b785-ccbf15687200')
    {
        // $this->data = json_decode($message);
        dd(json_decode($message));
        $this->message = json_decode($message);
        $this->on = $on;
        $this->as = $as;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return $this->on;
        return [
            'room.1'
        ];
        return new PrivateChannel('channel-name');
    }

    public function broadcastAs()
    {
        return $this->as;
        return 'customEvent';
    }
}
