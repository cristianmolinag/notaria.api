<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaProvidencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providencia', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo_providencia', ['separacion', 'cesacion', 'nulidad']);
            $table->integer('num_escritura');
            $table->integer('num_notaria');
            $table->date('fecha_providencia');
            $table->longText('firma_providencia');

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
        Schema::dropIfExists('providencia');
    }
}
