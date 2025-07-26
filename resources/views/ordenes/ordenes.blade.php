<!DOCTYPE html>
<html lang="en">

<head>
    <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="Tinq Sofware" />
    <meta name="robots" content="" />
    <meta name="description" content="estacion90" />
    <meta property="og:title" content="estacion90" />
    <meta property="og:description" content="estacion90" />
    <meta property="og:image" content="access/images/logo_white.png" />
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- para que no hagan zoom -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- PAGE TITLE HERE -->
    <title>estacion90</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="access/images/logo_white.png" />

    <!-- Stylesheet -->
    <link href="access/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="access/vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet">
    <link href="access/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="access/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="access/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css" rel="stylesheet">
    <link href="access/vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet">
    <link href="access/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Estilos personalizados para el tracking -->
    <style>
        .tracking-container {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .tracking-header {
            padding: 15px;
            border-radius: 6px 6px 0 0;
            background-color: #ff7a01;
            color: white;
        }

        /* Estilos base para todos los dispositivos */
        .tracking-progress {
            position: relative;
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .tracking-line {
            position: absolute;
            top: 25px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #e5e5e5;
            z-index: 1;
        }

        .tracking-line-progress {
            position: absolute;
            top: 25px;
            left: 0;
            height: 2px;
            background-color: #ff7a01;
            z-index: 2;
            transition: width 0.5s ease;
        }

        .tracking-step {
            position: relative;
            z-index: 3;
            text-align: center;
            width: 14.28%;
            /* 100% / 7 steps */
        }

        .tracking-icon {
            width: 50px;
            height: 50px;
            background-color: #e5e5e5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            color: white;
            transition: background-color 0.3s ease;
        }

        .tracking-icon.active {
            background-color: #ff7a01;
        }

        .tracking-icon.home {
            background-color: #fff;
            border: 2px solid #e5e5e5;
            color: #ff7a01;
        }

        .tracking-icon.home.active {
            border-color: #ff7a01;
        }

        .tracking-label {
            margin-top: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .tracking-time {
            font-size: 12px;
            color: #777;
        }

        .tracking-description {
            font-size: 12px;
            color: #555;
            margin-top: 4px;
        }

        /* Media query para tablets */
        @media (max-width: 991px) {
            .tracking-icon {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
            }

            .tracking-label {
                font-size: 12px;
            }

            .tracking-time,
            .tracking-description {
                font-size: 10px;
            }

            .tracking-line,
            .tracking-line-progress {
                top: 20px;
            }
        }

        /* Media query para dispositivos móviles */
        @media (max-width: 767px) {

            /* Cambiamos a un diseño vertical */
            .tracking-progress {
                flex-direction: column;
                margin-left: 20px;
                margin-top: 20px;
            }

            .tracking-step {
                width: 100%;
                display: flex;
                align-items: flex-start;
                margin-bottom: 20px;
                text-align: left;
            }

            .tracking-line {
                width: 2px;
                height: calc(100% - 60px);
                top: 25px;
                left: 20px;
            }

            .tracking-line-progress {
                width: 2px;
                top: 25px;
                left: 20px;
                height: 0%;
                /* Se controla por JS */
            }

            .tracking-icon {
                width: 40px;
                height: 40px;
                margin: 0;
                margin-right: 15px;
                flex-shrink: 0;
            }

            .tracking-step-content {
                display: flex;
                flex-direction: column;
            }

            .tracking-label {
                margin-top: 0;
                font-size: 14px;
                margin-bottom: 2px;
            }

            .tracking-time {
                margin-bottom: 2px;
            }
        }

        /* Otras clases que mantenemos igual... */
        .pedido-card {
            margin-bottom: 15px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .pedido-card:hover {
            transform: translateY(-5px);
        }

        .pedido-header {
            padding: 12px;
            background-color: #f8f8f8;
            border-bottom: 1px solid #eee;
        }

        .pedido-body {
            padding: 15px;
        }

        .badge-entregado {
            background-color: #28a745;
            color: white;
        }

        .badge-no-entregado {
            background-color: #dc3545;
            color: white;
        }

        .pedido-footer {
            padding: 12px;
            text-align: center;
            border-top: 1px solid #eee;
            background-color: #f9f9f9;
        }

        .btn-pedir {
            background-color: #ff7a01;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-pedir:hover {
            background-color: #e56b00;
        }
    </style>
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>

    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper" class="dlab-overflow">

        @include('partials.header')
        @include('partials.sidebar')

        @php use Carbon\Carbon; @endphp
        <!--**********************************
        Content body start
    ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container mt-3">
                <div class="row">
                    <div class="col-12">
                        @if(count($pedidos->whereNotIn('estado', [6, 10, 11])) > 0)
                        @php
                        $pedidoActual = $pedidos->whereNotIn('estado', [6, 10, 11])->first();
                        $horaCreacion = Carbon::parse($pedidoActual->created_at)->format('H:i');
                        $tiempoEstimado = 45; // Minutos de tiempo estimado
                        $idPedido = $pedidoActual->id;
                        $estado = $pedidoActual->estado;
                        $total = number_format($pedidoActual->monto_total, 2);
                        @endphp

                        <div id="pedido-tracking-{{ $idPedido }}" class="tracking-container">
                            <div class="tracking-header">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h3 class="mb-0">Pedido #{{ $idPedido }}</h3>
                                        <p class="mb-0">Realizado: {{ $horaCreacion }} - Tiempo estimado: {{ $tiempoEstimado }} min</p>
                                        <h4 class="mb-0">Total: S/ {{ $total }}</h4>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        @if($estado == 6)
                                        <span class="badge bg-white text-success fs-5 px-4 py-2 rounded-pill">Entregado</span>
                                        @elseif($estado == 10)
                                        <span class="badge bg-white text-danger fs-5 px-4 py-2 rounded-pill">No encontrado</span>
                                        @elseif($estado == 11)
                                        <span class="badge bg-white text-warning fs-5 px-4 py-2 rounded-pill">Finalizado</span>
                                        @else
                                        <span class="badge bg-white text-primary fs-5 px-4 py-2 rounded-pill">En proceso</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tracking-body p-4">
                                <h5 class="mb-3">Estado de tu pedido</h5>

                                <div class="tracking-progress">
                                    <div class="tracking-line"></div>
                                    <div id="progress-line-{{ $idPedido }}" class="tracking-line-progress" style="width: {{ min($estado * 16.67, 100) }}%"></div>

                                    <!-- Estado 0: Pedido Registrado -->
                                    <div class="tracking-step">
                                        <div id="step-0-{{ $idPedido }}" class="tracking-icon {{ $estado >= 0 ? 'active' : '' }}">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="tracking-step-content">
                                            <div class="tracking-label">Pedido Registrado</div>
                                            <div class="tracking-time">{{ $horaCreacion }}</div>
                                            <div class="tracking-description">Tu pedido ha sido recibido</div>
                                        </div>
                                    </div>

                                    <!-- Estado 1: En Preparación -->
                                    <div class="tracking-step">
                                        <div id="step-1-{{ $idPedido }}" class="tracking-icon {{ $estado >= 1 ? 'active' : '' }}">
                                            <i class="fa fa-utensils"></i>
                                        </div>
                                        <div class="tracking-step-content">
                                            <div class="tracking-label">En Preparación</div>
                                            <div class="tracking-time" id="time-1-{{ $idPedido }}">
                                                @if($estado >= 1)
                                                {{ Carbon::parse($pedidoActual->updated_at)->format('H:i') }}
                                                @endif
                                            </div>
                                            <div class="tracking-description">El chef está preparando tu pedido</div>
                                        </div>
                                    </div>

                                    <!-- Estado 2: Preparado -->
                                    <div class="tracking-step">
                                        <div id="step-2-{{ $idPedido }}" class="tracking-icon {{ $estado >= 2 || $estado == 8 ? 'active' : '' }}">
                                            <i class="fa fa-check-circle"></i>
                                        </div>
                                        <div class="tracking-step-content">
                                            <div class="tracking-label">Preparado</div>
                                            <div class="tracking-time" id="time-2-{{ $idPedido }}">
                                                @if($estado >= 2 || $estado == 8)
                                                {{ Carbon::parse($pedidoActual->updated_at)->format('H:i') }}
                                                @endif
                                            </div>
                                            <div class="tracking-description">Tu pedido está listo</div>
                                        </div>
                                    </div>

                                    <!-- Estado 3: Listo para Reparto -->
                                    <div class="tracking-step">
                                        <div id="step-3-{{ $idPedido }}" class="tracking-icon {{ $estado >= 3 ? 'active' : '' }}">
                                            <i class="fa fa-box"></i>
                                        </div>
                                        <div class="tracking-step-content">
                                            <div class="tracking-label">Listo para Reparto</div>
                                            <div class="tracking-time" id="time-3-{{ $idPedido }}">
                                                @if($estado >= 3)
                                                {{ Carbon::parse($pedidoActual->updated_at)->format('H:i') }}
                                                @endif
                                            </div>
                                            <div class="tracking-description">Esperando asignación de motorizado</div>
                                        </div>
                                    </div>

                                    <!-- Estado 4: Asignado a Motorizado -->
                                    <div class="tracking-step">
                                        <div id="step-4-{{ $idPedido }}" class="tracking-icon {{ $estado >= 4 ? 'active' : '' }}">
                                            <i class="fa fa-motorcycle"></i>
                                        </div>
                                        <div class="tracking-step-content">
                                            <div class="tracking-label">Asignado a Motorizado</div>
                                            <div class="tracking-time" id="time-4-{{ $idPedido }}">
                                                @if($estado >= 4)
                                                {{ Carbon::parse($pedidoActual->updated_at)->format('H:i') }}
                                                @endif
                                            </div>
                                            <div id="motorizado-info-{{ $idPedido }}" class="tracking-description">
                                                @if($estado >= 4 && isset($pedidoActual->motorizado))
                                                {{ $pedidoActual->motorizado->nombre }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Estado 5: En Camino -->
                                    <div class="tracking-step">
                                        <div id="step-5-{{ $idPedido }}" class="tracking-icon {{ $estado >= 5 ? 'active' : '' }}">
                                            <i class="fa fa-shipping-fast"></i>
                                        </div>
                                        <div class="tracking-step-content">
                                            <div class="tracking-label">En Camino</div>
                                            <div class="tracking-time" id="time-5-{{ $idPedido }}">
                                                @if($estado >= 5)
                                                {{ Carbon::parse($pedidoActual->updated_at)->format('H:i') }}
                                                @endif
                                            </div>
                                            <div class="tracking-description">Tu pedido está en camino</div>
                                        </div>
                                    </div>

                                    <!-- Estado 6: Entregado -->
                                    <div class="tracking-step">
                                        <div id="step-6-{{ $idPedido }}" class="tracking-icon home {{ $estado == 6 ? 'active' : '' }}">
                                            <i class="fa fa-home"></i>
                                        </div>
                                        <div class="tracking-step-content">
                                            <div class="tracking-label">Entregado</div>
                                            <div class="tracking-time" id="time-6-{{ $idPedido }}">
                                                @if($estado == 6)
                                                {{ Carbon::parse($pedidoActual->updated_at)->format('H:i') }}
                                                @endif
                                            </div>
                                            <div class="tracking-description">Pedido entregado exitosamente</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Sección de pedidos anteriores -->
                        <div class="mb-4">
                            <div class="bg-warning text-white p-3 rounded">
                                <h4 class="mb-0">Pedidos Anteriores</h4>
                            </div>
                        </div>

                    <div class="row" id="pedidos-anteriores">
    @foreach($pedidos->whereIn('estado', [6, 10, 11])->take(5) as $pedidoAnterior)
        @php
            $fecha = Carbon::parse($pedidoAnterior->created_at)->format('d M Y');
            $hora = Carbon::parse($pedidoAnterior->created_at)->format('H:i');
            $horaEstimada = Carbon::parse($pedidoAnterior->created_at)->addMinutes(45)->format('H:i');
            $estadoLabel = $pedidoAnterior->estado == 6 ? 'Entregado' : ($pedidoAnterior->estado == 10 ? 'No Encontrado' : 'Finalizado');
            $estadoClass = $pedidoAnterior->estado == 6 ? 'bg-warning' : 'bg-danger';
            
            // Organizar detalles por comensal para el modal
            $detallesPorComensal = [];
            $totalComensales = count($pedidoAnterior->comensales);
            $detallesSimples = []; // Para la vista de tarjeta cuando es un solo comensal
            
            foreach($pedidoAnterior->comensales as $comensal) {
                $detallesComensal = [];
                $subtotalComensal = 0;
                
                foreach($comensal->detalles as $detalle) {
                    if ($detalle->producto) {
                        $subtotalItem = $detalle->cantidad * $detalle->precio;
                        $subtotalComensal += $subtotalItem;
                        
                        $detalleItem = [
                            'nombre' => $detalle->producto->nombre,
                            'cantidad' => $detalle->cantidad,
                            'precio' => $detalle->precio,
                            'imagen' => $detalle->producto->imagen ?? '',
                            'subtotal' => $subtotalItem
                        ];
                        
                        $detallesComensal[] = $detalleItem;
                        $detallesSimples[] = $detalleItem;
                    }
                }
                
                $detallesPorComensal[] = [
                    'nombre' => $comensal->nombre_comensal,
                    'detalles' => $detallesComensal,
                    'subtotal' => $subtotalComensal
                ];
            }
        @endphp
        
        <!-- Cambiado a 3-4 tarjetas por fila: col-12 col-sm-6 col-md-4 col-xl-3 -->
        <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-4">
            <div class="card h-100 border-0" style="border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <!-- Encabezado del pedido más compacto -->
                <div class="card-header bg-white pt-2 pb-2 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fs-6 fw-bold">Pedido #{{ $pedidoAnterior->id }}</h5>
                        <span class="badge rounded-pill text-white px-2 py-1 {{ $estadoClass }}">{{ $estadoLabel }}</span>
                    </div>
                    <p class="text-muted mb-0 small">{{ $fecha }}</p>
                </div>
                
                <!-- Cuerpo de la tarjeta optimizado -->
                <div class="card-body p-2">
                    <!-- Información del pedido más compacta -->
                    <div class="mb-2">
                        @if($pedidoAnterior->direccion_contacto)
                            <div class="d-flex align-items-center mb-1">
                                <i class="fa fa-map-marker-alt text-muted me-2 small"></i>
                                <span class="small text-truncate">{{ $pedidoAnterior->direccion_contacto }}</span>
                            </div>
                        @endif
                        
                        <div class="d-flex align-items-center mb-1">
                            <i class="far fa-clock text-muted me-2 small"></i>
                            <span class="small">{{ $hora }} - Est: {{ $horaEstimada }}</span>
                        </div>
                        
                        @if($totalComensales > 1)
                            <div class="d-flex align-items-center mb-1">
                                <i class="fa fa-users text-muted me-2 small"></i>
                                <span class="small">{{ $totalComensales }} comensales</span>
                            </div>
                        @elseif(count($pedidoAnterior->comensales) > 0 && isset($pedidoAnterior->comensales[0]->nombre_comensal))
                            <div class="d-flex align-items-center mb-1">
                                <i class="fa fa-user text-muted me-2 small"></i>
                                <span class="small">{{ $pedidoAnterior->comensales[0]->nombre_comensal }}</span>
                            </div>
                        @elseif($pedidoAnterior->nombre_contacto)
                            <div class="d-flex align-items-center mb-1">
                                <i class="fa fa-user text-muted me-2 small"></i>
                                <span class="small">{{ $pedidoAnterior->nombre_contacto }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <hr class="my-2">
                    
                    <!-- Lista de productos optimizada -->
                    @if($totalComensales <= 1)
                        <!-- Mostrar detalles directamente cuando hay un solo comensal -->
                        @foreach($detallesSimples as $index => $detalle)
                            @if($index < 2)
                                <div class="d-flex align-items-center py-1 {{ $index > 0 ? 'border-top' : '' }}">
                                    <div class="me-2">
                                        @if(isset($detalle['imagen']) && !empty($detalle['imagen']))
                                            <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden;">
                                                <img src="{{ asset($detalle['imagen']) }}" alt="{{ $detalle['nombre'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                        @else
                                            <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden;">
                                                <img src="{{ asset('access/images/logo-full.png') }}" alt="Estación 90" style="width: 100%; height: 100%; object-fit: contain; background-color: #f8f8f8;">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="small fw-medium text-truncate" style="max-width: 150px;">{{ $detalle['nombre'] }}</div>
                                        <div class="text-muted small">{{ $detalle['cantidad'] }} x S/ {{ number_format($detalle['precio'], 2) }}</div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        @if(count($detallesSimples) > 2)
                            <div class="py-1 text-center">
                                <span class="text-muted small">+ {{ count($detallesSimples) - 2 }} item(s)</span>
                            </div>
                        @endif
                    @else
                        <!-- Resumen para múltiples comensales -->
                        <div class="d-flex align-items-center py-1">
                            <div class="me-2">
                                @if(isset($detallesPorComensal[0]['detalles'][0]['imagen']) && !empty($detallesPorComensal[0]['detalles'][0]['imagen']))
                                    <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden;">
                                        <img src="{{ asset($detallesPorComensal[0]['detalles'][0]['imagen']) }}" alt="Producto" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @else
                                    <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden;">
                                        <img src="{{ asset('access/images/logo-full.png') }}" alt="Estación 90" style="width: 100%; height: 100%; object-fit: contain; background-color: #f8f8f8;">
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="small fw-medium text-truncate" style="max-width: 150px;">{{ $detallesPorComensal[0]['nombre'] }}</div>
                                <div class="text-muted small">{{ count($detallesPorComensal[0]['detalles']) }} productos</div>
                            </div>
                        </div>
                        
                        <div class="py-1 text-center">
                            <span class="text-muted small">+ {{ $totalComensales - 1 }} comensal(es)</span>
                        </div>
                    @endif
                </div>
                
                <!-- Pie de la tarjeta más compacto -->
                <div class="card-footer bg-white p-2 border-0 rounded-bottom-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-medium small">Total:</span>
                        <span class="text-warning fw-bold">S/ {{ number_format($pedidoAnterior->monto_total, 2) }}</span>
                    </div>
                    
                    <div class="d-flex gap-1">
                        @if($totalComensales > 1)
                            <button type="button" class="btn btn-outline-secondary btn-sm w-100 py-1" data-bs-toggle="modal" data-bs-target="#modalPedido{{ $pedidoAnterior->id }}">
                                Detalles
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        @if($totalComensales > 1)
            <!-- Modal para pedidos con múltiples comensales -->
            <div class="modal fade" id="modalPedido{{ $pedidoAnterior->id }}" tabindex="-1" aria-labelledby="modalPedidoLabel{{ $pedidoAnterior->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold" id="modalPedidoLabel{{ $pedidoAnterior->id }}">Pedido #{{ $pedidoAnterior->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pt-2">
                            <!-- Información del pedido -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    @if($pedidoAnterior->direccion_contacto)
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fa fa-map-marker-alt text-muted me-2"></i>
                                            <span>{{ $pedidoAnterior->direccion_contacto }}</span>
                                        </div>
                                    @endif
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="far fa-clock text-muted me-2"></i>
                                        <span>Hora pedido: {{ $hora }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-clock text-muted me-2"></i>
                                        <span>Hora estimada: {{ $horaEstimada }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-user text-muted me-2"></i>
                                        <span>Cliente principal: {{ isset($pedidoAnterior->comensales[0]) ? $pedidoAnterior->comensales[0]->nombre_comensal : ($pedidoAnterior->nombre_contacto ?? 'Cliente') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <h6 class="mb-3 fw-bold">Detalles del Pedido</h6>
                            
                            <!-- Detalles por comensal -->
                            @foreach($detallesPorComensal as $indexComensal => $comensal)
                                <div class="card mb-3">
                                    <div class="card-header py-2 px-3 bg-light">
                                        <i class="fa fa-user text-warning me-2"></i>
                                        <span class="fw-medium">{{ $comensal['nombre'] }}</span>
                                    </div>
                                    <div class="card-body p-3">
                                        @foreach($comensal['detalles'] as $detalle)
                                            <div class="d-flex align-items-center py-2 {{ !$loop->first ? 'border-top' : '' }}">
                                                <div class="me-3">
                                                    @if(isset($detalle['imagen']) && !empty($detalle['imagen']))
                                                        <div style="width: 40px; height: 40px; border-radius: 6px; overflow: hidden;">
                                                            <img src="{{ asset($detalle['imagen']) }}" alt="{{ $detalle['nombre'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                        </div>
                                                    @else
                                                        <div style="width: 40px; height: 40px; border-radius: 6px; overflow: hidden;">
                                                            <img src="{{ asset('access/images/logo-full.png') }}" alt="Estación 90" style="width: 100%; height: 100%; object-fit: contain; background-color: #f8f8f8;">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div>{{ $detalle['nombre'] }}</div>
                                                    <div class="text-muted small">Cantidad: {{ $detalle['cantidad'] }} x S/ {{ number_format($detalle['precio'], 2) }}</div>
                                                </div>
                                                <div class="text-end">
                                                    <span class="text-warning">S/ {{ number_format($detalle['subtotal'], 2) }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="d-flex justify-content-between border-top mt-2 pt-2">
                                            <span class="fw-medium">Subtotal {{ $comensal['nombre'] }}:</span>
                                            <span class="fw-medium">S/ {{ number_format($comensal['subtotal'], 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            <!-- Total del pedido -->
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                                <h5 class="fw-bold mb-0">Total del Pedido:</h5>
                                <h5 class="text-warning fw-bold mb-0">S/ {{ number_format($pedidoAnterior->monto_total, 2) }}</h5>
                            </div>
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="access/vendor/global/global.min.js"></script>
    <script src="access/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="access/vendor/chart.js/chart.bundle.min.js"></script>
    <script src="access/vendor/swiper/js/swiper-bundle.min.js"></script>
    <script src="access/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="access/js/dlabnav-init.js"></script>
    <script src="access/js/custom.js"></script>
    <script src="access/vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="access/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="access/js/plugins-init/jquery.validate-init.js"></script>
    <script src="access/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Script para actualización en tiempo real -->
    <script>
        $(document).ready(function() {
            // Establecer el token CSRF para todas las solicitudes AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function actualizarProgresoResponsivo(estado) {
                const progressWidth = Math.min(estado * 16.67, 100);

                // Para móviles (vista vertical)
                if (window.innerWidth <= 767) {
                    const progressHeight = Math.min(estado * 16.67, 100);
                    $('#progress-line-{{ $idPedido }}').css('width', '2px');
                    $('#progress-line-{{ $idPedido }}').css('height', progressHeight + '%');
                }
                // Para tablets y desktop (vista horizontal)
                else {
                    $('#progress-line-{{ $idPedido }}').css('height', '2px');
                    $('#progress-line-{{ $idPedido }}').css('width', progressWidth + '%');
                }
            }

            actualizarProgresoResponsivo({{$estado}});

            // Actualizar cuando cambia el tamaño de la ventana
            $(window).resize(function() {
                actualizarProgresoResponsivo({{$estado}});
            });


            // Función para actualizar el estado del pedido
            function actualizarEstadoPedido() {
                @if(count($pedidos->whereNotIn('estado', [6, 10, 11])) > 0)
                $.ajax({
                    url: '/estado-pedido/{{ $idPedido }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log('Respuesta AJAX:', response);

                        if (response.success) {
                            const pedido = response.pedido;
                            const estado = parseInt(pedido.estado);

                            console.log('Estado actual:', estado);

                            // Actualizar la barra de progreso responsiva
                            actualizarProgresoResponsivo(estado);

                            // El resto del código sigue igual...
                            for (let i = 0; i <= 6; i++) {
                                if (i <= estado || (i == 2 && estado == 8)) {
                                    $('#step-' + i + '-{{ $idPedido }}').addClass('active');

                                    if (pedido['tiempo_estado_' + i]) {
                                        $('#time-' + i + '-{{ $idPedido }}').text(pedido['tiempo_estado_' + i]);
                                    }
                                } else {
                                    $('#step-' + i + '-{{ $idPedido }}').removeClass('active');
                                }
                            }

                            if (estado >= 4 && pedido.motorizado) {
                                try {
                                    $('#motorizado-info-{{ $idPedido }}').html(
                                        pedido.motorizado.nombre + ' - Moto: ' + pedido.motorizado.placa
                                    );
                                } catch (e) {
                                    console.error('Error al actualizar info del motorizado:', e);
                                }
                            }

                            if (estado == 6 || estado == 10 || estado == 11) {
                                location.reload();
                            }
                        }
                    },
                    error: function(xhr) {
                        console.error('Error al actualizar el estado del pedido:', xhr.responseText);
                    }
                });
                @endif
            }

            // Actualizar estado cada 15 segundos
            setInterval(actualizarEstadoPedido, 15000);

            // Actualizar estado al cargar la página
            actualizarEstadoPedido();
        });

        // Función para reordenar un pedido anterior
        function reordenarPedido(idPedido) {
            Swal.fire({
                title: '¿Deseas pedir nuevamente?',
                text: 'Se creará un nuevo pedido con los mismos productos',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ff7a01',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, pedir de nuevo',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/reordenar/' + idPedido,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    '¡Pedido realizado!',
                                    'Tu pedido se ha realizado correctamente',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error',
                                    response.message || 'Ocurrió un error al procesar tu pedido',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            console.error('Error al reordenar el pedido:', xhr.responseText);
                            Swal.fire(
                                'Error',
                                'Ocurrió un error al procesar tu pedido',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>