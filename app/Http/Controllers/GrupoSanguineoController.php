<?php

namespace App\Http\Controllers;

use App\Models\GrupoSanguineo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class GrupoSanguineoController extends Controller
{

    public function index()
    {

        $data = GrupoSanguineo::All();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $data = new GrupoSanguineo;
            $data->nombre = $request->json('nombre');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el grupo sanguineo',
                'data' => $ex,
            ]);

        }
    }

    public function find($id)
    {
        $data = GrupoSanguineo::find($id);

        return response()->json([
            'data' => $data,
        ], 200);

    }

    public function update(Request $request, $id)
    {
        try {

            $data = GrupoSanguineo::find($id);
            $data->nombre = $request->json('nombre');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error editando el grupo sanguineo',
                'data' => $ex,
            ]);

        }
    }
}
