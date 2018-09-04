<?php

namespace App\Http\Controllers;

use App\Models\Testigo;
use Illuminate\Database\QueryException;

class TestigoController extends Controller
{
    public function find($id)
    {
        try {

            $data = Testigo::where('documento', '=', $id)->with('tipoDocumento')->first();

            return response()->json([
                'data' => $data,
            ], 200);
        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error consultando el documento del testigo',
                'data' => $ex,
            ]);

        }
    }
}
