<?php

namespace App\Notifications;

use App\Models\SocialPost;
use Illuminate\Bus\Queueable;
use Illuminate\Broadcasting\Channel;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class CommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $commenterId;
    public $postOwnerId;
    public $postId;
    public $commenterName;

    public function __construct($commenterId, $postOwnerId, $commenterName, $postId)
    {
        $this->commenterId = $commenterId;
        $this->postOwnerId = $postOwnerId;
        $this->postId = $postId;
        $this->commenterName = $commenterName;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'commenter_id' => $this->commenterId,
            'post_owner_id' => $this->postOwnerId,
            'commenter_name' => $this->commenterName,
            'post_id' => $this->postId,
            'message' => $this->commenterName . ' commented on your post',
            'url' => config('app.url') . '/social-posts/' . $this->postId,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->id, // Important: include notification ID
            'type' => get_class($this),
            'data' => [
                'commenter_id' => $this->commenterId,
                'post_owner_id' => $this->postOwnerId,
                'post_id' => $this->postId,
                'commenter_name' => $this->commenterName,
                'message' => $this->commenterName . ' commented on your post',
            ],
            'read_at' => null,
            'created_at' => now()->toDateTimeString()
        ]);
    }

    public function broadcastOn()
    {
        return new Channel('my-channel-test.' . $this->postOwnerId);
    }

    public function broadcastAs()
    {
        return 'comment-notification';
    }
}
