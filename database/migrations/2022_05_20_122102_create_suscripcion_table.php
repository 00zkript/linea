<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuscripcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suscripcion', function (Blueprint $table) {
            $table->increments('idsuscripcion');
            $table->string('tipo_correo', 250)->nullable();
            $table->string('landing', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->dateTime('creado')->nullable();
            $table->dateTime('actualizado')->nullable();
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
        Schema::dropIfExists('suscripcion');
    }
}
