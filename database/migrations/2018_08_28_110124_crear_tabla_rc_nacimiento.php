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
            $table->increments('indicativo_serial');

            $table->unsignedInteger('inscrito_id');
            $table->foreign('inscrito_id')->references('nuip')->on('inscrito')->onDelete('cascade');

            $table->unsignedInteger('antecedente_id');
            $table->foreign('antecedente_id')->references('id')->on('antecedente')->onDelete('cascade');

            $table->string('num_nacido_vivo')->unique();

            $table->unsignedInteger('madre_id');
            $table->foreign('madre_id')->references('id')->on('madre')->onDelete('cascade');

            $table->unsignedInteger('padre_id')->nullable(true);
            $table->foreign('padre_id')->references('id')->on('padre')->onDelete('cascade');

            $table->unsignedInteger('declarante_id');
            $table->foreign('declarante_id')->references('id')->on('declarante')->onDelete('cascade');

            $table->unsignedInteger('testigo_uno_id')->nullable(true);
            $table->foreign('testigo_uno_id')->references('id')->on('testigo')->onDelete('cascade');

            $table->unsignedInteger('testigo_dos_id')->nullable(true);
            $table->foreign('testigo_dos_id')->references('id')->on('testigo')->onDelete('cascade');

            $table->unsignedInteger('firma_id')->nullable(true);
            $table->foreign('firma_id')->references('id')->on('firma')->onDelete('cascade');

            $table->string('notas_marginales')->nullable(true);

            $table->timestamps();
        });

        DB::statement("ALTER TABLE rc_nacimiento AUTO_INCREMENT = 10000000;");
    }

    public function down()
    {
        Schema::dropIfExists('rc_nacimiento');
    }
}
