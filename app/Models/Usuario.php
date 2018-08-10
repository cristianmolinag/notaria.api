<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

    protected $table = 'usuario';

    protected $fillable = [
        'correo', 'nombres', 'apellidos', 'estado',
    ];

    protected $hidden = [
        'contrasena', 'remember_token',
    ];
}
