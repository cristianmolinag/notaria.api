<?php

namespace App\Http\Controllers;

use App\Models\Denunciante;
use Illuminate\Database\QueryException;

class DenuncianteController extends Controller
{
    public function find($id)
    {
        try {

            $data = Denunciante::where('documento', '=', $id)->with('tipoDocumento')->first();

            return response()->json([
                'data' => $data,
            ], 200);
        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error consultando el documento del Denunciante',
                'data' => $ex,
            ]);

        }
    }
}
