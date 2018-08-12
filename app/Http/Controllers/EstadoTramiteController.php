<?php

namespace App\Http\Controllers;

use App\Models\EstadoTramite;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class EstadoTramiteController extends Controller
{
    public function index()
    {

        $data = EstadoTramite::All();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $data = new EstadoTramite;
            $data->nombre = $request->json('nombre');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el estado de trámite',
                'data' => $ex,
            ]);

        }
    }

    public function find($id)
    {
        $data = EstadoTramite::find($id);

        return response()->json([
            'data' => $data,
        ], 200);

    }

    public function update(Request $request, $id)
    {
        try {

            $data = EstadoTramite::find($id);
            $data->nombre = $request->json('nombre');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error editando el estado de tramite',
                'data' => $ex,
            ]);

        }
    }
}
