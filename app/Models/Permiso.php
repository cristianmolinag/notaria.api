<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permiso';

    protected $fillable = [
        'nombre',
    ];
}

class PermisoRol extends Model
{
    protected $table = 'permiso_rol';

    protected $fillable = [
        'permiso_id', 'rol_id',
    ];
}
