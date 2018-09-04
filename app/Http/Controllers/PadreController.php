<?php

namespace App\Http\Controllers;

use App\Models\Padre;
use Illuminate\Database\QueryException;

class PadreController extends Controller
{
    public function find($id)
    {
        try {

            $data = Padre::where('documento', '=', $id)->with('pais', 'tipoDocumento')->first();

            return response()->json([
                'data' => $data,
            ], 200);
        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error consultando el documento del padre',
                'data' => $ex,
            ]);

        }
    }
}
