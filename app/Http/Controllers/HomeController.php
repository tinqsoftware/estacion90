<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function inicio()
    {
        // Obtenemos la fecha de hoy en formato Y-m-d
        $hoy = Carbon::now()->format('Y-m-d');

        // Consultamos las entradas y fondos del Menú de S/15.
        // Se asume que en la tabla 'categorias' se usan los nombres: 
        //  'Entradas - Menú 15' y 'Fondos - Menú 15'
        $entradas15 = Producto::with('planeacionesMenu')
            ->whereHas('categoria', function ($q) {
                $q->where('id', '1'); //Entradas S/15
            })
            ->whereHas('planeacionesMenu', function ($q) use ($hoy) {
                $q->where('fecha_plan', $hoy)
                  ->where('stock_diario', '>', 0);
            })
            ->get();

        $fondos15 = Producto::with('planeacionesMenu')
            ->whereHas('categoria', function ($q) {
                $q->where('id', '3'); //Fondos S/15
            })
            ->whereHas('planeacionesMenu', function ($q) use ($hoy) {
                $q->where('fecha_plan', $hoy)
                  ->where('stock_diario', '>', 0);
            })
            ->get();

        // Consultamos las entradas y fondos del Menú de S/20.
        // Se asume que en la tabla 'categorias' se usan los nombres: 
        //  'Entradas - Menú 20' y 'Fondos - Menú 20'
        $entradas20 = Producto::with('planeacionesMenu')
            ->whereHas('categoria', function ($q) {
                $q->where('id', '2'); //Entradas S/20
            })
            ->whereHas('planeacionesMenu', function ($q) use ($hoy) {
                $q->where('fecha_plan', $hoy)
                  ->where('stock_diario', '>', 0);
            })
            ->get();

        $fondos20 = Producto::with('planeacionesMenu')
            ->whereHas('categoria', function ($q) {
                $q->where('id', '4'); //Fondos S/20
            })
            ->whereHas('planeacionesMenu', function ($q) use ($hoy) {
                $q->where('fecha_plan', $hoy)
                  ->where('stock_diario', '>', 0);
            })
            ->get();
  
            
                    // Consultar productos extras (categoría extras, id = 6)
        $extras = Producto::with('planeacionesMenu')
        ->whereHas('categoria', function ($q) {
            $q->where('id', '6'); // Extras
        })
        ->whereHas('planeacionesMenu', function ($q) use ($hoy) {
            $q->where('fecha_plan', $hoy)
              ->where('stock_diario', '>', 0);
        })
        ->get();

        // Retornamos la vista 'home' y pasamos las colecciones de productos
        return view('welcome', compact('entradas15', 'fondos15', 'entradas20', 'fondos20','extras'));
    }
}
