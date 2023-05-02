<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionHomeLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_home_link', function (Blueprint $table) {
            $table->bigIncrements('idsection_home_link');
            $table->integer('idsection_home');
            $table->string('texto',250)->nullable();
            $table->string('link',250)->nullable();
            $table->text('contenido')->nullable();
            $table->text('imagen')->nullable();
            $table->integer('posicion')->nullable();
            $table->boolean('estado')->nullable()->default(1);
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
        Schema::dropIfExists('section_home_link');
    }
}
