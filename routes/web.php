<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\InventariosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\CiudadesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/cart', function () {
    return view('welcome');
})->name('cart');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('productos', ProductosController::class);
Route::resource('inventarios', InventariosController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('proveedores', ProveedoresController::class);
Route::resource('ventas',  VentasController::class);
Route::resource('pedidos', PedidosController::class);
Route::resource('Paises', PaisesController::class);
Route::resource('Ciudades', CiudadesController::class);


require __DIR__.'/auth.php';
