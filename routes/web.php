<?php

use App\Http\Controllers\ControllerPopup;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Inicio;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PlaneacionMenuController;
use Illuminate\Support\Facades\Auth;

/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

// Public routes
Route::get('/', [Inicio::class, 'inicio']);

// Protected routes - requires authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
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
    Route::get('/api/calendar-month', [PlaneacionMenuController::class, 'getMesCalendario']);
    Route::get('/menusemana/agregar/{fecha?}', [PlaneacionMenuController::class, 'agregar']);
    Route::post('/api/menu/registrar', [PlaneacionMenuController::class, 'registrarMenu']);
    Route::delete('/api/menu/eliminar/{id}', [PlaneacionMenuController::class, 'eliminarMenu']);

    //Usuarios
    Route::get('/usuarios', [UsuarioController::class, 'prin']);
    Route::post('/usuarios/guardar', [UsuarioController::class, 'store']);
    Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit']);
    Route::put('/usuarios/guardar/{id}', [UsuarioController::class, 'update']);
    Route::delete('/usuarios/eliminar/{id}', [UsuarioController::class, 'destroy']);
    Route::post('/usuarios/{id}/reset-password', [UsuarioController::class, 'resetPassword']);

    //cambios Contraseña
    Route::post('/user/reset-password', [UsuarioController::class, 'resetPasswordLOGIN'])->name('user.reset-password');
    Route::get('/cambiarclave', [UsuarioController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/cambiar-password', [UsuarioController::class, 'changePassword'])->name('password.change.submit');


    // Popup
    Route::get('/popups', [ControllerPopup::class, 'index'])->name('popups.index');
    Route::get('/popups/create', [ControllerPopup::class, 'create'])->name('popups.create');
    Route::post('/popups/crear', [ControllerPopup::class, 'store'])->name('popups.store');
    Route::get('/popups/{id}/edit', [ControllerPopup::class, 'edit'])->name('popups.edit');
    Route::get('/popups/{id}/view', [ControllerPopup::class, 'viewDetails'])->name('popups.view');
    Route::put('/popups/{id}', [ControllerPopup::class, 'update'])->name('popups.update');
    Route::delete('/popups/{id}', [ControllerPopup::class, 'destroy'])->name('popups.destroy');
});