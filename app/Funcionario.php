<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table='funcionario';

    protected $fillable = [
        'persona_id', 'usuario_id', 'firma'
    ];
}
