<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'cita';

    protected $fillable = [
        'fecha',
        'hora',
        'estado',
        'cliente_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'cliente_id')->with('perfil');
    }
}
