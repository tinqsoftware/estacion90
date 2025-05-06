<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Storage;

class ProductoController extends Controller
{
    public function productos_tab()
    {
        $categorias = Categoria::all();
        return view('productos.productos', compact('categorias'));
    }

    // Mostrar un producto específico
    public function show($id)
    {
        $producto = Producto::with('creador')->findOrFail($id);
    
    // Agregar formato de fecha para mostrar en el modal
    $producto->updated_at_formatted = $producto->updated_at->format('d/m/Y H:i');
    
    return response()->json($producto);
    }

    // Guardar un nuevo producto
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric|min:0',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'stock' => 'required|integer|min:0',
    ]);

    DB::beginTransaction();
    try {
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        // Corregir el nombre de la columna
        $producto->id_categoria = $request->categoria_id;
        $producto->stock = $request->stock;
        // Agregar usuario que crea el producto
        $producto->id_user_create = auth()->id() ?? 1;
        
        // Procesar la imagen si existe
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $path;
        }
        
        $producto->save();
        DB::commit();
        
        return redirect()->route('productos_tab')->with('success', 'Producto creado exitosamente');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Error al crear el producto: ' . $e->getMessage());
    }
}

    // Mostrar formulario de edición
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // Actualizar el producto
    public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric|min:0',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'stock' => 'required|integer|min:0',
    ]);

    DB::beginTransaction();
    try {
        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        // Corregir el nombre de la columna
        $producto->id_categoria = $request->categoria_id;
        $producto->stock = $request->stock;
        
        // Procesar la imagen si existe
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }
            
            $path = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $path;
        }
        
        $producto->save();
        DB::commit();
        
        return redirect()->route('productos_tab')->with('success', 'Producto actualizado exitosamente');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
    }
}

    // Eliminar el producto
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $producto = Producto::findOrFail($id);
            
            // Eliminar la imagen si existe
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }
            
            $producto->delete();
            DB::commit();
            
            return redirect()->route('productos_tab')->with('success', 'Producto eliminado exitosamente');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
    }
}
