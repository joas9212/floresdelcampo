@php
    use App\Models\Ciudad;
    $ciudades = Ciudad::all();
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Editar Pedido')}}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success') )
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pedidos.update', $pedido->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4 " style="font-size: 12px">
                            <fieldset>
                                <legend>Datos del Envío</legend>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="nombre_destinatario" type="text" class="form-control" id="es_inputRecipientName" placeholder="Nombre del Destinatario" value="{{ $pedido->nombre_destinatario }}" required>
                                            <label for="es_inputRecipientName">Nombre del Destinatario</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="numero_contacto_destinatario" type="text" class="form-control" id="es_inputPhone" placeholder="Teléfono del Destinatario" value="{{ $pedido->numero_contacto_destinatario }}" required>
                                            <label for="es_inputPhone">Teléfono del Destinatario</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <select class="form-control" id="es_inputCiudadId" name="ciudad_id" required>
                                                <option value="" disabled selected>Seleccionar</option>
                                                @foreach ($ciudades as $ciudad)
                                                    <option value="{{ $ciudad->id }}" {{ $ciudad->id == $pedido->ciudad_id ? 'selected' : '' }}>{{ $ciudad->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <label for="es_inputCiudadId">Ciudad destino</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="direccion_destionatario" type="text" class="form-control" id="es_inputAdress" placeholder="Dirección del Destinatario" value="{{ $pedido->direccion_destionatario }}" required>
                                            <label for="es_inputAdress">Dirección del Destinatario</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating">
                                            <textarea name="mensaje_dedicatoria" class="form-control" placeholder="Mensaje o Dedicatoria" id="es_inputMessageDed" required>{{ $pedido->mensaje_dedicatoria }}</textarea>
                                            <label for="es_inputMessageDed">Mensaje o Dedicatoria</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <textarea name="observaciones" type="text" class="form-control" id="es_inputObservations" placeholder="Observaciones" required>{{ $pedido->observaciones }}</textarea>
                                            <label for="es_inputObservations">Observaciones o Comentarios</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating mb-3">
                                            <input name="costo_envio" min="0" max="99999999" type="number" class="form-control" id="es_CostSend" placeholder="Costo de envio" value="{{ $pedido->costo_envio }}" required>
                                            <label for="es_CostSend">Costo de envio</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating">
                                            <input type="datetime-local" name="fecha_envio" class="form-control" placeholder="Fecha de envio" id="es_inputDateSend" value="{{ date('Y-m-d\TH:i', strtotime($pedido->fecha_envio)) }}" required>
                                            <label for="es_inputDateSend">Fecha de envio</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating">
                                            @if(Auth::user()->rol == 'Administrador' || Auth::user()->rol == 'Aliado')
                                                <select class="form-control @error('estado') is-invalid @enderror" id="es_EstateOrder" name="estado" required>
                                                    <option value="Procesando" {{ $pedido->estado == 'Procesando' ? 'selected' : '' }}>Procesando</option>
                                                    <option value="Preparando" {{ $pedido->estado == 'Preparando' ? 'selected' : '' }}>Preparando</option>
                                                    <option value="Transito" {{ $pedido->estado == 'Transito' ? 'selected' : '' }}>Transito</option>
                                                    <option value="Entregado" {{ $pedido->estado == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                                </select>
                                                <label for="es_Estate">Estado del pedido</label>
                                                @error('estado')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <button id="es_btn_enter_sale" type="submit" class="btn btn-primary">Actualizar Pedido</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
