<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ContactFormReceived;
use App\Models\Message;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string',
            'number' => 'required|string',
            'country' => 'required|string',
            'message' => 'required|string',
            'email' => 'required|email'
        ]);

        $message = Message::create($validatedData);

        event(new ContactFormReceived($message->full_name, $message->number, $message->country, $message->message, $message->email));

        return response()->json(['message' => 'Your message has been received.'], 200);
    }
}
