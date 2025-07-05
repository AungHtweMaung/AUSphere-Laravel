<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the user profile.
     */
    public function show()
    {
        return view('profile.show');
    }

    /**
     * Show the form for editing the user profile.
     */
    public function edit()
    {
        return view('profile.edit');
    }
}
