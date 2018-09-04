<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaProvidenciaRcMatrimonio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providencia_rc_matrimonio', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('providencia_id')->nullable(true);
            $table->foreign('providencia_id')->references('id')->on('providencia')->onDelete('cascade');

            $table->unsignedInteger('rc_matrimonio_id')->nullable(true);
            $table->foreign('rc_matrimonio_id')->references('indicativo_serial')->on('rc_matrimonio')->onDelete('cascade');

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
        Schema::dropIfExists('providencia_rc_matrimonio');
    }
}
