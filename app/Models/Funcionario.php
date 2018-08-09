<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table='funcionario';

    protected $fillable = [
        'persona_id', 'usuario_id', 'firma'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }


}
