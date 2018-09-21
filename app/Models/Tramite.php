<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    protected $table = 'tramite';

    protected $fillable = [
        'tipo_tramite_id',
        'cliente_id',
        'estado_tramite_id',
        'funcionario_id',
        'indicativo_serial',
    ];

    public function tipoTramite()
    {
        return $this->belongsTo(TipoTramite::class);
    }
    public function estadoTramite()
    {
        return $this->belongsTo(EstadoTramite::class);
    }
}
