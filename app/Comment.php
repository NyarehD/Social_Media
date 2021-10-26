<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["comment"];
    public $with = ["comment_owner"];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment_owner(){
        return $this->belongsTo(User::class, "user_id");
    }

}
