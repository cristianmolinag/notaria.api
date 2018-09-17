<?php

namespace App\Http\Controllers;

use App\Models\Capitulacion;

class CapitulacionController extends Controller
{
    public function find($id)
    {
        try {

            $data = Capitulacion::find($id);

            return response()->json([
                'data' => $data,
            ], 200);
        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error consultando la capitulacion',
                'data' => $ex,
            ]);

        }
    }
}
