<?php

namespace App\Rules;

use Auth;
use Illuminate\Contracts\Validation\Rule;

class UserIdSameAuthIdRule implements Rule
{
    public function __construct(){
        //
    }

    public function passes($attribute, $value): bool{
        return $value == Auth::id();
    }

    public function message(): string{
        return 'You are not logged in or authorized';
    }
}
