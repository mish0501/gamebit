<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserJoinRoom implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $user;
    public $room_code;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $room_code)
    {
        $this->$user = $user;
        $this->room_code = $room_code;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('room.'.$this->room_code);
    }
}
