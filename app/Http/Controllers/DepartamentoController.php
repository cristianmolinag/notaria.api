<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {

        $data = Departamento::with('pais')->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $data = new Departamento;
            $data->nombre = $request->json('nombre');
            $data->pais_id = $request->json('pais_id');
            $data->save();

            return response()->json([
                'data' => $data->with('pais')->first(),
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el departamento',
                'data' => $ex,
            ]);

        }
    }

    public function find($id)
    {
        $data = Departamento::find($id);

        return response()->json([
            'data' => $data->with('pais')->first(),
        ], 200);

    }

    public function update(Request $request, $id)
    {
        try {

            $data = Departamento::find($id);
            $data->nombre = $request->json('nombre');
            $data->pais_id = $request->json('pais_id');
            $data->save();

            return response()->json([
                'data' => $data->with('pais')->first(),
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error editando el departamento',
                'data' => $ex,
            ]);

        }
    }
}
