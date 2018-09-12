<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capitulacion extends Model
{
    protected $table = 'capitulacion';

    protected $fillable = [
        'lugar_escritura',
        'num_notaria',
        'num_escritura',
        'fecha_escritura',
    ];
}
