<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    protected $fillable = ["comment"];

    // TODO: Need to fix duplicated User query
    public function comment_owner() {
        return $this->belongsTo(User::class, "user_id");
    }
}
