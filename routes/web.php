<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;

// INICIO
Route::view('/', 'inicio')->name('inicio');
Route::view('/inicio', 'inicio');

// CATÁLOGO (equivalente a procesar_productos.php)
Route::get('/catalogo', [ProductoController::class, 'index'])->name('catalogo');

// DETALLE DE PRODUCTO
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.detalle');

// CONTACTO
Route::view('/contacto', 'contacto');

// CARRITO
Route::post('/carrito/agregar', [ProductoController::class, 'addToCart'])->name('carrito.add');
Route::post('/carrito/eliminar/{index}', [ProductoController::class, 'removeFromCart'])->name('carrito.remove');

// AUTENTICACIÓN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/registro', [AuthController::class, 'showRegister'])->name('registro');
Route::post('/registro', [AuthController::class, 'register'])->name('register.submit');



Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/perfil_usuario', [AuthController::class, 'profile'])->name('perfil');
    Route::post('/perfil_usuario', [AuthController::class, 'updateProfile'])->name('perfil.update');

    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    // ADMIN
    Route::get('/admin/stock', [AdminController::class, 'stock'])->name('admin.stock');
    Route::get('/admin/producto/{id}/editar', [AdminController::class, 'edit'])->name('admin.producto.edit');
    Route::post('/admin/producto/{id}', [AdminController::class, 'update'])->name('admin.producto.update');
    Route::get('/admin/pedidos', [AdminController::class, 'pedidos'])->name('admin.pedidos');
    Route::post('/admin/pedidos/{pedido}/estado', [AdminController::class, 'updatePedidoStatus'])->name('admin.pedidos.update');
});