<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('idproducto');
            $table->integer('idmarca')->nullable();
            $table->integer('idcategoria')->nullable();
            $table->integer('idsection')->nullable();
            $table->string('codigo', 250)->nullable();
            $table->string('nombre', 250);
            $table->text('slug');
            $table->boolean('show_precio')->nullable()->default(true);
            $table->decimal('precio', 10)->default(0);
            $table->decimal('precio_promocional', 10)->nullable()->default(0);
            $table->integer('stock')->nullable()->default(0);
            $table->boolean('destacado')->nullable();
            $table->boolean('nuevo')->nullable();
            $table->boolean('liquidacion')->nullable();
            $table->text('descripcion_corta')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('ficha_tecnica')->nullable();
            $table->text('video')->nullable();
            $table->dateTime('fecha_registro')->nullable();
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
        Schema::dropIfExists('producto');
    }
}
