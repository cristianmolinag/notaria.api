<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoTramite extends Model
{
    protected $table='estado_tramite';

    protected $fillable = [
        'nombre'
    ];
}
