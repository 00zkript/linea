<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionHomeProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_home_producto', function (Blueprint $table) {
            $table->bigIncrements('idsection_home_producto');
            $table->integer('idsection_home');
            $table->integer('idproducto');
            $table->integer('posicion')->nullable();
            $table->boolean('estado')->nullable()->default(1);
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_home_producto');
    }
}
