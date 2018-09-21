<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaTramite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramite', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('tipo_tramite_id');
            $table->foreign('tipo_tramite_id')->references('id')->on('tipo_tramite')->onDelete('cascade');

            $table->bigInteger('indicativo_serial');

            $table->unsignedInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('usuario')->onDelete('cascade');

            $table->unsignedInteger('estado_tramite_id');
            $table->foreign('estado_tramite_id')->references('id')->on('estado_tramite')->onDelete('cascade');

            $table->unsignedInteger('funcionario_id')->nullable(true);
            $table->foreign('funcionario_id')->references('id')->on('usuario')->onDelete('cascade');

            $table->unsignedInteger('pago_id')->nullable(true);
            $table->foreign('pago_id')->references('id')->on('pago')->onDelete('cascade');

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
        Schema::dropIfExists('tramite');
    }
}
