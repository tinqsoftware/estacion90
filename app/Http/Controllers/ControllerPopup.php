<?php

namespace App\Http\Controllers;

use App\Models\popup;
use App\Models\popupdia;
use Illuminate\Http\Request;
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

    $targetDir = public_path('access/images/popular-img/');
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $filename = time() . '_' . $imageFile->getClientOriginalName();
    $imagePath = $targetDir . $filename;
    $relativePath = 'access/images/popular-img/' . $filename;

    // Usa ImageManager directamente
    $manager = new ImageManager(new Driver());
    $img = $manager->read($imageFile->getPathname());
    
    // Get image dimensions
    $width = $img->width();
    $height = $img->height();
    
    // First crop to a square (using the shortest side)
    if ($width > $height) {
        // Landscape image
        $x = ($width - $height) / 2;
        $y = 0;
        $size = $height;
    } else {
        // Portrait or square image
        $x = 0;
        $y = ($height - $width) / 2;
        $size = $width;
    }
    
    // Crop to square
    $img->crop($size, $size, (int)$x, (int)$y);
    
    // Now resize to exactly 200x200
    $img->resize(500, 500);
    
    // Save the final image
    $img->save($imagePath);

    return $relativePath;
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
