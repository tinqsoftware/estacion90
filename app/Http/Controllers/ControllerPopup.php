<?php

namespace App\Http\Controllers;

use App\Models\popup;
use App\Models\popupdia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Store a newly created popup
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url|max:255',
            'descripcion' => 'nullable|string',
            'fecha_visible' => 'required|date',
            'veces_dia' => 'required|integer|min:0',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('popups', 'public');
        }

        // Create popup
        $popup = new Popup();
        $popup->nombre = $validated['nombre'];
        $popup->imagen = $imagePath;
        $popup->link = $validated['link'] ?? null;
        $popup->descripcion = $validated['descripcion'] ?? null;
        $popup->fecha_visible = $validated['fecha_visible'];
        $popup->veces_dia = $validated['veces_dia'];
        $popup->id_user_create = Auth::id();
        $popup->save();

        // Create popup_dia record
        $popupDia = new PopupDia();
        $popupDia->id_popup = $popup->id;
        $popupDia->fecha = $validated['fecha_visible'];
        $popupDia->cantidad = $validated['veces_dia'];
        $popupDia->save();

        return redirect()->route('popups.index')
            ->with('success', 'Popup creado correctamente');
    }

    /**
     * Show the form for editing a popup
     */
    public function edit($id)
    {
        $popup = Popup::with('popupdias')->findOrFail($id);
        return view('popup.edit', compact('popup'));
    }

    /**
     * Update the specified popup
     */
    public function update(Request $request, $id)
    {
        $popup = Popup::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url|max:255',
            'descripcion' => 'nullable|string',
            'fecha_visible' => 'required|date',
            'veces_dia' => 'required|integer|min:0',
        ]);

        // Handle image upload
        if ($request->hasFile('imagen')) {
            // Delete old image if exists
            if ($popup->imagen) {
                Storage::disk('public')->delete($popup->imagen);
            }
            $imagePath = $request->file('imagen')->store('popups', 'public');
            $popup->imagen = $imagePath;
        }

        // Update popup
        $popup->nombre = $validated['nombre'];
        $popup->link = $validated['link'] ?? null;
        $popup->descripcion = $validated['descripcion'] ?? null;
        $popup->fecha_visible = $validated['fecha_visible'];
        $popup->veces_dia = $validated['veces_dia'];
        $popup->save();

        // Update or create popup_dia record
        $popupDia = $popup->popupdias->first();
        if (!$popupDia) {
            $popupDia = new popupdia();
            $popupDia->id_popup = $popup->id;
        }
        
        $popupDia->fecha = $validated['fecha_visible'];
        $popupDia->cantidad = $validated['veces_dia'];
        $popupDia->save();

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
}
