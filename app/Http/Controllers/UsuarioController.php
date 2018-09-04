<?php

namespace App\Http\Controllers;

use App\Models\Firma;
use App\Models\Perfil;
use App\Models\Rol;
use App\Models\Usuario;
use App\Models\UsuarioRol;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function indexFuncionario()
    {

        $perfil = Perfil::where('nombre', 'Funcionario')->first();

        $data = Usuario::where('perfil_id', $perfil->id)
            ->where('id', '>', 1)
            ->with('perfil', 'firma', 'usuario_rol')
            ->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function indexCliente()
    {

        $perfil = Perfil::where('nombre', 'Cliente')->first();

        $data = Usuario::where('perfil_id', $perfil->id)
            ->with('perfil', 'usuario_rol')
            ->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function login(Request $request)
    {
        $usuario = Usuario::where('correo', $request->json('correo'))->first();
        if (!!$usuario) {
            if (Hash::check($request->json('contrasena'), $usuario->contrasena)) {
                return response()->json([
                    'data' => Usuario::where('id', $usuario->id)->with('usuario_rol', 'perfil')->first(),
                ], 200);
            }
        }
        return response()->json([
            'mensaje' => 'Usuario incorrecto',
        ]);
    }

    public function registroCliente(Request $request)
    {
        $perfil = Perfil::where('nombre', 'Cliente')->first();
        $usuario = new Usuario();

        try {
            $usuario->correo = $request->json('correo');
            $usuario->contrasena = Hash::make($request->json('contrasena'));
            $usuario->nombres = $request->json('nombres');
            $usuario->apellidos = $request->json('apellidos');
            $usuario->perfil_id = $perfil->id;
            $usuario->remember_token = str_random(32);
            $usuario->estado = 1;
            $usuario->save();

            //Asignación del rol
            $rol = Rol::where('nombre', '=', 'Cliente')->first();

            $usuarioRol = new UsuarioRol();
            $usuarioRol->usuario_id = $usuario->id;
            $usuarioRol->rol_id = $rol->id;
            $usuarioRol->save();

            return response()->json([
                'data' => $usuario->with('perfil')->first(),
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el cliente',
                'data' => $ex,
            ]);
        }

    }

    public function updateCliente(Request $request, $id)
    {

        $usuario = Usuario::find($request->json('id'));

        try {
            $usuario->correo = $request->json('correo');
            $usuario->nombres = $request->json('nombres');
            $usuario->apellidos = $request->json('apellidos');
            if ($request->json('contrasena')) {
                $usuario->contrasena = Hash::make($request->json('contrasena'));
            }
            $usuario->save();

            return response()->json([
                'data' => $usuario->with('perfil')->first(),
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error editando el cliente',
                'data' => $ex,
            ]);
        }
    }

    public function registroFuncionario(Request $request)
    {
        $perfil = Perfil::where('nombre', 'Funcionario')->first();

        $usuario = new Usuario();
        $firmaF = $request->json('firma');

        try {
            $usuario->correo = $request->json('correo');
            $usuario->contrasena = Hash::make($request->json('contrasena'));
            $usuario->nombres = $request->json('nombres');
            $usuario->apellidos = $request->json('apellidos');
            $usuario->perfil_id = $perfil->id;
            $usuario->remember_token = str_random(32);
            $usuario->estado = 1;
            $usuario->save();

            $firma = new Firma();
            $firma->firma = $firmaF['firma'];
            $firma->usuario_id = $usuario->id;
            $firma->save();

            //Asignación del rol
            $usuarioRol = new UsuarioRol();
            $usuarioRol->usuario_id = $usuario->id;
            $usuarioRol->rol_id = $request->json('rol_id');
            $usuarioRol->save();

            return response()->json([
                'data' => $usuario->with('perfil', 'firma', 'usuario_rol')->first(),
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el funcionario',
                'data' => $ex,
            ]);
        }
    }

    public function updateFuncionario(Request $request, $id)
    {

        $usuario = Usuario::find($request->json('id'));
        $firmaF = $request->json('firma');
        $contrasena = $request->json('contrasena');

        try {
            $usuario->correo = $request->json('correo');
            $usuario->nombres = $request->json('nombres');
            $usuario->apellidos = $request->json('apellidos');
            if ($contrasena) {
                $usuario->contrasena = Hash::make($request->json('contrasena'));
            }
            $usuario->save();

            if ($firmaF['firma']) {
                $firma = Firma::where('usuario_id', $id)->first();
                $firma->firma = $firmaF['firma'];
                $firma->save();
            }

            //Asignación del rol
            $usuarioRol = UsuarioRol::where('usuario_id', '=', $usuario->id)->first();
            $usuarioRol->rol_id = $request->json('rol_id');
            $usuarioRol->save();

            return response()->json([
                'data' => $usuario->with('perfil')->first(),
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el funcionario',
                'data' => $ex,
            ]);
        }

    }
}
