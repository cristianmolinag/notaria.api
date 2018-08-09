<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstadoTramite;

class EstadoTramiteController extends Controller
{
    public function index(){ //listado de estados de tramite

        $estadoTramite = EstadoTramite::All();
        return self::validarRespuesta($estadoTramite);
    } 

    public function create(Request $request){
        
        $estadoTramite = new EstadoTramite;
        $estadoTramite->nombre = $request->json('nombre');
        $estadoTramite->save();
        
        return self::validarRespuesta($estadoTramite);
    }

    public function find($id){

        $estadoTramite = EstadoTramite::find($id);
        return self::validarRespuesta($estadoTramite);
    }

    public function update(Request $request, $id){

        $estadoTramite = EstadoTramite::find($id);
        $estadoTramite->nombre = $request->json('nombre');
        $estadoTramite->save();

        return self::validarRespuesta($estadoTramite);
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
