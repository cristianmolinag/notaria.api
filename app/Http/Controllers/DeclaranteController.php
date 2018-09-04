<?php

namespace App\Http\Controllers;

use App\Models\Declarante;
use Illuminate\Database\QueryException;

class DeclaranteController extends Controller
{
    public function find($id)
    {
        try {

            $data = Declarante::where('documento', '=', $id)->with('tipoDocumento')->first();

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
