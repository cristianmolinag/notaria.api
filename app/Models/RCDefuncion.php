<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RCDefuncion extends Model
{
    protected $table = 'rc_defuncion';
    protected $primaryKey = 'indicativo_serial';

    public function firma()
    {
        return $this->belongsTo(Firma::class);
    }

    public function denunciante()
    {
        return $this->belongsTo(Denunciante::class)->with('tipoDocumento');
    }

    public function inscritoDefuncion()
    {
        return $this->belongsTo(InscritoDefuncion::class, 'inscrito_id')->with('tipoDocumento', 'genero');
    }

    public function testigoUno()
    {
        return $this->belongsTo(Testigo::class, 'testigo_uno_id')->with('tipoDocumento');
    }
    public function testigoDos()
    {
        return $this->belongsTo(Testigo::class, 'testigo_dos_id')->with('tipoDocumento');
    }
}
