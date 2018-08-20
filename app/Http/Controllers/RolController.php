<?php

namespace App\Http\Controllers;

use App\Models\PermisoRol;
use App\Models\Rol;
use App\Models\UsuarioRol;
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
                'mensaje' => 'Error editando el rol',
                'data' => $ex,
            ]);
        }
    }

    public function asignarPermiso(Request $request, $id)
    {
        try {
            $data = new PermisoRol();

            $data->rol_id = $id;
            $data->permiso_id = $request->json('id');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error asignado el permiso',
                'data' => $ex,
            ]);
        }

    }

    public function eliminarPermiso($id)
    {
        try {
            $data = PermisoRol::find($id);
            $data->delete();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error eliminando el permiso',
                'data' => $ex,
            ]);
        }

    }

    public function asignarUsuario(Request $request, $id)
    {
        try {
            $data = new UsuarioRol();

            $data->rol_id = $id;
            $data->usuario_id = $request->json('id');
            $data->save();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error asignado el usuario',
                'data' => $ex,
            ]);
        }
    }

    public function eliminarUsuario($id)
    {
        try {
            $data = UsuarioRol::find($id);
            $data->delete();

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error eliminando el usuario',
                'data' => $ex,
            ]);
        }

    }
}
