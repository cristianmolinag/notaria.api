<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    protected $table='tramite';

    protected $fillable = [
        'tipo_tramite_id', 'estado_tramite_id', 'forma_pago_id', 'cliente_id'
    ];

    public function tipoTramite()
    {
        return $this->belongsTo(TipoTramite::class);
    }

    public function estadoTramite()
    {
        return $this->belongsTo(EstadoTramite::class);
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class)->with('persona', 'usuario');;
    }
}
