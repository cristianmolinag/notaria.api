<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCapitulacionRcMatrimonio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capitulacion_rc_matrimonio', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('rc_matrimonio_id');
            $table->foreign('rc_matrimonio_id')->references('indicativo_serial')->on('rc_matrimonio')->onDelete('cascade');

            $table->unsignedInteger('capitulacion_id');
            $table->foreign('capitulacion_id')->references('id')->on('capitulacion')->onDelete('cascade');

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
        Schema::dropIfExists('capitulacion_rc_matrimonio');
    }
}
