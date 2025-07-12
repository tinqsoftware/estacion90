<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Menu; 
use Carbon\Carbon;
use App\Models\HoraLlegada;
use App\Models\TipoPago;
use App\Models\ComprobantePago;
use App\Models\Distrito;
use App\Models\DireccionUser;
use App\Models\Banners;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Inicio extends Controller
{
    /**
     * Muestra la vista de inicio con los productos disponibles.
     *
     * Se consultan los productos de cada categoría (Entradas y Fondos para menús de S/15 y S/20, además de extras)
     * y se les agrega el stock disponible real calculado mediante StockService.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */

     private function obtenerProductosPorCategoria($categoriaId, $fecha)
    {
        return Producto::select(
            'productos.id',
            'productos.id_categoria',
            'productos.nombre',
            'productos.descripcion',
            'productos.imagen',
            'planeacion_menu.precio',
            DB::raw('planeacion_menu.stock_diario - COALESCE((
                SELECT SUM(pedido_detalles.cantidad)
                FROM pedido_detalles
                JOIN pedidos ON pedidos.id = pedido_detalles.id_pedido
                WHERE pedido_detalles.id_producto = productos.id
                AND DATE(pedidos.created_at) = "' . $fecha . '"
                AND pedidos.estado != 9
            ), 0) as stock_restante')
        )
        ->join('planeacion_menu', 'productos.id', '=', 'planeacion_menu.id_producto')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->where('categorias.id', $categoriaId)
        ->where('productos.estado', 1)
        ->whereDate('planeacion_menu.fecha_plan', $fecha)
        ->having('stock_restante', '>', 0)
        ->get();
    }

    public function web(Request $request)
    {
        $hoy = Carbon::now()->format('Y-m-d');

        // Banners activos por fecha
        $banners = Banners::where('fecha_inicio', '<=', $hoy)
            ->where('fecha_fin', '>=', $hoy)
            ->where('tipo', '1')
            ->where('tipo', '1')
            ->get();

        // Productos por categoría (sin filtro de stock ni fecha)
        $entradas15 = Producto::where('id_categoria', 1)->where('estado', 1)->get();
        $entradas20 = Producto::where('id_categoria', 2)->where('estado', 1)->get();
        $fondos15 = Producto::where('id_categoria', 3)->where('estado', 1)->get();
        $fondos20 = Producto::where('id_categoria', 4)->where('estado', 1)->get();
        $platosCarta = Producto::where('id_categoria', 5)->where('estado', 1)->get();
        $caldos = Producto::where('id_categoria', 8)->where('estado', 1)->get();
        $desayunos = Producto::where('id_categoria', 9)->where('estado', 1)->get();
        $img15 = Banners::where('tipo', '2')->first();
        $img20 = Banners::where('tipo', '3')->first();

        return view('web', compact('entradas15', 'fondos15', 'entradas20', 'fondos20', 'platosCarta','banners','caldos','desayunos','img15','img20'));
    }



    public function inicio(Request $request)
    {
        // Obtenemos la fecha actual
        $hoy = Carbon::now()->format('Y-m-d');
        $horasLlegada = HoraLlegada::where('estado', 1)->get();
        $tiposPago = TipoPago::where('estado', 1)->get();
        $comprobantesPago = ComprobantePago::where('estado', 1)->get();
        $distrito = Distrito::all();

        $menus = Menu::with(['categorias.productos' => function($query) use ($hoy) {
        $query->select(
            'productos.id',
            'productos.id_categoria',
            'productos.nombre',
            'productos.descripcion',
            'productos.imagen',
            'planeacion_menu.precio',
            DB::raw('planeacion_menu.stock_diario - COALESCE((
                SELECT SUM(pedido_detalles.cantidad)
                FROM pedido_detalles
                JOIN pedidos ON pedidos.id = pedido_detalles.id_pedido
                WHERE pedido_detalles.id_producto = productos.id
                AND DATE(pedidos.created_at) = "' . $hoy . '"
                AND pedidos.estado != 9
            ), 0) as stock_restante')
        )
        ->join('planeacion_menu', 'productos.id', '=', 'planeacion_menu.id_producto')
        ->where('productos.estado', 1)
        ->whereDate('planeacion_menu.fecha_plan', $hoy)
        ->having('stock_restante', '>', 0);
    }])->orderBy('id', 'asc')->get();

    // Mantener extras por separado
    $extras = $this->obtenerProductosPorCategoria(7, $hoy);

    return view('inicio', compact(
        'menus',
        'extras',
        'horasLlegada', 
        'tiposPago', 
        'comprobantesPago',
        'distrito'
    ));
    }


    public function guardarDireccion(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'distrito_id' => 'required|exists:distrito,id',
            'direccion' => 'required|string',
            'referencia' => 'nullable|string',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
        ]);

        $user = Auth::user();

        // Crea nueva dirección
        $direccion = DireccionUser::create([
            'id_user'     => $user->id,
            'id_distrito' => $request->distrito_id,
            'tipo_nombre' => $request->tipo,
            'direccion'   => $request->direccion,
            'referencia'  => $request->referencia,
            'lat'         => $request->lat,
            'lon'         => $request->lon,
        ]);

        // Actualiza usuario para establecer esa dirección como actual
        $user->id_direccion = $direccion->id;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Dirección guardada correctamente',
            'direccion' => $direccion
        ]);
    }

    public function mostrarDireccionesPopup()
    {
        $user = Auth::user();
        $direcciones = $user->direcciones; // Relación: hasManyThrough o belongsToMany
        return view('layouts.partials.popup-direcciones', compact('direcciones'));
    }

    public function actualizarPrincipal(Request $request)
    {
        $user = Auth::user();
        $user->id_direccion = $request->direccion_id;
        $user->save();
        return response()->json(['success' => true]);
    }



}