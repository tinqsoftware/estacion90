<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Carbon\Carbon;
use App\Models\HoraLlegada;
use App\Models\TipoPago;
use App\Models\ComprobantePago;
use App\Models\Distrito;
use App\Models\DireccionUser;
use Illuminate\Support\Facades\Auth;

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
    public function inicio(Request $request)
    {
        // Obtenemos la fecha actual
        $hoy = Carbon::now()->format('Y-m-d');
        $horasLlegada = HoraLlegada::where('estado', 1)->get();
        $tiposPago = TipoPago::where('estado', 1)->get();
        $comprobantesPago = ComprobantePago::where('estado', 1)->get();
        $distrito = Distrito::all();


        $entradas15 = Producto::select('productos.id','productos.id_categoria','productos.nombre','productos.descripcion','productos.imagen','productos.descripcion', 'planeacion_menu.precio')
        ->join('planeacion_menu', 'productos.id', '=', 'planeacion_menu.id_producto')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->where('categorias.id', 1)
        ->where('productos.estado', 1)
        ->whereDate('planeacion_menu.fecha_plan', $hoy)
        ->where('planeacion_menu.stock_diario', '>', 0)
        ->get();


        // Entradas S/20
        $entradas20 = Producto::select('productos.id','productos.id_categoria','productos.nombre','productos.descripcion','productos.imagen','productos.descripcion', 'planeacion_menu.precio')
        ->join('planeacion_menu', 'productos.id', '=', 'planeacion_menu.id_producto')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->where('categorias.id', 2)
        ->where('productos.estado', 1)
        ->whereDate('planeacion_menu.fecha_plan', $hoy)
        ->where('planeacion_menu.stock_diario', '>', 0)
        ->get();


        // Fondos S/15
        $fondos15 = Producto::select('productos.id','productos.id_categoria','productos.nombre','productos.descripcion','productos.imagen','productos.descripcion', 'planeacion_menu.precio')
        ->join('planeacion_menu', 'productos.id', '=', 'planeacion_menu.id_producto')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->where('categorias.id', 3)
        ->where('productos.estado', 1)
        ->whereDate('planeacion_menu.fecha_plan', $hoy)
        ->where('planeacion_menu.stock_diario', '>', 0)
        ->get();


        // Fondos S/20
        $fondos20 = Producto::select('productos.id','productos.id_categoria','productos.nombre','productos.descripcion','productos.imagen','productos.descripcion', 'planeacion_menu.precio')
        ->join('planeacion_menu', 'productos.id', '=', 'planeacion_menu.id_producto')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->where('categorias.id', 4)
        ->where('productos.estado', 1)
        ->whereDate('planeacion_menu.fecha_plan', $hoy)
        ->where('planeacion_menu.stock_diario', '>', 0)
        ->get();


        // Platos a la carta (id=5)
        $platosCarta = Producto::select('productos.id','productos.id_categoria','productos.nombre','productos.descripcion','productos.imagen','productos.descripcion', 'planeacion_menu.precio')
        ->join('planeacion_menu', 'productos.id', '=', 'planeacion_menu.id_producto')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->where('categorias.id', 5)
        ->where('productos.estado', 1)
        ->whereDate('planeacion_menu.fecha_plan', $hoy)
        ->where('planeacion_menu.stock_diario', '>', 0)
        ->get();


        // Combos (id=6)
        $combos = Producto::select('productos.id','productos.id_categoria','productos.nombre','productos.descripcion','productos.imagen','productos.descripcion', 'planeacion_menu.precio')
        ->join('planeacion_menu', 'productos.id', '=', 'planeacion_menu.id_producto')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->where('categorias.id', 6)
        ->where('productos.estado', 1)
        ->whereDate('planeacion_menu.fecha_plan', $hoy)
        ->where('planeacion_menu.stock_diario', '>', 0)
        ->get();



        // Extras (Categoría extras, id = 7)
        $extras = Producto::select('productos.id','productos.id_categoria','productos.nombre','productos.descripcion','productos.imagen','productos.descripcion', 'planeacion_menu.precio')
        ->join('planeacion_menu', 'productos.id', '=', 'planeacion_menu.id_producto')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->where('categorias.id', 7)
        ->where('productos.estado', 1)
        ->whereDate('planeacion_menu.fecha_plan', $hoy)
        ->where('planeacion_menu.stock_diario', '>', 0)
        ->get();

        return view('inicio', compact('entradas15', 'fondos15', 'entradas20', 'fondos20', 'extras','platosCarta','combos','horasLlegada', 'tiposPago', 'comprobantesPago','distrito'));
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
