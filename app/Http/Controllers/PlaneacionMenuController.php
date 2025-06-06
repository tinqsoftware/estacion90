<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PlaneacionMenu;
use App\Models\Categoria;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PlaneacionMenuController extends Controller
{
    public function menusemanal()
    {
        return view('menu.menu_semana');
    }

    public function getMenuSemanal(Request $request)
    {
        // Validate the request
        $request->validate([
            'start_date' => 'required|date_format:Y-m-d',
        ]);
        
        // Parse the start date (Monday)
        $startDate = Carbon::parse($request->start_date);
        
        // Calculate the end date (Sunday)
        $endDate = (clone $startDate)->addDays(6);
        
        // Fetch menu data for the week
        $menuItems = PlaneacionMenu::select(
                'planeacion_menu.id',
                'planeacion_menu.fecha_plan',
                'planeacion_menu.stock_diario',
                'planeacion_menu.precio',
                'productos.nombre as producto_nombre',
                'productos.descripcion as producto_descripcion',
                'categorias.nombre as categoria_nombre',
                'categorias.id as categoria_id'
            )
            ->join('productos', 'planeacion_menu.id_producto', '=', 'productos.id')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->whereBetween('fecha_plan', [$startDate->toDateString(), $endDate->toDateString()])
            ->orderBy('fecha_plan')
            ->orderBy('categorias.id')
            ->get();
        
        // Group the data by date and organize it for the frontend
        $result = [];
        
        // Initialize structure for all 7 days
        for ($i = 0; $i < 7; $i++) {
            $currentDate = (clone $startDate)->addDays($i)->toDateString();
            $result[$currentDate] = [
                'items' => []
            ];
        }
        
        // Group menu items by date
        $groupedByDate = $menuItems->groupBy('fecha_plan');
        
        // Define category mappings for frontend display
        $categoryMapping = [
            1 => 'entrada_15',   
            2 => 'entrada_20',   
            3 => 'fondo_15',     
            4 => 'fondo_20',
            5 => 'carta',       
            6 => 'combos',
            7 => 'extras' 
        ];
        
        // Process each date's menu items
        foreach ($groupedByDate as $date => $items) {
            // Group by product categories within this date
            $menuRows = [];
            $maxItems = 0;
            
            // Group items by category
        $groupedByCategory = $items->groupBy('categoria_id');
        
        // Count the maximum number of items in any category
        foreach ($groupedByCategory as $categoryItems) {
            $maxItems = max($maxItems, $categoryItems->count());
        }
        
        // Create rows for display
        for ($i = 0; $i < $maxItems; $i++) {
            $row = [];
            
            // For each category, get the item at index $i if it exists
            foreach ($categoryMapping as $categoryId => $fieldName) {
                $item = $groupedByCategory->get($categoryId, collect())->get($i);
                
                if ($item) {
                    // Always include price for Extras (category 5) and Combos (category 6)
                    $row[$fieldName] = $item->producto_nombre .'<br/><b>'.$item->stock_diario . '</b> - ' .   ' (S/' . ($item->precio ?? '0') . ')';
                } else {
                    $row[$fieldName] = '-';
                }
            }
            
            $menuRows[] = $row;
        }
        
        $result[$date]['items'] = $menuRows;
    }
    
    return response()->json($result);
    }

    public function registrarMenu(Request $request)
{
    $fecha = $request->fecha;
    $items = $request->items;
    
    $createdIds = [];
    
    foreach ($items as $item) {
        
        $menuItem = PlaneacionMenu::create([
            'fecha_plan' => $fecha, // Corregido el nombre del campo a fecha_plan
            'id_producto' => $item['producto_id'], // Asegurate de que estos nombres coincidan con tu BD
            'stock_diario' => $item['stock_diario'],
            'precio' => $item['precio']
        ]);
        
        $createdIds[] = $menuItem->id;
    }
    
    return response()->json([
        'success' => true,
        'item_id' => $createdIds[0] // Devuelve el ID del primer elemento creado (solo enviamos uno a la vez)
    ]);
}

public function eliminarMenu($id)
{
    try {
        // Primero recuperamos el elemento del menú para obtener su producto_id
        $menuItem = PlaneacionMenu::findOrFail($id);
        $producto_id = $menuItem->id_producto;
        $categoria_id = Producto::find($producto_id)->id_categoria;
        
        // Luego lo eliminamos
        $menuItem->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Elemento de menú eliminado correctamente',
            'producto_id' => $producto_id,
            'categoria_id' => $categoria_id
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al eliminar el elemento: ' . $e->getMessage()
        ], 500);
    }
}
    
    /**
     * Get calendar data for a specific month
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMesCalendario(Request $request)
    {
        // Validate the request
        $request->validate([
            'year' => 'required|integer',
            'month' => 'required|integer|between:0,11',
        ]);
        
        $year = $request->year;
        $month = $request->month + 1; // JavaScript months are 0-indexed
        
        // Get days with menu data for this month
        $daysWithMenu = PlaneacionMenu::select(DB::raw('DISTINCT DATE(fecha_plan) as date'))
            ->whereYear('fecha_plan', $year)
            ->whereMonth('fecha_plan', $month)
            ->get()
            ->pluck('date');
        
        return response()->json([
            'days_with_menu' => $daysWithMenu
        ]);
    }


    public function getMenuSemanalById(Request $request)
    {
        // Validate the request
        $request->validate([
            'id' => 'required|integer',
        ]);
        
        // Fetch menu data for the given ID
        $menuItem = PlaneacionMenu::select(
                'planeacion_menu.id',
                'planeacion_menu.fecha_plan',
                'planeacion_menu.stock_diario',
                'planeacion_menu.precio',
                'productos.nombre as producto_nombre',
                'productos.descripcion as producto_descripcion',
                'categorias.nombre as categoria_nombre',
                'categorias.id as categoria_id'
            )
            ->join('productos', 'planeacion_menu.id_producto', '=', 'productos.id')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->where('planeacion_menu.id', $request->id)
            ->first();
        
        return response()->json($menuItem);
    }

public function agregar(Request $request, $fecha = null)
{
    // Get date from request or default to today
    $fecha = $fecha ?? Carbon::today()->toDateString();
    $fechaObj = Carbon::parse($fecha);
    
    // Format the date for display (e.g., "Lunes 5 MAYO")
    $fechaFormateada = $fechaObj->locale('es')->isoFormat('dddd D MMMM');
    
    // Check if we're cloning a menu from another date
    $cloneItems = null;
    $cloneFromFormateado = null;
    $clonacionExitosa = false;
    
    if ($request->has('clone_from')) {
        $cloneFrom = $request->query('clone_from');
        
        // Format the source date for display
        $cloneFromObj = Carbon::parse($cloneFrom);
        $cloneFromFormateado = $cloneFromObj->locale('es')->isoFormat('dddd D MMMM');
        
        // Get menu items from the source date
        $cloneItems = PlaneacionMenu::select(
            'planeacion_menu.id',
            'planeacion_menu.fecha_plan',
            'planeacion_menu.stock_diario',
            'planeacion_menu.precio',
            'productos.nombre as producto_nombre',
            'productos.id as producto_id',
            'categorias.id as categoria_id'
        )
        ->join('productos', 'planeacion_menu.id_producto', '=', 'productos.id')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->where('fecha_plan', $cloneFrom)
        ->get();
        
        // Clonar los elementos directamente a la tabla si se solicita confirmar=1
        if ($request->query('confirmar') == '1') {
            foreach ($cloneItems as $item) {
                // Comprobar si ya existe este producto en el menú de la fecha actual
                $exists = PlaneacionMenu::where('fecha_plan', $fecha)
                    ->where('id_producto', $item->producto_id)
                    ->exists();
                
                if (!$exists) {
                    // Crear una nueva entrada en el menú
                    PlaneacionMenu::create([
                        'fecha_plan' => $fecha,
                        'id_producto' => $item->producto_id,
                        'stock_diario' => $item->stock_diario,
                        'precio' => $item->precio
                    ]);
                }
            }
            
            // Redirigir a la URL limpia después de confirmar la clonación
            return redirect("/menusemana/agregar/{$fecha}")->with('clonacion_exitosa', true);
        }
    }
    
    // Get menu items for this date
    $menuItems = PlaneacionMenu::select(
        'planeacion_menu.id',
        'planeacion_menu.fecha_plan',
        'planeacion_menu.stock_diario',
        'planeacion_menu.precio',
        'productos.nombre as producto_nombre',
        'productos.id as producto_id',
        'categorias.id as categoria_id'
    )
    ->join('productos', 'planeacion_menu.id_producto', '=', 'productos.id')
    ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
    ->where('fecha_plan', $fecha)
    ->get()
    ->groupBy('categoria_id');
    
    $productos = Producto::all();
    $categorias = Categoria::all();
    
    // Comprobar si hay un mensaje flash de clonación exitosa
    $clonacionExitosa = session('clonacion_exitosa', false);
    
    return view('menu.menu_agregar', compact(
        'productos', 
        'categorias', 
        'menuItems', 
        'fecha', 
        'fechaFormateada',
        'cloneItems',
        'cloneFromFormateado',
        'clonacionExitosa'
    ));
}

    public function getDiasConMenu(Request $request)
{
    // Validate the request
    $request->validate([
        'year' => 'required|integer',
        'month' => 'required|integer|between:1,12',
    ]);
    
    $year = $request->year;
    $month = $request->month;
    
    // Get days with menu data for this month
    $daysWithMenu = PlaneacionMenu::select(DB::raw('DISTINCT DATE(fecha_plan) as date'))
        ->whereYear('fecha_plan', $year)
        ->whereMonth('fecha_plan', $month)
        ->get()
        ->pluck('date');
    
    return response()->json([
        'days_with_menu' => $daysWithMenu
    ]);
}

/**
 * Get menu data for a specific day
 * 
 * @param Request $request
 * @return \Illuminate\Http\JsonResponse
 */
