<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubIndicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_indices', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('pagina');
            $table->string('subindices')->nullable();
            $table->integer('indices_id')->unsigned();
            $table->foreign('indices_id')->references('id')->on('indices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_indices');
    }
}
