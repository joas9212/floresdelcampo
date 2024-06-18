<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            Categoria::create($request->all());
            DB::commit();
            return redirect()->route('admin_panel')->with([
                'success' => 'Categoria creada exitosamente',
                'tab' => '3']);
        }catch(Exception $e){
            DB::rollBack();
            Categoria::create($request->all());
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Ha ocurrido un error al registrar la categoria. Por favor, inténtalo de nuevo.',
                'tab' => '3']);
        }
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $categoria->update($request->all());
        return redirect()->route('categorias.index')->with('success', 'Categoria actualizada exitosamente');
    }

    public function destroy(Categoria $categoria)
    {
        try{
            DB::beginTransaction();
            $categoria->delete();
            DB::commit();
            return redirect()->route('admin_panel')->with([
                'success' => 'Categoria eliminada exitosamente',
                'tab' => '3']
            );
        }catch(Exception $e){
            DB::rollBack();
            $categoria->delete();
            return redirect()->route('admin_panel')->with('success', 'Categoria eliminada exitosamente');
        }
    }
}
