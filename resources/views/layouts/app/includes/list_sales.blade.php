@php
    use App\Models\Venta;
    $ventas = Venta::paginate(1);

    function formatCurrency($amount) {
        return '$' . number_format($amount, 0, ',', '.');
    }
@endphp

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Fecha de Venta</th>
                <th>Vendedor</th>
                <th>Total Productos</th>
                <th>Costo del envio</th>
                <th>Total con envio</th>
                <th>Comprobantes de pago</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
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
                    <td>
                        <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-primary">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mostrar enlaces de paginación -->
    {{ $ventas->links() }}
</div>
