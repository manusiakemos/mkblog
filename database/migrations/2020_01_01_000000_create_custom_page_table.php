<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_page', function (Blueprint $table) {
            $table->id('custom_page_id');
            $table->string('title', 190)
                ->nullable();
            $table->string('url', 190)
                ->nullable();
            $table->longText('content')
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
        Schema::dropIfExists('custom_page');
    }
}
