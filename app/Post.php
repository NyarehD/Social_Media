<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function images(){
        return $this->hasMany(PostPhoto::class);
    }

    public function post_owner(){
        return $this->belongsTo(User::class,"user_id");
    }
}
