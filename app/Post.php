<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "description"];

    public $with = ["owner", "original_post", "post_photos", "total_likes", "comments"];

    public function post_photos(){
        return $this->hasMany(PostPhoto::class);
    }

    public function original_post(){
        return $this->belongsTo(Post::class, "original_post_id");
    }

    public function owner(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function total_likes(){
        return $this->hasMany(Like::class, "post_id");
    }

    public function comments(){
        return $this->hasMany(Comment::class, "post_id");
    }

}
