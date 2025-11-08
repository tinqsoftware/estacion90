<?php

namespace App\Http\Controllers;

use App\Models\ComprobantePago;
use App\Models\HoraLlegada;
use App\Models\TipoPago;
use App\Models\ConfiguracionSistema;
use App\Models\Distrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $tipo = $request->input('tipo', 'hora');

        $rules = [
            'tipo' => 'required|in:hora,rango',
        ];

        if ($tipo === 'hora') {
            $rules['valor'] = [
                'required','integer','min:1','max:1440',
                Rule::unique('horallegada','valor')->where(fn($q)=>$q->where('tipo','hora')),
            ];
        } else {
            $rules['inicio_rango'] = ['required','date_format:H:i'];
            $rules['fin_rango']    = ['required','date_format:H:i'];
        }

        $validator = Validator::make($request->all(), $rules);

        // Validación extra para rangos
        $validator->after(function ($v) use ($request, $tipo) {
            if ($tipo === 'rango') {
                $inicio = $request->input('inicio_rango');
                $fin    = $request->input('fin_rango');

                if ($inicio && $fin && $inicio >= $fin) {
                    $v->errors()->add('fin_rango', 'La hora fin debe ser mayor que la hora inicio.');
                }

                if ($inicio && $fin) {
                    $exists = \App\Models\HoraLlegada::where([
                        ['tipo','=','rango'],
                        ['inicio_rango','=',$inicio],
                        ['fin_rango','=',$fin],
                    ])->exists();

                    if ($exists) {
                        $v->errors()->add('inicio_rango', 'Este rango ya existe.');
                    }
                }
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $hora = HoraLlegada::create([
            'tipo'          => $tipo,
            'valor'         => $tipo === 'hora'  ? (int)$request->valor : null,
            'inicio_rango'  => $tipo === 'rango' ? $request->inicio_rango : null,
            'fin_rango'     => $tipo === 'rango' ? $request->fin_rango : null,
            'estado'        => 1,
            'id_user_create'=> Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Hora de llegada creada correctamente',
            'hora'    => $hora,
        ]);
    }
    public function obtenerHoraLlegada(Request $request)
    {
        $hora = HoraLlegada::findOrFail($request->id);
        return response()->json($hora);
    }

    public function actualizarHoraLlegada(Request $request)
    {
        $tipo = $request->input('tipo', 'hora');

        $rules = [
            'id'   => 'required|integer|exists:horallegada,id',
            'tipo' => 'required|in:hora,rango',
        ];

        if ($tipo === 'hora') {
            $rules['valor'] = [
                'required','integer','min:1','max:1440',
                Rule::unique('horallegada','valor')
                    ->where(fn($q)=>$q->where('tipo','hora'))
                    ->ignore($request->id,'id'),
            ];
        } else {
            $rules['inicio_rango'] = ['required','date_format:H:i'];
            $rules['fin_rango']    = ['required','date_format:H:i'];
        }

        $validator = Validator::make($request->all(), $rules);

        $validator->after(function ($v) use ($request, $tipo) {
            if ($tipo === 'rango') {
                $inicio = $request->input('inicio_rango');
                $fin    = $request->input('fin_rango');

                if ($inicio && $fin && $inicio >= $fin) {
                    $v->errors()->add('fin_rango', 'La hora fin debe ser mayor que la hora inicio.');
                }

                if ($inicio && $fin) {
                    $exists = \App\Models\HoraLlegada::where([
                        ['tipo','=','rango'],
                        ['inicio_rango','=',$inicio],
                        ['fin_rango','=',$fin],
                    ])->where('id','!=',$request->id)->exists();

                    if ($exists) {
                        $v->errors()->add('inicio_rango', 'Este rango ya existe.');
                    }
                }
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $hora = HoraLlegada::findOrFail($request->id);
        $hora->tipo         = $tipo;
        $hora->valor        = $tipo === 'hora'  ? (int)$request->valor : null;
        $hora->inicio_rango = $tipo === 'rango' ? $request->inicio_rango : null;
        $hora->fin_rango    = $tipo === 'rango' ? $request->fin_rango : null;
        $hora->save();

        return response()->json([
            'success' => true,
            'message' => 'Hora de llegada actualizada correctamente',
            'hora'    => $hora,
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

    // ======================
    // Distritos (activos / admin)
    // ======================
    public function listarDistritosActivos()
    {
        $distritos = Distrito::where('estado', 1)->orderBy('nombre')->get(['id','nombre','estado','created_at']);
        return response()->json($distritos);
    }

    public function listarDistritos()
    {
        $distritos = Distrito::orderBy('nombre')->get(['id','nombre','estado','created_at']);
        return response()->json($distritos);
    }

    public function cambiarEstadoDistrito(Request $request)
    {
        $request->validate(['id' => 'required|integer|exists:distrito,id']);
        $distrito = Distrito::findOrFail($request->id);
        $distrito->estado = ($distrito->estado == 1 ? 0 : 1);
        $distrito->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente',
            'estado'  => (int)$distrito->estado,
            'id'      => (int)$distrito->id,
        ]);
    }

    public function obtenerFlujoPedidos()
{
    try {
        $flujo = ConfiguracionSistema::obtenerFlujoPedidos();
        return response()->json(['flujo' => $flujo]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al obtener configuración'], 500);
    }
}

public function cambiarFlujoPedidos(Request $request)
{
    $validator = Validator::make($request->all(), [
        'modo' => 'required|in:cocina,despacho',
        'password' => 'required|string'
    ], [
        'modo.required' => 'El modo es requerido',
        'modo.in' => 'El modo debe ser cocina o despacho',
        'password.required' => 'La contraseña es requerida'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Verificar contraseña del usuario autenticado
    if (!\Illuminate\Support\Facades\Hash::check($request->password, Auth::user()->password)) {
        return response()->json(['message' => 'Contraseña incorrecta'], 403);
    }

    try {
        $modo = $request->input('modo');
        ConfiguracionSistema::cambiarFlujoPedidos($modo);
        
        $mensaje = $modo === 'cocina' 
            ? 'Configurado: Los pedidos irán a cocina primero'
            : 'Configurado: Los pedidos irán directo a despacho';
        
        return response()->json(['message' => $mensaje]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al cambiar configuración'], 500);
    }
}

public function obtenerConfiguracionImpresiones()
{
    try {
        $impresionAutomatica = ConfiguracionSistema::obtenerConfiguracion('impresion_automatica', '0');
        $mostrarPdf = ConfiguracionSistema::obtenerConfiguracion('mostrar_pdf', '0');
        $metodoImpresion = ConfiguracionSistema::obtenerConfiguracion('metodo_impresion', 'qztray');
        $impresoraPrincipal = ConfiguracionSistema::obtenerConfiguracion('impresora_principal', '');
        
        return response()->json([
            'impresion_automatica' => $impresionAutomatica,
            'mostrar_pdf' => $mostrarPdf,
            'metodo_impresion' => $metodoImpresion,
            'impresora_principal' => $impresoraPrincipal
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al obtener configuración'], 500);
    }
}

public function cambiarImpresionAutomatica(Request $request)
{
    $validator = Validator::make($request->all(), [
        'impresion_automatica' => 'required|in:0,1'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        ConfiguracionSistema::guardarConfiguracion('impresion_automatica', $request->impresion_automatica);
        
        $mensaje = $request->impresion_automatica === '1'
            ? 'Impresión automática activada'
            : 'Impresión automática desactivada';
        
        return response()->json(['message' => $mensaje]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al cambiar configuración'], 500);
    }
}

public function cambiarMostrarPdf(Request $request)
{
    $validator = Validator::make($request->all(), [
        'mostrar_pdf' => 'required|in:0,1'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        ConfiguracionSistema::guardarConfiguracion('mostrar_pdf', $request->mostrar_pdf);
        
        $mensaje = $request->mostrar_pdf === '1'
            ? 'Mostrar PDF activado'
            : 'Mostrar PDF desactivado';
        
        return response()->json(['message' => $mensaje]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al cambiar configuración'], 500);
    }
}

    public function cambiarMetodoImpresion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'metodo_impresion' => 'required|in:qztray,servicio'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            ConfiguracionSistema::guardarConfiguracion('metodo_impresion', $request->metodo_impresion);
            return response()->json(['message' => 'Método de impresión actualizado']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al cambiar método de impresión'], 500);
        }
    }

    public function cambiarImpresoraPrincipal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'impresora_principal' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            ConfiguracionSistema::guardarConfiguracion('impresora_principal', $request->impresora_principal);
            return response()->json([
                'message' => 'Impresora principal configurada: ' . $request->impresora_principal,
                'impresora' => $request->impresora_principal
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al configurar impresora principal'], 500);
        }
    }

    public function listarImpresoras(Request $request)
    {
        try {
            // Esta función utiliza la misma lógica que QZ Tray para obtener impresoras
            // En un entorno real, esto podría conectarse directamente a QZ Tray
            // o usar una API del servidor para obtener las impresoras disponibles
            
            return response()->json([
                'success' => true,
                'message' => 'Para obtener las impresoras, usa el botón "Cargar" que se conecta a QZ Tray',
                'impresoras' => []
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al listar impresoras: ' . $e->getMessage()
            ], 500);
        }
    }
}