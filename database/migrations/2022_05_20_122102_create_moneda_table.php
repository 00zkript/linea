<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonedaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moneda', function (Blueprint $table) {
            $table->increments('idmoneda');
            $table->string('nombre', 100)->nullable();
            $table->string('moneda', 10)->nullable();
            $table->string('simbolo', 10)->nullable();
            $table->enum('simbolo_posicion',['LEFT','RIGHT'])->dafault('LEFT')->nullable();
            $table->decimal('cambio', 10, 4)->nullable();
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
        Schema::dropIfExists('moneda');
    }
}
