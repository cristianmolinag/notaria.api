<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denunciante extends Model
{
    protected $table = 'denunciante';

    protected $fillable = [
        'nombres',
        'tipo_documento_id',
        'documento',
        'firma_denunciante',
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}
