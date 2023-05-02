<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categoria', function (Blueprint $table) {
            $table->increments('idblog_categoria');
            $table->string('nombre', 250);
            $table->text('slug');
            $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('blog_categoria');
    }
}
