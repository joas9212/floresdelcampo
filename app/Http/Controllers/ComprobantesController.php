<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComprobantesController extends Controller
{
    public function index()
    {
        $comprobantes = Comprobante::all();
        return view('comprobantes.index', compact('comprobantes'));
    }

    public function create()
    {
        return view('comprobantes.create');
    }

    public function store(Request $request)
    {
        Comprobante::create($request->all());
        return redirect()->route('comprobantes.index')->with('success', 'Comprobante creado exitosamente');
    }

    public function edit(Comprobante $comprobante)
    {
        return view('comprobantes.edit', compact('comprobante'));
    }

    public function update(Request $request, Comprobante $comprobante)
    {
        $comprobante->update($request->all());
        return redirect()->route('comprobantes.index')->with('success', 'Comprobante actualizado exitosamente');
    }

    public function destroy(Comprobante $comprobante)
    {
        $comprobante->delete();
        return redirect()->route('comprobantes.index')->with('success', 'Comprobante eliminado exitosamente');
    }
}
