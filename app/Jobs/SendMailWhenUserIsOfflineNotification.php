<?php

namespace App\Jobs;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Mail\ChatNotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMailWhenUserIsOfflineNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $receiverId;
    protected $sender;

    /**
     * Create a new job instance.
     */
    public function __construct($sender, $receiverId)
    {
        // dd($this->sender);
        $this->sender = $sender;
        $this->receiverId = $receiverId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $receiver = User::find($this->receiverId);

        // // Only send if offline for more than 1 hr
        // if ($receiver && $receiver->last_seen && $receiver->last_seen < now()->subMinutes(3)) {
        //     sendChatNotificationMail(
        //         $receiver->email,
        //         $this->senderName,
        //         $this->message
        //     );
        // }

        $receiver = User::find($this->receiverId);
        if (!$receiver) return;

        // Fetch unread messages
        $messages = Chat::where('receiver_id', $this->receiverId)
            ->where('is_read', false)
            ->take(10) // adjust as needed
            ->get();

        if ($messages->isEmpty()) return;

        // Build email content
        $messageText = $messages->pluck('message')->implode("\n");

        // Send email (example)
        // Mail::raw($messageText, function ($mail) use ($receiver) {
        //     $mail->to($receiver->email)
        //         ->subject('You have new chat messages');
        // });

        // Use Mailable instead of raw mail for better formatting
        Mail::to($receiver->email)->queue(new ChatNotificationMail([
            'subject' => "New chat message from {$this->sender->name}",
            'sender' => $this->sender->name,
            'message' => $messageText,
        ]));

        // Optionally mark messages as read
        Chat::whereIn('id', $messages->pluck('id'))
            ->update(['is_read' => true]);

        // Remove cache key to allow next batch
        Cache::forget('offline_mail_' . $this->receiverId);
    }
}
