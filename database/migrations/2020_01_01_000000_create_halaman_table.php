<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHalamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halaman', function (Blueprint $table) {
            $table->id('halaman_id')
                    ;
                            $table->string('judul' ,190)
                        ->nullable()
                ;
                $table->boolean('custom')
                ->nullable()
                ;
                            $table->string('gambar' ,190)
                        ->nullable()
                ;
                            $table->text('url' ,65535)
                        ->nullable()
                ;
                $table->boolean('aktif')
                ->nullable()
                ;
                            $table->text('isi')
                        ->nullable()
                ;
    
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
        Schema::dropIfExists('halaman');
    }
}
