<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primer_nombre',100);
            $table->string('documento',20);
            $table->string('segundo_nombre',100);
            $table->string('primer_apellido',100);
            $table->string('segundo_apellido',100);
            $table->unsignedInteger('tipo_documento_id');
            $table->foreign('tipo_documento_id')
                ->references('id')
                ->on('tipos_documento')
                ->onDelete('cascade');
            $table->unsignedInteger('nacionalidad_id');
            $table->foreign('nacionalidad_id')
                ->references('id')
                ->on('nacionalidad')
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
        Schema::dropIfExists('persona');
    }
}
