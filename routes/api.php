<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostApiController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post("register", [RegisterController::class, "register"]);
Route::prefix("posts")->group(function(){
    Route::get("", [PostApiController::class, "index"]);
    Route::get("/{post}", [PostApiController::class, "show"]);
    Route::post("", [PostApiController::class, "store"]);
    Route::put("/{post}", [PostApiController::class, "update"]);
    Route::delete("/{post}", [PostApiController::class, "destroy"]);
});
