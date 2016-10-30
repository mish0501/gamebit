<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewWord
{
    use InteractsWithSockets, SerializesModels;

    private $room_code;
    public $word;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($word, $room_code)
    {
        $this->word = $word;
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
