<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Rules\PostExistsRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){
        //
    }

    public function create(){
    }

    public function store(Request $request){
        $request->validate([
            "comment" => "string",
            "post_id" => [new PostExistsRule()]
        ]);
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->back();
    }

    public function show(Comment $comment){
        //
    }

    public function edit(Comment $comment){
        //
    }

    public function update(Request $request, Comment $comment){
        //
    }

    public function destroy(Comment $comment){
        //
    }
}
