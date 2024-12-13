<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ContactFormReceived;
use App\Mail\ContactFormReceived as Mailable;
use Illuminate\Support\Facades\Mail;

class SendContactFormEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ContactFormReceived $event)
    {
        $data = [
            'full_name' => $event->full_name,
            'number' => $event->number,
            'country' => $event->country,
            'email' => $event->email,
            'message' => $event->message,
        ];

        Mail::to($event->email)->send(new Mailable($data));
    }
}
