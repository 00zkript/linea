<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntoVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punto_venta', function (Blueprint $table) {
            $table->increments('idpunto_venta');
            $table->string('nombre', 250);
            $table->text('direccion')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->text('horario_atencion')->nullable();
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
        Schema::dropIfExists('punto_venta');
    }
}
