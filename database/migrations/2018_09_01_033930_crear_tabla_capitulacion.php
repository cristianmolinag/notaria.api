<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCapitulacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capitulacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lugar_escritura');
            $table->integer('num_notaria');
            $table->integer('num_escritura');
            $table->date('fecha_escritura');

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
        Schema::dropIfExists('capitulacion');
    }
}
