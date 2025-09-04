<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentNotiEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $postOwnerId;
    public $commenterId;

    /**
     * Create a new event instance.
     */
    public function __construct($postOwnerId, $commenterId)
    {
        $this->postOwnerId = $postOwnerId;
        $this->commenterId = $commenterId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('my-channel-test.' . $this->postOwnerId);
    }


     public function broadcastAs()
    {
        return 'my-event-test';
    }
}
