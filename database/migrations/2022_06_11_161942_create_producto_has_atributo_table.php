<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoHasAtributoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_has_atributo', function (Blueprint $table) {
            $table->increments('idproducto_has_atributo');
            $table->integer('idproducto')->nullable();
            $table->integer('idatributo')->nullable();
            $table->string("valor")->nullable();
            $table->string("slug")->nullable();
//            $table->boolean('estado')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_has_atributo');
    }
}
