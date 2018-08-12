<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function index()
    {

        $data = Genero::All();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $data = new Genero;
            $data->nombre = $request->json('nombre');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el genero',
                'data' => $ex,
            ]);

        }
    }

    public function find($id)
    {
        $data = Genero::find($id);

        return response()->json([
            'data' => $data,
        ], 200);

    }

    public function update(Request $request, $id)
    {
        try {

            $data = Genero::find($id);
            $data->nombre = $request->json('nombre');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error editando el genero',
                'data' => $ex,
            ]);

        }
    }
}
