@php
    use App\Models\Pedido;
    
    $arrayOrders = [];
    
    if(empty($findOrderById)){

        $myOrders = Pedido::whereHas('venta', function($query) {
            $query->where('user_id', Auth::user()->id)->where('estado', 'Aprobada'); 
        })->paginate(10, ['*'], 'propios_page');

        $orders = Pedido::whereHas('venta', function($query) {
            $query->where('estado', 'Aprobada');})->paginate(10, ['*'], 'todos_page');

        $arrayOrders = ['Pedidos Creados por mi' => $myOrders,
                        'Pedidos Todos' => $orders];

    }else if(!empty($findOrderById)){
        $arrayOrders = ['Pedido' => $findOrderById];
    }

    function formatCurrency($amount) {
        return '$' . number_format($amount, 0, ',', '.');
    }
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Bienvenido ') . Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-4">

        <!-- Formulario de búsqueda para ventas pendientes -->
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
                <div class="container">
                    <form action="{{ route('pedidos.indexById') }}" method="GET" class="mb-4">
                        <div class="flex items-center">
                            <input type="text" name="pedido_id" placeholder="Buscar por ID" class="form-input rounded-md shadow-sm mt-1 block" required>
                            <button type="submit" class="ml-3 btn btn-primary">Buscar</button>
                        </div>
                    </form>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @foreach ($arrayOrders as $key => $orders)
            @if(!empty($orders[0]))
                <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 mb-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-size-22">
                            <div class="container">
                                <h3 class="text-lg font-medium text-gray-700 mb-4">{{$key}}</h3>
                                <table class="table" style="font-size: 12px">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Venta ID</th>
                                            <th>Nombre Destinatario</th>
                                            <th>Teléfono Destinatario</th>
                                            <th>Ciudad Destino</th>
                                            <th>Dirección Destino</th>
                                            <th>Mensaje o Dedicatoria</th>
                                            <th>Observaciones</th>
                                            <th>Fecha de recepción</th>
                                            <th>Costo de envio</th>
                                            <th>Aliado Asignado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <th>{{$order->id}}</th>
                                                <th>{{$order->venta->id}}</th>
                                                <th>{{$order->nombre_destinatario}}</th>
                                                <th>{{$order->numero_contacto_destinatario}}</th>
                                                <th>{{$order->ciudad->nombre}}</th>
                                                <th>{{$order->direccion_destionatario}}</th>
                                                <th>{{$order->mensaje_dedicatoria}}</th>
                                                <th>{{$order->observaciones}}</th>
                                                <th>{{$order->fecha_envio}}</th>
                                                <th>{{$order->costo_envio}}</th>
                                                <th>
                                                    @if(empty($order->user->name))
                                                        Sin asignar
                                                    @else
                                                        {{$order->user->name}}
                                                    @endif
                                                </th>
                                                <th>
                                                    <a href="{{ route('productos.edit', $order->id) }}" class="btn btn-primary">Editar</a>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Mostrar enlaces de paginación -->
                                @if($key == 'Pedidos Creados por mi')
                                    {{ $myOrders->appends(['todos_page' => $orders->currentPage()])->links() }}
                                @elseif($key == 'Pedidos Todos')
                                    {{ $orders->appends(['propios_page' => $myOrders->currentPage()])->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
        @endforeach

    </div>
</x-app-layout>