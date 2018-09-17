<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProvidenciaRCMatrimonio extends Model
{

    protected $table = 'providencia_rc_matrimonio';

    protected $fillable = [
        'rc_matrimonio_id',
        'providencia_id',
    ];

    public function providencia()
    {
        return $this->belongsTo(Providencia::class);
    }

}
