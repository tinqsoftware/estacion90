<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Menu;
use App\Models\MenuCategorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
   
    public function index()
    {
        $menus = Menu::with('categorias')->orderBy('id', 'asc')->get();
        $categorias = Categoria::all();
        return view('menu.menu', compact('menus', 'categorias'));
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->id_rol != 1) {
            return response()->json([
                'success' => false,
                'message' => 'No autorizado'
            ], 403);
        }

        // Validar contraseña del usuario
        if (!Hash::check($request->password, Auth::user()->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Contraseña incorrecta'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'precio' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|file|max:10240',
            'categorias_existentes' => 'nullable|array',
            'categorias_existentes.*' => 'exists:categorias,id',
            'nuevas_categorias' => 'nullable|array',
            'nuevas_categorias.*.nombre' => 'required_with:nuevas_categorias|string|max:255',
            'nuevas_categorias.*.descripcion' => 'nullable|string',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $nombreImagen = null;
            
            // Subir imagen si existe
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                $rutaDestino = public_path('access/images/menu');
                if (!file_exists($rutaDestino)) {
                    mkdir($rutaDestino, 0755, true);
                }
                
                $imagen->move($rutaDestino, $nombreImagen);
            }

            // Crear menú
            $menu = Menu::create([
                'nombre' => $request->nombre,
                'precio' => $request->filled('precio') ? $request->precio : null,
                'url_imagen' => $nombreImagen
            ]);

            $categoriasIds = [];

            // Asociar categorías existentes
            if ($request->categorias_existentes) {
                $categoriasIds = array_merge($categoriasIds, $request->categorias_existentes);
            }

            // Crear nuevas categorías
            if ($request->nuevas_categorias) {
                foreach ($request->nuevas_categorias as $nuevaCategoria) {
                    $categoria = Categoria::create([
                        'nombre' => $nuevaCategoria['nombre'],
                        'descripcion' => $nuevaCategoria['descripcion'] ?? null
                    ]);
                    $categoriasIds[] = $categoria->id;
                }
            }

            // Asociar todas las categorías al menú
            foreach ($categoriasIds as $categoriaId) {
                MenuCategorias::create([
                    'menu_id' => $menu->id,
                    'categoria_id' => $categoriaId
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Elemento de menú creado exitosamente',
                'menu' => $menu->load('categorias')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el elemento: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            if (!Auth::check() || Auth::user()->id_rol != 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'No autorizado'
                ], 403);
            }
            $menu = Menu::with('categorias')->findOrFail($id);
            return response()->json([
                'menu' => $menu,
                'categorias_asociadas' => $menu->categorias->pluck('id')->toArray()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Elemento no encontrado'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->id_rol != 1) {
            return response()->json([
                'success' => false,
                'message' => 'No autorizado'
            ], 403);
        }

        // Validar contraseña del usuario
        if (!Hash::check($request->password, Auth::user()->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Contraseña incorrecta'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'precio' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|file|max:10240',
            'categorias_existentes' => 'nullable|array',
            'categorias_existentes.*' => 'exists:categorias,id',
            'nuevas_categorias' => 'nullable|array',
            'nuevas_categorias.*.nombre' => 'required_with:nuevas_categorias|string|max:255',
            'nuevas_categorias.*.descripcion' => 'nullable|string',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $menu = Menu::findOrFail($id);
            
            // Actualizar campos básicos
            $menu->nombre = $request->nombre;
            $menu->precio = $request->filled('precio') ? $request->precio : null;

            // Subir nueva imagen si existe
            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior si existe
                if ($menu->url_imagen && file_exists(public_path('access/images/menu/' . $menu->url_imagen))) {
                    unlink(public_path('access/images/menu/' . $menu->url_imagen));
                }

                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                $rutaDestino = public_path('access/images/menu');
                if (!file_exists($rutaDestino)) {
                    mkdir($rutaDestino, 0755, true);
                }
                
                $imagen->move($rutaDestino, $nombreImagen);
                $menu->url_imagen = $nombreImagen;
            }

            $menu->save();

            // Eliminar relaciones anteriores
            MenuCategorias::where('menu_id', $id)->delete();

            $categoriasIds = [];

            // Asociar categorías existentes
            if ($request->categorias_existentes) {
                $categoriasIds = array_merge($categoriasIds, $request->categorias_existentes);
            }

            // Crear nuevas categorías
            if ($request->nuevas_categorias) {
                foreach ($request->nuevas_categorias as $nuevaCategoria) {
                    $categoria = Categoria::create([
                        'nombre' => $nuevaCategoria['nombre'],
                        'descripcion' => $nuevaCategoria['descripcion'] ?? null
                    ]);
                    $categoriasIds[] = $categoria->id;
                }
            }

            // Asociar todas las categorías al menú
            foreach ($categoriasIds as $categoriaId) {
                MenuCategorias::create([
                    'menu_id' => $menu->id,
                    'categoria_id' => $categoriaId
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Elemento de menú actualizado exitosamente',
                'menu' => $menu->load('categorias')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el elemento: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->id_rol != 1) {
            return response()->json([
                'success' => false,
                'message' => 'No autorizado'
            ], 403);
        }

        // Validar contraseña del usuario
        if (!Hash::check($request->password, Auth::user()->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Contraseña incorrecta'
            ], 401);
        }

        try {
            $menu = Menu::findOrFail($id);
            
            // Eliminar imagen si existe
            if ($menu->url_imagen && file_exists(public_path('access/images/menu/' . $menu->url_imagen))) {
                unlink(public_path('access/images/menu/' . $menu->url_imagen));
            }

            // Eliminar relaciones
            MenuCategorias::where('menu_id', $id)->delete();

            // Eliminar el menú
            $menu->delete();

            return response()->json([
                'success' => true,
                'message' => 'Elemento de menú eliminado exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el elemento: ' . $e->getMessage()
            ], 500);
        }
    }
}
