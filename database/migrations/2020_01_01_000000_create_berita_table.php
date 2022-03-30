<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id('berita_id');
            $table->integer('user_id')
                ->nullable();
            $table->integer('kategori_id')
                ->nullable();
            $table->string('judul', 190)
                ->nullable();
            $table->text('url')
                ->nullable();
            $table->string('gambar', 190)
                ->nullable();
            $table->text('isi')
                ->nullable();
            $table->integer('hit')
                ->nullable();
            $table->boolean('aktif')
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
