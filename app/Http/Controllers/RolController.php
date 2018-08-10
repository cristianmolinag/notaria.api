<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RolController extends Controller
{

    public function index()
    {
        $data = Rol::All();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $rol = new Rol;
            $rol->nombre = $request->json('nombre');
            $rol->save();

            return response()->json([
                'data' => $rol,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el rol',
                'data' => $ex,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $rol = Rol::find($id);
            $rol->nombre = $request->json('nombre');
            $rol->save();

            return response()->json([
                'data' => $rol,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el rol',
                'data' => $ex,
            ]);
        }
    }
}
