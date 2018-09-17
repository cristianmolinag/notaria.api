<?php

namespace App\Http\Controllers;

use App\Models\Denunciante;
use App\Models\InscritoDefuncion;
use App\Models\RCDefuncion;
use App\Models\Testigo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RCDefuncionController extends Controller
{
    public function index()
    {
        $data = RCDefuncion::
            with('inscritoDefuncion', 'denunciante', 'testigoUno', 'testigoDos', 'firma')
            ->get();

        return response()->json([
            'data' => $data,
        ], 200);

    }

    public function find($id)
    {
        $registro = RCDefuncion::where('indicativo_serial', '=', $id)
            ->with('inscritoDefuncion', 'denunciante', 'testigoUno', 'testigoDos', 'firma')
            ->first();

        return response()->json([
            'data' => $registro,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $data = new RCDefuncion();
            DB::transaction(function () use ($request, $data) {

                //Insertar inscrito
                $inscrito = new InscritoDefuncion();
                $inscrito->nombres = $request->json('inscrito_nombres');
                $inscrito->documento = $request->json('inscrito_documento');
                $inscrito->tipo_documento_id = $request->json('inscrito_tipo_documento_id');
                $inscrito->genero_id = $request->json('inscrito_genero_id');
                $inscrito->save();

                //Insertar denunciante
                if ($request->json('denunciante_id')) {
                    $denunciante = Denunciante::find($request->json('denunciante_id'));
                    $denunciante->nombres = $request->json('denunciante_nombres');
                    $denunciante->tipo_documento_id = $request->json('denunciante_tipo_documento_id');
                    $denunciante->documento = $request->json('denunciante_documento');
                    $denunciante->firma_denunciante = $request->json('denunciante_firma');
                    $denunciante->save();
                } else {
                    $denunciante = new Denunciante();
                    $denunciante->nombres = $request->json('denunciante_nombres');
                    $denunciante->tipo_documento_id = $request->json('denunciante_tipo_documento_id');
                    $denunciante->documento = $request->json('denunciante_documento');
                    $denunciante->firma_denunciante = $request->json('denunciante_firma');
                    $denunciante->save();
                }

                //Insertar testigo 1
                if ($request->json('testigo_uno_id')) {
                    $testigoUno = Testigo::find($request->json('testigo_uno_id'));
                    $testigoUno->nombres = $request->json('testigo_uno_nombres');
                    $testigoUno->tipo_documento_id = $request->json('testigo_uno_tipo_documento_id');
                    $testigoUno->documento = $request->json('testigo_uno_documento');
                    $testigoUno->firma_testigo = $request->json('testigo_uno_firma');
                    $testigoUno->save();

                } else {
                    $testigoUno = new Testigo();
                    if ($request->json('testigo_uno_documento')) {
                        $testigoUno->nombres = $request->json('testigo_uno_nombres');
                        $testigoUno->tipo_documento_id = $request->json('testigo_uno_tipo_documento_id');
                        $testigoUno->documento = $request->json('testigo_uno_documento');
                        $testigoUno->firma_testigo = $request->json('testigo_uno_firma');
                        $testigoUno->save();
                    }
                }

                //Insertar testigo 2
                if ($request->json('testigo_dos_id')) {
                    $testigoDos = Testigo::find($request->json('testigo_dos_id'));
                    $testigoDos->nombres = $request->json('testigo_dos_nombres');
                    $testigoDos->tipo_documento_id = $request->json('testigo_dos_tipo_documento_id');
                    $testigoDos->documento = $request->json('testigo_dos_documento');
                    $testigoDos->firma_testigo = $request->json('testigo_dos_firma');
                    $testigoDos->save();
                } else {
                    $testigoDos = new Testigo();
                    if ($request->json('testigo_dos_documento')) {
                        $testigoDos->nombres = $request->json('testigo_dos_nombres');
                        $testigoDos->tipo_documento_id = $request->json('testigo_dos_tipo_documento_id');
                        $testigoDos->documento = $request->json('testigo_dos_documento');
                        $testigoDos->firma_testigo = $request->json('testigo_dos_firma');
                        $testigoDos->save();
                    }
                }

                //Insertar registro civil de defuncion
                $data->inscrito_id = $inscrito->id;
                $data->lugar_defuncion = $request->json('lugar_defuncion');
                $data->fecha_defuncion = $request->json('fecha_defuncion');
                $data->hora_defuncion = $request->json('hora_defuncion');
                $data->certificado_defuncion = $request->json('certificado_defuncion');
                $data->juzgado = $request->json('juzgado_defuncion');
                $data->fecha_sentencia = $request->json('fecha_sentencia');
                $data->tipo_certificado = $request->json('tipo_certificado');
                $data->nombre_funcionario = $request->json('nombre_funcionario');
                $data->denunciante_id = $denunciante->id;
                $data->testigo_uno_id = ($testigoUno->id) ? $testigoUno->id : null;
                $data->testigo_dos_id = ($testigoDos) ? $testigoDos->id : null;
                $data->notas_marginales = $request->json('notas_marginales');
                $data->save();

            });

            return response()->json([
                'data' => RCDefuncion::find($data->indicativo_serial)
                    ->with('inscritoDefuncion', 'denunciante', 'testigoUno', 'testigoDos', 'firma')
                    ->first(),
            ], 200);

        } catch (QueryException $ex) {
            return response()->json([
                'mensaje' => 'Error creando el registro civil',
                'data' => $ex,
            ]);
        }
    }
}
