<?php

namespace App\Rules;

use App\Like;
use Auth;
use Illuminate\Contracts\Validation\Rule;

class UserHasNotLikedRule implements Rule
{
    public function __construct(){
        //
    }

    public function passes($attribute, $value): bool{
        if (Like::where("user_id", Auth::id())->count() == 0) {
            return true;
        }
        return false;
    }

    public function message(): string{
        return 'You haven\'t liked current post.';
    }
}
