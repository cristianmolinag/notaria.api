<?php

namespace App\Http\Controllers;

use App\Models\RCNacimiento;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RCNacimientoController extends Controller
{
    public function index()
    {
        $data = RCNacimiento::All();

        return response()->json([
            'data' => $data,
        ], 200);

    }

    public function create(Request $request)
    {
        try {
            $registro = new RCNacimiento();

            $registro->nuip = $request->json('nuip');
            $registro->indicativo_serial = $request->json('indicativo_serial');
            $registro->primer_apellido = $request->json('primer_apellido');
            $registro->segundo_apellido = $request->json('segundo_apellido');
            $registro->nombres = $request->json('nombres');
            $registro->fecha_nacimiento = $request->json('fecha_nacimiento');
            $registro->genero_id = $request->json('genero_id');
            $registro->grupo_sanguineo_id = $request->json('grupo_sanguineo_id');
            $registro->factor_rh_id = $request->json('factor_rh_id');
            $registro->lugar_nacimiento = $request->json('lugar_nacimiento', "la veredita");
            $registro->antecedente_id = $request->json('antecedente_id');
            $registro->num_nacido_vivo = $request->json('num_nacido_vivo');
            $registro->nombres_madre = $request->json('nombres_madre');
            $registro->tipo_documento_madre_id = $request->json('tipo_documento_madre_id');
            $registro->documento_madre = $request->json('documento_madre');
            $registro->pais_madre_id = $request->json('pais_madre_id');
            $registro->nombres_padre = $request->json('nombres_padre', null);
            $registro->tipo_documento_padre_id = $request->json('tipo_documento_padre_id', null);
            $registro->documento_padre = $request->json('documento_padre', null);
            $registro->pais_padre_id = $request->json('pais_padre_id', null);
            $registro->nombres_declarante = $request->json('nombres_declarante');
            $registro->tipo_documento_declarante_id = $request->json('tipo_documento_declarante_id');
            $registro->documento_declarante = $request->json('documento_declarante');
            $registro->firma_declarante = $request->json('firma_declarante');
            $registro->nombres_testigo_uno = $request->json('nombres_testigo_uno', null);
            $registro->tipo_documento_testigo_uno_id = $request->json('tipo_documento_testigo_uno_id', null);
            $registro->documento_testigo_uno = $request->json('nomdocumento_testigo_unobre', null);
            $registro->firma_testigo_uno = $request->json('firma_testigo_uno', null);
            $registro->nombres_testigo_dos = $request->json('nombres_testigo_dos', null);
            $registro->tipo_documento_testigo_dos_id = $request->json('tipo_documento_testigo_dos_id', null);
            $registro->documento_testigo_dos = $request->json('documento_testigo_dos', null);
            $registro->firma_testigo_dos = $request->json('firma_testigo_dos', null);
            $registro->notas_marginales = $request->json('notas_marginales', null);
            $registro->save();

            return response()->json([
                'data' => $registro,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el registro civil',
                'data' => $ex,
            ]);

        }

    }

}
