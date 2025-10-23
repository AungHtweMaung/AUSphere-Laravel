<?php

namespace App\Http\Controllers;

use App\Models\SocialPost;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(SocialPost $social_post)
    {

        $user = auth()->user();

        // Check if the user has already liked the post
        $like = $user->likes()->where('social_post_id', $social_post->id)->first();
        
        if ($like) {
            // Unlike (delete the like)
            $like->delete();
            $like_count = $social_post->likes()->count();
            return response()->json([
                'like_count' => $like_count,
            ]);

        } else {
            // Like (create the like)
            $like = $user->likes()->create(['social_post_id' => $social_post->id]);
            $like_count = $social_post->likes()->count();
            return response()->json([
                'like_count' => $like_count,
                'liked' => true,
            ]);
        }
    }
}
