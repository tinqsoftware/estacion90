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
    
    // Define categorías que deben mostrar precio
    $categoriasConPrecio = [5, 6, 7, 8, 9];
    
    // Para cada categoría, cargamos sus productos con paginación
    foreach ($categorias as $categoria) {
        // Usar un prefijo único para la paginación de cada categoría
        $categoria->productosPaginados = Producto::where('id_categoria', $categoria->id)
            ->where('estado', 1)  // Solo mostrar productos activos
            ->orderBy('nombre', 'asc')  // Ordenar alfabéticamente por nombre
            ->paginate(15, ['*'], 'categoria_'.$categoria->id);
        
        // Importante: Asegurarse que los links de paginación mantengan el tab activo
        $categoria->productosPaginados->appends(['tab_id' => $activeTabId]);
        
        // Marcar si esta categoría debe mostrar columna de precio
        $categoria->mostrarPrecio = in_array($categoria->id, $categoriasConPrecio);
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
    
    return view('productos.productos', compact('categorias', 'activeTabId', 'todosProductos', 'search', 'categoriasConPrecio'));
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,bmp,tiff,heic,heif,svg|max:10240', // Ampliado soporte y tamaño a 10MB
        ]);

        DB::beginTransaction();
        try {
            $producto = new Producto();
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio = $request->precio;
            $producto->id_categoria = $request->categoria_id;
            $producto->stock = 0;
            $producto->estado = 1;
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,bmp,tiff,heic,heif,svg|max:10240', // Ampliado soporte
        ]);

        DB::beginTransaction();
        try {
            $producto = Producto::findOrFail($id);
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio = $request->precio;
            $producto->id_categoria = $request->categoria_id;
            $producto->stock = 0;
            
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
            // Aumentar límite de memoria para procesar imágenes grandes
            ini_set('memory_limit', '1024M');
            set_time_limit(120); // 2 minutos para procesar
            
            $targetDir = public_path('access/images/popular-img/');
            if (!file_exists($targetDir)) {
                if (!mkdir($targetDir, 0755, true)) {
                    Log::error("Failed to create directory: $targetDir");
                    return null;
                }
            }

            if (!is_writable($targetDir)) {
                Log::error("Directory is not writable: $targetDir");
                return null;
            }
            
            // Obtener información del archivo
            $originalExtension = strtolower($imageFile->getClientOriginalExtension());
            $mimeType = $imageFile->getMimeType();
            $fileSize = $imageFile->getSize();
            
            Log::info("Processing image - Extension: {$originalExtension}, MIME: {$mimeType}, Size: {$fileSize}");
            
            // Determinar extensión de salida (siempre convertir a JPG para consistencia, excepto PNG con transparencia)
            $saveExtension = $this->determineSaveExtension($originalExtension, $mimeType, $imageFile);
            
            $filename = time() . '_' . uniqid() . '.' . $saveExtension;
            $imagePath = $targetDir . $filename;
            $relativePath = 'access/images/popular-img/' . $filename;

            // Procesar según el tipo de imagen
            if ($this->isSpecialFormat($originalExtension, $mimeType)) {
                return $this->processSpecialFormat($imageFile, $imagePath, $relativePath, $originalExtension, $mimeType);
            } else {
                return $this->processStandardFormat($imageFile, $imagePath, $relativePath, $saveExtension, $fileSize);
            }
            
        } catch (\Exception $e) {
            Log::error("Image processing failed: " . $e->getMessage());
            Log::error("Error trace: " . $e->getTraceAsString());
            return null;
        }
    }

    private function determineSaveExtension($originalExtension, $mimeType, $imageFile)
    {
        // Mantener PNG si tiene transparencia
        if ($originalExtension === 'png' && $this->hasTransparency($imageFile)) {
            return 'png';
        }
        
        // Para formatos especiales o imágenes sin transparencia, convertir a JPG
        return 'jpg';
    }

    private function hasTransparency($imageFile)
    {
        try {
            $manager = new ImageManager(new Driver());
            $img = $manager->read($imageFile->getPathname());
            // Verificar si tiene canal alfa
            $color = $img->pickColor(0, 0); // returns [R, G, B, A]
            return isset($color[3]) && $color[3] < 1.0;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function isSpecialFormat($extension, $mimeType)
    {
        $specialFormats = ['heic', 'heif', 'webp', 'bmp', 'tiff', 'tif', 'svg'];
        return in_array($extension, $specialFormats) || 
               in_array($mimeType, ['image/heic', 'image/heif', 'image/webp', 'image/bmp', 'image/tiff', 'image/svg+xml']);
    }

    private function processSpecialFormat($imageFile, $imagePath, $relativePath, $extension, $mimeType)
    {
        try {
            // Para SVG, guardar como está (pero convertir a PNG para web)
            if ($extension === 'svg' || $mimeType === 'image/svg+xml') {
                return $this->processSVG($imageFile, $imagePath, $relativePath);
            }

            // Para HEIC/HEIF
            if (in_array($extension, ['heic', 'heif']) || in_array($mimeType, ['image/heic', 'image/heif'])) {
                return $this->processHEIC($imageFile, $imagePath, $relativePath);
            }

            // Para otros formatos especiales, usar Intervention Image
            $manager = new ImageManager(new Driver());
            $img = $manager->read($imageFile->getPathname());
            
            // Redimensionar manteniendo proporción
            $img->resize(1200, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            // Guardar como JPG con buena calidad
            $img->save($imagePath, 85);
            
            Log::info("Special format processed successfully: " . $relativePath);
            return $relativePath;
            
        } catch (\Exception $e) {
            Log::warning("Special format processing failed, trying fallback: " . $e->getMessage());
            return $this->processFallback($imageFile, $imagePath, $relativePath);
        }
    }

    private function processSVG($imageFile, $imagePath, $relativePath)
    {
        try {
            // Para SVG, convertir a PNG con Intervention Image
            $manager = new ImageManager(new Driver());
            $img = $manager->read($imageFile->getPathname());
            
            // Redimensionar a un tamaño razonable
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            // Cambiar extensión a PNG para SVG
            $newPath = str_replace('.jpg', '.png', $imagePath);
            $newRelativePath = str_replace('.jpg', '.png', $relativePath);
            
            $img->save($newPath, 90);
            
            Log::info("SVG processed successfully: " . $newRelativePath);
            return $newRelativePath;
            
        } catch (\Exception $e) {
            Log::error("SVG processing failed: " . $e->getMessage());
            return null;
        }
    }

    private function processHEIC($imageFile, $imagePath, $relativePath)
    {
        try {
            $tempFile = $imageFile->getRealPath();
            
            // Método 1: Intervention Image
            try {
                $manager = new ImageManager(new Driver());
                $img = $manager->read($tempFile);
                $img->resize(1200, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                $img->save($imagePath, 85);
                Log::info("HEIC processed successfully with Intervention Image");
                return $relativePath;
            } catch (\Exception $e) {
                Log::warning("Intervention Image HEIC failed: " . $e->getMessage());
            }
            
            // Método 2: Conversión con GD (fallback)
            return $this->processHEICWithGD($tempFile, $imagePath, $relativePath);
            
        } catch (\Exception $e) {
            Log::error("All HEIC processing methods failed: " . $e->getMessage());
            return null;
        }
    }

    private function processHEICWithGD($tempFile, $imagePath, $relativePath)
    {
        try {
            // Copiar archivo temporalmente
            copy($tempFile, $imagePath);
            
            // Intentar leer con GD
            $image = @imagecreatefromjpeg($imagePath);
            if ($image) {
                $width = imagesx($image);
                $height = imagesy($image);
                
                // Redimensionar si es necesario
                if ($width > 1200 || $height > 1200) {
                    $ratio = min(1200 / $width, 1200 / $height);
                    $newWidth = (int)($width * $ratio);
                    $newHeight = (int)($height * $ratio);
                    
                    $resized = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagejpeg($resized, $imagePath, 85);
                    imagedestroy($resized);
                } else {
                    imagejpeg($image, $imagePath, 85);
                }
                
                imagedestroy($image);
                Log::info("HEIC processed with GD fallback");
                return $relativePath;
            }
            
            return null;
        } catch (\Exception $e) {
            Log::error("GD HEIC processing failed: " . $e->getMessage());
            return null;
        }
    }

    private function processStandardFormat($imageFile, $imagePath, $relativePath, $saveExtension, $fileSize)
    {
        try {
            if ($fileSize > 5000000) { // 5MB - usar GD para archivos grandes
                return $this->processLargeImageWithGD($imageFile, $imagePath, $relativePath, $saveExtension);
            } else {
                return $this->processImageWithIntervention($imageFile, $imagePath, $relativePath, $saveExtension);
            }
        } catch (\Exception $e) {
            Log::warning("Standard processing failed, trying fallback: " . $e->getMessage());
            return $this->processFallback($imageFile, $imagePath, $relativePath);
        }
    }

    private function processImageWithIntervention($imageFile, $imagePath, $relativePath, $saveExtension)
    {
        $manager = new ImageManager(new Driver());
        $img = $manager->read($imageFile->getPathname());
        
        // Redimensionar manteniendo proporción
        $img->resize(1200, 1200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        
        // Guardar según el formato
        $quality = $saveExtension === 'png' ? 90 : 85;
        $img->save($imagePath, $quality);
        
        Log::info("Image processed with Intervention: " . $relativePath);
        return $relativePath;
    }

    private function processLargeImageWithGD($imageFile, $imagePath, $relativePath, $saveExtension)
    {
        $tempPath = $imageFile->getRealPath();
        
        // Crear imagen desde archivo
        $srcImage = imagecreatefromstring(file_get_contents($tempPath));
        
        if (!$srcImage) {
            throw new \Exception("Failed to create image resource");
        }
        
        $width = imagesx($srcImage);
        $height = imagesy($srcImage);
        
        // Calcular nuevas dimensiones
        $maxDimension = 1200;
        
        if ($width > $maxDimension || $height > $maxDimension) {
            $ratio = min($maxDimension / $width, $maxDimension / $height);
            $newWidth = (int)($width * $ratio);
            $newHeight = (int)($height * $ratio);
            
            $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
            
            // Preservar transparencia para PNG
            if ($saveExtension === 'png') {
                imagealphablending($resizedImage, false);
                imagesavealpha($resizedImage, true);
                $transparent = imagecolorallocatealpha($resizedImage, 255, 255, 255, 127);
                imagefilledrectangle($resizedImage, 0, 0, $newWidth, $newHeight, $transparent);
            }
            
            imagecopyresampled($resizedImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            
            // Guardar según formato
            switch ($saveExtension) {
                case 'png':
                    imagepng($resizedImage, $imagePath, 8);
                    break;
                default:
                    imagejpeg($resizedImage, $imagePath, 85);
            }
            
            imagedestroy($resizedImage);
        } else {
            // Guardar sin redimensionar
            switch ($saveExtension) {
                case 'png':
                    imagepng($srcImage, $imagePath, 8);
                    break;
                default:
                    imagejpeg($srcImage, $imagePath, 85);
            }
        }
        
        imagedestroy($srcImage);
        
        Log::info("Large image processed with GD: " . $relativePath);
        return $relativePath;
    }

    private function processFallback($imageFile, $imagePath, $relativePath)
    {
        try {
            // Último recurso: simplemente mover el archivo
            if ($imageFile->move(dirname($imagePath), basename($imagePath))) {
                Log::info("Image saved as fallback: " . $relativePath);
                return $relativePath;
            }
        } catch (\Exception $e) {
            Log::error("Fallback processing failed: " . $e->getMessage());
        }
        
        return null;
    }
}