<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corregimiento extends Model
{
    protected $table = 'corregimiento';

    protected $fillable = [
        'nombre',
        'municipio_id',
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}
