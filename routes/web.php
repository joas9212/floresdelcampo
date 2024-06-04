<?php

use App\Http\Controllers\ProfileController;
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

Route::resource('productos', 'ProductosController');
Route::resource('inventarios', 'InventariosController');
Route::resource('vendedores', 'VendedoresController');
Route::resource('proveedores', 'ProveedoresController');
Route::resource('ventas', 'VentasController');
Route::resource('pedidos', 'PedidosController');
Route::resource('Paises', 'PaisesController');
Route::resource('Ciudades', 'CiudadesController');


require __DIR__.'/auth.php';
