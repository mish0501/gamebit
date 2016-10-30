<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InviteFriendNotification extends Notification
{
    use Queueable;

    private $room_code;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($room_code, $user)
    {
        $this->room_code = $room_code;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "room_code" => $this->room_code,
            "user" => [
              "name" => $this->user->name,
              "username" => $this->user->username,
              "id" => $this->user->id
            ]
        ];
    }
}
