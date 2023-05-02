<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionHomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_home', function (Blueprint $table) {
            $table->bigIncrements('idsection_home');
            $table->text('tipo')->nullable();
            $table->string('titulo',250)->nullable();
            $table->string('slug',250)->nullable();
            $table->string('subtitulo',250)->nullable();
            $table->text('contenido')->nullable();
            $table->integer('posicion')->nullable();
            $table->boolean('estado')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home');
    }
}
