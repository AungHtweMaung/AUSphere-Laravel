<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the user profile.
     */
    public function show($id)
    {
        if (auth()->user()->id != $id) {
            abort(403, 'Unauthorized action.');
        }

        $profile = User::findOrFail($id);

        $social_posts = $profile->socialPosts()->with('user')->latest()->paginate(10);

        return view('profiles.show', compact('profile', 'social_posts'));
    }

    /**
     * Show the form for editing the user profile.
     */
    public function update(ProfileRequest $request)
    {
        $profile = User::findOrFail($request->profile_id);
        $profile->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json([
                'success'=>'Profile updated successfully.',
                'redirectUrl' => route('profiles.show', $profile->id),
            ]);
        // return redirect()->route('profiles.show', ['id' => $profile->id])->with('success', 'Profile updated successfully.');
    }
}
