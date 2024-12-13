<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Folder;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        return view('messages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'number' => 'required',
            'country' => 'required',
            'message' => 'required',
            'email' => 'required',
        ]);

        Message::create($request->all());
        return redirect()->route('messages.index')->with('success', 'Message created successfully');
    }

    public function edit(Message $message)
    {
        return view('messages.edit', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
            'email' => 'required',
        ]);

        $message->update($request->all());
        return redirect()->route('messages.index')->with('success', 'Message updated successfully');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.index')->with('success', 'Message deleted successfully');
    }
}
