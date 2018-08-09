<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RCNacimiento;

class RCNacimientoController extends Controller
{
    public function index(){ //listado de Registro de nacimiento

        $reg_nacimiento = RCNacimiento::All();
        return self::validarRespuesta($reg_nacimiento);
    }

    public function create(Request $request){
        
        $reg_nacimiento = new RCNacimiento;
        
        $reg_nacimiento->fecha_nacimiento = $request->json('fecha_nacimiento');
        $reg_nacimiento->fecha_inscripcion = $request->json('fecha_inscripcion');
        $reg_nacimiento->firma_reconocimiento = $request->json('firma_reconocimiento');
        $reg_nacimiento->genero_id = $request->json('genero_id');
        $reg_nacimiento->persona_id = $request->json('persona_id');
        $reg_nacimiento->madre_id = $request->json('madre_id');
        $reg_nacimiento->padre_id = $request->json('padre_id');
        $reg_nacimiento->declarante_id = $request->json('declarante_id');
        $reg_nacimiento->testigo1_id = $request->json('testigo1_id');
        $reg_nacimiento->testigo2_id = $request->json('testigo2_id');
        $reg_nacimiento->funcionario_autoriza_id = $request->json('funcionario_autoriza_id');
        $reg_nacimiento->funcionario_tramite_id = $request->json('funcionario_tramite_id');
        $reg_nacimiento->notas = $request->json('notas');
        $reg_nacimiento->save();
        
        return self::validarRespuesta($reg_nacimiento);
    }

    public function find($id){

        $reg_nacimiento = RCNacimiento::find($id);
        return self::validarRespuesta($reg_nacimiento);
    }

    public function update(Request $request, $id){

        $reg_nacimiento = RCNacimiento::find($id);

        $reg_nacimiento->fecha_nacimiento = $request->json('fecha_nacimiento');
        $reg_nacimiento->fecha_inscripcion = $request->json('fecha_inscripcion');
        $reg_nacimiento->firma_reconocimiento = $request->json('firma_reconocimiento');
        $reg_nacimiento->genero_id = $request->json('genero_id');
        $reg_nacimiento->persona_id = $request->json('persona_id');
        $reg_nacimiento->madre_id = $request->json('madre_id');
        $reg_nacimiento->padre_id = $request->json('padre_id');
        $reg_nacimiento->declarante_id = $request->json('declarante_id');
        $reg_nacimiento->testigo1_id = $request->json('testigo1_id');
        $reg_nacimiento->testigo2_id = $request->json('testigo2_id');
        $reg_nacimiento->funcionario_autoriza_id = $request->json('funcionario_autoriza_id');
        $reg_nacimiento->funcionario_tramite_id = $request->json('funcionario_tramite_id');
        $reg_nacimiento->notas= $request->json('notas');
        $reg_nacimiento->save();

        return self::validarRespuesta($reg_nacimiento);
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
