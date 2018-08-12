<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    protected $table = 'firma';

    protected $fillable = [
        'usuario_id', 'firma',
    ];
}
