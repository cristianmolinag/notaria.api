<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoDocumento;

class TipoDocumentoController extends Controller
{
    public function index(){ //listado de tipos de documento

        $tipos = TipoDocumento::All();
        return self::validarRespuesta($tipos);
    } 

    public function create(Request $request){
        
        $tipo = new TipoDocumento;
        $tipo->nombre = $request->json('nombre');
        $tipo->save();
        
        return self::validarRespuesta($tipo);
    }

    public function find($id){

        $tipo = TipoDocumento::find($id);
        return self::validarRespuesta($tipo);
    }

    public function update(Request $request, $id){

        $tipo = TipoDocumento::find($id);
        $tipo->nombre = $request->json('nombre');
        $tipo->save();

        return self::validarRespuesta($tipo);
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
