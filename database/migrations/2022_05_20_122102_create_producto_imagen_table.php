<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoImagenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_imagen', function (Blueprint $table) {
            $table->increments('idproducto_imagen');
            $table->integer('idproducto');
            $table->text('nombre');
            $table->integer('posicion')->nullable();
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
        Schema::dropIfExists('producto_imagen');
    }
}
