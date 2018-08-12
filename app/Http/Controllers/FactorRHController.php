<?php

namespace App\Http\Controllers;

use App\Models\FactorRH;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FactorRHController extends Controller
{
    public function index()
    {

        $data = FactorRH::All();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $data = new FactorRH;
            $data->nombre = $request->json('nombre');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el factor RH',
                'data' => $ex,
            ]);

        }
    }

    public function find($id)
    {
        $data = FactorRH::find($id);

        return response()->json([
            'data' => $data,
        ], 200);

    }

    public function update(Request $request, $id)
    {
        try {

            $data = FactorRH::find($id);
            $data->nombre = $request->json('nombre');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error editando el factor RH',
                'data' => $ex,
            ]);

        }
    }
}
