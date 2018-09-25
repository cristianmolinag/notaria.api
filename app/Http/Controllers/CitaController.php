<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $data = Cita::with('cliente')->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function find($id)
    {
        $data = Cita::where('cliente_id', $id)->with('cliente')->get();
        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $data = Cita::find($id);
        $data->estado = $request->json('estado');
        $data->save();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        $data = new Cita();
        $data->fecha = $request->json('fecha');
        $data->hora = $request->json('hora');
        $data->estado = "Asignada";
        $data->cliente_id = $request->json('cliente_id');
        $data->save();

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function getHoras(Request $request)
    {
        $data = Cita::where('fecha', $request->json('fecha'))
            ->where('hora', $request->json('hora'))
            ->get();

        return response()->json([
            'data' => $data,
        ], 200);
    }

}
