@php
    use App\Models\Producto;
    
    $productos = Producto::paginate(15);
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido ') . Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Listado de Productos</h3>
                    <table class="table table-bordered" style="font-size: 12px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Ciudades</th>
                                <th>Categorías</th>
                                <th>Imagen</th>
                                @if (Auth::user()->rol == 'Administrador')
                                    <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->precio }}</td>
                                    <td>
                                        @foreach ($producto->ciudades as $ciudad)
                                            {{ $ciudad->nombre }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($producto->categorias as $categoria)
                                            {{ $categoria->nombre }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if(!empty($producto->imagenes[0]))
                                            <img src="{{ asset('storage/' . $producto->imagenes[0]->ruta) }}" style="max-width: 100px; max-height: 100px;">
                                        @else
                                            <img id="selectedAvatar" src="{{ asset('img/icons/ramoicon.png') }}" style="max-width: 100px; max-height: 100px;">
                                        @endif
                                    </td>
                                    @if (Auth::user()->rol == 'Administrador')
                                        <td>
                                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary">Editar</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $productos->links() }} 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
