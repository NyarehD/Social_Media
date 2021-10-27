<?php

namespace App\Providers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(){
        $this->registerPolicies();
        Gate::define("post_owner", function(User $user, Post $post){
            return Auth::id() == $post->user_id && $user->id == $post->user_id;
        });
        Gate::define("comment_owner", function(User $user, Comment $comment){
            return Auth::id() === $comment->user_id && $user->id === $comment->user_id;
        });
        //
    }
}
