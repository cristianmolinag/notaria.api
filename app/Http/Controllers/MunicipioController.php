<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function index()
    {

        $data = Municipio::with('departamento')->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $data = new Municipio;
            $data->nombre = $request->json('nombre');
            $data->departamento_id = $request->json('departamento_id');
            $data->save();

            return response()->json([
                'data' => $data->with('departamento')->first(),
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el Municipio',
                'data' => $ex,
            ]);

        }
    }

    public function find($id)
    {
        $data = Municipio::find($id);

        return response()->json([
            'data' => $data->with('departamento')->first(),
        ], 200);

    }

    public function update(Request $request, $id)
    {
        try {

            $data = Municipio::find($id);
            $data->nombre = $request->json('nombre');
            $data->departamento_id = $request->json('departamento_id');
            $data->save();

            return response()->json([
                'data' => $data->with('departamento')->first(),
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error editando el Municipio',
                'data' => $ex,
            ]);

        }
    }
}
