<?php

namespace App\Http\Controllers;

use App\Models\Madre;
use Illuminate\Database\QueryException;

class MadreController extends Controller
{
    public function find($id)
    {
        try {

            $data = Madre::where('documento', '=', $id)->with('pais', 'tipoDocumento')->first();

            return response()->json([
                'data' => $data,
            ], 200);
        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error consultando el documento de la madre',
                'data' => $ex,
            ]);

        }
    }
}
