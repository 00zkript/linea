<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroReclamacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libro_reclamacion', function (Blueprint $table) {
            $table->increments('idlibro_reclamacion');
            $table->string('nombres_apellidos', 250)->nullable();
            $table->string('tipo_documento', 100)->nullable();
            $table->string('num_documento', 50)->nullable();
            $table->text('direccion')->nullable();
            $table->string('correo', 250)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('nombre_apoderado', 250)->nullable();
            $table->string('tipo_bien', 100)->nullable();
            $table->text('descripcion_bien')->nullable();
            $table->string('tipo_reclamo', 100)->nullable();
            $table->text('detalle_reclamo')->nullable();
            $table->dateTime('fecha_ingreso')->nullable();
            $table->string('estado', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libro_reclamacion');
    }
}
