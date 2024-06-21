<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use Illuminate\Http\Request;

class MetodosPagoController extends Controller
{
    public function index()
    {
        return MetodoPago::all();
    }

    public function create()
    {
        return view('metodos_pago.create');
    }

    public function store(Request $request)
    {
        MetodoPago::create($request->all());
        return redirect()->route('metodos_pago.index')->with('success', 'Metodo de pago creado exitosamente');
    }

    public function edit(MetodoPago $inventario)
    {
        return view('metodos_pago.edit', compact('inventario'));
    }

    public function update(Request $request, MetodoPago $inventario)
    {
        $inventario->update($request->all());
        return redirect()->route('metodos_pago.index')->with('success', 'Metodo de pago actualizado exitosamente');
    }

    public function destroy(MetodoPago $inventario)
    {
        $inventario->delete();
        return redirect()->route('metodos_pago.index')->with('success', 'Metodo de pago eliminado exitosamente');
    }
}
