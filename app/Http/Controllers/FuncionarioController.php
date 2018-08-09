<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function index(){ //listado de generos

        $funcionarios = Funcionario::with('persona', 'usuario')->get();
        return self::validarRespuesta($funcionarios);
    } 

    public function create(Request $request){
        
        $funcionario = new Funcionario;
        $funcionario->usuario_id = $request->json('usuario_id');
        $funcionario->persona_id = $request->json('persona_id');
        $funcionario->firma = $request->json('firma');
        $funcionario->save();

        $funcionario = Funcionario::with('persona', 'usuario')->where('id','=',$funcionario->id)->get();
        return self::validarRespuesta($funcionario);
    }

    public function find($id){

        $funcionario = Funcionario::with('persona', 'usuario')->where('id','=',$id)->first();
        return self::validarRespuesta($funcionario);
    }

    public function update(Request $request, $id){

        $funcionario = Funcionario::find($id);
        $funcionario->usuario_id = $request->json('usuario_id');
        $funcionario->persona_id = $request->json('persona_id');
        $funcionario->firma = $request->json('firma');
        $funcionario->save();

        $funcionario = Funcionario::with('persona', 'usuario')->where('id','=',$funcionario->id)->get();
        return self::validarRespuesta($funcionario);
    }

    private function validarRespuesta($data)
    {
        if($data){
            return Response()->json($data,200);
        }
        else{
            return Response()->json("Error inesperado, por favor contacte con su administrador",404);
        }
    }
}
