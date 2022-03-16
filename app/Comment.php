<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    protected $fillable = ["comment"];

    // TODO: Change model usage to be able to review comment without no repeated queries
    public function comment_owner() {
        return $this->belongsTo(User::class, "user_id");
    }
}
