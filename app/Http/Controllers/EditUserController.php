<?php

namespace App\Http\Controllers;

use App\Models\DireccionUser;
use App\Models\Distrito;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EditUserController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        
        // Obtener todas las direcciones asociadas a este usuario
        $direcciones = DireccionUser::where('id_user', $user->id)
                        ->with('distrito')
                        ->get();
        
        // Obtener todos los distritos para el formulario
        $distritos = Distrito::all();
        
        return view('usuarios.edit_usuario', compact('user', 'direcciones', 'distritos'));
    }


    public function update(Request $request)
{
    // Customize validation messages
    $messages = [
        'email.unique' => 'Este correo ya lo está usando otra cuenta'
    ];

    // Validate the form input with custom messages
    $validated = $request->validate([
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        'telefono' => 'nullable|string|max:20',
    ], $messages);
    
    // Rest of the method remains the same
    $user = Auth::user();
    
    $user->name = $validated['nombres'];
    $user->apellido = $validated['apellidos'];
    $user->email = $validated['email'];
    $user->telefono = $validated['telefono'];
    
    if ($request->hasFile('imagen')) {
        $image = $request->file('imagen');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        
        $image->move(public_path('access/images/popular-img/'), $imageName);
        
        if ($user->imagen && file_exists(public_path('access/images/popular-img/' . $user->imagen))) {
            unlink(public_path('access/images/popular-img/' . $user->imagen));
        }
        
        $user->imagen = $imageName;
    }
    
    if ($user instanceof \App\Models\User) {
        $user->save();
    }
    
    return response()->json([
        'success' => true, 
        'message' => 'Perfil actualizado correctamente',
        'imagen' => $user && $user->imagen ? asset('access/images/popular-img/' . $user->imagen) : null
    ]);
}

public function uploadImage(Request $request)
{
    $request->validate([
        'imagen' => 'required|image|mimes:jpeg,png,jpg,gif',
    ]);
    
    $user = User::find(Auth::id());
    $image = $request->file('imagen');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    
    // Save image to storage location
    $image->move(public_path('access/images/popular-img/'), $imageName);
    
    // Delete old image if exists
    if ($user && $user->imagen && file_exists(public_path('access/images/popular-img/' . $user->imagen))) {
        unlink(public_path('access/images/popular-img/' . $user->imagen));
    }
    
    // Update user's image field
    if ($user) {
        $user->imagen = $imageName;
        $user->save();
    }
    
    return response()->json([
        'success' => true, 
        'message' => 'Imagen actualizada correctamente',
        'imagen' => asset('access/images/popular-img/' . $imageName)
    ]);
}


public function storeAddress(Request $request)
{
    try {
        // Validate the form input
        $validated = $request->validate([
            'tipo_nombre' => 'required|string|max:255',
            'id_distrito' => 'required|exists:distritos,id',
            'direccion' => 'required|string|max:255',
            'referencia' => 'required|string|max:255', // Changed to required to match DB
            'lat' => 'required|string|max:255',        // Changed to string to match DB
            'lon' => 'required|string|max:255',        // Changed to string to match DB
        ]);
        
        // Get the authenticated user
        $userId = Auth::id();
        
        // Create new address using create method
        $direccion = DireccionUser::create([
            'id_user' => $userId,
            'id_distrito' => $validated['id_distrito'],
            'tipo_nombre' => $validated['tipo_nombre'],
            'lat' => $validated['lat'],
            'lon' => $validated['lon'],
            'direccion' => $validated['direccion'],
            'referencia' => $validated['referencia'],
            'principal' => 0,
            'empresa' => null
        ]);
        
        return response()->json([
            'success' => true, 
            'message' => 'Dirección agregada correctamente'
        ]);
    } catch (\Exception $e) {
        Log::error('Error storing address: ' . $e->getMessage());
        Log::error('Error trace: ' . $e->getTraceAsString());
        
        return response()->json([
            'success' => false,
            'message' => 'Error al guardar la dirección: ' . $e->getMessage()
        ], 500);
    }
}



    
}
