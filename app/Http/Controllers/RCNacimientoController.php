<?php

namespace App\Http\Controllers;

use App\Models\Declarante;
use App\Models\Inscrito;
use App\Models\Madre;
use App\Models\Padre;
use App\Models\RCNacimiento;
use App\Models\Testigo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RCNacimientoController extends Controller
{
    public function index()
    {
        $data = RCNacimiento::All();

        return response()->json([
            'data' => $data,
        ], 200);

    }

    public function find($id)
    {
        $registro = RCNacimiento::where('nuip', '=', $id)
            ->first();

        return response()->json([
            'data' => $registro,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $data = new RCNacimiento();
            DB::transaction(function () use ($request, $data) {

                //Insertar inscrito
                $inscrito = new Inscrito();
                $inscrito->primer_apellido = $request->json('inscrito_primer_apellido');
                $inscrito->segundo_apellido = $request->json('inscrito_segundo_apellido');
                $inscrito->nombres = $request->json('inscrito_nombres');
                $inscrito->fecha_nacimiento = $request->json('inscrito_fecha_nacimiento');
                $inscrito->genero_id = $request->json('inscrito_genero_id');
                $inscrito->grupo_sanguineo_id = $request->json('inscrito_grupo_sanguineo_id');
                $inscrito->factor_rh_id = $request->json('inscrito_factor_rh_id');
                $inscrito->lugar_nacimiento = $request->json('inscrito_lugar_nacimiento');
                $inscrito->tipo_inscrito = "rc_nacimiento";
                $inscrito->save();

                //Insertar madre
                if ($request->json('madre_id')) {
                    $madre = Madre::find($request->json('madre_id'));
                    $madre->nombres = $request->json('madre_nombres');
                    $madre->tipo_documento_id = $request->json('madre_tipo_documento_id');
                    $madre->documento = $request->json('madre_documento');
                    $madre->pais_id = $request->json('madre_pais_id');
                    $madre->save();

                } else {
                    $madre = new Madre();
                    $madre->nombres = $request->json('madre_nombres');
                    $madre->tipo_documento_id = $request->json('madre_tipo_documento_id');
                    $madre->documento = $request->json('madre_documento');
                    $madre->pais_id = $request->json('madre_pais_id');
                    $madre->save();
                }

                //Insertar padre
                if ($request->json('padre_id')) {
                    $padre = Padre::find($request->json('padre_id'));
                    $padre->nombres = $request->json('padre_nombres');
                    $padre->tipo_documento_id = $request->json('padre_tipo_documento_id');
                    $padre->documento = $request->json('padre_documento');
                    $padre->pais_id = $request->json('padre_pais_id');
                    $padre->save();
                } else {
                    $padre = new Padre();
                    if ($request->json('padre_documento')) {
                        $padre->nombres = $request->json('padre_nombres');
                        $padre->tipo_documento_id = $request->json('padre_tipo_documento_id');
                        $padre->documento = $request->json('padre_documento');
                        $padre->pais_id = $request->json('padre_pais_id');
                        $padre->save();
                    }
                }

                //Insertar delcarante
                if ($request->json('declarante_id')) {
                    $declarante = Declarante::find($request->json('declarante_id'));
                    $declarante->nombres = $request->json('declarante_nombres');
                    $declarante->tipo_documento_id = $request->json('declarante_tipo_documento_id');
                    $declarante->documento = $request->json('declarante_documento');
                    $declarante->firma_declarante = $request->json('declarante_firma');
                    $declarante->save();
                } else {
                    $declarante = new Declarante();
                    $declarante->nombres = $request->json('declarante_nombres');
                    $declarante->tipo_documento_id = $request->json('declarante_tipo_documento_id');
                    $declarante->documento = $request->json('declarante_documento');
                    $declarante->firma_declarante = $request->json('declarante_firma');
                    $declarante->save();
                }

                //Insertar testigo 1
                if ($request->json('testigo_uno_id')) {
                    $testigoUno = Testigo::find($request->json('testigo_uno_id'));
                    $testigoUno->nombres = $request->json('testigo_uno_nombres');
                    $testigoUno->tipo_documento_id = $request->json('testigo_uno_tipo_documento_id');
                    $testigoUno->documento = $request->json('testigo_uno_documento');
                    $testigoUno->firma_testigo = $request->json('firma_testigo_uno');
                    $testigoUno->save();

                } else {
                    $testigoUno = new Testigo();
                    if ($request->json('testigo_uno_documento')) {
                        $testigoUno->nombres = $request->json('testigo_uno_nombres');
                        $testigoUno->tipo_documento_id = $request->json('testigo_uno_tipo_documento_id');
                        $testigoUno->documento = $request->json('testigo_uno_documento');
                        $testigoUno->firma_testigo = $request->json('firma_testigo_uno');
                        $testigoUno->save();
                    }
                }

                //Insertar testigo 2
                if ($request->json('testigo_dos_id')) {
                    $testigoDos = Testigo::find($request->json('testigo_dos_id'));
                    $testigoDos->nombres = $request->json('testigo_dos_nombres');
                    $testigoDos->tipo_documento_id = $request->json('testigo_dos_tipo_documento_id');
                    $testigoDos->documento = $request->json('testigo_dos_documento');
                    $testigoDos->firma_testigo = $request->json('firma_testigo_dos');
                    $testigoDos->save();
                } else {
                    $testigoDos = new Testigo();
                    if ($request->json('testigo_dos_documento')) {
                        $testigoDos->nombres = $request->json('testigo_dos_nombres');
                        $testigoDos->tipo_documento_id = $request->json('testigo_dos_tipo_documento_id');
                        $testigoDos->documento = $request->json('testigo_dos_documento');
                        $testigoDos->firma_testigo = $request->json('firma_testigo_dos');
                        $testigoDos->save();
                    }
                }

                //Insertar registro civil de nacimiento
                $data->inscrito_id = $inscrito->nuip;
                $data->antecedente_id = $request->json('antecedente_id');
                $data->num_nacido_vivo = $request->json('num_nacido_vivo');
                $data->madre_id = $madre->id;
                $data->padre_id = ($padre->id) ? $padre->id : null;
                $data->declarante_id = $declarante->id;
                $data->testigo_uno_id = ($testigoUno->id) ? $testigoUno->id : null;
                $data->testigo_dos_id = ($testigoDos) ? $testigoDos->id : null;
                $data->notas_marginales = $request->json('notas_marginales');
                $data->save();

            });

            return response()->json([
                'data' => $data,
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el registro civil',
                'data' => $ex,
            ]);

        }

    }

}
