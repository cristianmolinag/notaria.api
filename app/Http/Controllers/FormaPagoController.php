<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormaPago;

class FormaPagoController extends Controller
{

    public function index(){ //listado de generos

        $formasPago = FormaPago::All();
        return self::validarRespuesta($formasPago);
    } 

    public function create(Request $request){
        
        $formaPago = new FormaPago;
        $formaPago->nombre = $request->json('nombre');
        $formaPago->save();
        
        return self::validarRespuesta($formaPago);
    }

    public function find($id){

        $formaPago = FormaPago::find($id);
        return self::validarRespuesta($formaPago);
    }

    public function update(Request $request, $id){

        $formaPago = FormaPago::find($id);
        $formaPago->nombre = $request->json('nombre');
        $formaPago->save();

        return self::validarRespuesta($formaPago);
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
