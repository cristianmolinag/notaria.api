<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Providencia extends Model
{
    protected $table = 'providencia';

    protected $fillable = [
        'tipo_provicencia',
        'num_escritura',
        'num_notaria',
        'fecha_providencia',
        'firma_id',
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
