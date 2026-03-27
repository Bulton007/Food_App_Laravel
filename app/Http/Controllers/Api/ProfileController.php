<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    // REGISTER USER
    public function store(Request $request)
    {
        $profile = Profile::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $request->image
        ]);

        return response()->json([
            'message' => 'User created',
            'data' => $profile
        ]);
    }

    // GET USER PROFILE
    public function show($id)
    {
        return Profile::findOrFail($id);
    }
}