public function getMenuDia(Request $request)
{
    // Validate the request
    $request->validate([
        'date' => 'required|date_format:Y-m-d',
    ]);
    
    $date = $request->date;
    
    // Fetch menu data for the specified date
    $menuItems = PlaneacionMenu::select(
        'planeacion_menu.id',
        'planeacion_menu.fecha_plan',
        'planeacion_menu.stock_diario',
        'planeacion_menu.precio',
        'productos.id as producto_id',
        'productos.nombre as producto_nombre',
        'productos.descripcion as producto_descripcion',
        'categorias.nombre as categoria_nombre',
        'categorias.id as categoria_id'
    )
    ->join('productos', 'planeacion_menu.id_producto', '=', 'productos.id')
    ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
    ->where('fecha_plan', $date)
    ->orderBy('categorias.id')
    ->get();
    
    return response()->json([
        'date' => $date,
        'items' => $menuItems
    ]);
}

/**
 * Show the form for creating/editing a menu with clone capability
 *
 * @param  string  $fecha
 * @return \Illuminate\Http\Response
 */

public function clonarMenuDirecto(Request $request)
{
    // Validate the request
    $request->validate([
        'source_date' => 'required|date_format:Y-m-d',
        'target_date' => 'required|date_format:Y-m-d',
    ]);
    
    $sourceDate = $request->source_date;
    $targetDate = $request->target_date;
    
    try {
        // Begin transaction
        DB::beginTransaction();
        
        // 1. Delete all existing menu items for the target date
        PlaneacionMenu::where('fecha_plan', $targetDate)->delete();
        
        // 2. Get all menu items from the source date
        $sourceItems = PlaneacionMenu::where('fecha_plan', $sourceDate)->get();
        
        // 3. Clone each item to the target date
        foreach ($sourceItems as $item) {
            PlaneacionMenu::create([
                'fecha_plan' => $targetDate,
                'id_producto' => $item->id_producto,
                'stock_diario' => $item->stock_diario,
                'precio' => $item->precio
            ]);
        }
        
        // Commit transaction
        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => 'Menu clonado correctamente',
            'items_count' => count($sourceItems)
        ]);
        
    } catch (\Exception $e) {
        // Rollback transaction on error
        DB::rollBack();
        
        return response()->json([
            'success' => false,
            'message' => 'Error al clonar el menú: ' . $e->getMessage()
        ], 500);
    }
}


}