<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\RCDefuncion;
use App\Models\RCMatrimonio;
use App\Models\RCNacimiento;
use App\Models\Tramite;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TramiteController extends Controller
{

    public function find($id)
    {
        $data = RCDefuncion::with('inscritoDefuncion')->find($id);

        if (!$data) {
            $data = RCNacimiento::with('inscrito')->find($id);

            if (!$data) {
                $data = RCMatrimonio::with('contrayenteUno', 'contrayenteDos')->find($id);

                if (!$data) {
                    $data = RCNacimiento::with('inscrito')->where('inscrito_id', $id)->first();
                    if ($data) {
                        $data->tipo_registro = "rc_nacimiento";
                    }
                } else {
                    $data->tipo_registro = "rc_matrimonio";
                }
            } else {
                $data->tipo_registro = "rc_nacimiento";
            }
        } else {
            $data->tipo_registro = "rc_defuncion";
        }

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function index()
    {
        $data = Tramite::with('tipoTramite', 'estadoTramite')->orderBy('id', 'DESC')->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function buscar($id)
    {
        $data = Tramite::with('tipoTramite', 'estadoTramite')->where('cliente_id', '=', $id)->orderBy('id', 'DESC')->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {

        try {
            $registro = $request->json('registro');
            $tramite = new Tramite();
            DB::transaction(function () use ($request, $tramite, $registro) {

                $pago = new Pago();
                $pago->cod_autorizacion = ($request->json('cod_autorizacion')) ? $request->json('cod_autorizacion') : null;
                $pago->cod_transaccion = ($request->json('cod_transaccion')) ? $request->json('cod_transaccion') : null;
                $pago->valor = $request->json('tramite_valor');
                $pago->forma_pago_id = $request->json('forma_pago_id');
                $pago->save();

                $tramite->tipo_tramite_id = $request->json('tramite_id');
                $tramite->cliente_id = $request->json('cliente_id');
                $tramite->indicativo_Serial = $registro['indicativo_serial'];
                $tramite->estado_tramite_id = 1;
                $tramite->pago_id = $pago->id;
                $tramite->save();

            });

            return response()->json([
                'data' => $tramite,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error guardando el trámite',
                'data' => $ex,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $data = Tramite::find($id);
        $data->estado_tramite_id = $request->json('estado_tramite_id');
        $data->save();
        return response()->json([
            'data' => $data,
        ], 200);
    }
}
