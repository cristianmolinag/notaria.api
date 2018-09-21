<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCita extends Migration
{
    public function up()
    {
        Schema::create('cita', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->time('hora');
            $table->enum('estado', ['Asignada', 'Cancelada', 'Cerrada']);

            $table->unsignedInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('usuario')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cita');
    }
}
