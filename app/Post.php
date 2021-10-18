<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "description"];
    public $with = ["images", "post_owner", "total_likes"];

    public function images(){
        return $this->hasMany(PostPhoto::class);
    }

    public function post_owner(){
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     * Returning total likes of a post
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function total_likes(){
        return $this->hasMany(Like::class, "post_id");
    }
}
