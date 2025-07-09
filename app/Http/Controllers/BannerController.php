<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banners;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banners::with('creator')
                          ->where('tipo', 1)
                          ->orderBy('id', 'asc')
                          ->get();
        return view('banner.banner', compact('banners'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        try {
            // Subir imagen a public/access/images/banners
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            // Crear directorio si no existe
            $rutaDestino = public_path('access/images/banners');
            if (!file_exists($rutaDestino)) {
                mkdir($rutaDestino, 0755, true);
            }
            
            // Mover imagen
            $imagen->move($rutaDestino, $nombreImagen);

            // Crear banner con todos los campos requeridos - solo guardar el nombre
            $banner = Banners::create([
                'url_imagen' => $nombreImagen, // Solo el nombre del archivo
                'link' => '', // Campo por defecto vacío
                'tipo' => 1, // Campo por defecto 1
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'id_user_create' => Auth::id()
            ]);

            return response()->json(['success' => true, 'message' => 'Banner creado exitosamente', 'banner' => $banner]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al crear el banner: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ya no necesitamos retornar una vista, todo se maneja inline
        $banner = Banners::with('creator')->findOrFail($id);
        
        // Retornar datos JSON para uso inline si es necesario
        return response()->json([
            'id' => $banner->id,
            'url_imagen' => $banner->url_imagen,
            'fecha_inicio' => $banner->fecha_inicio,
            'fecha_fin' => $banner->fecha_fin,
            'creator_name' => optional($banner->creator)->name ?? 'Usuario no encontrado',
            'created_at' => $banner->created_at->format('d M Y H:i')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $banner = Banners::findOrFail($id);
        return response()->json($banner);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $banner = Banners::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        try {
            $datosActualizar = [
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
            ];

            // Si se subió una nueva imagen
            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior
                if ($banner->url_imagen && file_exists(public_path('access/images/banners/' . $banner->url_imagen))) {
                    unlink(public_path('access/images/banners/' . $banner->url_imagen));
                }

                // Subir nueva imagen
                $imagen = $request->file('imagen');
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                
                // Crear directorio si no existe
                $rutaDestino = public_path('access/images/banners');
                if (!file_exists($rutaDestino)) {
                    mkdir($rutaDestino, 0755, true);
                }
                
                // Mover imagen
                $imagen->move($rutaDestino, $nombreImagen);
                $datosActualizar['url_imagen'] = $nombreImagen; // Solo el nombre del archivo
            }

            $banner->update($datosActualizar);

            return response()->json(['success' => true, 'message' => 'Banner actualizado exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al actualizar el banner: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $banner = Banners::findOrFail($id);
            
            // Eliminar imagen
            if ($banner->url_imagen && file_exists(public_path('access/images/banners/' . $banner->url_imagen))) {
                unlink(public_path('access/images/banners/' . $banner->url_imagen));
            }

            $banner->delete();

            return response()->json(['success' => true, 'message' => 'Banner eliminado exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al eliminar el banner: ' . $e->getMessage()]);
        }
    }

    /**
     * Get banners activos para mostrar en el frontend
     */
    public function getBannersActivos()
    {
        $hoy = now()->format('Y-m-d');
        $banners = Banners::where('fecha_inicio', '<=', $hoy)
                          ->where('fecha_fin', '>=', $hoy)
                          ->where('tipo', 1)
                          ->orderBy('created_at', 'desc')
                          ->get();
        
        return response()->json($banners);
    }
}
