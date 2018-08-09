<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RCNacimiento extends Model
{
    protected $table='rc_nacimiento';

    protected $fillable = [
        'nombre',
        'fecha_nacimiento',
        'fecha_inscripcion',
        'firma_reconocimiento',
        'genero_id',
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