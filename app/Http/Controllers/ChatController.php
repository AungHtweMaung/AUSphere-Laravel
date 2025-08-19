<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use App\Events\MessageSent;
use App\Helpers\Helper;
use Exception;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())
            ->get();
        return view('chat.index', compact('users'));
    }


    public function fetchMessages(Request $request)
    {
        // Fetch messages from the database
        // You can use your own logic to retrieve messages based on the user ID or other criteria
        $userId = Auth()->id();
        $receiverId = $request->query('receiver_id'); // receiver_id

        $messages = Chat::where(function($query) use ($userId, $receiverId) {
            $query->where('sender_id', $userId)->where('receiver_id', $receiverId);
            })->orWhere(function($query) use ($userId, $receiverId) {
                $query->where('sender_id', $receiverId)->where('receiver_id', $userId);
            })->orderby('created_at', 'asc')
            ->get();

        // return [];

        return response()->json(['messages'=> $messages]);
    }

    public function sendMessage(Request $request)
    {

        // Fetch messages from the database
        $sender = User::find(auth()->id());
        // dd($sender);
        $receiverId = $request->receiver_id; // receiver_id

        $message = $request->message;

        $chat = Chat::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiverId,
            'message' => $message,
        ]);

        try {
            event(new MessageSent($message, $sender->id, $receiverId, $sender->name, $sender->picture));
            // logger()->info('message event is sent.');
        } catch (Exception $e) {
            logger($e->getMessage());
        }

        // $receiverEmail = User::find($receiverId)->email;
        // $senderName = User::find($sender->id)->name;
        // $message = $chat->message;

        // sendChatNotificationMail($receiverEmail, $senderName, $message);

        return response()->json(['success'=>true,'messages'=> 'Message sent successfully']);
    }



}
