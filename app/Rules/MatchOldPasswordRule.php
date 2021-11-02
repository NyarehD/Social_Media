<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MatchOldPasswordRule implements Rule
{
    public function __construct(){
        //
    }

    public function passes($attribute, $value){
        return \Hash::check($value, auth()->user()->password);
    }

    public function message(){
        return 'The provided password do not match with current password';
    }
}
