<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HijoRCMatrimonio extends Model
{

    protected $table = 'hijo_rc_matrimonio';

    protected $fillable = [
        'rc_matrimonio_id',
        'hijo_id',
    ];

    public function hijo()
    {
        return $this->belongsTo(Hijo::class)->with('tipoDocumento');
    }

}
