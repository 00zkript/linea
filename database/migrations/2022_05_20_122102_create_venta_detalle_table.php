<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_detalle', function (Blueprint $table) {
            $table->increments('idventa_detalle');
            $table->integer('idventa')->nullable();
            $table->integer('idproducto')->nullable();
            $table->decimal('precio_producto', 10)->nullable();
            $table->integer('cantidad')->nullable();
            $table->decimal('subtotal', 10)->nullable();
            $table->smallInteger('estado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venta_detalle');
    }
}
