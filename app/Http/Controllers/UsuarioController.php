<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use App\Models\UsuarioRol;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function index()
    {
        $data = Usuario::All();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {
            $usuario = new Usuario;
            $rol = Rol::find($request->json('rol_id'));

            DB::transaction(function () use ($request, $usuario, $rol) {

                $usuario->correo = $request->json('correo');
                $usuario->nombres = $request->json('nombres');
                $usuario->apellidos = $request->json('apellidos');
                $usuario->contrasena = Hash::make($request->json('contrasena'));
                $usuario->remember_token = str_random(32);
                $usuario->save();

                $usuario_rol = new UsuarioRol;
                $usuario_rol->rol_id = $rol->id;
                $usuario_rol->usuario_id = $usuario->id;
                $usuario_rol->save();

            });
            return response()->json([
                'data' => $usuario,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el usuario',
                'data' => $ex,
            ]);
        }
    }

    public function login(Request $request)
    {
        $usuario = Usuario::where('correo', $request->json('correo'))->first();
        if ($usuario) {
            if (Hash::check($request->json('contrasena'), $usuario->contrasena)) {
                return response()->json([
                    'data' => $usuario,
                ], 200);
            }
        }

        return response()->json([
            'mensaje' => 'Usuario incorrecto',
        ]);
    }
}
