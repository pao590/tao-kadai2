<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function store(ProfileRequest $request)
    {
        Profile::create([
            'user_id' => Auth::id(),
            'gender' => $request->gender,
            'birthday' => $request->birthday,
        ]);
    }
}