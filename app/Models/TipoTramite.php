<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTramite extends Model
{
    protected $table='tipo_tramite';

    protected $fillable = [
        'nombre', 'valor'
    ];
}
