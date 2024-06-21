<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use Illuminate\Http\Request;

class CiudadesController extends Controller
{
    public function index()
    {
        return Ciudad::with(['productos', 'pedidos', 'venta'])->get();
    }

    public function create()
    {
        return view('ciudades.create');
    }

    public function store(Request $request)
    {
        Ciudad::create($request->all());
        return redirect()->route('ciudades.index')->with('success', 'Ciudad creada exitosamente');
    }

    public function edit(Ciudad $ciudad)
    {
        return view('ciudades.edit', compact('ciudad'));
    }

    public function update(Request $request, Ciudad $ciudad)
    {
        $ciudad->update($request->all());
        return redirect()->route('ciudades.index')->with('success', 'Ciudad actualizada exitosamente');
    }

    public function destroy(Ciudad $ciudad)
    {
        $ciudad->delete();
        return redirect()->route('ciudades.index')->with('success', 'Ciudad eliminada exitosamente');
    }
}
