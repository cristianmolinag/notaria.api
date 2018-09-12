<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrayente extends Model
{
    protected $table = 'contrayente';

    protected $fillable = [
        'nombres',
        'tipo_documento_id',
        'documento',
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}
