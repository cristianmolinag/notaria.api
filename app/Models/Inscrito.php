<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscrito extends Model
{
    protected $table = 'inscrito';
    protected $primaryKey = 'nuip';

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    public function grupoSanguineo()
    {
        return $this->belongsTo(GrupoSanguineo::class);
    }
    public function factorRh()
    {
        return $this->belongsTo(FactorRH::class);
    }
}
