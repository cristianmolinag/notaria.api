<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hijo extends Model
{
    protected $table = 'hijo';

    protected $fillable = [
        'nombres',
        'tipo_documento_id',
        'documento',
        'pais_id',
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
class HijoRCMatrimonio extends Model
{

    protected $table = 'hijo';

    protected $fillable = [
        'rc_matrimonio_id',
        'hijo_id',
    ];

}
