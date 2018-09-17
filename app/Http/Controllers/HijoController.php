<?php

namespace App\Http\Controllers;

use App\Models\HijoRCMatrimonio;

class HijoController extends Controller
{
    public function find($id)
    {
        try {

            $data = HijoRCMatrimonio::with('hijo')->where('rc_matrimonio_id', $id)->get();

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
