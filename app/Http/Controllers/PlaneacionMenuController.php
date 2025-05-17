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
            1 => 'entrada_15',   // Assuming category 1 is for Entrada S/15.00
            2 => 'entrada_20',   // Assuming category 2 is for Entrada S/20.00
            3 => 'fondo_15',     // Assuming category 3 is for Fondo S/15.00
            4 => 'fondo_20',     // Assuming category 4 is for Fondo S/20.00
            5 => 'extras',       // Assuming category 5 is for Extras
            6 => 'combos'        // Assuming category 6 is for Combos
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
                    if ($categoryId == 5 || $categoryId == 6) {
                        $row[$fieldName] = $item->stock_diario . ' - ' . $item->producto_nombre . 
                            ' (S/' . ($item->precio ?? '0') . ')';
                    } else {
                        $row[$fieldName] = $item->stock_diario . ' - ' . $item->producto_nombre . 
                            ($item->precio ? ' (S/' . $item->precio . ')' : '');
                    }
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
    
    foreach ($items as $item) {
        // Create new menu items
        PlaneacionMenu::create([
            'fecha' => $fecha,
            'categoria_id' => $item['categoria_id'],
            'producto_id' => $item['producto_id'],
            'stock_diario' => $item['stock_diario'],
            'precio' => $item['precio']
        ]);
    }
    
    return response()->json(['success' => true]);
}

public function eliminarMenu($id)
{
    try {
        $item = PlaneacionMenu::findOrFail($id);
        $item->delete();
        
        return response()->json([
            'success' => true, 
            'message' => 'Ítem eliminado correctamente'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al eliminar: ' . $e->getMessage()
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

    public function agregar(Request $request){
    // Get date from request or default to today
    $fecha = $request->fecha ?? Carbon::today()->toDateString();
    $fechaObj = Carbon::parse($fecha);
    
    // Format the date for display (e.g., "Lunes 5 MAYO")
    $fechaFormateada = $fechaObj->locale('es')->isoFormat('dddd D MMMM');
    
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
    
    return view('menu.menu_agregar', compact(
        'productos', 
        'categorias', 
        'menuItems', 
        'fecha', 
        'fechaFormateada'
    ));
}
}