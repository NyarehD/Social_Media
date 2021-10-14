<?php

namespace App\Http\Controllers;

use App\Like;
use App\Rules\PostExistsRule;
use App\Rules\UserHasLikedRule;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikesController extends Controller
{
    public function like(Request $request){
        $request->validate([
            "post_id" => [new PostExistsRule()],
            "user_id" => [new UserHasLikedRule()]
        ]);
        $like = new Like();
        $like->post_id = $request->post_id;
        $like->user_id = Auth::id();
        $like->save();
        return redirect()->back();
    }

    public function unlike(Request $request){
        $request->validate([
            "post_id" => [new PostExistsRule()],
            "user_id" => [new UserHasLikedRule()]
        ]);

    }
}

