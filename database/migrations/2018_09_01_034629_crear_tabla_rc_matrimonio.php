<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaRcMatrimonio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rc_matrimonio', function (Blueprint $table) {
            $table->increments('indicativo_serial');

            $table->string('lugar_celebracion');
            $table->date('fecha_celebracion');
            $table->enum('tipo_matrimonio', ['civil', 'religioso']);
            $table->enum('tipo_documento', ['escritura de protocolización', 'partida eclesiástica', 'acta de matrimonio']);

            $table->unsignedInteger('contrayente_uno_id');
            $table->foreign('contrayente_uno_id')->references('id')->on('contrayente')->onDelete('cascade');

            $table->unsignedInteger('contrayente_dos_id');
            $table->foreign('contrayente_dos_id')->references('id')->on('contrayente')->onDelete('cascade');

            $table->unsignedInteger('denunciante_id');
            $table->foreign('denunciante_id')->references('id')->on('denunciante')->onDelete('cascade');

            $table->unsignedInteger('capitulacion_id')->nullable(true);
            $table->foreign('capitulacion_id')->references('id')->on('capitulacion')->onDelete('cascade');

            $table->unsignedInteger('firma_id')->nullable(true);
            $table->foreign('firma_id')->references('id')->on('firma')->onDelete('cascade');

            $table->longText('notas_marginales')->nullable(true);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE rc_matrimonio AUTO_INCREMENT = 30000000;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rc_matrimonio');
    }
}
