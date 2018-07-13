<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='rol';

    protected $fillable = [
        'name', 'guard_name','usuario_id'
    ];
}
