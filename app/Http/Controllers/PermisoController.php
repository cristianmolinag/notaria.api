<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Rol;
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

            $roles = Rol::where('rol.id', '>', 1)->get();

            $permisos = Permiso::All();

            // foreach ($permisos as $permiso) {
            //     $permiso->roles = $roles;
            // }

            // foreach ($permisos as $key => $permiso) {
            //     foreach ($permisos->roles as $rol) {
            //         return $key;
            //         $permiso_rol = PermisoRol::where('rol_id', $permiso->id)
            //             ->where('permiso_id', $rol->id)
            //             ->first();
            //         if ($permiso_rol) {
            //             $rol->permiso_rol_id = $permiso_rol->id;
            //         }
            //     }
            // }

            for ($i = 0; $i < count($permisos); $i++) {
                $permisos[$i]->roles = $roles;
                for ($j = 0; $j < count($roles); $j++) {
                    // echo $permisos[$i]['id'];
                    // echo $permisos[$i]->roles[$j]['id'];
                    $item = DB::table('permiso_rol')
                        ->where('rol_id', '=', $permisos[$i]->roles[$j]['id'])
                        ->where('permiso_id', '=', $permisos[$i]['id'])
                        ->select('permiso_rol.*')
                        ->first();
                    // $item = json_decode(json_encode($item), true);
                    //if ($item) {
                    // print_r($item);
                    // } else {
                    //echo ' no hay nada ';
                    //   $permisos[$i]->roles[$j]->permiso_rol = 0;
                    // }
                    // echo $item;

                }
            }
            $permisos[0]->roles[2]->permiso_rol = $item;

            return $permisos;

            // foreach ($roles as $rol) {
            //     $permiso_rol = DB::table('permiso_rol')
            //         ->join('permiso', 'permiso_rol.permiso_id', '=', 'permiso.id')
            //         ->join('rol', 'rol.id', '=', 'permiso_rol.rol_id')
            //         ->where('permiso.id', '=', $id)
            //         ->where('rol.id', '=', $rol->id)
            //         ->select('permiso_rol.id')
            //         ->first();
            //     if ($permiso_rol) {
            //         $rol->permiso_rol_id = $permiso_rol->id;
            //     }
            // }

            // return response()->json([
            //     'data' => $roles,
            //     'estado' => true,
            // ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Error insertando el empleado',
                'detalles' => $ex,
            ]);
        }
    }
}
