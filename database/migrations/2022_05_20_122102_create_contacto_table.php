<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto', function (Blueprint $table) {
            $table->increments('idcontacto');
            $table->text('telefono')->nullable();
            $table->text('celular')->nullable();
            $table->text('correo')->nullable();
            $table->text('facebook')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('instagram')->nullable();
            $table->text('twitter')->nullable();
            $table->text('youtube')->nullable();
            $table->text('linkendin')->nullable();
            $table->text('direccion')->nullable();
            $table->text('google_maps')->nullable();
            $table->text('horario')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacto');
    }
}
