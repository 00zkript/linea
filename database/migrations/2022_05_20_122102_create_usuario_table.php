<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('idusuario');
            $table->integer('idrol');
            $table->string('usuario', 50)->nullable();
            $table->text('clave');
            $table->string('correo', 250)->nullable()->unique('correo');
            $table->string('nombres', 250)->nullable();
            $table->string('apellidos', 250)->nullable();
            $table->text('foto')->nullable();
            $table->dateTime('creado')->nullable();
            $table->dateTime('actualizado')->nullable();
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
        Schema::dropIfExists('usuario');
    }
}
