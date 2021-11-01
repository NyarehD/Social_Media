<?php

use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "PostController@index")->name("newsfeed");

Auth::routes();

Route::middleware("auth")->group(function(){
    // Post
    Route::resource("/post", "PostController");
    Route::post("/post/{post}/share", [PostController::class, "share"])->name("post.share");
    Route::resource("/comment", "CommentController");
    // Post like
    Route::post("/like", [LikesController::class, "like"])->name("like.like");
    Route::post("/unlike", [LikesController::class, "unlike"])->name("like.unlike");

    Route::prefix("/profile")->group(function(){
        Route::get('/id/{id}', "ProfileController@index")->name("profile");
        Route::view("/edit", "profile.edit")->name("profile.edit");
        Route::post("/edit", "ProfileController@profileUpdate")->name("profile.update");
        Route::post("/edit/profile-picture", "ProfileController@profilePictureUpdate")->name("profile.pictureUpdate");
        Route::post("/edit/social", [ProfileController::class, "profileSocialUpdate"])->name("profile.socialUpdate");
    });
});
