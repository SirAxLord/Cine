<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\sala;
use App\Models\funcion;
use App\Models\pelicula;
use App\Imports\PeliculasImport;
use Maatwebsite\Excel\Facades\Excel;

class adminController extends Controller
{
  public function generarReportePeliculasSalas(Request $request)
  {
    $dompdf = new Dompdf();

    // Acepta tanto 'sala_id' como 'salas' (por compatibilidad con el formulario actual)
    $salaId = $request->input('sala_id', $request->input('salas'));

    // Cuando se solicita una sala específica, convertir a colección para que la vista itere igual
    if ($salaId) {
      $salas = sala::whereKey($salaId)->get();
    } else {
      $salas = sala::all();
    }

    // Obtener funciones y películas relacionadas
    $funciones = funcion::whereIn('sala_id', $salas->pluck('id'))
      ->orderBy('fecha')
      ->get();

    $peliculas = pelicula::whereIn('id', $funciones->pluck('pelicula_id')->unique())
      ->get();

    // Renderizar la vista del reporte
    $html = view('reportesPeliclas', compact('salas', 'funciones', 'peliculas'))->render();

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    return $dompdf->stream('reporte-peliculas-salas.pdf');
  }

  public function importarPeliculas(Request $request)
  {
    $validated = $request->validate([
      'archivo' => ['required', 'file', 'mimes:xlsx,xls,csv,txt', 'max:10240'],
    ]);

    try {
      Excel::import(new PeliculasImport, $validated['archivo']);
      return redirect()->route('peliculas.index')->with('status', 'Películas importadas correctamente.');
    } catch (\Throwable $e) {
      return redirect()->route('peliculas.index')->withErrors(['archivo' => 'Error al importar: '.$e->getMessage()]);
    }
  }
}
