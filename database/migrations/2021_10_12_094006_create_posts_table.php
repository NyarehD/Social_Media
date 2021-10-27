<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up(){
        Schema::create('posts', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->text("title")->nullable();
            $table->longText("description")->nullable();
            $table->foreignId("user_id")->constrained();
            $table->bigInteger("original_post_id")->nullable();
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('posts');
    }
}
