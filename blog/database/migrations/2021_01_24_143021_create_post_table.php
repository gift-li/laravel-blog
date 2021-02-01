<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id'); // It should be required to record who post the article, thus, it should not be null able
            $table->foreign('author_id')->references('id')->on('users'); // Due to declaring cascade on foreign key, the operation on deleting users should be much more careful
            $table->string('title');
            $table->text('content'); // Declare text maybe be better, or at least give it a much bigger space to store
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
