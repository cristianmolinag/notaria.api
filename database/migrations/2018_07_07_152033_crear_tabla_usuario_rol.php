<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsuarioRol extends Migration
{

    public function up()
    {
        Schema::create('usuario_rol', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuario')->onDelete('cascade');

            $table->unsignedInteger('rol_id');
            $table->foreign('rol_id')->references('id')->on('rol')->onDelete('cascade');

            $table->unique(['rol_id', 'usuario_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario_rol');
    }
}
