<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroCivil extends Model
{
    protected $table='registro_civil';

    protected $fillable = [
        'nombre',
        'fecha_nacimiento',
        'fecha_inscripcion',
        'firma_reconocimiento',
        'sexo_id',
        'persona_id',
        'madre_id',
        'padre_id',
        'declarante_id',
        'testigo1_id',
        'testigo2_id',
        'funcionario_autoriza_id',
        'funcionario_tramite_id'
    ];
}
