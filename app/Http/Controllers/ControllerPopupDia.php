<?php

namespace App\Http\Controllers;

use App\Models\popup;
use App\Models\popupdia;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ControllerPopupDia extends Controller
{
     public function getPopupsForUser()
    {
        // Obtener fecha actual
        $today = Carbon::now()->format('Y-m-d');
        
        // Obtener ID del usuario (si está autenticado)
        $userId = Auth::check() ? Auth::id() : null;
        
        // Buscar popups válidos para hoy
        $popups = popup::where('fecha_visible', $today)
                       ->where('veces_dia', '>', 0)
                       ->get();
        
        $popupsToShow = [];
        
        foreach ($popups as $popup) {
            // Si el usuario no está autenticado, mostrar el popup
            if (!$userId) {
                $popupsToShow[] = $popup;
                continue;
            }
            
            // Buscar registro de vistas para este usuario y popup
            $viewRecord = popupdia::where('id_user_cliente', $userId)
                               ->where('id_popup', $popup->id)
                               ->where('fecha', $today)
                               ->first();
            
            // Si no hay registro de vistas o aún no alcanza el límite, mostrar el popup
            if (!$viewRecord || $viewRecord->cant_vistas < $popup->veces_dia) {
                $popupsToShow[] = $popup;
            }
        }
        
        return response()->json([
            'success' => true,
            'popups' => $popupsToShow
        ]);
    }
    
    /**
     * Registra una vista de popup para el usuario actual.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recordPopupView(Request $request)
{
    try {
        $request->validate([
            'popup_id' => 'required|integer',
        ]);
        
        // Obtener fecha actual
        $today = Carbon::now()->format('Y-m-d');
        
        // Obtener ID del usuario (si está autenticado)
        $userId = Auth::check() ? Auth::id() : null;
        
        // Si el usuario no está autenticado, simulamos éxito pero no guardamos
        if (!$userId) {
            return response()->json([
                'success' => true,
                'message' => 'Usuario no autenticado, no se registró vista'
            ]);
        }
        
        // Verificar si el popup existe
        $popup = popup::find($request->popup_id);
        if (!$popup) {
            return response()->json([
                'success' => false,
                'message' => 'El popup no existe'
            ], 404);
        }
        
        // Buscar registro de vistas
        $viewRecord = popupdia::where([
            'id_user_cliente' => $userId,
            'id_popup' => $request->popup_id,
            'fecha' => $today,
        ])->first();
        
        // Si no existe, crear nuevo registro
        if (!$viewRecord) {
            $viewRecord = new popupdia();
            $viewRecord->id_user_cliente = $userId;
            $viewRecord->id_popup = $request->popup_id;
            $viewRecord->fecha = $today;
            $viewRecord->cant_vistas = 1;
        } else {
            // Incrementar contador de vistas
            $viewRecord->cant_vistas++;
        }
        
        $viewRecord->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Vista registrada correctamente',
            'views' => $viewRecord->cant_vistas
        ]);
    } catch (\Exception $e) {
        // Registrar el error y devolver respuesta de error
        Log::error('Error al registrar vista de popup: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error al registrar vista: ' . $e->getMessage()
        ], 500);
    }
}
    
    /**
     * Muestra los popups en el frontend
     * 
     * @return \Illuminate\View\View
     */
    public function showPopupsOnPage()
    {
        // Este método puede ser usado para mostrar popups en una vista específica
        // En lugar de usar AJAX, si prefieres cargar los popups directamente
        
        // Obtener fecha actual
        $today = Carbon::now()->format('Y-m-d');
        
        // Obtener ID del usuario (si está autenticado)
        $userId = Auth::check() ? Auth::id() : null;
        
        // Buscar popups válidos para hoy
        $popups = popup::where('fecha_visible', $today)
                       ->where('veces_dia', '>', 0)
                       ->get();
        
        $popupsToShow = [];
        
        foreach ($popups as $popup) {
            // Si el usuario no está autenticado, mostrar el popup
            if (!$userId) {
                $popupsToShow[] = $popup;
                continue;
            }
            
            // Buscar registro de vistas para este usuario y popup
            $viewRecord = popupdia::where('id_user_cliente', $userId)
                               ->where('id_popup', $popup->id)
                               ->where('fecha', $today)
                               ->first();
            
            // Si no hay registro de vistas o aún no alcanza el límite, mostrar el popup
            if (!$viewRecord || $viewRecord->cant_vistas < $popup->veces_dia) {
                $popupsToShow[] = $popup;
            }
        }
        
        return view('popup.show_popups', ['popups' => $popupsToShow]);
    }
}
