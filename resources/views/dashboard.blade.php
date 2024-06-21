<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido ') . Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h5>Ventas Totales</h5>
                            <div style="width:100%; height:200px;">
                                <canvas id="ventasChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h5>Ventas por Ciudad</h5>
                            <div style="width:100%; height:200px;">
                                <canvas id="ciudadesChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h5>Métodos de Pago</h5>
                            <div style="width:100%; height:200px;">
                                <canvas id="metodosPagoChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h5>Pedidos por Aliado</h5>
                            <div style="width:100%; height:200px;">
                                <canvas id="pedidosChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h5>Ventas por Vendedor</h5>
                            <div style="width:100%; height:200px;">
                                <canvas id="usuariosChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
