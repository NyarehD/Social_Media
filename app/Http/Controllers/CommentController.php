<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Rules\PostExistsRule;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){
    }

    public function create(){
    }

    public function store(Request $request){
        $request->validate([
            "comment" => "string",
            "post_id" => [new PostExistsRule()]
        ]);
        $comment = new Comment();
        $comment->post_id = $request['post_id'];
        $comment->user_id = Auth::id();
        $comment->comment = $request['comment'];
        $comment->save();
        return redirect()->back();
    }

    public function show(Comment $comment){
    }

    public function edit(Comment $comment){
        return $comment;
    }

    public function update(Request $request, Comment $comment){
        $comment->comment = $request->edited_comment;
        $comment->update();
        return redirect()->back()->with("message", "Comment Updated");
    }

    public function destroy(Comment $comment){
        if (Gate::allows("comment_owner", $comment)) {
            $comment->delete();
            return back()->with("message", "Comment Deleted");
        }
        return back()->with("message", "Cannot delete the message");
    }
}
