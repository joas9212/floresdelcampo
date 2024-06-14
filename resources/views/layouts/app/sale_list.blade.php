@php
    use App\Models\Venta;
    
    $arrayventas = [];
    
    if(empty($findSaleById)){
        $misVentas = Venta::where('user_id', Auth::user()->id)->paginate(10, ['*'], 'propias_page');
        $ventasPendientes = Venta::where('estado', 'Pendiente')->paginate(10, ['*'], 'pendientes_page');
        $ventasAprobadas = Venta::where('estado', 'Aprobada')->paginate(10, ['*'], 'aprovadas_page');
        $ventasRechazadas = Venta::where('estado', 'Rechazada')->paginate(10, ['*'], 'rechazadas_page');
        $arrayventas = ['Mis ventas' => $misVentas, 
                        'Ventas Pendientes' => $ventasPendientes, 
                        'Ventas Aprobadas' => $ventasAprobadas,
                        'Ventas Rechazadas' => $ventasRechazadas];
    }else if(!empty($findSaleById)){
        $arrayventas = ['Venta' => $findSaleById];
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
                    <form action="{{ route('ventas.indexById') }}" method="GET" class="mb-4">
                        <div class="flex items-center">
                            <input type="text" name="venta_id" placeholder="Buscar por ID" class="form-input rounded-md shadow-sm mt-1 block" required>
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

        @foreach ($arrayventas as $key => $ventas)
            @if(!empty($ventas[0]))
                <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 mb-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-size-22">
                            <div class="container">
                                <h3 class="text-lg font-medium text-gray-700 mb-4">{{$key}}</h3>
                                <table class="table" style="font-size: 12px">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Pedido ID</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Fecha de Venta</th>
                                            <th>Vendedor</th>
                                            <th>Total Productos</th>
                                            <th>Costo del envio</th>
                                            <th>Total con envio</th>
                                            <th>Comprobantes de pago</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ventas as $venta)
                                            <tr>
                                                <td>{{ $venta->id }}</td>
                                                <td>{{ $venta->pedido->id }}</td>
                                                <td>{{ $venta->producto->nombre }}</td>
                                                <td>{{ $venta->cantidad }}</td>
                                                <td>{{ formatCurrency($venta->precio) }}</td>
                                                <td>{{ $venta->fecha_venta }}</td>
                                                <td>{{ $venta->user->name }}</td>
                                                <td>{{ formatCurrency($venta->valor_total) }}</td>
                                                <td>{{ formatCurrency($venta->pedido->costo_envio) }}</td>
                                                <td>{{ formatCurrency($venta->pedido->costo_envio + $venta->valor_total) }}</td>
                                                <td>
                                                    @foreach ($venta->comprobantes as $comprobante)
                                                        @if(isset($comprobante))
                                                            <a href="{{ asset('storage/' . $comprobante->ruta) }}" target="_blank">Ver Comprobante</a></br>
                                                        @else
                                                            No hay comprobantes
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $venta->estado }}</td>
                                                <td>
                                                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-primary">Editar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Mostrar enlaces de paginación -->
                                @if($key == 'Mis ventas')
                                    {{ $misVentas->appends(['pendientes_page' => $ventasPendientes->currentPage(),
                                                          'aprobadas_page' => $ventasAprobadas->currentPage(),
                                                          'rechazadas_page' => $ventasRechazadas->currentPage()])->links() }}
                                @elseif($key == 'Ventas Pendientes')
                                    {{ $ventasPendientes->appends(['aprobadas_page' => $ventasAprobadas->currentPage(),
                                                                  'rechazadas_page' => $ventasRechazadas->currentPage(),
                                                                  'propias_page' => $misVentas->currentPage()])->links() }}
                                @elseif($key == 'Ventas Aprobadas')
                                    {{ $ventasAprobadas->appends(['pendientes_page' => $ventasPendientes->currentPage(),
                                                                  'rechazadas_page' => $ventasRechazadas->currentPage(),
                                                                  'propias_page' => $misVentas->currentPage()])->links() }}
                                @elseif($key == 'Ventas Rechazadas')
                                    {{ $ventasRechazadas->appends(['pendientes_page' => $ventasPendientes->currentPage(),
                                                                  'aprobadas_page' => $ventasAprobadas->currentPage(),
                                                                  'propias_page' => $misVentas->currentPage()])->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>
</x-app-layout>