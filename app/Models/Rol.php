<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';

    protected $fillable = [
        'name',
    ];
}

class UsuarioRol extends Model
{
    protected $table = 'usuario_rol';

    protected $fillable = [
        'usuario_id', 'rol_id',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
