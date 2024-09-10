<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Models\ContentModel;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(ContentModel $item){

        request()->validate([
            "comment"=> "required",
            ]);

        $comment = new CommentModel();
        $comment-> content_id = $item->id;
        $comment->user_id = auth()->user()->id;
        $comment->comment = request()->comment;
        $comment->save();
        // request()->headers->set('X-Requested-With', 'XMLHttpRequest');

        return redirect()->route("content.show", $item)->with("success","Post Comment Successfuly");

    }
}
