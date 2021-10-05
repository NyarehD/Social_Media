<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.home', compact("user"));
    }

    public function profilePictureUpdate(Request $request)
    {
        $request->validate([
            "profile-photo" => "required|mimetypes:image/jpeg,image/png|file|max:2500"
        ]);
        $dir = "public/profile-picture/";

        Storage::delete($dir . Auth::user()->profile_picture);

        $newName = uniqid() . "_profile-picture." . $request->file("profile-photo")->getClientOriginalExtension();
        $request->file("profile-photo")->storeAs($dir, $newName);

        $user = User::find(Auth::id());
        $user->profile_picture = $newName;
        $user->update();

        return redirect()->route("profile");
    }
}
