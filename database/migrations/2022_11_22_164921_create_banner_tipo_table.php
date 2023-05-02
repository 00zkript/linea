<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerTipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_tipo', function (Blueprint $table) {
            $table->increments('idbanner_tipo');
            $table->string('nombre',250)->nullable();
            $table->string('slug',250)->nullable();
            $table->boolean('estado')->nullable()->default('0');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner_tipo');
    }
}
