<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|integer',
            'recipient_id' => 'required|integer',
            'text' => 'required|string'
        ]);

        $message = new Message();
        $message->sender_id = $request->sender_id;
        $message->recipient_id = $request->recipient_id;
        $message->text = $request->text;
        $message->save();

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => $message->text
        ], 201);
    }

    public function getMessage($sender, $recipient)
    {
        $messages = Message::where(function ($query) use ($sender, $recipient) {
            $query->where('sender_id', $sender)
                ->where('recipient_id', $recipient);
        })->orWhere(function ($query) use ($sender, $recipient) {
            $query->where('sender_id', $recipient)
                ->where('recipient_id', $sender);
        })->get();

        return response()->json([
            'message' => 'Messages fetched successfully',
            'data' => $messages
        ], 200);
    }
}
