<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaRcDefuncion extends Migration
{

    public function up()
    {
        Schema::create('rc_defuncion', function (Blueprint $table) {
            $table->increments('indicativo_serial');

            $table->unsignedInteger('inscrito_id');
            $table->foreign('inscrito_id')->references('nuip')->on('inscrito')->onDelete('cascade');

            $table->string('lugar_defuncion');
            $table->date('fecha_defuncion');
            $table->time('hora_defuncion');
            $table->string('certificado_defuncion')->unique();

            $table->unsignedInteger('juzgado_id');
            $table->foreign('juzgado_id')->references('id')->on('juzgado')->onDelete('cascade');

            $table->date('fecha_sentencia');
            $table->enum('tipo_certificado', ['judicial', 'medico']);
            $table->string('nombre_funcionario');

            $table->unsignedInteger('denunciante_id');
            $table->foreign('denunciante_id')->references('id')->on('denunciante')->onDelete('cascade');

            $table->unsignedInteger('testigo_uno_id')->nullable(true);
            $table->foreign('testigo_uno_id')->references('id')->on('testigo')->onDelete('cascade');

            $table->unsignedInteger('testigo_dos_id')->nullable(true);
            $table->foreign('testigo_dos_id')->references('id')->on('testigo')->onDelete('cascade');

            $table->date('fecha_inscripcion');

            $table->unsignedInteger('firma_id')->nullable(true);
            $table->foreign('firma_id')->references('id')->on('firma')->onDelete('cascade');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE rc_defuncion AUTO_INCREMENT = 20000000;");
    }

    public function down()
    {
        Schema::dropIfExists('rc_defuncion');
    }
}
