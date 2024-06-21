<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

class PaisesController extends Controller
{
    public function index()
    {
        $paises = Pais::all();
        return view('paises.index', compact('paises'));
    }

    public function create()
    {
        return view('paises.create');
    }

    public function store(Request $request)
    {
        Pais::create($request->all());
        return redirect()->route('paises.index')->with('success', 'País creado exitosamente');
    }

    public function edit(Pais $pais)
    {
        return view('paises.edit', compact('pais'));
    }

    public function update(Request $request, Pais $pais)
    {
        $pais->update($request->all());
        return redirect()->route('paises.index')->with('success', 'País actualizado exitosamente');
    }

    public function destroy(Pais $pais)
    {
        $pais->delete();
        return redirect()->route('paises.index')->with('success', 'País eliminado exitosamente');
    }
}
