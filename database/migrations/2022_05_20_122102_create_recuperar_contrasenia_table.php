<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecuperarContraseniaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recuperar_contrasenia', function (Blueprint $table) {
            $table->increments('idrecuperar_contrasenia');
            $table->string('token', 250)->nullable();
            $table->string('correo', 250)->nullable();
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
        Schema::dropIfExists('recuperar_contrasenia');
    }
}
