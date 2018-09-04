<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaHijoRcMatrimonio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hijo_rc_matrimonio', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('rc_matrimonio_id');
            $table->foreign('rc_matrimonio_id')->references('indicativo_serial')->on('rc_matrimonio')->onDelete('cascade');

            $table->unsignedInteger('hijo_id');
            $table->foreign('hijo_id')->references('id')->on('hijo')->onDelete('cascade');

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
        Schema::dropIfExists('hijo_rc_matrimonio');
    }
}
