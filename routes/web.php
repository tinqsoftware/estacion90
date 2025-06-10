<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CocinaController;
use App\Http\Controllers\ControllerPopup;
use App\Http\Controllers\ControllerPopupDia;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Inicio;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PlaneacionMenuController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DespachoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\OrdenController;

/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

// Public routes
Route::get('/', [Inicio::class, 'inicio']);
Route::get('/popups/for-user', [ControllerPopupDia::class, 'getPopupsForUser'])->name('popups.for-user');
Route::post('/popups/view', [ControllerPopupDia::class, 'recordPopupView'])->name('popups.view');

//login y registro con ajax
Route::post('/login-ajax', [LoginController::class, 'loginAjax'])->name('login.ajax');
Route::post('/register-ajax', [RegisterController::class, 'registerAjax'])->name('register.ajax');
Route::get('/partial/auth-form', function () {
    return view('layouts.partials.auth-form');
})->name('partial.auth.form');


//registrar pedido 
Route::post('/registrar-pedido', [PedidoController::class, 'store'])->name('pedido.store');

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
    //CalendarioClon
    Route::get('/api/calendar-with-menu', [PlaneacionMenuController::class, 'getDiasConMenu']);
    Route::get('/api/menu-day', [PlaneacionMenuController::class, 'getMenuDia']);
    Route::post('/api/menu-clone', [App\Http\Controllers\PlaneacionMenuController::class, 'clonarMenuDirecto']);

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
    Route::get('/popups/{id}/view', [ControllerPopup::class, 'viewDetails'])->name('popups.view-details');
    Route::put('/popups/{id}', [ControllerPopup::class, 'update'])->name('popups.update');
    Route::delete('/popups/{id}', [ControllerPopup::class, 'destroy'])->name('popups.destroy');

    // Popup diario
    Route::get('/popups/for-user', [ControllerPopupDia::class, 'getPopupsForUser'])->name('popups.for-user');
    Route::post('/popups/view', [ControllerPopupDia::class, 'recordPopupView'])->name('popups.view');

    //renderizar menu con ajax
    Route::get('/partial/header-sidebar', function () {
        return response()->json([
            'header' => view('partials.header')->render(),
            'sidebar' => view('partials.sidebar')->render(),
            'authContainer' => view('layouts.partials.user-summary')->render()
        ]);
    })->middleware('auth');

    //grabar direccion en home
    Route::post('/direccion/guardar', [Inicio::class, 'guardarDireccion'])->name('direccion.guardar');
    Route::get('/direccion/partial', [Inicio::class, 'mostrarDireccionesPopup'])->name('direccion.partial')->middleware('auth');
    Route::post('/direccion/actualizar-principal', [Inicio::class, 'actualizarPrincipal'])->name('direccion.actualizarPrincipal');

    //verificar si tiene sesión abierta con ajax
    Route::get('/check-auth', function () {
    return response()->json([
            'auth' => auth()->check(),
            'user' => auth()->user(),
            'direccion' => auth()->user()?->direccion
        ]);
    })->middleware('auth');


    //Mis Ordenes
    Route::get('/misordenes', [OrdenController::class, 'ordenes'])->name('misordenes');

    // Usuarios Edit.
    Route::get('/usuariosEditPerfil', [EditUserController::class, 'index'])->name('usuarios.edit_usuario');
    Route::post('/usuariosEditPerfil/update', [EditUserController::class, 'update'])->name('usuarios.update_profile');
    Route::post('/usuariosEditPerfil/upload-image', [EditUserController::class, 'uploadImage'])->name('usuarios.upload_image');
    Route::post('/usuariosEditPerfil/store-address', [EditUserController::class, 'storeAddress'])->name('usuarios.store_address');
    Route::post('/usuariosEditPerfil/set-default-address', [EditUserController::class, 'setDefaultAddress'])->name('usuarios.set_default_address');
    Route::delete('/usuariosEditPerfil/delete-address/{id}', [EditUserController::class, 'deleteAddress'])->name('usuarios.delete_address');
    Route::post('/usuariosEditPerfil/update-address', [EditUserController::class, 'updateAddress'])->name('usuarios.update_address');

    // Cocina Rutas.

    Route::get('/cocina', [CocinaController::class, 'index'])->name('cocina.index');
    Route::get('/cocina/new-orders', [CocinaController::class, 'getNewOrders'])->name('cocina.new-orders');
    Route::post('/pedidos/update-status', [CocinaController::class, 'updateStatus'])->name('pedidos.update-status');
    Route::get('/cocina/orders-by-date', [CocinaController::class, 'getOrdersByDate'])->name('cocina.orders-by-date');
    Route::get('/cocina/days-with-orders', [CocinaController::class, 'getDaysWithOrders'])->name('cocina.days-with-orders');
     Route::post('/cocina/update-item-status', [CocinaController::class, 'updateItemStatus'])->name('cocina.update-item-status');

    // Administrador Routes

    Route::get('/admin/config', [AdministradorController::class, 'index'])->name('admin.config');

// TipoPago
    Route::get('/admin/tipopago/listar', [AdministradorController::class, 'listarTiposPago'])->name('admin.tipoPago.listar');
    Route::post('/admin/tipopago/guardar', [AdministradorController::class, 'guardarTipoPago'])->name('admin.tipoPago.guardar');
    Route::post('/admin/tipopago/cambiarestado', [AdministradorController::class, 'cambiarEstadoTipoPago'])->name('admin.tipoPago.cambiarEstado');

// ComprobantePago
    Route::get('/admin/comprobante/listar', [AdministradorController::class, 'listarComprobantes'])->name('admin.comprobante.listar');
    Route::post('/admin/comprobante/guardar', [AdministradorController::class, 'guardarComprobante'])->name('admin.comprobante.guardar');
    Route::post('/admin/comprobante/cambiarestado', [AdministradorController::class, 'cambiarEstadoComprobante'])->name('admin.comprobante.cambiarEstado');

// HoraLlegada
    Route::get('/admin/horallegada/listar', [AdministradorController::class, 'listarHorasLlegada'])->name('admin.horaLlegada.listar');
    Route::post('/admin/horallegada/guardar', [AdministradorController::class, 'guardarHoraLlegada'])->name('admin.horaLlegada.guardar');
    Route::get('/admin/horallegada/obtener', [AdministradorController::class, 'obtenerHoraLlegada'])->name('admin.horaLlegada.obtener');
    Route::post('/admin/horallegada/actualizar', [AdministradorController::class, 'actualizarHoraLlegada'])->name('admin.horaLlegada.actualizar');
    Route::post('/admin/horallegada/cambiarestado', [AdministradorController::class, 'cambiarEstadoHoraLlegada'])->name('admin.horaLlegada.cambiarEstado');

// Despacho

    Route::get('/despacho', [DespachoController:: class, 'despacho'])->name('despacho.despacho');
    Route::get('/despacho-moto', [DespachoController:: class, 'despachoMoto'])->name('despacho.despacho_moto');
    Route::get('/despacho/pedidos-nuevos', [DespachoController::class, 'obtenerPedidosNuevos'])->name('despacho.pedidos-nuevos');
    Route::post('/despacho/pedido/actualizar-estado', [DespachoController::class, 'actualizarEstadoPedido'])->name('despacho.actualizar-estado');
    Route::post('/despacho/pedido/asignar-moto', [DespachoController::class, 'asignarPedidoAMoto'])->name('despacho.asignar-moto');
});