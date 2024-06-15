@php
    use App\Models\Ciudad;
    use App\Models\Categoria;
    use App\Models\User;
    $users = User::all();
    $ciudades = Ciudad::all();
    $categorias = Categoria::all();
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
                <div class="p-6 text-gray-900">

                    <!-- Pestañas de navegación -->
                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="add-user-tab" data-bs-toggle="tab" data-bs-target="#add-user" type="button" role="tab" aria-controls="add-user" aria-selected="true">Agregar Usuario</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="list-users-tab" data-bs-toggle="tab" data-bs-target="#list-users" type="button" role="tab" aria-controls="list-users" aria-selected="false">Listar Usuarios</button>
                        </li>
                    </ul>

                    <!-- Contenido de las pestañas -->
                    <div class="tab-content" id="myTabContent" style="font-size: 12px">
                        <div class="tab-pane fade show active" id="add-user" role="tabpanel" aria-labelledby="add-user-tab">
                            <!-- Formulario para agregar usuario -->
                            @include('layouts.app.admin_panel.new_user')
                        </div>
                        <div class="tab-pane fade" id="list-users" role="tabpanel" aria-labelledby="list-users-tab">
                            <!-- Listado de usuarios -->
                            @include('layouts.app.admin_panel.user_list')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
