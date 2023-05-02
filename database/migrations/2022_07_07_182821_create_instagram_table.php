<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstagramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagram', function (Blueprint $table) {
            $table->increments('idinstagram');
            $table->string('nombre')->nullable();
            $table->text('imagen')->nullable();
            $table->text('link')->nullable();
            $table->boolean('estado')->nullable()->default(true);
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
        Schema::dropIfExists('instagram');
    }
}
