<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function create()
    {
        $user = auth()->user();
        // This method can be used to show a form for creating a new social post
        return view('social-posts.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialPostRequest $request, User $user)
    {
        $data = $request->validated();
        $post = $user->socialPosts()->create($data);

        return response()->json([
            'success' => 'Post created successfully.',
            'redirectUrl' => route('profiles.show', $user->id)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(User $user, $post_id)
    {
        try {
            $post = $user->socialPosts()->findOrFail($post_id);
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
