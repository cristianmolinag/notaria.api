<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaInscrito extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscrito', function (Blueprint $table) {
            $table->increments('nuip');
            $table->string('primer_apellido');
            $table->string('segundo_apellido');
            $table->string('nombres');
            $table->date('fecha_nacimiento')->nullable(true);

            $table->unsignedInteger('genero_id');
            $table->foreign('genero_id')->references('id')->on('genero')->onDelete('cascade');

            $table->unsignedInteger('grupo_sanguineo_id')->nullable(true);
            $table->foreign('grupo_sanguineo_id')->references('id')->on('grupo_sanguineo')->onDelete('cascade');

            $table->unsignedInteger('factor_rh_id')->nullable(true);
            $table->foreign('factor_rh_id')->references('id')->on('factor_rh')->onDelete('cascade');

            $table->string('lugar_nacimiento')->nullable(true);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE inscrito AUTO_INCREMENT = 1000000000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscrito');
    }
}
