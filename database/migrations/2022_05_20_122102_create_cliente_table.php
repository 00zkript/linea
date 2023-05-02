<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('idcliente');
            $table->integer('idtipo_documento_identidad')->nullable();
            $table->integer('idusuario')->nullable();
            $table->string('nombres', 100)->nullable();
            $table->string('apellidos', 100)->nullable();
            $table->string('correo', 100);
            $table->string('numero_documento_identidad', 15)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('sexo', 3)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('iddepartamento')->nullable();
            $table->integer('idprovincia')->nullable();
            $table->integer('iddistrito')->nullable();
            $table->text('direccion')->nullable();
            $table->text('referencia')->nullable();
            $table->dateTime('fecha_creacion');
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
        Schema::dropIfExists('cliente');
    }
}
