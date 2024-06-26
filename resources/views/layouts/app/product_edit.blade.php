@php
    use App\Models\Producto;
    use App\Models\Ciudad;
    use App\Models\Categoria;


    $ciudades = Ciudad::all();
    $categorias = Categoria::all();
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Editar Producto') }}
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

                    <form method="POST" action="{{ route('productos.update', $producto->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4" style="font-size: 12px">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input name="nombre" type="text" class="form-control" id="inputName" placeholder="Nombre del producto" value="{{ $producto->nombre }}" required>
                                        <label for="inputName">Nombre del producto</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input name="precio" type="number" class="form-control" id="inputPrice" placeholder="Precio" value="{{ $producto->precio }}" required>
                                        <label for="inputPrice">Precio</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <select class="form-control select2" id="ControlSelect2Cities" name="ciudades[]" multiple="multiple" required>
                                        @foreach ($ciudades as $ciudad)
                                            <option value="{{ $ciudad->id }}" {{ $producto->ciudades->contains($ciudad->id) ? 'selected' : '' }}>{{ $ciudad->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12">
                                    <select class="form-control select2" id="ControlSelect2Categories" name="categorias[]" multiple="multiple" required>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ $producto->categorias->contains($categoria->id) ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6 col-12">
                                    <div>
                                        <div class="d-flex justify-content-center mb-4">
                                            @if(!empty($producto->imagenes[0]))
                                                <img id="selectedAvatar" src="{{ asset('storage/' . $producto->imagenes[0]->ruta) }}" style="width: 200px; height: 200px; object-fit: contain;" alt="Imagen del producto" />
                                            @else
                                                <img id="selectedAvatar" src="{{ asset('img/icons/ramoicon.png') }}" style="width: 200px; height: 200px; object-fit: contain;" alt="Imagen del producto" />
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                                                <label class="form-label text-white m-1" for="customFile">Cargar Imagen</label>
                                                <input name="imagenes" type="file" class="form-control d-none" id="customFile"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <button id="btn_send_new_product" type="submit" class="btn btn-primary">Actualizar Producto</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
