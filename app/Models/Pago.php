<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';

    protected $fillable = [
        'cod_autorizacion',
        'cod_transaccion',
        'valor',
        'forma_pago_id',
    ];
}
