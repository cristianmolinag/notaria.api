<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Declarante extends Model
{
    protected $table = 'declarante';

    protected $fillable = [
        'nombres',
        'tipo_documento_id',
        'documento',
        'firma_declarante',
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}
