<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaginaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagina', function (Blueprint $table) {
            $table->increments('idpagina');
            $table->string('slug')->nullable();
            $table->string('titulo')->nullable();
            $table->string('subtitulo')->nullable();
            $table->string('autor')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('contenido')->nullable();
            $table->text('imagen')->nullable();
            $table->boolean('estado')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagina');
    }
}
