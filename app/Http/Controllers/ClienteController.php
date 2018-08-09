<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Persona;
use App\Models\Usuario;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function index()
    {

        $clientes = Cliente::with('persona', 'usuario')->get();
        return self::validarRespuesta($clientes);
    }

    public function create(Request $request)
    {
        try {

            $usuario = new Usuario();
            $persona = new Persona();
            $cliente = new Cliente();

            DB::transaction(function () use ($request, $usuario, $persona, $cliente) {

                $usuario->correo = $request->json('usuario.correo');
                $usuario->contrasena = Hash::make($request->json('usuario.contrasena'));
                $usuario->remember_token = str_random(32);
                $usuario->estado = 1;
                $usuario->save();

                $persona->documento = $request->json('persona.documento');
                $persona->primer_nombre = $request->json('persona.primer_nombre');
                $persona->segundo_nombre = $request->json('persona.segundo_nombre');
                $persona->primer_apellido = $request->json('persona.primer_apellido');
                $persona->segundo_apellido = $request->json('persona.segundo_apellido');
                $persona->tipo_documento_id = $request->json('persona.tipo_documento_id');
                $persona->nacionalidad_id = $request->json('persona.nacionalidad_id');
                $persona->save();

                $cliente->persona_id = $persona->id;
                $cliente->usuario_id = $usuario->id;
                $cliente->save();

            });
            return response()->json([
                'data' => $persona,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando la cuenta',
                'data' => $ex,
            ]);
        }
    }

    public function find($id)
    {

        $cliente = Cliente::with('persona', 'usuario')->where('id', '=', $id)->first();
        return self::validarRespuesta($cliente);
    }

    public function update(Request $request, $id)
    {

        $cliente = Cliente::find($id);
        $cliente->usuario_id = $request->json('usuario_id');
        $cliente->persona_id = $request->json('persona_id');
        $cliente->save();

        $cliente = Cliente::with('persona', 'usuario')->where('id', '=', $cliente->id)->get();
        return self::validarRespuesta($cliente);
    }

    public function login(Request $request)
    {

        $usuario = Usuario::where('correo', $request->json('correo'))->first();
        if ($usuario) {
            if (Hash::check($request->json('contrasena'), $usuario->contrasena)) {

                $cliente = Cliente::where('usuario_id', $usuario->id)->first();
                $persona = Persona::where('id', $cliente->persona_id)->first();
                return response()->json([
                    'data' => [
                        'nombre' => "$persona->primer_nombre $persona->segundo_nombre",
                        'perfil' => "cliente",
                        'remember_token' => $usuario->remember_token,
                    ],
                ], 200);
            }
        }

        return response()->json([
            'mensaje' => 'Usuario y/o contraseña incorrectos',
        ]);
    }

}
