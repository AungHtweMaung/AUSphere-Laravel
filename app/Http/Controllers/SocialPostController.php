<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SocialPost;
use Illuminate\Http\Request;
use App\Http\Requests\SocialPostRequest;

class SocialPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user, SocialPost $social_post = null)
    {
        $social_post = $social_post ?: new SocialPost();
        $button = $social_post ? 'Update': 'Create';
        // dd($social_post);
        // This method can be used to show a form for creating a new social post
        return view('social-posts.create', compact('user', 'social_post', 'button'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialPostRequest $request, User $user, SocialPost $social_post = null)
    {
        $data = $request->validated();

        if ($social_post) {
            $social_post->update($data);
            $message = 'Post updated successfully.';
        } else {
            $social_post = $user->socialPosts()->create($data);
            $message = 'Post created successfully.';
        }

        return response()->json([
            'success' => $message,
            'redirectUrl' => route('profiles.show', $user->id)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, SocialPost $social_post)
    {
        $social_post->load([
            'comments.user:id,name',
            'comments'
        ]);

        // dd($social_post->comments);
        // This method can be used to show a specific social post
        return view('social-posts.show', compact('user', 'social_post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $social_post)
    {
        try {
            $post = $user->socialPosts()->findOrFail($social_post);
            $post->delete();

            return response()->json([
                'success' => 'Post deleted successfully.',
                'redirectUrl' => route('profiles.show', $user->id)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Post not found or could not be deleted.'
            ], 404);
        }
    }
}
