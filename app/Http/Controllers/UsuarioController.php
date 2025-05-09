<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;

use App\Models\User;
use Validator;

class UsuarioController extends Controller
{

    public function prin(){
        $usuarios = User::paginate(10);
        return view('usuarios.usuario', compact('usuarios'));
    }

    
    public function show($id)
    {
        try {
            $usuario = User::findOrFail($id);
            return response()->json($usuario);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }

    /**
     * Mostrar el formulario de edición para un usuario específico
     */
    public function edit($id)
    {
        try {
            $usuario = User::findOrFail($id);
            return response()->json($usuario);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }

    /**
     * Actualizar los datos de un usuario específico
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'id_rol' => 'required|in:1,3,4', // Solo permitir roles 1, 3 y 4
            'telefono' => 'nullable|string|max:20',
            'id_direccion' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $usuario = User::findOrFail($id);
            
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->id_rol = $request->id_rol;
            $usuario->telefono = $request->telefono;
            $usuario->id_direccion = $request->id_direccion;
            
            // Si se proporciona una contraseña, actualizarla
            if ($request->filled('password')) {
                $usuario->password = Hash::make($request->password);
            }
            
            $usuario->save();
            
            return response()->json(['message' => 'Usuario actualizado con éxito', 'usuario' => $usuario]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el usuario: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Eliminar un usuario específico
     */
    public function destroy($id)
    {
        try {
            $usuario = User::findOrFail($id);
            $usuario->delete();
            
            return response()->json(['message' => 'Usuario eliminado con éxito']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el usuario: ' . $e->getMessage()], 500);
        }
    }

    public function resetPassword($id)
{
    try {
        $usuario = User::findOrFail($id);
        $usuario->password = Hash::make('12345678');
        $usuario->save();
        
        return response()->json(['message' => 'Contraseña restablecida con éxito']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al restablecer la contraseña: ' . $e->getMessage()], 500);
    }
}
}
