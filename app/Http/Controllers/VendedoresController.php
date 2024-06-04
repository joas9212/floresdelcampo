<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;

class VendedoresController extends Controller
{
    public function index()
    {
        $vendedores = Vendedor::all();
        return view('vendedores.index', compact('vendedores'));
    }

    public function create()
    {
        return view('vendedores.create');
    }

    public function store(Request $request)
    {
        Vendedor::create($request->all());
        return redirect()->route('vendedores.index')->with('success', 'Vendedor creado exitosamente');
    }

    public function edit(Vendedor $vendedor)
    {
        return view('vendedores.edit', compact('vendedor'));
    }

    public function update(Request $request, Vendedor $vendedor)
    {
        $vendedor->update($request->all());
        return redirect()->route('vendedores.index')->with('success', 'Vendedor actualizado exitosamente');
    }

    public function destroy(Vendedor $vendedor)
    {
        $vendedor->delete();
        return redirect()->route('vendedores.index')->with('success', 'Vendedor eliminado exitosamente');
    }
}
