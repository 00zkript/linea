<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoRutaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_ruta', function (Blueprint $table) {
            $table->increments('idtipo_ruta');
            $table->string('nombre', 250)->nullable();
            $table->string('slug', 250)->nullable();
            $table->boolean('is_internal')->nullable()->default(false);
            $table->string('route_alias', 250)->nullable();
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
        Schema::dropIfExists('tipo_ruta');
    }
}
