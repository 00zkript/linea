<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntaFrecuenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta_frecuente', function (Blueprint $table) {
            $table->increments('idpregunta_frecuente');
            $table->string('pregunta', 250)->nullable();
            $table->text('respuesta')->nullable();
            $table->boolean('estado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregunta_frecuente');
    }
}
