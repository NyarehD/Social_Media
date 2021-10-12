<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up(){
        Schema::create('posts', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->text("title");
            $table->longText("description");
            $table->bigInteger("user_id");
            $table->integer("likes")->default(0);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('posts');
    }
}
