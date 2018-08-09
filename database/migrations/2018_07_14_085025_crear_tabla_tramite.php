<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->foreign('tipo_tramite_id')
                ->references('id')
                ->on('tipo_tramite')
                ->onDelete('cascade');

            $table->unsignedInteger('estado_tramite_id');
            $table->foreign('estado_tramite_id')
                ->references('id')
                ->on('estado_tramite')
                ->onDelete('cascade');

            $table->unsignedInteger('forma_pago_id');
            $table->foreign('forma_pago_id')
                ->references('id')
                ->on('forma_pago')
                ->onDelete('cascade');

            $table->unsignedInteger('cliente_id');
            $table->foreign('cliente_id')
                ->references('id')
                ->on('cliente')
                ->onDelete('cascade');

            $table->string('observaciones', 250);

            $table->timestamps()->required(false);
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
