@php
    use App\Models\Producto;
    use App\Models\Ciudad;
    use App\Models\MetodoPago;
    $productos = Producto::all();
    $ciudades = Ciudad::all();
    $metodosPago = MetodoPago::all();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Bienvenido ') . Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('ventas.update', $venta->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4" style="font-size: 12px">
                            <fieldset>
                                <legend>Datos de la venta</legend>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="es_selectProduct" name="producto_id" required>
                                                <option value="" disabled>Seleccionar</option>
                                                @foreach ($productos as $producto)
                                                    <option value="{{ $producto->id }}" {{ $venta->producto_id == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <label for="es_selectProduct">Producto</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="cantidad" type="number" min="0" max="99999999" class="form-control" id="es_inputQuantity" placeholder="Cantidad" value="{{ $venta->cantidad }}" required>
                                            <label for="es_inputQuantity">Cantidad</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="fecha_venta" type="date" class="form-control" id="es_inputDate" placeholder="Fecha de Venta" value="{{ $venta->fecha_venta }}" required>
                                            <label for="es_inputDate">Fecha de Venta</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="precio" min="0" type="number" max="99999999" class="form-control" id="es_inputPrice" placeholder="Precio" value="{{ $venta->precio }}" required>
                                            <label for="es_inputPrice">Precio</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input readonly name="valor_total" type="number" min="0" max="99999999" class="form-control" id="es_inputTotalValue" placeholder="Valor total" value="{{ $venta->valor_total }}" required>
                                            <label for="es_inputTotalValue">Valor total</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            @if(Auth::user()->rol == 'Administrador')
                                                <select class="form-control" id="es_Estate" name="estado_venta" required>
                                                    <option value="" disabled>Seleccionar</option>
                                                    <option value="Pendiente" {{ $venta->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                    <option value="Aprobada" {{ $venta->estado == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
                                                    <option value="Rechazada" {{ $venta->estado == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                                                </select>
                                                <label for="es_Estate">Estado de la venta</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            @foreach ($venta->comprobantes as $comprobante)
                                                @if(isset($comprobante))
                                                    <a href="{{ asset('storage/' . $comprobante->ruta) }}" target="_blank">Ver Comprobante</a></br>
                                                @else
                                                    No hay comprobantes
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <legend>Datos del Comprador</legend>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="nombre_cliente" type="text" class="form-control" id="es_inputClientName" placeholder="Nombre del Cliente" value="{{ $venta->cliente->nombre }}" required>
                                            <label for="es_inputClientName">Nombre del Cliente</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="email_cliente" type="email" class="form-control" id="es_inputClientEmail" placeholder="Email del Cliente" value="{{ $venta->cliente->email }}" required>
                                            <label for="es_inputClientEmail">Email del Cliente</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="telefono_cliente" type="text" class="form-control" id="es_inputClientPhone" placeholder="Teléfono del Cliente" value="{{ $venta->cliente->telefono }}" required>
                                            <label for="es_inputClientPhone">Teléfono del Cliente</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="es_inputCiudadId" name="ciudad_id" required>
                                                <option value="" disabled>Seleccionar</option>
                                                @foreach ($ciudades as $ciudad)
                                                    @if ($ciudad->nombre != 'Todas' && $ciudad->nombre != 'Ninguna')
                                                        <option value="{{ $ciudad->id }}" {{ $venta->ciudad_id == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->nombre }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <label for="es_inputCiudadId">Ciudad del comprador</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="es_inputMetodoPago" name="metodo_pago_id" required>
                                                <option value="" disabled>Seleccionar</option>
                                                @foreach ($metodosPago as $metodoPago)
                                                    <option value="{{ $metodoPago->id }}" {{ $venta->metodo_pago_id == $metodoPago->id ? 'selected' : '' }}>{{ $metodoPago->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <label for="es_inputMetodoPago">Método de pago</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="es_inputProofPay">Comprobantes de pago</label>
                                            <input name="comprobantes_pago[]" type="file" class="form-control" id="es_inputProofPay" placeholder="Comprobante de pago" multiple>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <legend>Datos de Envio</legend>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="nombre_destinatario" type="text" class="form-control" id="es_inputRecipientName" placeholder="Nombre del Destinatario" value="{{ $venta->pedido->nombre_destinatario }}" required>
                                            <label for="es_inputRecipientName">Nombre del Destinatario</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="numero_contacto_destinatario" type="text" class="form-control" id="es_inputPhone" placeholder="Teléfono del Destinatario" value="{{ $venta->pedido->numero_contacto_destinatario }}" required>
                                            <label for="es_inputPhone">Teléfono del Destinatario</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="direccion_destionatario" type="text" class="form-control" id="es_inputAdress" placeholder="Dirección del Destinatario" value="{{ $venta->pedido->direccion_destionatario }}" required>
                                            <label for="es_inputAdress">Dirección del Destinatario</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating">
                                            <textarea name="mensaje_dedicatoria" class="form-control" placeholder="Mensaje o Dedicatoria" id="es_inputMessageDed" required>{{ $venta->pedido->mensaje_dedicatoria }}</textarea>
                                            <label for="es_inputMessageDed">Mensaje o Dedicatoria</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <textarea name="observaciones" class="form-control" id="es_inputObservations" placeholder="Observaciones" required>{{ $venta->pedido->observaciones }}</textarea>
                                            <label for="es_inputObservations">Observaciones o Comentarios</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating">
                                            <input type="datetime-local" name="fecha_envio" class="form-control" placeholder="Fecha de envio" id="es_inputDateSend" value="{{ $venta->pedido->fecha_envio }}" required>
                                            <label for="es_inputDateSend">Fecha de envio</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="costo_envio" min="0" max="99999999" type="number" class="form-control" id="es_CostSend" placeholder="Costo de envio" value="{{ $venta->pedido->costo_envio }}" required>
                                            <label for="es_CostSend">Costo de envio</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <button id="es_btn_enter_sale" type="submit" class="btn btn-primary">Actualizar Venta</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectProduct = document.getElementById('es_selectProduct');
        const inputPrice = document.getElementById('es_inputPrice');
        const inputQuantity = document.getElementById('es_inputQuantity');
        const totalValue = document.getElementById('es_inputTotalValue');

        selectProduct.addEventListener('change', function () {
            const productId = this.value;
            const product = @json($productos->keyBy('id')->toArray())[productId];
            if (product) {
                inputPrice.value = parseInt(product.precio);
                totalValue.value = calculateTotalValue();
            } else {
                inputPrice.value = ''; 
            }
        });

        inputQuantity.addEventListener('change', function () {
            totalValue.value = calculateTotalValue();
        });

        inputPrice.addEventListener('change', function () {
            totalValue.value = calculateTotalValue();
        });

    });

    function calculateTotalValue() {
        const inputPrice = document.getElementById('es_inputPrice');
        const inputQuantity = document.getElementById('es_inputQuantity');
        const totalValue = document.getElementById('es_inputTotalValue');
        const quantity = inputQuantity.value;
        const price = inputPrice.value;
        let calcTotalValue = quantity * price;
        if(calcTotalValue < 99999999){
            calcTotalValue = calcTotalValue;
        }else{
            calcTotalValue = 99999999;
        }
        return calcTotalValue;
    }

</script>