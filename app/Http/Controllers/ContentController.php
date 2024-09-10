<?php

namespace App\Http\Controllers;

use App\Models\ContentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\search;

class ContentController extends Controller
{
    public function index()
    {


        $currentPage = request()->get("page", session('currentPage', 1)); // Get the current page from the request or session
        session(['currentPage' => $currentPage]); // Store the current page in the session



        $content = ContentModel::orderByDesc("id")->paginate(5, ['*'], 'page', $currentPage);
        // Use the current page for pagination

        return view('index', compact('content', 'currentPage'));
    }

    public function store(ContentModel $content)
    {
        request()->validate(
            [
                "content" => "required|min:5|max:255",
                "image" => "image",
            ]

        );
        if(request()->has("image")){

            $image = request()->file("image")->store("avatar","public");

            $content->image = $image;

        }

        $content->content = request()->content;
        $content->user_id = auth("")->user()->id;
            // dd($image);

        $content->save();
        // dd($content);

        return redirect()->route("content.index")->with("success", "Content created Successfully");
    }

    public function like(ContentModel $content)
    {
        $content->increment("like");
        $content->save();
        return redirect()->route("content.index")->with("success", "Content liked Successfully");
    }

    public function show(ContentModel $item)
    {

        $page = session("extra_number");
        $comment_show = $item->comments()->paginate(3);

        $showing = true;

        return view('content_Interaction.show', compact('item', 'showing', 'comment_show', 'page'));
    }

    public function edit(ContentModel $item)
    {
        if (auth()->id() == $item->user_id) {
            $editting1 = true;
            return view('content_Interaction.show', compact('item', 'editting1'));
        } else {
            abort(404);
        }
    }

    public function update(ContentModel  $item)
    {
        request()->validate([
            "content" => "required|min:5|max:255"
        ]);
        $item->content = request()->content;

        return redirect()->route("content.show", $item)->with("success", "Content updated Successfully");
    }

    public function delete(ContentModel $item)
    {
        // dd(request()->content);
        if (auth()->id() !== $item->user_id) {
            abort(404);
        } else {
            $item->delete();
            // $item->save();
            if(Storage::disk("public")->exists("{$item->image}")){
                Storage::disk("public")->delete("{$item->image}");
            }
        }
        return redirect()->route("content.index")->with("success", "Delete Successfully");
    }

    public function search()
    {
        session()->forget('currentPage');
        $search = request()->get("search");
        $content = ContentModel::with("user")
            ->where(function ($query) use ($search) {
                $query->whereHas("user", function ($q) use ($search) {
                    $q->where("name", 'like', "%$search%");
                })
                    ->orWhere("content", "like", "%$search%");
            })
            ->orderByDesc("id")->paginate(5)->appends(['search' => $search]);

        // dd($content);
        return view("index", compact("content", 'search'));
    }
}
