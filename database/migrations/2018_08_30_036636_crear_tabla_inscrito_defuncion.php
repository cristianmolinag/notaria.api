<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaInscritoDefuncion extends Migration
{
    public function up()
    {
        Schema::create('inscrito_defuncion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->bigInteger('documento')->unique();

            $table->unsignedInteger('tipo_documento_id');
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento')->onDelete('cascade');

            $table->unsignedInteger('genero_id');
            $table->foreign('genero_id')->references('id')->on('genero')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inscrito_defuncion');
    }
}
