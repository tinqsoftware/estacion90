<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
   
    public function index()
    {
        $menus = Menu::orderBy('id', 'asc')->get();
        return view('menu.menu', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar contraseña del usuario
        if (!Hash::check($request->password, Auth::user()->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Contraseña incorrecta'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif',
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
            $rutaImagen = null;
            
            // Subir imagen si existe
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                // Crear directorio si no existe
                $rutaDestino = public_path('access/images/menu');
                if (!file_exists($rutaDestino)) {
                    mkdir($rutaDestino, 0755, true);
                }
                
                // Mover imagen
                $imagen->move($rutaDestino, $nombreImagen);
                $rutaImagen = 'access/images/menu/' . $nombreImagen;
            }

            // Crear menú
            $menu = Menu::create([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'url_imagen' => $rutaImagen
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Elemento de menú creado exitosamente',
                'menu' => $menu
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el elemento: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            return response()->json($menu);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Elemento no encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar contraseña del usuario
        if (!Hash::check($request->password, Auth::user()->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Contraseña incorrecta'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif',
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
            $menu->precio = $request->precio;

            // Subir nueva imagen si existe
            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior si existe
                if ($menu->url_imagen && file_exists(public_path($menu->url_imagen))) {
                    unlink(public_path($menu->url_imagen));
                }

                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                // Crear directorio si no existe
                $rutaDestino = public_path('access/images/menu');
                if (!file_exists($rutaDestino)) {
                    mkdir($rutaDestino, 0755, true);
                }
                
                // Mover imagen
                $imagen->move($rutaDestino, $nombreImagen);
                $menu->url_imagen = 'access/images/menu/' . $nombreImagen;
            }

            $menu->save();

            return response()->json([
                'success' => true,
                'message' => 'Elemento de menú actualizado exitosamente',
                'menu' => $menu
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el elemento: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
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
            if ($menu->url_imagen && file_exists(public_path($menu->url_imagen))) {
                unlink(public_path($menu->url_imagen));
            }

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

