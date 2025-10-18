<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sucursal as Sucursal;
use App\Models\sala as Sala;

class salasController extends Controller
{
    public function index()
    {
        $sucursales = Sucursal::all();
        $salas = Sala::with('sucursal')->get();
        return view('salas', compact('sucursales', 'salas'));
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'sucursal_id' => ['required', 'exists:sucursals,id'],
            'name' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:1'],
        ]);

        $sala = new Sala();
        $sala->sucursal_id = $validated['sucursal_id'];
        $sala->name = $validated['name'];
        $sala->capacity = $validated['capacity'];
        $sala->save();

        return redirect()->route('salas.index');
    }

    public function show($id)
    {
        $sala = Sala::with('sucursal')->findOrFail($id);
        $sucursales = Sucursal::all();
        return view('salas-modifica', compact('sala', 'sucursales'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'sucursal_id' => ['required', 'exists:sucursals,id'],
            'name' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:1'],
        ]);

        $sala = Sala::findOrFail($id);
        $sala->sucursal_id = $validated['sucursal_id'];
        $sala->name = $validated['name'];
        $sala->capacity = $validated['capacity'];
        $sala->save();

        return redirect()->route('salas.index');
    }

    public function delete($id)
    {
        $sala = Sala::find($id);
        if ($sala) {
            $sala->delete();
        }
        return redirect()->back();
    }
}
