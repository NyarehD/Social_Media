<?php

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

Route::get('/', function(){
    return view('welcome');
});

Auth::routes();

// Profile
Route::prefix("/profile")->group(function(){
    Route::get('/', "ProfileController@index")->name("profile");
    Route::view("/edit", "profile.edit")->name("profile.edit");
    Route::post("/edit", "ProfileController@profileUpdate")->name("profile.update");
    Route::post("/edit/profile-picture","ProfileController@profilePictureUpdate")->name("profile.pictureUpdate");
});
