<?php

namespace App\Rules;

use App\Post;
use Illuminate\Contracts\Validation\Rule;

class PostExistsRule implements Rule
{
    public function __construct(){
        //
    }

    public function passes($attribute, $value): bool{
        return (bool)Post::find($value);
    }

    public function message(): string{
        return 'The post do not exist anymore.';
    }
}
