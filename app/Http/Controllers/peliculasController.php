<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pelicula as Pelicula;

class peliculasController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::all();
        return view('peliculas', compact('peliculas'));
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'integer', 'min:1'],
            'director' => ['required', 'string', 'max:255'],
        ]);

        $pelicula = new Pelicula();
        $pelicula->title = $validated['title'];
        $pelicula->genre = $validated['genre'];
        $pelicula->duration = $validated['duration'];
        $pelicula->director = $validated['director'];
        $pelicula->save();

        return redirect()->route('peliculas.index');
    }

    public function delete($id)
    {
        $pelicula = Pelicula::find($id);
        if ($pelicula) {
            $pelicula->delete();
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $pelicula = Pelicula::find($id);
        return view('peliculas.modifica', compact('pelicula'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'integer', 'min:1'],
            'director' => ['required', 'string', 'max:255'],
        ]);

        $pelicula = Pelicula::findOrFail($id);
        $pelicula->title = $validated['title'];
        $pelicula->genre = $validated['genre'];
        $pelicula->duration = $validated['duration'];
        $pelicula->director = $validated['director'];
        $pelicula->save();

        return redirect()->route('peliculas.index');
    }
}
