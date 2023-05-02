<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostoEnvioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costo_envio', function (Blueprint $table) {
            $table->increments('idcosto_envio');
            $table->integer('iddepartamento')->nullable();
            $table->integer('idprovincia')->nullable();
            $table->integer('iddistrito')->nullable();
            $table->decimal('precio', 11)->nullable();
            $table->text('descripcion')->nullable();
            $table->text('restriccion')->nullable();
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
        Schema::dropIfExists('costo_envio');
    }
}
