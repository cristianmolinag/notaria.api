<?php

namespace App\Http\Controllers;

use App\Models\ProvidenciaRCMatrimonio;

class ProvidenciaController extends Controller
{
    public function find($id)
    {
        try {

            $data = ProvidenciaRCMatrimonio::with('providencia')->where('rc_matrimonio_id', $id)->first();

            return response()->json([
                'data' => $data,
            ], 200);
        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error consultando la providencia',
                'data' => $ex,
            ]);

        }
    }
}
