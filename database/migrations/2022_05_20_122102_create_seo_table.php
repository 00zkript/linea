<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo', function (Blueprint $table) {
            $table->increments('idseo');
            $table->string('titulo_general', 100)->nullable();
            $table->text('autor')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('keywords')->nullable();
            $table->text('googleAnalytics')->nullable();
            $table->text('googleTagManager')->nullable();
            $table->text('facebookPixel')->nullable();
            $table->text('imagen_compartir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo');
    }
}
