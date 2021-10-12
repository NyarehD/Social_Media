<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostPhoto;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return view("newsfeed", [
            "posts" => Post::all()
        ])->with("images");
    }

    public function create(){
        return view("post.create");
    }

    public function store(Request $request){
        if ($request->hasFile("post-img.*")) {
            $fileNameArr = [];
            foreach ($request->file("post-img.*") as $file) {
                $newName = uniqid() . "_post-img." . $file->getClientOriginalExtension();
                array_push($fileNameArr, $newName);
                $file->storeAs('public/post', $newName);
            }
        }

        $request->validate([
            "title" => "required|string|min:4|max:255",
            "description" => "required|string|min:10|",
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = Auth::id();
        $post->save();

        if (isset($fileNameArr)) {
            foreach ($fileNameArr as $fileName) {
                $postPhoto = new PostPhoto();
                $postPhoto->post_id = $post->id;
                $postPhoto->filename = $fileName;
                $postPhoto->save();
            }
        }
        return redirect()->route("newsfeed");
    }

    public function show(Post $post){
        //
    }

    public function edit(Post $post){
        //
    }

    public function update(Request $request, Post $post){
        //
    }

    public function destroy(Post $post){
        //
    }
}
