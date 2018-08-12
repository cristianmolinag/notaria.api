<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsuario extends Migration
{
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('correo', 100)->unique();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('contrasena');

            $table->unsignedInteger('perfil_id');
            $table->foreign('perfil_id')->references('id')->on('perfil')->onDelete('cascade');

            $table->rememberToken();
            $table->boolean('estado')->default(1);

            $table->unique(['perfil_id', 'id', 'correo']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
