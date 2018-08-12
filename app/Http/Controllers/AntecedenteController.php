<?php

namespace App\Http\Controllers;

use App\Models\Antecedente;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AntecedenteController extends Controller
{
    public function index()
    {

        $data = Antecedente::All();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $data = new Antecedente;
            $data->nombre = $request->json('nombre');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el Antecedente',
                'data' => $ex,
            ]);

        }
    }

    public function find($id)
    {
        $data = Antecedente::find($id);

        return response()->json([
            'data' => $data,
        ], 200);

    }

    public function update(Request $request, $id)
    {
        try {

            $data = Antecedente::find($id);
            $data->nombre = $request->json('nombre');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error editando el Antecedente',
                'data' => $ex,
            ]);

        }
    }
}
