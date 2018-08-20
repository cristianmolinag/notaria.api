<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaRcNacimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rc_nacimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nuip')->unique();
            $table->string('indicativo_serial')->unique();
            $table->string('primer_apellido');
            $table->string('segundo_apellido');
            $table->string('nombres');
            $table->date('fecha_nacimiento');

            $table->unsignedInteger('genero_id');
            $table->foreign('genero_id')->references('id')->on('genero')->onDelete('cascade');

            $table->unsignedInteger('grupo_sanguineo_id');
            $table->foreign('grupo_sanguineo_id')->references('id')->on('grupo_sanguineo')->onDelete('cascade');

            $table->unsignedInteger('factor_rh_id');
            $table->foreign('factor_rh_id')->references('id')->on('factor_rh')->onDelete('cascade');

            $table->string('lugar_nacimiento');

            $table->unsignedInteger('antecedente_id');
            $table->foreign('antecedente_id')->references('id')->on('antecedente')->onDelete('cascade');

            $table->string('num_nacido_vivo')->unique();

            $table->string('nombres_madre');

            $table->unsignedInteger('tipo_documento_madre_id');
            $table->foreign('tipo_documento_madre_id')->references('id')->on('tipo_documento')->onDelete('cascade');

            $table->bigInteger('documento_madre');

            $table->unsignedInteger('pais_madre_id');
            $table->foreign('pais_madre_id')->references('id')->on('pais')->onDelete('cascade');

            $table->string('nombres_padre')->nullable(true);

            $table->unsignedInteger('tipo_documento_padre_id')->nullable(true);
            $table->foreign('tipo_documento_padre_id')->references('id')->on('tipo_documento')->onDelete('cascade');

            $table->bigInteger('documento_padre')->nullable(true);

            $table->unsignedInteger('pais_padre_id')->nullable(true);
            $table->foreign('pais_padre_id')->references('id')->on('pais')->onDelete('cascade');

            $table->string('nombres_declarante');

            $table->unsignedInteger('tipo_documento_declarante_id');
            $table->foreign('tipo_documento_declarante_id')->references('id')->on('tipo_documento')->onDelete('cascade');

            $table->bigInteger('documento_declarante');

            $table->longText('firma_declarante');

            $table->string('nombres_testigo_uno')->nullable(true);

            $table->unsignedInteger('tipo_documento_testigo_uno_id')->nullable(true);
            $table->foreign('tipo_documento_testigo_uno_id')->references('id')->on('tipo_documento')->onDelete('cascade');

            $table->bigInteger('documento_testigo_uno')->nullable(true);

            $table->longText('firma_testigo_uno')->nullable(true);

            $table->string('nombres_testigo_dos')->nullable(true);

            $table->unsignedInteger('tipo_documento_testigo_dos_id')->nullable(true);
            $table->foreign('tipo_documento_testigo_dos_id')->references('id')->on('tipo_documento')->onDelete('cascade');

            $table->bigInteger('documento_testigo_dos')->nullable(true);

            $table->longText('firma_testigo_dos')->nullable(true);

            $table->unsignedInteger('firma_id')->nullable(true);
            $table->foreign('firma_id')->references('id')->on('firma')->onDelete('cascade');

            $table->string('notas_marginales')->nullable(true);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rc_nacimiento');
    }
}
