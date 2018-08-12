<?php

namespace App\Http\Controllers;

use App\Models\Firma;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FirmaController extends Controller
{
    public function index()
    {

        $data = Firma::All();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $data = new Firma;
            $data->usuario_id = $request->json('usuario_id');
            $data->firma = $request->json('firma');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando la firma',
                'data' => $ex,
            ]);

        }
    }

    public function find($id)
    {
        $data = Firma::find($id);

        return response()->json([
            'data' => $data,
        ], 200);

    }

    public function update(Request $request, $id)
    {
        try {

            $data = Firma::find($id);
            $data->usuario_id = $request->json('usuario_id');
            $data->firma = $request->json('firma');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error editando la firma',
                'data' => $ex,
            ]);

        }
    }
}
