<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();

            $producto = Producto::create($request->all());

            if ($request->has('imagenes')) {
                $ruta = $request->file('imagenes')->store('imagenes', 'public');
                $producto->imagenes()->create(['ruta' => $ruta]);
            }

            if ($request->has('ciudades')) {
                $producto->ciudades()->attach($request->input('ciudades'));
            }

            if ($request->has('categorias')) {
                $producto->categorias()->attach($request->input('categorias'));
            }

            DB::commit();

            return redirect()->route('new_product')->with([
                'success' => '¡Producto Guardado!'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Ha ocurrido un error al guardar el producto. Por favor, inténtalo de nuevo.'
            ]);
        }
    }


    public function edit(Producto $producto)
    {
        return view('layouts.app.product_edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        try {
            DB::beginTransaction();
            $producto->update($request->all());
        
            if ($request->has('imagenes')) {
                $ruta = $request->file('imagenes')->store('imagenes', 'public');
                $producto->imagenes()->create(['ruta' => $ruta]);
            }
        
            if ($request->has('ciudades')) {
                $producto->ciudades()->sync($request->input('ciudades'));
            } else {
                $producto->ciudades()->detach();
            }

            if ($request->has('categorias')) {
                $producto->categorias()->sync($request->input('categorias'));
            } else {
                $producto->categorias()->detach();
            }
            
            DB::commit();

            return redirect()->route('product_list')->with([
                'success' => '¡Producto Actualizado!'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Ha ocurrido un error al actializar el producto. Por favor, inténtalo de nuevo.'
            ]);
        }
    }

    public function destroy(Producto $producto)
    {
        try {
            DB::beginTransaction();
            $producto->delete();
            DB::commit();
            return redirect()->route('product_list')->with('success', 'Producto eliminado exitosamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Ha ocurrido un error al acteliminar el producto. Por favor, inténtalo de nuevo.'
            ]);
        }
    }
}