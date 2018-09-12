<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaHijo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hijo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->bigInteger('documento')->unique();
            $table->string('indicativo_serial')->unique();

            $table->unsignedInteger('tipo_documento_id');
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento')->onDelete('cascade');

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
        Schema::dropIfExists('hijo');
    }
}
