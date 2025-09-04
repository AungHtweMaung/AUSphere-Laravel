<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Chat;
use App\Models\User;
use App\Helpers\Helper;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Jobs\SendMailWhenUserIsOfflineNotification;

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

        $messages = Chat::where(function ($query) use ($userId, $receiverId) {
            $query->where('sender_id', $userId)->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($userId, $receiverId) {
            $query->where('sender_id', $receiverId)->where('receiver_id', $userId);
        })->orderby('created_at', 'asc')
            ->get();

        // return [];

        return response()->json(['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $sender = User::find(auth()->id());
        $receiverId = $request->receiver_id;
        $messageText = $request->message;

        // Create chat message
        $chat = Chat::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiverId,
            'message' => $messageText,
            'is_read' => false, // default
        ]);

        // DEBUG: Check cache key
        // $conversationCacheKey = "conversation_opened_{$receiverId}_{$sender->id}";
        // \Log::info('Checking cache key: ' . $conversationCacheKey);
        // \Log::info('Cache exists: ' . (Cache::has($conversationCacheKey) ? 'YES' : 'NO'));



        // FIX: Check if RECEIVER is currently viewing THIS SENDER's conversation
        // Format: "conversation_opened_{receiver_id}_{sender_id}"
        $conversationCacheKey = "conversation_opened_{$receiverId}_{$sender->id}";
        // Log::info('Check cache key ' . $conversationCacheKey);

        if (Cache::has($conversationCacheKey)) {
            // Log::info('Marking message as read immediately');

            // Use Query Builder instead of Eloquent to bypass any model logic
            $updated = DB::table('chats')
                ->where('id', $chat->id)
                ->update(['is_read' => 1]);

            // Refresh the model
            $chat->refresh();
        }

        // Fire real-time event
        try {
            event(new MessageSent($messageText, $sender->id, $receiverId, $sender->name, $sender->picture));
        } catch (Exception $e) {
            logger($e->getMessage());
        }

        // Schedule offline mail only if receiver is not viewing conversation
        $offlineCacheKey = 'offline_mail_' . $receiverId;
        if (!Cache::has($offlineCacheKey) && !Cache::has($conversationCacheKey)) {
            SendMailWhenUserIsOfflineNotification::dispatch($sender, $receiverId)
                ->delay(now()->addMinutes(1));

            Cache::put($offlineCacheKey, true, now()->addMinutes(1));
        }

        return response()->json([
            'success' => true,
            'messages' => 'Message sent successfully'
        ]);
    }



    public function markAsRead(Request $request)
    {
        // Update all provided chat IDs to is_read = true
        Chat::whereIn('id', $request->chat_ids)
            ->where('receiver_id', Auth::user()->id)
            ->update(['is_read' => true]);

        return response()->json(['status' => 'ok']);
    }

    public function conversationOpened(Request $request)
    {
        $receiverId = auth()->id();              // logged-in user (receiver)
        $otherUserId = $request->other_user_id;  // conversation partner (sender)

        // FIX: Set cache key to indicate RECEIVER is viewing SENDER's conversation
        // Format: "conversation_opened_{receiver_id}_{sender_id}"
        $cacheKey = "conversation_opened_{$receiverId}_{$otherUserId}";
        Cache::put($cacheKey, true, now()->addMinutes(5));

        // Also mark all existing messages from this sender as read
        Chat::where('sender_id', $otherUserId)
            ->where('receiver_id', $receiverId)
            ->where('is_read', false)
            ->update(['is_read' => 1]);

        return response()->json(['status' => 'conversation_opened']);
    }
}
