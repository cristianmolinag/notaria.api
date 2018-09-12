<?php

namespace App\Http\Controllers;

use App\Models\Capitulacion;
use App\Models\Contrayente;
use App\Models\Denunciante;
use App\Models\Hijo;
use App\Models\HijoRCMatrimonio;
use App\Models\RCMatrimonio;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RCMatrimonioController extends Controller
{
    public function index()
    {
        $data = RCMatrimonio::
            with('firma', 'denunciante', 'contrayenteUno', 'contrayenteDos')
            ->get();

        return response()->json([
            'data' => $data,
        ], 200);

    }

    public function find($id)
    {
        $registro = RCMatrimonio::where('indicativo_serial', '=', $id)
            ->with('firma', 'denunciante', 'contrayenteUno', 'contrayenteDos')
            ->first();

        return response()->json([
            'data' => $registro,
        ], 200);
    }

    public function create(Request $request)
    {
        try {

            $data = new RCMatrimonio();
            DB::transaction(function () use ($request, $data) {

                //Insertar contrayente 1
                if ($request->json('contrayente_uno_id')) {
                    $contrayenteUno = Contrayente::find($request->json('contrayente_uno_id'));
                    $contrayenteUno->nombres = $request->json('contrayente_uno_nombres');
                    $contrayenteUno->tipo_documento_id = $request->json('contrayente_uno_tipo_documento_id');
                    $contrayenteUno->documento = $request->json('contrayente_uno_documento');
                    $contrayenteUno->save();

                } else {
                    $contrayenteUno = new Contrayente();
                    if ($request->json('contrayente_uno_documento')) {
                        $contrayenteUno->nombres = $request->json('contrayente_uno_nombres');
                        $contrayenteUno->tipo_documento_id = $request->json('contrayente_uno_tipo_documento_id');
                        $contrayenteUno->documento = $request->json('contrayente_uno_documento');
                        $contrayenteUno->save();
                    }
                }

                //Insertar contrayente 2
                if ($request->json('contrayente_dos_id')) {
                    $contrayenteDos = Contrayente::find($request->json('contrayente_dos_id'));
                    $contrayenteDos->nombres = $request->json('contrayente_dos_nombres');
                    $contrayenteDos->tipo_documento_id = $request->json('contrayente_dos_tipo_documento_id');
                    $contrayenteDos->documento = $request->json('contrayente_dos_documento');
                    $contrayenteDos->save();

                } else {
                    $contrayenteDos = new Contrayente();
                    if ($request->json('contrayente_dos_documento')) {
                        $contrayenteDos->nombres = $request->json('contrayente_dos_nombres');
                        $contrayenteDos->tipo_documento_id = $request->json('contrayente_dos_tipo_documento_id');
                        $contrayenteDos->documento = $request->json('contrayente_dos_documento');
                        $contrayenteDos->save();
                    }
                }

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

                //Insertar capitulacion
                $capitulacion = new Capitulacion();
                if ($request->json('capitulacion_num_escritura')) {
                    $capitulacion->num_escritura = $request->json('capitulacion_num_escritura');
                    $capitulacion->fecha_escritura = $request->json('capitulacion_fecha_escritura');
                    $capitulacion->lugar_escritura = $request->json('capitulacion_lugar_escritura');
                    $capitulacion->num_notaria = $request->json('capitulacion_num_notaria');
                    $capitulacion->save();
                }

                //Insertar registro civil de matrimonio
                $data->lugar_celebracion = $request->json('lugar_celebracion');
                $data->tipo_matrimonio = $request->json('tipo_matrimonio');
                $data->tipo_documento = $request->json('tipo_documento');
                $data->contrayente_uno_id = $contrayenteUno->id;
                $data->contrayente_dos_id = $contrayenteDos->id;
                $data->denunciante_id = $denunciante->id;
                $data->fecha_celebracion = $request->json('fecha_celebracion');
                $data->capitulacion_id = ($capitulacion->id) ? $capitulacion->id : null;
                $data->notas_marginales = $request->json('notas_marginales');
                $data->save();

                if ($request->json('hijo_uno_documento')) {
                    $hijoUno = new Hijo();
                    $hijoUno->nombres = $request->json('hijo_uno_nombres');
                    $hijoUno->documento = $request->json('hijo_uno_documento');
                    $hijoUno->tipo_documento_id = $request->json('hijo_uno_tipo_documento_id');
                    $hijoUno->indicativo_serial = $request->json('hijo_uno_indicativo_serial');
                    $hijoUno->save();

                    $hijo_matrimonioUno = new HijoRCMatrimonio();
                    $hijo_matrimonioUno->rc_matrimonio_id = $data->id;
                    $hijo_matrimonioUno->hijo_id = $hijoUno->id;
                    $hijo_matrimonioUno->save();
                }

                if ($request->json('hijo_dos_documento')) {
                    $hijoDos = new Hijo();
                    $hijoDos->nombres = $request->json('hijo_dos_nombres');
                    $hijoDos->documento = $request->json('hijo_dos_documento');
                    $hijoDos->tipo_documento_id = $request->json('hijo_dos_tipo_documento_id');
                    $hijoDos->indicativo_serial = $request->json('hijo_dos_indicativo_serial');
                    $hijoDos->save();

                    $hijo_matrimonioDos = new HijoRCMatrimonio();
                    $hijo_matrimonioDos->rc_matrimonio_id = $data->id;
                    $hijo_matrimonioDos->hijo_id = $hijoDos->id;
                    $hijo_matrimonioDos->save();
                }

            });

            return response()->json([
                'data' => RCMatrimonio::find($data->indicativo_serial)
                    ->with('firma', 'denunciante', 'contrayenteUno', 'contrayenteDos')
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
