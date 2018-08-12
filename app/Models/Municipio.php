<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipio';

    protected $fillable = [
        'nombre',
        'departamento_id',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function corregimiento()
    {
        return $this->hasMany(Corregimiento::class);
    }
}
