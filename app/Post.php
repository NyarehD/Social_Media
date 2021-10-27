<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "description"];
    public $with = ["images", "post_owner", "total_likes", "comments"];

    public function images(){
        return $this->hasMany(PostPhoto::class);
    }

    public function post_owner(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function total_likes(){
        return $this->hasMany(Like::class, "post_id");
    }

    public function comments(){
        return $this->hasMany(Comment::class, "post_id");
    }
}
