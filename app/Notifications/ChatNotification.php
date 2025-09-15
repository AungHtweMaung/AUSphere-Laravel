<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Broadcasting\Channel;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ChatNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $senderId;
    public $receiverId;
    public $senderName;
    public $message;

    public function __construct($senderId, $receiverId, $senderName, $message)
    {
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->senderName = $senderName;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'sender_id' => $this->senderId,
            'receiver_id' => $this->receiverId,
            'sender_name' => $this->senderName,
            'message' => $this->senderName . ' sent you a message',
            'url' => config('app.url') . '/chat',
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->id, // Important: include notification ID
            'type' => get_class($this),
            'data' => [
                'sender_id' => $this->senderId,
                'receiver_id' => $this->receiverId,
                'sender_name' => $this->senderName,
                'message' => $this->senderName . ' sent you a message: ' . $this->message,
            ],
            'read_at' => null,
            'created_at' => now()->toDateTimeString()
        ]);
    }

    public function broadcastOn()
    {
        return new Channel('my-channel-test.' . $this->receiverId);
    }

    public function broadcastAs()
    {
        return 'chat-notification';
    }
}
