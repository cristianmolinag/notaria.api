<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscritoDefuncion extends Model
{
    protected $table = 'inscrito_defuncion';

    protected $fillable = [
        'nombres',
        'tipo_documento_id',
        'documento',
        'genero_id',
        'firma',
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }
}
