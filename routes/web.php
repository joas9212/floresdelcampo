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

Route::get('/new_product', function () {
    return view('layouts.app.new_product');
})->middleware(['auth', 'verified'])->name('new_product');
//})->middleware(['auth', 'verified', 'admin'])->name('new_product');

Route::get('/register_sale', function () {
    return view('layouts.app.register_sale');
})->middleware(['auth', 'verified'])->name('register_sale');

Route::get('/sale_list', function () {
    return view('layouts.app.sale_list');
})->middleware(['auth', 'verified'])->name('sale_list');

Route::get('/order_list', function () {
    return view('layouts.app.order_list');
})->middleware(['auth', 'verified'])->name('order_list');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('productos', ProductosController::class);
Route::resource('inventarios', InventariosController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('proveedores', ProveedoresController::class);
Route::resource('pedidos', PedidosController::class);
Route::get('/pedidosById', [PedidosController::class, 'indexById'])->name('pedidos.indexById');
Route::resource('Paises', PaisesController::class);
Route::resource('Ciudades', CiudadesController::class);
Route::resource('ventas',  VentasController::class);
Route::get('/ventasById', [VentasController::class, 'indexById'])->name('ventas.indexById');


require __DIR__.'/auth.php';
