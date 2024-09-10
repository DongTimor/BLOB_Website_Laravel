<?php

namespace App\Http\Controllers;

use App\Models\ContentModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if(request()->has('editting')){
            $editting = true;
        }else{
            $editting = false;
        }

        return view("user.show",compact('user','editting'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $editting = true;
        return redirect()->route('user.show',compact('user','editting'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $validate = request()->validate([
            "name" => "required|min:5|max:25",
            "bio" =>"nullable|min:1|max:255",
            "image" => "image"
        ]);


        // $image = null;


        if(request()->has("image")){
            // dd(Storage::disk("public")->exists("{$user->image}"));
            $image = request()->file("image")->store("profile","public");
            $validate["image"] = $image;
            if(Storage::disk("public")->exists("{$user->image}")){
                Storage::disk("public")->delete("{$user->image}");
            }
        }
        // dd(request()->all());

        $user ->update($validate);
        return redirect()->route("user.show", compact("user"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function profile()
    {
        $user = auth()->user();
        if ($user instanceof User) { // Simplified namespace reference
            return $this->show($user);
        }
        abort(404); // or handle the error as needed
    }
}
