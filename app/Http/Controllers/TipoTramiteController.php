<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoTramite;

class TipoTramiteController extends Controller
{
    public function index(){ //listado de generos

        $tipoTramite = TipoTramite::All();
        return self::validarRespuesta($tipoTramite);
    } 

    public function create(Request $request){
        
        $tipoTramite = new TipoTramite;
        $tipoTramite->nombre = $request->json('nombre');
        $tipoTramite->valor = $request->json('valor');
        $tipoTramite->save();
        
        return self::validarRespuesta($tipoTramite);
    }

    public function find($id){

        $tipoTramite = TipoTramite::find($id);
        return self::validarRespuesta($tipoTramite);
    }

    public function update(Request $request, $id){

        $tipoTramite = TipoTramite::find($id);
        $tipoTramite->nombre = $request->json('nombre');
        $tipoTramite->valor = $request->json('valor');
        $tipoTramite->save();

        return self::validarRespuesta($tipoTramite);
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
