<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsesorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesor', function (Blueprint $table) {
            $table->increments('idasesor');
            $table->string('nombres', 250)->nullable();
            $table->string('celular', 250)->nullable();
            $table->string('whatsapp', 250)->nullable();
            $table->string('telegram', 250)->nullable();
            $table->string('correo', 250)->nullable();
            $table->text('foto')->nullable();
            $table->boolean('contacto_rapido')->nullable()->default(false);
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
        Schema::dropIfExists('asesor');
    }
}
