<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GameStarted
{
    use InteractsWithSockets, SerializesModels;

    private $room_code;
    public $players;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($room_code, $players)
    {
        $this->room_code = $room_code;
        $this->players = $players;
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
