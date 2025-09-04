<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // unread notifications
    public function index()
    {
        // Fetch notifications for the authenticated user
        $latestNotiCount = auth()->user()->unreadNotifications()->latest()->get();
        $allNotiCount = auth()->user()->unreadNotifications()->count();


        // Return a view with the notifications
        return response()->json([
            'latestNotiCount' => $latestNotiCount,
            'allNotiCount' => $allNotiCount
        ]);
    }

    public function markAsread(Request $request)
    {
        $notification = auth()->user()->unreadNotifications()->find($request->id);
        if($notification) {
            // Assuming the notification data contains a post_id field
            $postId = $notification->data['post_id'] ?? null;
            if ($postId) {
                $user = auth()->user();
                $user->unreadNotifications()
                    ->where('type', $notification->type)
                    ->where('data->post_id', $postId)
                    ->get()
                    ->each(function ($notif) {
                        $notif->markAsRead();
                    });
                return response()->json(['message' => 'All related notifications marked as read.']);
            }
            // If no post_id, just mark this notification as read
            $notification->markAsRead();
            // return response()->json(['message' => 'Notification marked as read.']);
        }
        // return response()->json(['message' => 'Notification not found.'], 404);
    }
}
