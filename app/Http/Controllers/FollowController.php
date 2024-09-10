<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(User $user)
    {

        $follower = auth()->user();
        $follower->following()->attach($user);
        return redirect()->back()->with("success","Aha");
    }



    public function unfollow(User $user)
    {

        $follower = auth()->user();
        // dd($follower->following()->attach($user->id));
        $follower->following()->detach($user);
        return redirect()->back()->with("success","Aha");
    }
}

