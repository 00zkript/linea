<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonio', function (Blueprint $table) {
            $table->increments('idtestimonio');
            $table->string('nombre')->nullable();
            $table->text('testimonio')->nullable();
            $table->text('avatar')->nullable();
            $table->text('imagen')->nullable();
            $table->boolean('estado')->nullable()->default(true);
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
        Schema::dropIfExists('testimonio');
    }
}
