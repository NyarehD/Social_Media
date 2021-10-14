<?php

namespace App\Rules;

use App\Like;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserHasLikedRule implements Rule
{
    public function __construct(){
        //
    }

    public function passes($attribute, $value): bool{
        if (Like::where("user_id", Auth::id())->where("post_id", $value)->count() == 1) {
            return true;
        }
        return false;
    }

    public function message(): string{
        return 'You haven\'t liked the post';
    }
}
