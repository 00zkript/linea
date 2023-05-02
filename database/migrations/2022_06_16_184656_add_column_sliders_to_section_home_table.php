<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSlidersToSectionHomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('section_home', function (Blueprint $table) {
            $table->integer('nuevo')->nullable();
            $table->integer('destacado')->nullable();
            $table->integer('liquidacion')->nullable();
            $table->integer('idmarca')->nullable();
            $table->integer('idcategoria')->nullable();
            $table->integer('idsection')->nullable();
            $table->integer('cantidad_slider')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('section_home', function (Blueprint $table) {
            //
        });
    }
}
