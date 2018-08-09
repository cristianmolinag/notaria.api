<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nacionalidad;

class NacionalidadController extends Controller
{
    public function index(){ //listado de nacionalidades

        $nacionalidades = Nacionalidad::All();
        return self::validarRespuesta($nacionalidades);
    } 

    public function create(Request $request){
        
        $nacionalidad = new Nacionalidad;
        $nacionalidad->nombre = $request->json('nombre');
        $nacionalidad->save();
        
        return self::validarRespuesta($nacionalidad);
    }

    public function find($id){

        $nacionalidad = Nacionalidad::find($id);
        return self::validarRespuesta($nacionalidad);
    }

    public function update(Request $request, $id){

        $nacionalidad = Nacionalidad::find($id);
        $nacionalidad->nombre = $request->json('nombre');
        $nacionalidad->save();

        return self::validarRespuesta($nacionalidad);
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
