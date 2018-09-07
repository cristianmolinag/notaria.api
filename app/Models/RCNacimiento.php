<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RCNacimiento extends Model
{
    protected $table = 'rc_nacimiento';
    protected $primaryKey = 'indicativo_serial';

    public function antecedente()
    {
        return $this->belongsTo(Antecedente::class);
    }

    public function firma()
    {
        return $this->belongsTo(Firma::class);
    }

    public function inscrito()
    {
        return $this->belongsTo(Inscrito::class, 'inscrito_id')->with('grupoSanguineo', 'genero', 'factorRh');
    }

    public function madre()
    {
        return $this->belongsTo(Madre::class)->with('pais', 'tipoDocumento');
    }

    public function padre()
    {
        return $this->belongsTo(Padre::class)->with('pais', 'tipoDocumento');
    }
    public function declarante()
    {
        return $this->belongsTo(Declarante::class)->with('tipoDocumento');
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
