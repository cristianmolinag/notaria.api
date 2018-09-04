<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testigo extends Model
{
    protected $table = 'testigo';

    protected $fillable = [
        'nombres',
        'tipo_documento_id',
        'documento',
        'firma_testigo',
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}
