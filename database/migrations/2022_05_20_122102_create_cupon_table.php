<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupon', function (Blueprint $table) {
            $table->increments('idcupon');
            $table->string('codigo', 250)->unique('codigo_UNIQUE');
            $table->string('nombre', 250)->nullable();
            $table->string('tipoDescuento', 100);
            $table->decimal('descuentoMonto', 11)->nullable()->default(0);
            $table->decimal('descuentoPorcentaje', 11)->nullable()->default(0);
            $table->decimal('montoMinimo', 11)->nullable()->default(0);
            $table->integer('cantidad');
            $table->date('fechaInicio');
            $table->date('fechaExpiracion');
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
        Schema::dropIfExists('cupon');
    }
}
