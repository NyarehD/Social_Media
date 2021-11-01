<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class ProfileController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id){
        $user = User::find($id);
        $post_by_user = Post::where("user_id", $id)->when(request()->search, function($query){
            $search_key = request()->search;
            return $query->where("title", "LIKE", "%$search_key%")->orWhere("description", "LIKE", "%$search_key%");
        })->latest()->get();
        return view('profile.index', compact("user", "post_by_user"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profilePictureUpdate(Request $request){
        $request->validate([
            "profile_picture" => "required|mimetypes:image/jpeg,image/png|file|max:2500"
        ]);
        $dir = "public/profile-picture/";

        if (Auth::user()->profile_picture != "default-profile.jpg") {
            Storage::delete($dir . Auth::user()->profile_picture);
        }

        $newName = uniqid() . "_profile-picture." . $request->file("profile_picture")->getClientOriginalExtension();
        $img = Image::make($request->file("profile_picture"));
        $img->fit(350);
        $img->save("storage/profile-picture/" . $newName);

        $user = User::find(Auth::id());
        $user->profile_picture = $newName;
        $user->update();

        return redirect()->route("profile.edit")->with("message", "Profile picture is updated");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
        return redirect()->route("profile", Auth::id())->with("Profile updated");
    }

    public function profileSocialUpdate(Request $request){
        $request->validate([
            "facebook_link" => "nullable|url",
            "github_link" => "nullable|url",
            "twitter_link" => "nullable|url"
        ], [
            "facebook_link" => "Facebook link is invalid",
            "github_link" => "Github link is invalid",
            "twitter_link" => "Twitter link is invalid"
        ]);
        $user = User::find(Auth::id());
        if ($request->filled("facebook_link")) {
            $user->facebook_link = $request->facebook_link;
        }
        if ($request->filled("twitter_link")) {
            $user->twitter_link = $request->twitter_link;
        }
        if ($request->filled("github_link")) {
            $user->github_link = $request->github_link;
        }
        $user->update();
        return redirect()->route("profile", Auth::id())->with("message", "Updated social links");
    }
}
