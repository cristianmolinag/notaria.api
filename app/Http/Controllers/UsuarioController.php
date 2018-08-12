<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function indexFuncionario()
    {

        $perfil = Perfil::where('nombre', 'Funcionario')->first();

        $data = Usuario::where('perfil_id', $perfil->id)->with('perfil', 'firma', 'usuario_rol')->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function loginCliente(Request $request)
    {
        $usuario = Usuario::where('correo', $request->json('correo'))->first();

        if ($usuario) {
            $perfil = Perfil::find($usuario->perfil_id);
            if ($perfil->nombre == 'Cliente') {
                if (Hash::check($request->json('contrasena'), $usuario->contrasena)) {
                    return response()->json([
                        'data' => $usuario->with('perfil')->first(),
                    ], 200);
                }
            }
        }

        return response()->json([
            'mensaje' => 'Usuario incorrecto',
        ]);
    }

    public function loginFuncionario(Request $request)
    {
        $usuario = Usuario::where('correo', $request->json('correo'))->first();
        if ($usuario) {
            $perfil = Perfil::find($usuario->perfil_id);
            if ($perfil->nombre == 'Funcionario') {
                if (Hash::check($request->json('contrasena'), $usuario->contrasena)) {
                    return response()->json([
                        'data' => $usuario->with('perfil')->first(),
                    ], 200);
                }
            }
        }

        return response()->json([
            'mensaje' => 'Usuario incorrecto',
        ]);
    }

    public function registroCliente(Request $request)
    {
        $perfil = Perfil::where('nombre', 'Cliente')->first();
        if ($request->json('id')) {
            $usuario = Usuario::find($request->json('id'));
        } else {
            $usuario = new Usuario();
        }

        try {
            $usuario->correo = $request->json('correo');
            $usuario->contrasena = Hash::make($request->json('contrasena'));
            $usuario->nombres = $request->json('nombres');
            $usuario->apellidos = $request->json('apellidos');
            $usuario->perfil_id = $perfil->id;
            $usuario->remember_token = str_random(32);
            $usuario->estado = 1;
            $usuario->save();

            return response()->json([
                'data' => $usuario->with('perfil')->first(),
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el usuario',
                'data' => $ex,
            ]);
        }

    }

    public function registroFuncionario(Request $request)
    {
        $perfil = Perfil::where('nombre', 'Funcionario')->first();

        if ($request->json('id')) {
            $usuario = Usuario::find($request->json('id'));
        } else {
            $usuario = new Usuario();
        }

        try {
            $usuario->correo = $request->json('correo');
            $usuario->contrasena = Hash::make($request->json('contrasena'));
            $usuario->nombres = $request->json('nombres');
            $usuario->apellidos = $request->json('apellidos');
            $usuario->perfil_id = $perfil->id;
            $usuario->remember_token = str_random(32);
            $usuario->estado = 1;
            $usuario->save();

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
