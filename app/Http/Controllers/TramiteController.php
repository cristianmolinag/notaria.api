<?php

namespace App\Http\Controllers;

use App\Models\RCDefuncion;
use App\Models\RCMatrimonio;
use App\Models\RCNacimiento;

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
}
