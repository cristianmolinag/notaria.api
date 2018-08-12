<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        $data = Perfil::All();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function find($id)
    {

        $data = Perfil::find($id);

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {

        try {

            $data = new Perfil();

            $data->nombre = $request->json('nombre');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el perfil',
                'data' => $ex,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $data = Perfil::find($id);

            $data->nombre = $request->json('nombre');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el perfil',
                'data' => $ex,
            ]);
        }
    }
}
