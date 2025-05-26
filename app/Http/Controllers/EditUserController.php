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



    
}
