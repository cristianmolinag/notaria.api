<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
 
    public function index()
    {
        $usuarios = Usuario::All();
        return self::validarRespuesta($usuarios);
    }

    public function create(Request $request)
    {
        $usuario = new Usuario;
        $usuario->correo = $request->json('correo');
        $usuario->remember_token = str_random(32);
        $usuario->contrasena = self::encriptar($request->json('contrasena'));
        $usuario->estado = $request->json('estado');
        $usuario->save();

        return self::validarRespuesta($usuario);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);
        return self::validarRespuesta($usuario);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        $usuario->correo = $request->json('correo');
        $usuario->activo = $request->json('activo');
        if($request->json('contrasena') != "")
        $usuario->contrasena = self::encriptar($request->json('contrasena'));
        $usuario->save();

        return self::validarRespuesta($usuario);
    }

    public function getPermisos(Request $request){
        $api_token = $request->header('Api-Token');
        $usuario = Usuario::where('api_token', $api_token)->first();
        $usuario->getAllPermissions();
        return self::validarRespuesta($usuario);
    }

    private function validarRespuesta($data)
    {
        if($data){
            return Response()->json($data,201);
        }
        else{
            return Response()->json("Error inesperado, por favor contacte con su administrador",404);
        }
    }

    private function encriptar($contrasena)
    {
        return Hash::make($contrasena);
    }

    public function login(Request $request)
    {
        $usuario = Usuario::where('correo', $request->json('correo'))->first();
        if($usuario)
            if (Hash::check($request->json('contrasena'), $usuario->contrasena)) {

                switch ($request->json('tipo')) {
                    case 0: // cliente
                        $usuario = Cliente::with('usuario','persona')->where('estado', 1)->where('usuario_id', '=',$usuario->id)->first();
                        break;
                    case 1: // funcionario
                        $usuario = Funcionario::with('usuario', 'persona')->where('estado', 1)->where('usuario_id', '=',$usuario->id)->first();
                        break;
                }    
                return self::validarRespuesta($usuario);
            }
        return response()->json("Usuario incorrecto", 202);   
    }
}
