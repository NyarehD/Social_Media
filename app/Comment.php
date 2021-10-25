<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["comment"];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment_owner(){
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment_post(){

        return $this->belongsTo(Post::class);
    }
}
