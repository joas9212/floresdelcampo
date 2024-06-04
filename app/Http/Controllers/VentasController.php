<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        return view('ventas.create');
    }

    public function store(Request $request)
    {
        Venta::create($request->all());
        return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente');
    }

    public function edit(Venta $venta)
    {
        return view('ventas.edit', compact('venta'));
    }

    public function update(Request $request, Venta $venta)
    {
        $venta->update($request->all());
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente');
    }

    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente');
    }
}
