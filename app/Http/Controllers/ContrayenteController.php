<?php

namespace App\Http\Controllers;

use App\Models\Contrayente;
use Illuminate\Database\QueryException;

class ContrayenteController extends Controller
{
    public function find($id)
    {
        try {

            $data = Contrayente::where('documento', '=', $id)->with('tipoDocumento')->first();

            return response()->json([
                'data' => $data,
            ], 200);
        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error consultando el documento del contrayente',
                'data' => $ex,
            ]);

        }
    }
}
