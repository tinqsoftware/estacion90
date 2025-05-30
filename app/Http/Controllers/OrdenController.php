<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Carbon\Carbon;
use App\Models\HoraLlegada;
use App\Models\TipoPago;
use App\Models\ComprobantePago;
use App\Models\Distrito;
use App\Models\DireccionUser;
use Illuminate\Support\Facades\Auth;
use App\Models\PlaneacionMenu;
use App\Models\PedidoDetalle;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use App\Models\PedidoComensal;
use App\Models\User;



class OrdenController extends Controller
{

    public function ordenes()
    {
        $usuarioId = auth()->id();

        $pedidos = Pedido::with([
            'comensales.detalles.producto.categoria',
            'distritoContacto',
            'horaLlegada',
            'tipoPago'
        ])
        ->where('id_usuario', $usuarioId)
        ->whereIn('estado', [0, 1, 2, 3])
        ->orderByDesc('created_at')
        ->get();

        return view('ordenes.ordenes', compact('pedidos'));
    }




}
