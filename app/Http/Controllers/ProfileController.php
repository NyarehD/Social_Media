<?php

namespace App\Http\Controllers;

use App\Post;
use App\Rules\MatchOldPasswordRule;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
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
    public function pictureUpdate(Request $request){
        $request->validate([
            "profile_picture" => "required|mimetypes:image/jpeg,image/png|file|max:2500"
        ]);
        $dir = "public/profile-picture/";

        if (Auth::user()->profile_picture != "default-profile.jpg") {
            Storage::delete($dir . Auth::user()->profile_picture);
        }

        $newName = uniqid() . "_profile-picture." . $request->file("profile_picture")->getClientOriginalExtension();
        // Using intervention packages to resize profile image to 350px
        $img = Image::make($request->file("profile_picture"));
        $img->fit(350);
        $img->save("storage/profile-picture/" . $newName);

        $user = User::find(Auth::id());
        $user->profile_picture = $newName;
        $user->update();

        return redirect()->back()->with("message", "Profile picture is updated");
    }

    /**
     * Updating name and bio
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdate(Request $request){
        $request->validate([
            "name" => "required|string|min:1|max:100",
            "bio" => "required|string|min:10|max:255"
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->update();
        return redirect()->back()->with("Profile updated");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function socialLinkUpdate(Request $request): \Illuminate\Http\RedirectResponse{
        $request->validate([
            "facebook_link" => ["nullable", "url", "regex:/(?:(?:http|https):\/\/)?(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?/m"],
            "github_link" => ["nullable", "url", "regex:/(?:(?:http|https):\/\/)?(?:www.)?github.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?/m"],
            "twitter_link" => ["nullable", "url", "regex:/(?:(?:http|https):\/\/)?(?:www.)?twitter.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?/m"]
        ], [
            "facebook_link.*" => "Facebook link is invalid",
            "github_link" => "Github link is invalid",
            "twitter_link.*" => "Twitter link is invalid"
        ]);
        $user = Auth::user();
        $user->facebook_link = $request->facebook_link;
        $user->twitter_link = $request->twitter_link;
        $user->github_link = $request->github_link;
        $user->update();
        return redirect()->back()->with("message", "Updated social links");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function emailUpdate(Request $request){
        $request->validate([
            "email" => "email|required"
        ]);
        $user = Auth::user();
        $user->email = $request->email;
        if ($user->isDirty("email")) {
            $user->update();
            return redirect()->back()->with("message", "Updated Email");
        }
        return redirect()->back()->with("message", "New email is the same as previous email");
    }

    public function passwordUpdate(Request $request){
        $request->validate([
            "current_password" => ["required", new MatchOldPasswordRule()],
            "new_password" => "required|min:8|different:current_password",
            "confirm_password" => "required|same:new_password|min:8"
        ]);
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->update();
        return redirect()->back()->with("message", "Password is updated");
    }
}
