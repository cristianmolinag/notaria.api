<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaFuncionario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('persona_id');
            $table->binary('firma');

            $table->foreign('persona_id')
                ->references('id')
                ->on('persona')
                ->onDelete('cascade');
            $table->unsignedInteger('usuario_id');

            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuario')
                ->onDelete('cascade');
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
        Schema::dropIfExists('funcionario');
    }
}
