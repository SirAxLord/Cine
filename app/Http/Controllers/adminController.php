<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\sala;
use App\Models\funcion;
use App\Models\pelicula;

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
}
