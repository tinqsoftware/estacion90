<?php

namespace App\Http\Controllers;

use App\Models\popup;
use App\Models\popupdia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ControllerPopup extends Controller
{
    public function index(Request $request)
{
    $currentTab = $request->input('tab', 'pendientes');
    $today = now()->startOfDay();
    
    if ($currentTab == 'pendientes') {
        // Popups with date greater than or equal to today
        $popups = Popup::with(['viewRecords', 'creator'])
                    ->where('fecha_visible', '>=', $today)
                    ->orderBy('fecha_visible', 'desc')
                    ->paginate(10);
    } else {
        // Past popups with date less than today
        $popups = Popup::with(['viewRecords', 'creator'])
                    ->where('fecha_visible', '<', $today)
                    ->orderBy('fecha_visible', 'desc')
                    ->paginate(10);
    }
    
    return view('popup.popup', compact('popups'));
}

    /**
     * Show the form for creating a new popup
     */
    public function create()
    {
        return view('popup.create');
    }

    private function processAndSaveImage($imageFile)
{
    if (!$imageFile) {
        return null;
    }

    try {
        // Set memory limit higher for processing large images
        ini_set('memory_limit', '256M');
        
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

        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\_\.]/', '', $imageFile->getClientOriginalName());
        $imagePath = $targetDir . $filename;
        $relativePath = 'access/images/popular-img/' . $filename;

        // For very large images, use a different approach
        $fileSize = $imageFile->getSize();
        
        // Log file information
        Log::info("Processing image: " . $filename . ", size: " . $fileSize . " bytes");
        
        if ($fileSize > 5000000) { // 5MB
            Log::info("Large image detected, using optimized processing");
            
            // Save the uploaded file directly
            $tempPath = $imageFile->getRealPath();
            
            // Use PHP's GD library instead of Intervention for large files
            $srcImage = imagecreatefromstring(file_get_contents($tempPath));
            
            // Get original dimensions
            $width = imagesx($srcImage);
            $height = imagesy($srcImage);
            
            // Calculate dimensions for square crop
            if ($width > $height) {
                $x = ($width - $height) / 2;
                $y = 0;
                $size = $height;
            } else {
                $x = 0;
                $y = ($height - $width) / 2;
                $size = $width;
            }
            
            // Create a square image
            $squareImage = imagecreatetruecolor($size, $size);
            imagecopy($squareImage, $srcImage, 0, 0, (int)$x, (int)$y, $size, $size);
            
            // Create final resized image
            $finalImage = imagecreatetruecolor(200, 200);
            imagecopyresampled($finalImage, $squareImage, 0, 0, 0, 0, 200, 200, $size, $size);
            
            // Save the image
            imagejpeg($finalImage, $imagePath, 90);
            
            // Free memory
            imagedestroy($srcImage);
            imagedestroy($squareImage);
            imagedestroy($finalImage);
        } else {
            // Use intervention/image for smaller files
            $manager = new ImageManager(new Driver());
            $img = $manager->read($imageFile->getPathname());
            
            // Get image dimensions
            $width = $img->width();
            $height = $img->height();
            
            // First crop to a square (using the shortest side)
            if ($width > $height) {
                $x = ($width - $height) / 2;
                $y = 0;
                $size = $height;
            } else {
                $x = 0;
                $y = ($height - $width) / 2;
                $size = $width;
            }
            
            // Crop to square
            $img->crop($size, $size, (int)$x, (int)$y);
            
            // Now resize to exactly 200x200
            $img->resize(200, 200);
            
            // Save the final image
            $img->save($imagePath);
        }
        
        Log::info("Image processed successfully: " . $relativePath);
        return $relativePath;
    } catch (\Exception $e) {
        Log::error("Image processing failed: " . $e->getMessage());
        Log::error("Error trace: " . $e->getTraceAsString());
        return null;
    }
}

    /**
     * Store a newly created popup
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'link' => 'nullable|url|max:255',
        'fecha_visible' => 'required|date',
        'veces_dia' => 'required|integer|min:0',
    ]);

    // Process image upload with automatic resizing
    $url_imagen = null;
    if ($request->hasFile('imagen')) {
        $url_imagen = $this->processAndSaveImage($request->file('imagen'));
    }

    // Create popup using fillable fields
    $popup = new Popup();
    $popup->nombre = $validated['nombre'];
    $popup->url_imagen = $url_imagen;
    $popup->link = $validated['link'] ?? null;
    $popup->veces_dia = $validated['veces_dia'];
    $popup->id_user_create = Auth::id();
    $popup->fecha_visible = $validated['fecha_visible'];
    $popup->save();

    return redirect()->route('popups.index')
        ->with('success', 'Popup creado correctamente');
}

    /**
     * Show the form for editing a popup
     */
    public function edit($id)
{
    $popup = Popup::findOrFail($id);
    return response()->json($popup);
}

    /**
     * Update the specified popup
     */
    public function update(Request $request, $id)
{
    try {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'link' => 'nullable|url|max:255',
            'fecha_visible' => 'required|date',
            'veces_dia' => 'required|integer|min:0',
        ]);

        $popup = Popup::findOrFail($id);
        
        // Keep original image if no new image is uploaded
        $url_imagen = $popup->url_imagen;

        // Handle image upload with automatic resizing
        if ($request->hasFile('imagen')) {
            // Delete old image if exists
            if ($popup->url_imagen && file_exists(public_path($popup->url_imagen))) {
                unlink(public_path($popup->url_imagen));
            }
            
            $url_imagen = $this->processAndSaveImage($request->file('imagen'));
            
            if ($url_imagen === null) {
                return response()->json(['message' => 'Failed to process image'], 500);
            }
        }

        // Update popup fields
        $popup->nombre = $validated['nombre'];
        $popup->url_imagen = $url_imagen;
        $popup->link = $validated['link'] ?? null;
        $popup->veces_dia = $validated['veces_dia'];
        $popup->fecha_visible = $validated['fecha_visible'];
        $popup->save();

        return redirect()->route('popups.index')
            ->with('success', 'Popup actualizado correctamente');
    } catch (\Exception $e) {
        Log::error("Popup update failed: " . $e->getMessage());
        return response()->json(['message' => $e->getMessage()], 500);
    }
}

    /**
     * Display popup details for modal view
     */
    public function viewDetails($id)
    {
        $popup = Popup::with(['viewRecords', 'creator'])->findOrFail($id);
    return view('popup.popup_details', compact('popup'));
    }


    public function destroy($id)
{
    $popup = Popup::findOrFail($id);
    
    // Delete image file if exists
    if ($popup->url_imagen && file_exists(public_path($popup->url_imagen))) {
        unlink(public_path($popup->url_imagen));
    }
    
    
    // Delete popup
    $popup->delete();
    
    return redirect()->route('popups.index')
        ->with('success', 'Popup eliminado correctamente');
}
}
