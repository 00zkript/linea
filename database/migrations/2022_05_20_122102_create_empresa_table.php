<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('idempresa');
            $table->string('nombre', 250)->nullable();
            $table->string('ruc', 50)->nullable();
            $table->decimal('igv', 11)->nullable()->default(0);
            $table->integer('idmoneda')->nullable();
            $table->text('logo')->nullable();
            $table->text('favicon')->nullable();
            $table->text('cuenta_bancaria')->nullable();
            $table->text('logo2')->nullable();
            $table->text('informacion_adicional')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
