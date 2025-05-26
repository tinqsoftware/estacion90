<?php

namespace App\Http\Controllers;

use App\Models\DireccionUser;
use App\Models\Distrito;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    // Validate the form input
    $validated = $request->validate([
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        'telefono' => 'nullable|string|max:20',
    ]);
    
    // Get the authenticated user
    $user = Auth::user();
    
    // Update user information
    $user->name = $validated['nombres'];
    $user->apellido = $validated['apellidos'];
    $user->email = $validated['email'];
    $user->telefono = $validated['telefono'];
    
    // Handle image upload if present
    if ($request->hasFile('imagen')) {
        $image = $request->file('imagen');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        
        // Save image to storage location
        $image->move(public_path('access/images/popular-img/'), $imageName);
        
        // Delete old image if exists
        if ($user->imagen && file_exists(public_path('access/images/popular-img/' . $user->imagen))) {
            unlink(public_path('access/images/popular-img/' . $user->imagen));
        }
        
        // Update user's image field
        $user->imagen = $imageName;
    }
    
    // Save the user if it is a valid model instance
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



    
}
