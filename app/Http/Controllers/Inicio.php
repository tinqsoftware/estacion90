<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Carbon\Carbon;

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


        // Consultar productos para Menú S/15 (Entradas)
        $entradas15 = Producto::with('planeacionesMenu')
            ->whereHas('categoria', function ($q) {
                $q->where('id', '1'); // Categoría: Entradas S/15
            })
            ->whereHas('planeacionesMenu', function ($q) use ($hoy) {
                $q->where('fecha_plan', $hoy)
                  ->where('stock_diario', '>', 0);
            })
            ->get();

        // Fondos S/15
        $fondos15 = Producto::with('planeacionesMenu')
            ->whereHas('categoria', function ($q) {
                $q->where('id', '3'); // Categoría: Fondos S/15
            })
            ->whereHas('planeacionesMenu', function ($q) use ($hoy) {
                $q->where('fecha_plan', $hoy)
                  ->where('stock_diario', '>', 0);
            })
            ->get();

        // Entradas S/20
        $entradas20 = Producto::with('planeacionesMenu')
            ->whereHas('categoria', function ($q) {
                $q->where('id', '2'); // Categoría: Entradas S/20
            })
            ->whereHas('planeacionesMenu', function ($q) use ($hoy) {
                $q->where('fecha_plan', $hoy)
                  ->where('stock_diario', '>', 0);
            })
            ->get();

        // Fondos S/20
        $fondos20 = Producto::with('planeacionesMenu')
            ->whereHas('categoria', function ($q) {
                $q->where('id', '4'); // Categoría: Fondos S/20
            })
            ->whereHas('planeacionesMenu', function ($q) use ($hoy) {
                $q->where('fecha_plan', $hoy)
                  ->where('stock_diario', '>', 0);
            })
            ->get();

        // Extras (Categoría extras, id = 6)
        $extras = Producto::with('planeacionesMenu')
            ->whereHas('categoria', function ($q) {
                $q->where('id', '6'); // Categoría: Extras
            })
            ->whereHas('planeacionesMenu', function ($q) use ($hoy) {
                $q->where('fecha_plan', $hoy)
                  ->where('stock_diario', '>', 0);
            })
            ->get();

        
        // Platos a la carta (id=7)
        $platosCarta = Producto::with('planeacionesMenu')
        ->whereHas('categoria', function ($q) {
            $q->where('id', '7');
        })
        ->whereHas('planeacionesMenu', function ($q) use ($hoy) {
            $q->where('fecha_plan', $hoy)
                ->where('stock_diario', '>', 0);
        })
        ->get();



        return view('inicio', compact('entradas15', 'fondos15', 'entradas20', 'fondos20', 'extras','platosCarta'));
    }
}
