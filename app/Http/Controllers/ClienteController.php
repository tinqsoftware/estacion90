<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = User::with(['direccion', 'pedidos'])
            ->where('id_rol', 2) // Solo clientes
            ->withCount('pedidos')
            ->withSum('pedidos', 'monto_total')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Agregar el total pagado a cada cliente
        $clientes->getCollection()->transform(function ($cliente) {
            $cliente->total_pagado = $cliente->pedidos_sum_monto_total ?? 0;
            return $cliente;
        });

        // Estadísticas para las tarjetas
        $clientesActivos = User::where('id_rol', 2)->where('estado', 1)->count();
        $totalVentas = User::where('id_rol', 2)->withSum('pedidos', 'monto_total')->get()->sum('pedidos_sum_monto_total');
        $mejorCliente = User::where('id_rol', 2)
            ->withSum('pedidos', 'monto_total')
            ->orderBy('pedidos_sum_monto_total', 'desc')
            ->first();

        return view('users.users_ventas', compact('clientes', 'clientesActivos', 'totalVentas', 'mejorCliente'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['success' => true]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/' // Solo letras y espacios
            ],
            'apellido' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/' // Solo letras y espacios
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/' // Al menos una mayúscula, minúscula y número
            ],
            'telefono' => [
                'nullable',
                'string',
                'min:9',
                'max:15',
                'regex:/^[0-9+\-\s]+$/' // Solo números, espacios, + y -
            ],
        ], [
            'name.required' => 'El nombre es obligatorio',
            'name.regex' => 'El nombre solo puede contener letras y espacios',
            'name.min' => 'El nombre debe tener al menos 2 caracteres',
            'apellido.required' => 'El apellido es obligatorio',
            'apellido.regex' => 'El apellido solo puede contener letras y espacios',
            'apellido.min' => 'El apellido debe tener al menos 2 caracteres',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe tener un formato válido',
            'email.unique' => 'Este email ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula y un número',
            'telefono.regex' => 'El teléfono solo puede contener números',
            'telefono.min' => 'El teléfono debe tener al menos 9 dígitos',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $cliente = User::create([
                'name' => trim($request->name),
                'apellido' => trim($request->apellido),
                'email' => strtolower(trim($request->email)),
                'password' => Hash::make($request->password),
                'telefono' => $request->telefono ?: null,
                'id_rol' => 2, // Rol de cliente
                'id_user_create' => Auth::id(),
                'estado' => 1,
                'email_verified_at' => now(),
                'imagen' => 'access/images/default-avatar.png', // Imagen por defecto
                'id_direccion' => null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cliente creado exitosamente',
                'cliente' => $cliente
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear cliente: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $cliente = User::with(['direccion', 'pedidos'])
                ->where('id_rol', 2)
                ->withCount('pedidos')
                ->withSum('pedidos', 'monto_total')
                ->findOrFail($id);

            $cliente->total_pagado = $cliente->pedidos_sum_monto_total ?? 0;

            return response()->json($cliente);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cliente no encontrado'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $cliente = User::where('id_rol', 2)->findOrFail($id);
            return response()->json($cliente);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cliente no encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/'
            ],
            'apellido' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' . $id
            ],
            'telefono' => [
                'nullable',
                'string',
                'min:9',
                'max:15',
                'regex:/^[0-9+\-\s]+$/'
            ],
            'estado' => 'required|in:0,1',
        ], [
            'name.required' => 'El nombre es obligatorio',
            'name.regex' => 'El nombre solo puede contener letras y espacios',
            'apellido.required' => 'El apellido es obligatorio',
            'apellido.regex' => 'El apellido solo puede contener letras y espacios',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'Este email ya está registrado',
            'telefono.regex' => 'El teléfono solo puede contener números',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $cliente = User::where('id_rol', 2)->findOrFail($id);
            
            $cliente->update([
                'name' => trim($request->name),
                'apellido' => trim($request->apellido),
                'email' => strtolower(trim($request->email)),
                'telefono' => $request->telefono ?: null,
                'estado' => $request->estado
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cliente actualizado exitosamente',
                'cliente' => $cliente
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar cliente: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $cliente = User::where('id_rol', 2)->findOrFail($id);
            
            // Verificar si el cliente tiene pedidos
            if ($cliente->pedidos()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar el cliente porque tiene pedidos asociados'
                ], 422);
            }

            $cliente->delete();

            return response()->json([
                'success' => true,
                'message' => 'Cliente eliminado exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar cliente: ' . $e->getMessage()
            ], 500);
        }
    }

}
