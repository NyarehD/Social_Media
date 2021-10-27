<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostPhoto;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){
        return view("newsfeed", [
            "posts" => Post::all(),
        ]);
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
            "post-img.*" => "mimetypes:image/jpeg,image/png"
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
        return view("post.show", compact('post'));
    }

    public function edit(Post $post){
        if (Gate::allows("post_owner", $post)) {
            return view("post.edit", [
                "post" => $post
            ]);
        }
        return abort(404);
    }

    public function update(Request $request, Post $post){
        if (Gate::allows("post_owner", $post)) {
            if ($request->hasFile("post-img.*")) {
                $fileNameArr = [];
                foreach ($request->file("post-img.*") as $file) {
                    $newName = uniqid() . "_post-img." . $file->getClientOriginalExtension();
                    array_push($fileNameArr, $newName);
                    $file->storeAs('public/post', $newName);
                }
                // Deleting previous photos
                foreach ($post->images as $image) {
                    Storage::delete("public/post/" . $image->filename);
                }
                $toDelete = $post->images->pluck("id");
                PostPhoto::destroy($toDelete);
            }

            $request->validate([
                "title" => "required|string|min:4|max:255",
                "description" => "required|string|min:10|",
                "post-img.*" => "mimetypes:image/jpeg,image/png"
            ]);
            $post->title = $request->title;
            $post->description = $request->description;
            $post->user_id = Auth::id();
            $post->update();

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
        return abort(404);
    }

    public function destroy(Post $post){
        if (Gate::allows("post_owner", $post)) {
            if (isset($post->images)) {
                foreach ($post->images as $image) {
                    Storage::delete("public/post/" . $image->filename);
                }
                $toDelete = $post->images->pluck("id");
                PostPhoto::destroy($toDelete);
            }
            $title = $post->title;
            $post->delete();
            return redirect()->route("newsfeed")->with("status", "$title is deleted");
        }
        return abort(404);
    }
}
