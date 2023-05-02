<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoDocumentoIdentidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_documento_identidad', function (Blueprint $table) {
            $table->increments('idtipo_documento_identidad');
            $table->string('nombre', 100)->nullable();
            $table->boolean('estado')->nullable();
            $table->integer('orden')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_documento_identidad');
    }
}
