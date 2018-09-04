<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Madre extends Model
{
    protected $table = 'madre';

    protected $fillable = [
        'nombres',
        'tipo_documento_id',
        'documento',
        'pais_id',
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

}
