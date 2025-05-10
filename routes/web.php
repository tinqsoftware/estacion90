<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Inicio;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PlaneacionMenuController;

/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [Inicio::class, 'inicio']);

//Productos

Route::get('/productos', [ProductoController::class, 'productos_tab'])->name('productos_tab');
Route::post('/productos/crear', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');


//MenuSemanal
Route::get('/menuSemanal', [PlaneacionMenuController::class, 'menusemanal'])->name('menu.menu_semana');
Route::get('/api/menusemana', [PlaneacionMenuController::class, 'getMenuSemanal']);
Route::get('/api/calendario', [PlaneacionMenuController::class, 'getMesCalendario']);


Route::get('/menusemana/agregar', [PlaneacionMenuController::class, 'agregar']);


//Usuarios

Route::get('/usuarios', [UsuarioController::class, 'prin']);
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
Route::post('/usuarios/{id}/reset-password', [UsuarioController::class, 'resetPassword'])->name('usuarios.reset_password');

