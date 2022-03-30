<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkTerkaitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_terkait', function (Blueprint $table) {
            $table->id('link_terkait_id');
            $table->string('label', 190)
                ->nullable();
            $table->string('url', 190)
                ->nullable();
            $table->string('icon', 190)
                ->nullable();
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
        Schema::dropIfExists('link_terkait');
    }
}
