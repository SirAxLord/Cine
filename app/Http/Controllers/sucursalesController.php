<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sucursal as Sucursal;

class sucursalesController extends Controller
{
    public function index()
    {
        $sucursales = Sucursal::all();
        return view('sucursales', compact('sucursales'));
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'director' => ['required', 'string', 'max:255'],
        ]);

        $sucursal = new Sucursal();
        $sucursal->name = $validated['name'];
        $sucursal->address = $validated['address'];
        $sucursal->phone = $validated['phone'];
        $sucursal->director = $validated['director'];
        $sucursal->save();

        return redirect()->route('sucursales.index');
    }

    public function delete($id)
    {
        $sucursal = Sucursal::find($id);
        if ($sucursal) {
            $sucursal->delete();
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $sucursal = Sucursal::find($id);
        return view('sucursales-modifica', compact('sucursal'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'director' => ['required', 'string', 'max:255'],
        ]);

        $sucursal = Sucursal::findOrFail($id);
        $sucursal->name = $validated['name'];
        $sucursal->address = $validated['address'];
        $sucursal->phone = $validated['phone'];
        $sucursal->director = $validated['director'];
        $sucursal->save();

        return redirect()->route('sucursales.index');
    }
}

