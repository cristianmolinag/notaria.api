<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    protected $table = 'tramite';

    protected $fillable = [
        'tipo_tramite_id',
        'cliente_id',
        'estado_tramite_id',
        'funcionario_id',
    ];
}
