<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string("title", 255);
            $table->text("description");
            $table->string("tags", 255);
            $table->string("image", 100);
            $table->unsignedInteger("user_id");
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
