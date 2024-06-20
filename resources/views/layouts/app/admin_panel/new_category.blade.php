@php
    use App\Models\Categoria;
    $categorias = Categoria::all();
@endphp
<form method="POST" action="{{ route('categorias.store') }}">
    @csrf
    <div class="form-group mb-4" style="font-size: 12px">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-floating mb-3">
                    <input name="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" id="inputNombre" placeholder="Nombre de la categoría" value="{{ old('nombre') }}" required>
                    <label for="inputNombre">Nombre de la categoría</label>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="d-flex justify-content-center">
            <button id="btn_add_category" type="submit" class="btn btn-primary">Agregar Categoría</button>
        </div>
    </div>
</form>

<div class="table-responsive mt-5">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->nombre }}</td>
                    <td>
                        <form action="{{ route('categorias.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
