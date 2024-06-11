@php
    use App\Models\Producto;
    use App\Models\Ciudad;
    use App\Models\MetodoPago;
    $productos = Producto::all();
    $ciudades = Ciudad::all();
    $metodosPago = MetodoPago::all();
@endphp

@if (session('success') && session('action') == '2')
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error') && session('action') == '2')
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('ventas.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-4">
        <fieldset>
            <legend>Datos del Producto</legend>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <select class="form-control" id="es_selectProduct" name="producto_id" required>
                            <option value="" disabled selected>Seleccionar</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                        <label for="es_selectProduct">Producto</label>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <input name="cantidad" type="number" min=0 max=99999999 class="form-control" id="es_inputQuantity" placeholder="Cantidad" required>
                        <label for="es_inputQuantity">Cantidad</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <input name="fecha_venta" type="date" class="form-control" id="es_inputDate" placeholder="Fecha de Venta" required>
                        <label for="es_inputDate">Fecha de Venta</label>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <input name="precio"  min=0 type="number" max=99999999 class="form-control" id="es_inputPrice" placeholder="Precio" required>
                        <label for="es_inputPrice">Precio</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <input readonly name="valor_total" type="number" min=0 max=99999999 class="form-control" id="es_inputTotalValue" placeholder="Valor total" required>
                        <label for="es_inputTotalValue">Valor total</label>
                    </div>
                </div>
            </div>
        </fieldset>
        
        <fieldset>
            <legend>Datos del Comprador</legend>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <input name="nombre_cliente" type="text" class="form-control" id="es_inputClientName" placeholder="Nombre del Cliente" required>
                        <label for="es_inputClientName">Nombre del Cliente</label>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <input name="email_cliente" type="email" class="form-control" id="es_inputClientEmail" placeholder="Email del Cliente" required>
                        <label for="es_inputClientEmail">Email del Cliente</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <input name="telefono_cliente" type="text" class="form-control" id="es_inputClientPhone" placeholder="Teléfono del Cliente" required>
                        <label for="es_inputClientPhone">Teléfono del Cliente</label>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <select class="form-control" id="es_inputCiudadId" name="ciudad_id" required>
                            <option value="" disabled selected>Seleccionar</option>
                            @foreach ($ciudades as $ciudad)
                                @if ($ciudad->nombre != 'Todas' && $ciudad->nombre != 'Ninguna')
                                    <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
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
                        <select class="form-control" id="es_inputMetodoPago" name="metodo_pago" required>
                            <option value="" disabled selected>Seleccionar</option>
                            @foreach ($metodosPago as $metodoPago)
                                <option value="{{ $metodoPago->id }}">{{ $metodoPago->nombre }}</option>
                            @endforeach
                        </select>
                        <label for="es_inputMetodoPago">Método de pago</label>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="es_inputProofPay">Comprobantes de pago</label>
                        <input name="comprobantes_pago[]" type="file" class="form-control" id="es_inputProofPay" placeholder="Comprobante de pago" multiple required> 
                    </div>
                </div>
            </div>
        </fieldset>
        
        <fieldset>
            <legend>Datos de Envio</legend>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <input name="nombre_destinatario" type="text" class="form-control" id="es_inputRecipientName" placeholder="Nombre del Destinatario" required>
                        <label for="es_inputRecipientName">Nombre del Destinatario</label>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <input name="numero_contacto_destinatario" type="text" class="form-control" id="es_inputPhone" placeholder="Teléfono del Destinatario" required>
                        <label for="es_inputPhone">Teléfono del Destinatario</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <input name="direccion_destionatario" type="text" class="form-control" id="es_inputAdress" placeholder="Dirección del Destinatario" required>
                        <label for="es_inputAdress">Dirección del Destinatario</label>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-floating">
                        <textarea name="mensaje_dedicatoria" class="form-control" placeholder="Mensaje o Dedicatoria" id="es_inputMessageDed" required></textarea>
                        <label for="es_inputMessageDed">Mensaje o Dedicatoria</label>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <textarea name="observaciones" type="text" class="form-control" id="es_inputObservations" placeholder="Observaciones" required></textarea>
                        <label for="es_inputObservations">Observaciones o Comentarios</label>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-floating">
                        <input type="datetime-local" name="fecha_envio" class="form-control" placeholder="Fecha de envio" id="es_inputDateSend" required>
                        <label for="es_inputDateSend">Fecha de envio</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-floating mb-3">
                        <input name="costo_envio" min="0" max=99999999 type="number" class="form-control" id="es_CostSend" placeholder="Costo de envio" required>
                        <label for="es_CostSend">Costo de envio</label>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="row">
        <div class="d-flex justify-content-center">
            <button id="es_btn_enter_sale" type="submit" class="btn btn-primary">Registrar Venta</button>
        </div>
    </div>
</form>


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