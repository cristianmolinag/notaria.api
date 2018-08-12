<?php

namespace App\Http\Controllers;

use App\Models\Corregimiento;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CorregimientoController extends Controller
{
    public function index()
    {

        $data = Corregimiento::with('municipio')->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $data = new Corregimiento;
            $data->nombre = $request->json('nombre');
            $data->municipio_id = $request->json('municipio_id');
            $data->save();

            return response()->json([
                'data' => $data->with('municipio')->first(),
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el Corregimiento',
                'data' => $ex,
            ]);

        }
    }

    public function find($id)
    {
        $data = Corregimiento::find($id);

        return response()->json([
            'data' => $data->with('municipio')->first(),
        ], 200);

    }

    public function update(Request $request, $id)
    {
        try {

            $data = Corregimiento::find($id);
            $data->nombre = $request->json('nombre');
            $data->municipio_id = $request->json('municipio_id');
            $data->save();

            return response()->json([
                'data' => $data->with('municipio')->first(),
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error editando el Corregimiento',
                'data' => $ex,
            ]);

        }
    }
}
