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
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'telefono' => 'nullable|string|max:20',
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
                'name' => $request->name,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telefono' => $request->telefono,
                'id_rol' => 2, // Rol de cliente
                'id_user_create' => Auth::id(),
                'estado' => 1
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
                ->withSum('pedidos', 'monto_total') // Cambié 'total' por 'monto_total'
                ->findOrFail($id);

            $cliente->total_pagado = $cliente->pedidos_sum_monto_total ?? 0; // Cambié el nombre del campo

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
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'telefono' => 'nullable|string|max:20',
            'estado' => 'required|in:0,1',
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
                'name' => $request->name,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'telefono' => $request->telefono,
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
