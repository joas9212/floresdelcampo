<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Ciudad;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    public function index(Request $request)
    {
        // Obtener los parámetros de la solicitud
        $priceRange = $request->input('price_range');
        $category = $request->input('category');
        $city = $request->input('city');

        // Inicializar consulta de productos
        $productos = Producto::query();

        // Aplicar filtros según el rango de precios seleccionado
        if ($priceRange) {
            switch ($priceRange) {
                case '0-50000':
                    $productos->where('precio', '>=', 0)->where('precio', '<=', 50000);
                    break;
                case '50000-100000':
                    $productos->where('precio', '>=', 50000)->where('precio', '<=', 100000);
                    break;
                case '100000-150000':
                    $productos->where('precio', '>=', 100000)->where('precio', '<=', 150000);
                    break;
                case '200000+':
                    $productos->where('precio', '>=', 200000);
                    break;
            }
        }

        // Aplicar filtro por categoría
        if ($category) {
            switch ($category) {
                case 'all':
                    break;
                case 'Todas':
                    break;
                default:
                    $productos->whereHas('categorias', function($query) use ($category) {
                        $query->where('nombre', $category);
                    });
                    break;
            }
        }

        // Aplicar filtro por ciudad
        if ($city) {
            switch ($city) {
                case 'all':
                    break;
                case 1:
                    break;
                default:
                    $productos->whereHas('ciudades', function($query) use ($city) {
                        $query->where('ciudades.id', $city); // Especificar la tabla 'ciudades'
                    });
                    break;
            }
        }

        // Obtener la colección paginada de productos
        $productos = $productos->paginate(15);

        return view('welcome', [
            'productos' => $productos,
            'priceRange' => $priceRange,
            'category' => $category,
            'city' => $city,
        ]);
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