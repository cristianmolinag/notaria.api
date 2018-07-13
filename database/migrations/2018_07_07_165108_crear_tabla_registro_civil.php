<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRegistroCivil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_civil', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_nacimiento');
            $table->date('fecha_inscripcion');
            $table->string('firma_reconocimiento');
            $table->unsignedInteger('sexo_id');
            $table->foreign('sexo_id')
                ->references('id')
                ->on('sexo')
                ->onDelete('cascade');
            $table->unsignedInteger('persona_id');
            $table->foreign('persona_id')
                ->references('id')
                ->on('persona')
                ->onDelete('cascade');
            $table->unsignedInteger('madre_id');
            $table->foreign('madre_id')
                ->references('id')
                ->on('persona')
                ->onDelete('cascade');
            $table->unsignedInteger('padre_id');
            $table->foreign('padre_id')
                ->references('id')
                ->on('persona')
                ->onDelete('cascade');
            $table->unsignedInteger('declarante_id');
            $table->foreign('declarante_id')
                ->references('id')
                ->on('persona')
                ->onDelete('cascade');
            $table->unsignedInteger('testigo1_id');
            $table->foreign('testigo1_id')
                ->references('id')
                ->on('persona')
                ->onDelete('cascade')
                ->nullable();
            $table->unsignedInteger('testigo2_id');
            $table->foreign('testigo2_id')
                ->references('id')
                ->on('persona')
                ->onDelete('cascade')
                ->nullable();
            $table->unsignedInteger('funcionario_autoriza_id');
            $table->foreign('funcionario_autoriza_id')
                ->references('id')
                ->on('funcionario')
                ->onDelete('cascade');
            $table->unsignedInteger('funcionario_tramite_id');
            $table->foreign('funcionario_tramite_id')
                ->references('id')
                ->on('funcionario')
                ->onDelete('cascade');
            $table->string('notas');         
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
        Schema::dropIfExists('registro_civil');
    }
}
