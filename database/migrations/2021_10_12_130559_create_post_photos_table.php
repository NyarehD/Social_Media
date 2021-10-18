<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostPhotosTable extends Migration
{
    public function up(){
        Schema::create('post_photos', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->foreignId("post_id")->constrained();
            $table->string("filename");
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('post_photos');
    }
}
