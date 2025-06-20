<?php

namespace App\Http\Controllers;

use App\Models\ComprobantePago;
use App\Models\HoraLlegada;
use App\Models\TipoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdministradorController extends Controller
{
    public function index()
    {
        return view('admin.adminCop');
    }

    // TipoPago Methods
    public function listarTiposPago()
    {
        $tiposPago = TipoPago::with('creador')->get();
        return response()->json($tiposPago);
    }

    public function guardarTipoPago(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:tipopago,nombre'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tipoPago = TipoPago::create([
            'nombre' => $request->nombre,
            'estado' => 1,
            'id_user_create' => Auth::id()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tipo de pago creado correctamente',
            'tipoPago' => $tipoPago
        ]);
    }

    public function cambiarEstadoTipoPago(Request $request)
    {
        $tipoPago = TipoPago::findOrFail($request->id);
        $tipoPago->estado = $tipoPago->estado == 1 ? 0 : 1;
        $tipoPago->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente',
            'estado' => $tipoPago->estado
        ]);
    }

    // ComprobantePago Methods
    public function listarComprobantes()
    {
        $comprobantes = ComprobantePago::with('creador')->get();
        return response()->json($comprobantes);
    }

    public function guardarComprobante(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:comprobantepago,nombre'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $comprobante = ComprobantePago::create([
            'nombre' => $request->nombre,
            'estado' => 1,
            'id_user_create' => Auth::id()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comprobante de pago creado correctamente',
            'comprobante' => $comprobante
        ]);
    }

    public function cambiarEstadoComprobante(Request $request)
    {
        $comprobante = ComprobantePago::findOrFail($request->id);
        $comprobante->estado = $comprobante->estado == 1 ? 0 : 1;
        $comprobante->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente',
            'estado' => $comprobante->estado
        ]);
    }

    // HoraLlegada Methods
    public function listarHorasLlegada()
    {
        $horas = HoraLlegada::with('creador')->get();
        return response()->json($horas);
    }

    public function guardarHoraLlegada(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'valor' => 'required|string|max:255|unique:horallegada,valor'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $hora = HoraLlegada::create([
            'valor' => $request->valor,
            'estado' => 1,
            'id_user_create' => Auth::id()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Hora de llegada creada correctamente',
            'hora' => $hora
        ]);
    }

    public function obtenerHoraLlegada(Request $request)
    {
        $hora = HoraLlegada::findOrFail($request->id);
        return response()->json($hora);
    }

    public function actualizarHoraLlegada(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'valor' => 'required|string|max:255|unique:horallegada,valor,'.$request->id
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $hora = HoraLlegada::findOrFail($request->id);
        $hora->valor = $request->valor;
        $hora->save();

        return response()->json([
            'success' => true,
            'message' => 'Hora de llegada actualizada correctamente',
            'hora' => $hora
        ]);
    }

    public function cambiarEstadoHoraLlegada(Request $request)
    {
        $hora = HoraLlegada::findOrFail($request->id);
        $hora->estado = $hora->estado == 1 ? 0 : 1;
        $hora->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente',
            'estado' => $hora->estado
        ]);
    }
}
