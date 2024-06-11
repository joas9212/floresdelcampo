@php
    use App\Models\Ciudad;
    use App\Models\Categoria;
    $ciudades = Ciudad::all();
    $categorias = Categoria::all();
@endphp

@if (session('success') && session('action') == '1')
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error') && session('action') == '1')
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-4">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-floating mb-3">
                    <input name="nombre" type="text" class="form-control" id="inputName" placeholder="Nombre del producto" required>
                    <label for="inputName">Nombre del producto</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-floating mb-3">
                    <input name="precio" type="number" class="form-control" id="inputPrice" placeholder="Precio" required>
                    <label for="inputPrice">Precio</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                <select class="form-control select2" id="ControlSelect2Cities" name="ciudades[]" multiple="multiple" required>
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 col-12">
                <select class="form-control select2" id="ControlSelect2Categories" name="categorias[]" multiple="multiple" required>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                <div>
                    <div class="d-flex justify-content-center mb-4">
                        <img id="selectedAvatar" src="{{ asset('img/icons/ramoicon.png') }}"
                        style="width: 200px; height: 200px; object-fit: contain;" alt="example placeholder" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                            <label class="form-label text-white m-1" for="customFile">Cargar Imagen</label>
                            <input name="imagenes" type="file" class="form-control d-none" id="customFile" required/>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="col-md-6 col-12"></div>
        </div>
    </div>
    <div class="row">
        <div class="d-flex justify-content-center">
            <button id="btn_send_new_product" type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</form>
