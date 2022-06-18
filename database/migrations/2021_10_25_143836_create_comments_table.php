<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration {
    public function up() {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId("user_id")->constrained();
            $table->foreignId("post_id")->constrained();
            $table->longText("comment");
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('comments');
    }
}
