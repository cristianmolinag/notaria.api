<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCorregimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corregimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();

            $table->unsignedInteger('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('municipio')->onDelete('cascade');

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
        Schema::dropIfExists('corregimiento');
    }
}
