<?php

namespace App\Http\Controllers;

use App\Models\InscritoDefuncion;

class InscritoDefuncionController extends Controller
{
    public function find($id)
    {
        try {

            $data = InscritoDefuncion::where('documento', '=', $id)->with('tipoDocumento', 'genero')->first();

            return response()->json([
                'data' => $data,
            ], 200);
        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error consultando el documento del inscrito',
                'data' => $ex,
            ]);

        }
    }
}
