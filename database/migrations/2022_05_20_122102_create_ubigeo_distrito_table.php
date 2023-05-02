<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbigeoDistritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubigeo_distrito', function (Blueprint $table) {
            $table->increments('iddistrito');
            $table->integer('iddepartamento')->nullable();
            $table->integer('idprovincia')->nullable();
            $table->string('nombre', 100)->nullable();
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
        Schema::dropIfExists('ubigeo_distrito');
    }
}
