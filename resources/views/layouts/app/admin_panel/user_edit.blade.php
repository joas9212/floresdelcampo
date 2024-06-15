<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Bienvenido ') . Auth::user()->name}}
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

                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4" style="font-size: 12px">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Nombre del usuario" value="{{ old('name', $user->name) }}" required>
                                        <label for="inputName">Nombre del usuario</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Correo electrónico" value="{{ old('email', $user->email) }}" required>
                                        <label for="inputEmail">Correo electrónico</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-control @error('rol') is-invalid @enderror" id="es_Estate" name="rol" required>
                                            <option value="Vendedor" {{ old('rol', $user->rol) == 'Vendedor' ? 'selected' : '' }}>Vendedor</option>
                                            <option value="Aliado" {{ old('rol', $user->rol) == 'Aliado' ? 'selected' : '' }}>Aliado</option>
                                            <option value="Administrador" {{ old('rol', $user->rol) == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                                        </select>
                                        <label for="es_Estate">Rol del usuario</label>
                                        @error('rol')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" placeholder="Contraseña">
                                        <label for="inputPassword">Contraseña (dejar en blanco si no desea cambiarla)</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputPasswordConfirmation" placeholder="Confirmar Contraseña">
                                        <label for="inputPasswordConfirmation">Confirmar Contraseña</label>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <button id="btn_update_user" type="submit" class="btn btn-primary">Actualizar Usuario</button>
                            </div>
                        </div>
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
