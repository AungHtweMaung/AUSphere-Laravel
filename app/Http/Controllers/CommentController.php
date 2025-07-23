<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\SocialPost;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request, SocialPost $social_post)
    {
        $social_post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        $comments = $social_post->comments()->with('user')->get();

        return response()->json([
            'success' => 'Comment added successfully.',
            'comments' => $comments,
        ]);

    }

}
