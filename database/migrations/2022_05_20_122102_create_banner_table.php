<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->increments('idbanner');
            $table->integer('idtipo_ruta')->nullable();
            $table->string('ruta')->nullable();
            $table->integer('posicion')->nullable();
            $table->integer('idbanner_tipo')->nullable();
            $table->string('nombre')->nullable();
            $table->text('contenido')->nullable();
            $table->string('boton_text')->nullable();
            $table->string('boton_link')->nullable();
            $table->string('boton_target')->nullable();
            $table->text('imagen')->nullable();
            $table->text('imagen_movil')->nullable();
            $table->text('video')->nullable();
            $table->boolean('estado')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner');
    }
}
