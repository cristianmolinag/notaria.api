<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPermisoRol extends Migration
{
    public function up()
    {
        Schema::create('permiso_rol', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('permiso_id');
            $table->foreign('permiso_id')->references('id')->on('permiso')->onDelete('cascade');

            $table->unsignedInteger('rol_id');
            $table->foreign('rol_id')->references('id')->on('rol')->onDelete('cascade');

            $table->unique(['rol_id', 'permiso_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permiso_rol');
    }
}
