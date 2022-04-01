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
        Schema::create('post', function (Blueprint $table) {
            $table->id('post_id');
            $table->integer('user_id')
                ->nullable();
            $table->integer('category_id')
                ->nullable();
            $table->string('title', 190)
                ->nullable();
            $table->text('url')
                ->nullable();
            $table->string('image', 190)
                ->nullable();
            $table->text('content')
                ->nullable();
            $table->integer('hit')
                ->nullable();
            $table->boolean('active')
                ->nullable();

            //$table->softDeletes();
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
        Schema::dropIfExists('berita');
    }
}
