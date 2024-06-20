<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Comprobante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return view('ventas.index', compact('ventas'));
    }

    public function indexById(Request $request)
    {
        $findSaleById = Venta::where('id', $request->venta_id)->get();
        if (empty($findSaleById[0])) {
            return redirect()->back()->withInput()->with([
                'error' => "No se encontró la venta con ID: " . $request->venta_id
            ]);
        }

        return view('layouts.app.sale_list', compact('findSaleById'));
    }

    public function create()
    {
        return view('ventas.create');
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Buscar o crear cliente por correo electrónico
            $cliente = Cliente::firstOrCreate(
                ['email' => $request->input('email_cliente')],
                [
                    'nombre' => $request->input('nombre_cliente'),
                    'telefono' => $request->input('telefono_cliente')
                ]
            );

            // Guardar la venta
            $venta = new Venta();
            $venta->producto_id = $request->input('producto_id');
            $venta->user_id = Auth::id();
            $venta->cliente_id = $cliente->id;
            $venta->cantidad = $request->input('cantidad');
            $venta->fecha_venta = $request->input('fecha_venta');
            $venta->precio = $request->input('precio');
            $venta->estado = $request->input('estado', 'Pendiente');
            $venta->valor_total = $request->input('valor_total');
            $venta->metodo_pago_id = $request->input('metodo_pago');
            $venta->ciudad_id = $request->input('ciudad_id');
            $venta->save();

            // Guardar el pedido
            $pedido = new Pedido();
            $pedido->venta_id = $venta->id;
            $pedido->ciudad_id = $request->input('ciudad_id');
            $pedido->user_id = null;
            $pedido->nombre_destinatario = $request->input('nombre_destinatario');
            $pedido->numero_contacto_destinatario = $request->input('numero_contacto_destinatario');
            $pedido->direccion_destionatario = $request->input('direccion_destionatario');
            $pedido->mensaje_dedicatoria = $request->input('mensaje_dedicatoria');
            $pedido->observaciones = $request->input('observaciones');
            $pedido->fecha_envio = $request->input('fecha_envio');
            $pedido->costo_envio = $request->input('costo_envio');
            $pedido->estado = $request->input('estado', 'Procesando');
            $pedido->save();

            // Guardar los comprobantes de pago
            if ($request->has('comprobantes_pago') && is_array($request->file('comprobantes_pago'))) {
                foreach ($request->file('comprobantes_pago') as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('comprobantes', 'public');
                        $comprobante = new Comprobante();
                        $comprobante->venta_id = $venta->id;
                        $comprobante->ruta = $path;
                        $comprobante->save();
                    }
                }
            }

            DB::commit();

            return redirect()->route('register_sale')->with([
                'success' => '¡Venta realizada correctamente!'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['
                error' => 'Ha ocurrido un error al registrar la venta. Por favor, inténtalo de nuevo.'
            ]);
        }
    }



    public function edit(Venta $venta)
    {
        return view('layouts.app.sale_edit', compact('venta'));
    }

    public function update(Request $request, Venta $venta)
    {
        if($request->input('estado_venta') == 'Aprobada'){
            $request->validate([
                'id_partner' => 'required|numeric|min:1',
            ]);
        }

        if ($request->input('id_partner') != null) {
            $request->validate([
                'estado_venta' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if ($value !== 'Aprobada') {
                            $fail('El estado de la venta debe ser Aprobada cuando hay un Aliado Asignado.');
                        }
                    },
                ],
            ]);
        }

        try {
            DB::beginTransaction();

            // Actualizar cliente (o crear si no existe)
            $cliente = Cliente::firstOrCreate(
                ['email' => $request->input('email_cliente')],
                [
                    'nombre' => $request->input('nombre_cliente'),
                    'telefono' => $request->input('telefono_cliente')
                ]
            );

            // Actualizar venta
            $venta->producto_id = $request->input('producto_id');
            $venta->cliente_id = $cliente->id;
            $venta->cantidad = $request->input('cantidad');
            $venta->fecha_venta = $request->input('fecha_venta');
            $venta->precio = $request->input('precio');
            $venta->valor_total = $request->input('valor_total');
            $venta->metodo_pago_id = $request->input('metodo_pago_id');
            $venta->ciudad_id = $request->input('ciudad_id');
            $venta->estado = $request->input('estado_venta');
            $venta->save();

            // Actualizar o crear pedido asociado
            if ($venta->pedido) {
                // Si existe un pedido asociado, actualizarlo
                $pedido = $venta->pedido;
            } else {
                // Si no existe, crear uno nuevo
                $pedido = new Pedido();
                $pedido->venta_id = $venta->id;
            }
            $pedido->user_id = $request->input('id_partner', null);
            $pedido->ciudad_id = $request->input('ciudad_id');
            $pedido->nombre_destinatario = $request->input('nombre_destinatario');
            $pedido->numero_contacto_destinatario = $request->input('numero_contacto_destinatario');
            $pedido->direccion_destionatario = $request->input('direccion_destionatario');
            $pedido->mensaje_dedicatoria = $request->input('mensaje_dedicatoria');
            $pedido->observaciones = $request->input('observaciones');
            $pedido->fecha_envio = $request->input('fecha_envio');
            $pedido->costo_envio = $request->input('costo_envio');
            $pedido->save();

            // Guardar los comprobantes de pago
            if ($request->has('comprobantes_pago') && is_array($request->file('comprobantes_pago'))) {
                foreach ($request->file('comprobantes_pago') as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('comprobantes', 'public');
                        $comprobante = new Comprobante();
                        $comprobante->venta_id = $venta->id;
                        $comprobante->ruta = $path;
                        $comprobante->save();
                    }
                }
            }

            DB::commit();

            return redirect()->route('sale_list')->with('success', 'Venta actualizada exitosamente');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Ha ocurrido un error al actualizar la venta. Por favor, inténtalo de nuevo.'
            ]);
        }
    }


    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente');
    }
}
