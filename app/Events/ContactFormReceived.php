<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactFormReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $full_name;
    public $number;
    public $country;
    public $message;
    public $email;

    /**
     * Create a new event instance.
     */
    public function __construct($full_name, $number, $country, $message, $email)
    {
        $this->full_name = $full_name;
        $this->number = $number;
        $this->country = $country;
        $this->message = $message;
        $this->email = $email;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
