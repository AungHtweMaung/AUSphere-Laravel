<?php

namespace App\Http\Controllers;

use App\Models\SocialPost;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Notifications\CommentNotification;

class CommentController extends Controller
{
    public function store(CommentRequest $request, SocialPost $social_post)
    {
        $social_post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
            'parent_comment_id' => $request->input('parent_comment_id'), // add parent_comment_id support
        ]);

        // send notification to post owner if the commenter is not the post owner when commenting
        if ($social_post->user->id !== auth()->id()) {
            $social_post->user->notify(
                new CommentNotification(
                    auth()->id(),
                    $social_post->user->id,
                    auth()->user()->name,  // commenter name
                    $social_post->id,
                )
            );
        }

        $comments = $social_post->comments()->with(['user', 'replies.user'])->get();

        return response()->json([
            'success' => 'Comment added successfully.',
            'comments' => $comments,
        ]);

    }

}
