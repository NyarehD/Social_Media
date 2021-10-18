<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        $post_by_user = Post::where("user_id", Auth::id())->when(request()->search, function($query){
            $search_key = request()->search;
            return $query->where("title", "LIKE", "%$search_key%")->orWhere("description", "LIKE", "%$search_key%");
        })->get();
        return view('profile.index', compact("user", "post_by_user"));
    }

    public function profilePictureUpdate(Request $request){
        $request->validate([
            "profile_picture" => "required|mimetypes:image/jpeg,image/png|file|max:2500|dimensions:ratio=1/1"
        ]);
        $dir = "public/profile-picture/";

        Storage::delete($dir . Auth::user()->profile_picture);

        $newName = uniqid() . "_profile-picture." . $request->file("profile_picture")->getClientOriginalExtension();
        $request->file("profile_picture")->storeAs($dir, $newName);

        $user = User::find(Auth::id());
        $user->profile_picture = $newName;
        $user->update();

        return redirect()->route("profile.edit");
    }


    public function profileUpdate(Request $request){
        $request->validate([
            "name" => "required|string|min:1|max:100",
            "email" => "required|email",
            "bio" => "required|string|min:10|max:255"
        ]);
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->update();
        return redirect()->route("profile");
    }

}
