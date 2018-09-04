<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{
    protected $table = 'padre';

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
