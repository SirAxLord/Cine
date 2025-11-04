<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\funcion as Funcion;

class funcionesController extends Controller
{
    public function index()
    {
        $funciones = Funcion::with(['pelicula', 'sala.sucursal'])
            ->orderByDesc('fecha')
            ->get();

        return view('funciones', compact('funciones'));
    }

    public function show($id)
    {
        $funcion = Funcion::with(['pelicula', 'sala.sucursal'])->findOrFail($id);
        return view('funciones-detalle', compact('funcion'));
    }
}
