<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    protected $table='nacionalidad';

    protected $fillable = [
        'nombre'
    ];
}
