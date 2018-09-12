<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RCMatrimonio extends Model
{
    protected $table = 'rc_matrimonio';
    protected $primaryKey = 'indicativo_serial';

    public function firma()
    {
        return $this->belongsTo(Firma::class);
    }

    public function denunciante()
    {
        return $this->belongsTo(Denunciante::class)->with('tipoDocumento');
    }

    public function contrayenteUno()
    {
        return $this->belongsTo(Contrayente::class, 'contrayente_uno_id')->with('tipoDocumento');
    }

    public function contrayenteDos()
    {
        return $this->belongsTo(Contrayente::class, 'contrayente_dos_id')->with('tipoDocumento');
    }
}
