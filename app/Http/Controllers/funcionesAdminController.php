<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\funcion as Funcion;
use App\Models\pelicula as Pelicula;
use App\Models\sala as Sala;
use Carbon\Carbon;

class funcionesAdminController extends Controller
{
    public function index()
    {
        $funciones = Funcion::with(['pelicula', 'sala'])->orderByDesc('fecha')->get();
        $peliculas = Pelicula::all();
        $salas = Sala::all();
        return view('funcionesAdmin', compact('funciones', 'peliculas', 'salas'));
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'sala_id' => ['required', 'exists:salas,id'],
            'pelicula_id' => ['required', 'exists:peliculas,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'tipo' => ['required', 'string', 'max:50'],
            'costo' => ['required', 'numeric', 'min:0'],
        ]);

        $funcion = new Funcion();
        $funcion->sala_id = $validated['sala_id'];
        $funcion->pelicula_id = $validated['pelicula_id'];
    // combinar fecha y hora
    $funcion->start_time = Carbon::parse($validated['date'].' '.$validated['time']);
        $funcion->type = $validated['tipo'];
        $funcion->cost = $validated['costo'];
        $funcion->save();

        return redirect()->route('funciones.index');
    }
    
    public function delete($id)
    {
        $funcion = Funcion::find($id);
        if ($funcion) {
            $funcion->delete();
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $funcion = Funcion::with(['pelicula', 'sala'])->findOrFail($id);
        $peliculas = Pelicula::all();
        $salas = Sala::all();
        return view('funcionesAdmin-modifica', compact('funcion', 'peliculas', 'salas'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'sala_id' => ['required', 'exists:salas,id'],
            'pelicula_id' => ['required', 'exists:peliculas,id'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            'tipo' => ['required', 'string', 'max:50'],
            'costo' => ['required', 'numeric', 'min:0'],
        ]);

        $funcion = Funcion::findOrFail($id);
        $funcion->sala_id = $validated['sala_id'];
        $funcion->pelicula_id = $validated['pelicula_id'];
    $funcion->start_time = Carbon::parse($validated['date'].' '.$validated['time']);
        $funcion->type = $validated['tipo'];
        $funcion->cost = $validated['costo'];
        $funcion->save();

        return redirect()->route('funciones.index');
    }
}
