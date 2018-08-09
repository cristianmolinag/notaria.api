<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tramite;

class TramiteController extends Controller
{
    public function index(){
        $tramites = Tramite::with('tipoTramite', 'estadoTramite', 'formaPago', 'cliente')->get();

        return self::validarRespuesta($tramites);
    } 

    public function create(Request $request){
        
        $tramite = new Tramite;
        $tramite->tipo_tramite_id = $request->json('tipo_tramite_id');
        $tramite->estado_tramite_id = $request->json('estado_tramite_id');
        $tramite->forma_pago_id = $request->json('forma_pago_id');
        $tramite->cliente_id = $request->json('cliente_id');
        $tramite->save();

        $tramite = Tramite::with('tipoTramite', 'estadoTramite', 'formaPago', 'cliente')->where('id','=',$tramite->id)->first();
        return self::validarRespuesta($tramite);
    }

    public function find($id){

        $tramite = Tramite::with('tipoTramite', 'estadoTramite', 'formaPago', 'cliente')->where('id','=',$id)->first();
        return self::validarRespuesta($tramite);
    }

    public function update(Request $request, $id){

        $tramite = Tramite::find($id);
        $tramite->estado_tramite_id = $request->json('estado_tramite_id');
        $tramite->save();

        $tramite = Tramite::with('tipoTramite', 'estadoTramite', 'formaPago', 'cliente')->where('id','=',$tramite->id)->get();
        return self::validarRespuesta($tramite);
    }

    private function validarRespuesta($data)
    {
        if($data){
            return Response()->json([
                "data"=> $data,
                "estado"=> false
            ]);
        }
        else{
            return Response()->json([
                "estado" => false,
                "mensaje" => "Error inesperado, por favor contacte con su administrador"
            ]);
        }
    }
}
