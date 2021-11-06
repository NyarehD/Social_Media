<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Exception;
use Socialite;

class GithubController extends Controller
{
    public function redirect(){
        return Socialite::driver("github")->redirect();
    }

    public function callback(){
        try {
            $socialite = Socialite::driver("github")->stateless()->user();
            $user = $socialite->user;
            $searchUser = User::where("github_id", $socialite->id)->first();
            if ($searchUser) {
                Auth::login($searchUser);
                return redirect("/");
            } else {
                $newUser = User::create([
                    "name" => $user["name"],
                    "github_id" => $user["id"],
                    "email" => $user["email"],
                    "github_link" => $user["html_url"]
                ]);
                Auth::login($newUser);
                return redirect("/");
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
