<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermisoController extends Controller
{
    public function index()
    {
        $data = Permiso::All();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $rol = new Permiso;
            $rol->titulo = $request->json('titulo');
            $rol->componente = $request->json('componente');
            $rol->save();

            return response()->json([
                'data' => $rol,
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

            $rol = Permiso::find($id);
            $rol->titulo = $request->json('titulo');
            $rol->componente = $request->json('componente');
            $rol->save();

            return response()->json([
                'data' => $rol,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error editando el perfil',
                'data' => $ex,
            ]);
        }
    }

    public function porUsuario($id)
    {
        try {

            $data = DB::table('permiso')
                ->join('permiso_rol', 'permiso_rol.permiso_id', '=', 'permiso.id')
                ->join('rol', 'rol.id', '=', 'permiso_rol.rol_id')
                ->join('usuario_rol', 'usuario_rol.rol_id', '=', 'rol.id')
                ->join('usuario', 'usuario.id', '=', 'usuario_rol.usuario_id')
                ->where('usuario.id', '=', $id)
                ->select('permiso.*')
                ->get();

            return response()->json([
                'data' => $data,
                'estado' => true,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error insertando el empleado',
                'detalles' => $ex,
            ]);
        }
    }

    public function porRol()
    {
        try {
            $permisos = Permiso::select('id', 'titulo', 'componente')->get();

            foreach ($permisos as $permiso) {
                $permiso->roles = DB::table('permiso_rol')
                    ->join('rol', 'rol.id', '=', 'permiso_rol.rol_id')
                    ->where('permiso_rol.permiso_id', '=', $permiso->id)
                    ->select('rol.*')
                    ->get();
            }

            return response()->json([
                'data' => $permisos,
                'estado' => true,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error consultando los roles por permiso',
                'detalles' => $ex,
            ]);
        }
    }
}
