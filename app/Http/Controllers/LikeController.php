<?php

namespace App\Http\Controllers;

use App\Models\ContentModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(ContentModel $content){
        $content->liked()->attach(Auth::user()->id);
        return redirect()->back()->with("success","Aha");

    }

    public function unlike(ContentModel $content){
        $content->liked()->detach(Auth::user()->id);
        return redirect()->back()->with("success","Aha");

    }
}
