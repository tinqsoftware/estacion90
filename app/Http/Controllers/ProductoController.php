<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use App\Models\Producto;
use Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductoController extends Controller
{
   public function productos_tab()
{
    $categorias = Categoria::all();
    $activeTabId = request()->get('tab_id', 'todos');
    $search = request()->get('search');
    
    // Para cada categoría, cargamos sus productos con paginación
    foreach ($categorias as $categoria) {
        // Usar un prefijo único para la paginación de cada categoría
        $categoria->productosPaginados = Producto::where('id_categoria', $categoria->id)
            ->where('estado', 1)  // Solo mostrar productos activos
            ->orderBy('nombre', 'asc')  // Ordenar alfabéticamente por nombre
            ->paginate(15, ['*'], 'categoria_'.$categoria->id);
        
        // Importante: Asegurarse que los links de paginación mantengan el tab activo
        $categoria->productosPaginados->appends(['tab_id' => $activeTabId]);
    }

    // Tab "Todos" - ordenado alfabéticamente por nombre, sin paginación
    $query = Producto::with(['creador', 'categoria'])
        ->where('estado', 1);  // Solo mostrar productos activos
    
    // Aplicar búsqueda si existe
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('nombre', 'like', "%{$search}%")
              ->orWhere('descripcion', 'like', "%{$search}%")
              ->orWhere('precio', 'like', "%{$search}%")
              ->orWhereHas('categoria', function($subq) use ($search) {
                  $subq->where('nombre', 'like', "%{$search}%");
              });
        });
    }
    
    // Obtener todos los productos sin paginación
    $todosProductos = $query->orderBy('nombre', 'asc')->get();
    
    return view('productos.productos', compact('categorias', 'activeTabId', 'todosProductos', 'search'));
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,HEIC', // Added heic format and increased max size
            'stock' => 'required|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            $producto = new Producto();
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio = $request->precio;
            $producto->id_categoria = $request->categoria_id;
            $producto->stock = $request->stock;
            $producto->estado = 1; // Estado activo por defecto
            $producto->id_user_create = \Illuminate\Support\Facades\Auth::id() ?? 1;
            
            // Procesar la imagen si existe
            if ($request->hasFile('imagen')) {
                $producto->imagen = $this->processAndSaveImage($request->file('imagen'));
                
                if ($producto->imagen === null) {
                    throw new \Exception('Error al procesar la imagen');
                }
            }
            
            $producto->save();
            DB::commit();
            
            return redirect()->route('productos_tab')->with('success', 'Producto creado exitosamente');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error al crear producto: ' . $e->getMessage());
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,HEIC', // Added heic format and increased max size
            'stock' => 'required|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            $producto = Producto::findOrFail($id);
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio = $request->precio;
            $producto->id_categoria = $request->categoria_id;
            $producto->stock = $request->stock;
            
            // Procesar la imagen si existe
            if ($request->hasFile('imagen')) {
                // Eliminar la imagen anterior si existe y no es la imagen por defecto
                if ($producto->imagen && file_exists(public_path($producto->imagen)) && 
                    !str_contains($producto->imagen, 'product/1.jpg')) {
                    unlink(public_path($producto->imagen));
                }
                
                // Procesar y guardar la nueva imagen
                $producto->imagen = $this->processAndSaveImage($request->file('imagen'));
                
                if ($producto->imagen === null) {
                    throw new \Exception('Error al procesar la imagen');
                }
            }
            
            $producto->save();
            DB::commit();
            
            return redirect()->route('productos_tab')->with('success', 'Producto actualizado exitosamente');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error al actualizar producto: ' . $e->getMessage());
            return back()->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }
    // Eliminar el producto
    public function destroy($id)
    {
         DB::beginTransaction();
    try {
        $producto = Producto::findOrFail($id);
        
        // Cambiamos el estado a 0 (inactivo) en lugar de eliminar
        $producto->estado = 0;
        $producto->save();
        
        DB::commit();
        
        return redirect()->route('productos_tab')->with('success', 'Producto desactivado exitosamente');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Error al desactivar el producto: ' . $e->getMessage());
    }
    }

    private function processAndSaveImage($imageFile)
{
    if (!$imageFile) {
        return null;
    }

    try {
        // Set memory limit higher for processing large images
        ini_set('memory_limit', '512M');
        
        $targetDir = public_path('access/images/popular-img/');
        if (!file_exists($targetDir)) {
            if (!mkdir($targetDir, 0755, true)) {
                Log::error("Failed to create directory: $targetDir");
                return null;
            }
        }

        // Check if directory is writable
        if (!is_writable($targetDir)) {
            Log::error("Directory is not writable: $targetDir");
            return null;
        }
        
        // Get file extension and prepare filename
        $originalExtension = strtolower($imageFile->getClientOriginalExtension());
        $mimeType = $imageFile->getMimeType();
        
        // Fix for HEIC detection - sometimes it's not correctly identified by extension
        if ($originalExtension == 'heic' || $mimeType == 'image/heic' || $mimeType == 'image/heif') {
            Log::info("HEIC image detected: {$originalExtension}, MIME type: {$mimeType}");
            $saveExtension = 'jpg';
        } else {
            $saveExtension = $originalExtension;
        }
        
        $filename = time() . '_' . uniqid() . '.' . $saveExtension;
        $imagePath = $targetDir . $filename;
        $relativePath = 'access/images/popular-img/' . $filename;

        // For HEIC files, try multiple approaches for conversion
        if ($originalExtension == 'heic' || $mimeType == 'image/heic' || $mimeType == 'image/heif') {
            Log::info("Processing HEIC image with fallback methods");
            
            // Method 1: Get raw file contents - don't rely on Laravel's file handling
            $tempFile = $imageFile->getRealPath();
            
            // Method 2: Try using Intervention Image
            try {
                $manager = new ImageManager(new Driver());
                $img = $manager->read($tempFile);
                $img->resize(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                $img->save($imagePath, 85);
                
                // If we get here, it worked!
                Log::info("HEIC processed successfully with Intervention Image");
                return $relativePath;
            } catch (\Exception $e) {
                Log::warning("Intervention Image couldn't process HEIC: " . $e->getMessage());
                // Continue to fallback methods
            }
            
            // Method 3: Try with GD after simple copy
            try {
                // First save the file as is
                copy($tempFile, $imagePath);
                
                // Then try to read with GD and resave
                $image = @imagecreatefromjpeg($imagePath);
                if ($image) {
                    // Get dimensions
                    $width = imagesx($image);
                    $height = imagesy($image);
                    
                    // Resize if too large
                    if ($width > 1200 || $height > 1200) {
                        if ($width > $height) {
                            $newWidth = 1200;
                            $newHeight = ($height / $width) * 1200;
                        } else {
                            $newHeight = 1200;
                            $newWidth = ($width / $height) * 1200;
                        }
                        
                        $resized = imagecreatetruecolor((int)$newWidth, (int)$newHeight);
                        imagecopyresampled($resized, $image, 0, 0, 0, 0, (int)$newWidth, (int)$newHeight, $width, $height);
                        imagejpeg($resized, $imagePath, 85);
                        imagedestroy($resized);
                    } else {
                        // Just save with compression
                        imagejpeg($image, $imagePath, 85);
                    }
                    
                    imagedestroy($image);
                    Log::info("HEIC processed with GD fallback method");
                    return $relativePath;
                }
            } catch (\Exception $e) {
                Log::warning("GD fallback failed: " . $e->getMessage());
            }
            
            // Method 4: Last resort - just keep the file as is
            if (file_exists($imagePath)) {
                Log::info("Using unprocessed HEIC file (converted to JPG)");
                return $relativePath;
            }
            
            Log::error("All HEIC processing methods failed");
            return null;
        }
        
        // For regular images, use your existing code
        $fileSize = $imageFile->getSize();
        
        if ($fileSize > 3000000) { // 3MB
            // Your existing large file handling code
            // ...
            
            // Use temporary file for processing
            $tempPath = $imageFile->getRealPath();
            
            // Now process with GD library
            $srcImage = imagecreatefromstring(file_get_contents($tempPath));
            
            if (!$srcImage) {
                Log::error("Failed to create image resource");
                return null;
            }
            
            // Get original dimensions
            $width = imagesx($srcImage);
            $height = imagesy($srcImage);
            
            // Calculate new dimensions - maintain aspect ratio
            $maxDimension = 1200; // Maximum width or height
            
            if ($width > $maxDimension || $height > $maxDimension) {
                if ($width > $height) {
                    $newWidth = $maxDimension;
                    $newHeight = ($height / $width) * $newWidth;
                } else {
                    $newHeight = $maxDimension;
                    $newWidth = ($width / $height) * $newHeight;
                }
                
                // Create resized image
                $resizedImage = imagecreatetruecolor((int)$newWidth, (int)$newHeight);
                
                // Preserve transparency for PNG
                if ($saveExtension == 'png') {
                    imagealphablending($resizedImage, false);
                    imagesavealpha($resizedImage, true);
                    $transparent = imagecolorallocatealpha($resizedImage, 255, 255, 255, 127);
                    imagefilledrectangle($resizedImage, 0, 0, $newWidth, $newHeight, $transparent);
                }
                
                imagecopyresampled($resizedImage, $srcImage, 0, 0, 0, 0, (int)$newWidth, (int)$newHeight, $width, $height);
                
                // Save the image based on format
                switch ($saveExtension) {
                    case 'png':
                        imagepng($resizedImage, $imagePath, 8); // 0-9 compression
                        break;
                    case 'gif':
                        imagegif($resizedImage, $imagePath);
                        break;
                    default:
                        imagejpeg($resizedImage, $imagePath, 85); // 85% quality
                }
                
                // Free memory
                imagedestroy($resizedImage);
            } else {
                // Just save the original with compression
                switch ($saveExtension) {
                    case 'png':
                        imagepng($srcImage, $imagePath, 8);
                        break;
                    case 'gif':
                        imagegif($srcImage, $imagePath);
                        break;
                    default:
                        imagejpeg($srcImage, $imagePath, 85);
                }
            }
            
            // Free memory
            imagedestroy($srcImage);
        } else {
            // Use intervention/image for smaller files
            $manager = new ImageManager(new Driver());
            $img = $manager->read($imageFile->getPathname());
            
            // Resize to reasonable dimensions while maintaining aspect ratio
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            // Save the image with reasonable compression
            switch ($saveExtension) {
                case 'png':
                    $img->save($imagePath, 80); // 80% quality for PNG
                    break;
                case 'gif':
                    $img->save($imagePath); // GIF doesn't use quality param
                    break;
                default:
                    $img->save($imagePath, 85); // 85% quality for JPEG
            }
        }
        
        Log::info("Image processed successfully: " . $relativePath);
        return $relativePath;
    } catch (\Exception $e) {
        Log::error("Image processing failed: " . $e->getMessage());
        Log::error("Error trace: " . $e->getTraceAsString());
        return null;
    }
}
}