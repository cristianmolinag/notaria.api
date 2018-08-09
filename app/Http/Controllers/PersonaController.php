<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    public function index(){ //listado de generos

        $personas = Persona::All();
        return self::validarRespuesta($personas);
    } 

    public function create(Request $request){
        
        $persona = new Persona;
        $persona->primer_nombre = $request->json('primer_nombre');
        $persona->segundo_nombre = $request->json('segundo_nombre');
        $persona->primer_apellido = $request->json('primer_apellido');
        $persona->segundo_apellido = $request->json('segundo_apellido');
        $persona->documento = $request->json('documento');
        $persona->tipo_documento_id = $request->json('tipo_documento_id');
        $persona->nacionalidad_id = $request->json('nacionalidad_id');
        $persona->save();
        
        return self::validarRespuesta($persona);
    }

    public function find($id){

        $persona = Persona::find($id);
        return self::validarRespuesta($persona);
    }

    public function update(Request $request, $id){

        $persona = Persona::find($id);
        $persona->primer_nombre = $request->json('primer_nombre');
        $persona->segundo_nombre = $request->json('segundo_nombre');
        $persona->primer_apellido = $request->json('primer_apellido');
        $persona->segundo_apellido = $request->json('segundo_apellido');
        $persona->documento = $request->json('documento');
        $persona->tipo_documento_id = $request->json('tipo_documento_id');
        $persona->nacionalidad_id = $request->json('nacionalidad_id');
        $persona->save();

        return self::validarRespuesta($persona);
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
