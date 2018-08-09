<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;

class GeneroController extends Controller
{
    public function index(){ //listado de generos

        $generos = Genero::All();
        return self::validarRespuesta($generos);
    } 

    public function create(Request $request){
        
        $genero = new Genero;
        $genero->nombre = $request->json('nombre');
        $genero->save();
        
        return self::validarRespuesta($genero);
    }

    public function find($id){

        $genero = Genero::find($id);
        return self::validarRespuesta($genero);
    }

    public function update(Request $request, $id){

        $genero = Genero::find($id);
        $genero->nombre = $request->json('nombre');
        $genero->save();

        return self::validarRespuesta($genero);
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
