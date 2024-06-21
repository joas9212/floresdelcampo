<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    public function index()
    {
        return Pedido::with(['venta','user','ciudad'])->get();;
    }

    public function indexById(Request $request)
    {
        $findOrderById = Pedido::where('id', $request->pedido_id)->get();
        if (empty($findOrderById[0])) {
            return redirect()->back()->withInput()->with([
                'error' => "No se encontró el pedido con ID: " . $request->pedido_id
            ]);
        }

        return view('layouts.app.order_list', compact('findOrderById'));
    }

    public function create()
    {
        return view('pedidos.create');
    }

    public function store(Request $request)
    {
        Pedido::create($request->all());
        return redirect()->route('pedidos.index')->with('success', 'Pedido creado exitosamente');
    }

    public function edit(Pedido $pedido)
    {
        return view('layouts.app.order_edit', compact('pedido'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        try {
            DB::beginTransaction();

            $pedido->update($request->all());
            
            DB::commit();

            return redirect()->route('order_list')->with('success', 'Pedido actualizado exitosamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Ha ocurrido un error al actualizar el pedido. Por favor, inténtalo de nuevo.'
            ]);
        }
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado exitosamente');
    }
}
