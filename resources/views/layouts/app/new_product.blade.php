
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
<form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input name="nombre" type="text" class="form-control" id="inputName" placeholder="Nombre del producto">
                    <label for="floatingInput">Nombre del producto</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input name="precio" type="number" class="form-control" id="inputPrice" placeholder="Precio">
                    <label for="floatingInput">Precio</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <select class="form-control select2" id="exampleFormControlSelect2" name="ciudades[]" multiple="multiple">
                    <option value="1">Bogotá</option>
                    <option value="2">Cali</option>
                </select>
            </div>
            <div class="col">
                <div>
                    <div class="d-flex justify-content-center mb-4">
                        <img id="selectedAvatar" src="{{ asset('img/icons/ramoicon.png') }}"
                        style="width: 200px; height: 200px; object-fit: contain;" alt="example placeholder" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                            <label class="form-label text-white m-1" for="customFile">Cargar Imagen</label>
                            <input name="imagenes" type="file" class="form-control d-none" id="customFile" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="d-flex justify-content-center">
            <button id="btn_send_new_product" type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</form>