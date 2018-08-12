<?php

namespace App\Http\Controllers;

use App\Models\TipoTramite;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TipoTramiteController extends Controller
{
    public function index()
    {
        $data = TipoTramite::All();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $rol = new TipoTramite;
            $rol->nombre = $request->json('nombre');
            $rol->valor = $request->json('valor');
            $rol->save();

            return response()->json([
                'data' => $rol,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el tipo de trámite',
                'data' => $ex,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $rol = TipoTramite::find($id);
            $rol->nombre = $request->json('nombre');
            $rol->valor = $request->json('valor');
            $rol->save();

            return response()->json([
                'data' => $rol,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error editando el tipo de trámite',
                'data' => $ex,
            ]);
        }
    }
}
