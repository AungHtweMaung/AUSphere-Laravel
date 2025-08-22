<?php

use App\Mail\ChatNotificationMail;
use Illuminate\Support\Facades\Mail;


if (!function_exists('sendChatNotificationMail')) {
        /**
     * Send chat notification email.
     *
     * @param string $receiverEmail
     * @param string $sender
     * @param string $message
     * @return string
     */
    function sendChatNotificationMail($receiverEmail, $sender, $message)
    {
        $details = [
            'subject' => 'New Chat Message from ' . $sender,
            'sender'  => $sender,
            'message' => $message,
        ];

        try {
            Mail::to($receiverEmail)->send(new ChatNotificationMail($details));
        } catch (\Exception $e) {
            logger()->error('Error sending chat notification email: ' . $e->getMessage());
            // return "Failed to send chat notification email.";
        }

    }
}
