<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function images(){
        return Post::hasMany(PostPhoto::class);
    }

}
