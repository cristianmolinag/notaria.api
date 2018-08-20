<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaFirma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firma', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('firma');

            $table->unsignedInteger('usuario_id')->unique();
            $table->foreign('usuario_id')->references('id')->on('usuario')->onDelete('cascade');

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
        Schema::dropIfExists('firma');
    }
}
