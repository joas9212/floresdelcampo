<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $producto = Producto::create($request->all());
    
        if ($request->has('imagenes')) {
            $ruta = $request->file('imagenes')->store('imagenes');
            $producto->imagenes()->create(['ruta' => $ruta]);
        }

        if ($request->has('ciudades')) {
            $producto->ciudades()->attach($request->input('ciudades'));
        }
    
        return redirect()->route('dashboard')->with('success', '¡Producto Guardado!');;
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $producto->update($request->all());
    
        $producto->imagenes()->delete();
    
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $ruta = $imagen->store('imagenes');
                $producto->imagenes()->create(['ruta' => $ruta]);
            }
        }
    
        if ($request->has('ciudades')) {
            $producto->ciudades()->sync($request->input('ciudades'));
        } else {
            $producto->ciudades()->detach();
        }
        
        return redirect()->route('productos.index');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente');
    }
}