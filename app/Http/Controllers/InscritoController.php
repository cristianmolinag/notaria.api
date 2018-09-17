<?php

namespace App\Http\Controllers;

class InscritoController extends Controller
{
    public function find($id)
    {
        try {

            $data = Inscrito::where('documento', '=', $id)->with('tipoDocumento')->first();

            return response()->json([
                'data' => $data,
            ], 200);
        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error consultando el documento del declarante',
                'data' => $ex,
            ]);

        }
    }
}
