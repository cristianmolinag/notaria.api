<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

    protected $table = 'usuario';

    protected $fillable = [
        'correo',
        'nombres',
        'apellidos',
        'estado',
        'perfil_id',
        'contrasena',
        'remember_token',
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }

    public function usuario_rol()
    {
        return $this->hasMany(UsuarioRol::class)->with('rol');
    }

    public function firma()
    {
        return $this->hasOne(Firma::class);
    }
}
