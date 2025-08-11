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

    <!-- para que no hagan zoom -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- PAGE TITLE HERE -->
    <title>estacion90</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="access/images/logo_white.png" />

    <!-- Stylesheet -->
    <link href="{{ asset('access/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('access/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('access/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('access/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <!-- Form step -->
    <link href="{{ asset('access/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') }}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('access/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Global Stylesheet -->
    <link href="{{ asset('access/css/style.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    /* Dashboard Header */
    .dashboard-header {
        background-color: #f59e0b;
        color: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .dashboard-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .dashboard-date {
        font-size: 1rem;
        opacity: 0.9;
    }

    /* Summary Stats */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        text-align: center;
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .stat-label {
        color: #6b7280;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .stat-por-preparar { border-left: 4px solid #ef4444; }
    .stat-preparados { border-left: 4px solid #f59e0b; }
    .stat-en-reparto { border-left: 4px solid #10b981; }
    .stat-total { border-left: 4px solid #6366f1; }

    /* Filters */


    .filters-row {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        align-items: center;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .filter-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #374151;
    }

    .filter-select {
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.9rem;
        min-width: 150px;
    }

    /* Kanban Board */
    .kanban-board {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .kanban-column {
        background: #f8fafc;
        border-radius: 12px;
        padding: 16px;
        min-height: 600px;
        max-height: 80vh;
        overflow-y: auto;
    }

    .column-content {
        max-height: calc(80vh - 100px);
        overflow-y: auto;
    }

    .column-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        padding: 12px 16px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .column-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #1f2937;
    }

    .column-count {
        background: #6366f1;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .por-preparar .column-count { background: #ef4444; }
    .preparados .column-count { background: #f59e0b; }
    .en-reparto .column-count { background: #10b981; }

    /* Order Cards */
    .order-card {
        background: white;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        cursor: pointer;
        transition: all 0.2s;
        border-left: 4px solid transparent;
    }

    .order-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .order-card.por-preparar { border-left-color: #ef4444; }
    .order-card.preparados { border-left-color: #f59e0b; }
    .order-card.en-reparto { border-left-color: #10b981; }
    .order-card.en-camino { 
        border-left-color: #3b82f6; 
        border-left-width: 6px; /* Borde más grueso para "En Camino" */
    }

    .card-header-compact {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .order-number {
        font-weight: 700;
        color: #1f2937;
        font-size: 0.95rem;
    }

    .order-time {
        font-size: 0.8rem;
        color: #6b7280;
        background: #f3f4f6;
        padding: 2px 8px;
        border-radius: 4px;
    }

    .card-body-compact {
        margin-bottom: 8px;
    }

    .card-body-compact > * + * {
        margin-top: 8px;
    }

    .customer-info-compact {
        margin-bottom: 8px;
    }

    .customer-name-compact {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.9rem;
        margin-bottom: 2px;
    }

    .customer-phone {
        font-size: 0.8rem;
        color: #6b7280;
    }

    .order-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        padding: 8px;
        background: #f9fafb;
        border-radius: 6px;
    }

    .order-total-compact {
        font-weight: 700;
        color: #059669;
        font-size: 1rem;
    }

    .payment-method {
        font-size: 0.8rem;
        color: #6b7280;
        background: #e5e7eb;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .card-actions {
        display: flex;
        gap: 8px;
        margin-top: 12px;
    }

    .btn-expand {
        flex: 1;
        background: #f3f4f6;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        color: #374151;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-expand:hover {
        background: #e5e7eb;
    }

    .btn-print {
        background: #374151;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-print:hover {
        background: #1f2937;
    }

    .btn-ready {
        background: #10b981;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-ready:hover {
        background: #059669;
    }

    /* Status Indicators */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-por-preparar {
        background: #fef2f2;
        color: #dc2626;
    }

    .status-preparados {
        background: #fffbeb;
        color: #d97706;
    }

    .status-en-reparto {
        background: #ecfdf5;
        color: #059669;
    }

    .status-en-camino {
        background: #eff6ff;
        color: #2563eb;
    }o {
        background: #eff6ff;
        color: #2563eb;
    }

    .status-entregado {
        background: #f0fdf4;
        color: #16a34a;
    }

    .status-no-encontrado {
        background: #fef2f2;
        color: #dc2626;
    }

    .status-finalizado {
        background: #f9fafb;
        color: #6b7280;
    }

    /* Motorizado Assignment */
    .moto-assignment {
        margin-top: 8px;
        padding: 8px;
        background: #f0f9ff;
        border-radius: 6px;
        border: 1px solid #e0f2fe;
    }

    .moto-name {
        font-size: 0.8rem;
        font-weight: 600;
        color: #0369a1;
    }

    .delivery-order {
        font-size: 0.75rem;
        color: #64748b;
    }

    /* Expandable Details */
    .order-details-expanded {
        margin-top: 12px;
        padding: 12px;
        background: #f9fafb;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        display: none;
    }

    .detail-section {
        margin-bottom: 12px;
    }

    .detail-title {
        font-weight: 600;
        color: #374151;
        font-size: 0.85rem;
        margin-bottom: 4px;
    }

    .detail-content {
        font-size: 0.8rem;
        color: #6b7280;
        line-height: 1.4;
    }

    .order-items-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .order-item-compact {
        padding: 2px 0;
        font-size: 0.8rem;
        color: #6b7280;
    }

    /* Drag and Drop */
    .sortable-ghost {
        opacity: 0.5;
    }

    .sortable-chosen {
        transform: rotate(5deg);
    }

    .pedido-card.asignado {
        border-left: 4px solid #17a2b8;
    }

    .pedido-card.en-camino {
        border-left: 4px solid #fd7e14;
    }

    .pedido-card.entregado {
        border-left: 4px solid #28a745;
    }

    .pedido-card.no-encontrado {
        border-left: 4px solid #dc3545;
    }

    .pedido-card.finalizado {
        border-left: 4px solid #6c757d;
    }

    .orden-numero {
        display: inline-block;
        background: #007bff;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        text-align: center;
        line-height: 20px;
        font-size: 12px;
        font-weight: bold;
        margin-right: 5px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .kanban-board {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .stats-container {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .filters-row {
            flex-direction: column;
            align-items: stretch;
        }
        
        .filter-group {
            width: 100%;
        }
        
        .filter-select {
            min-width: auto;
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .stats-container {
            grid-template-columns: 1fr;
        }
        
        .card-actions {
            flex-direction: column;
        }
        
        .dashboard-header {
            text-align: center;
        }
    }

    /* Loading and Empty States */
    .empty-column {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        color: #9ca3af;
        text-align: center;
    }

    .empty-icon {
        font-size: 3rem;
        margin-bottom: 12px;
        opacity: 0.5;
    }

    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Drag and Drop Effects */
    .sortable-ghost {
        opacity: 0.5;
        background: #e3f2fd;
        transform: rotate(2deg);
        border: 2px dashed #3498db;
    }

    .sortable-chosen {
        cursor: grabbing !important;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        transform: scale(1.02);
        z-index: 1000;
    }

    .sortable-drag {
        opacity: 0.8;
        transform: rotate(-2deg);
    }

    /* Hover Effects */
    .kanban-column:hover {
        background: #f1f5f9;
    }

    .order-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* Repartidores Styles */
    .repartidor-container {
        background: white;
        border-radius: 8px;
        margin-bottom: 12px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    .repartidor-header {
        background: #f8fafc;
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
    }

    .repartidor-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .repartidor-icon {
        font-size: 1.5rem;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #10b981;
        border-radius: 50%;
        color: white;
    }

    .repartidor-details {
        flex: 1;
    }

    .repartidor-name {
        font-weight: 600;
        color: #111827;
        font-size: 0.875rem;
    }

    .repartidor-status {
        font-size: 0.75rem;
        color: #10b981;
        background: #dcfce7;
        padding: 2px 8px;
        border-radius: 12px;
        display: inline-block;
        margin-top: 2px;
    }

    .repartidor-pedidos {
        padding: 12px;
        min-height: 100px;
        background: #fafafa;
    }

    .empty-repartidor {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        color: #9ca3af;
        text-align: center;
        font-size: 0.875rem;
    }

    .empty-repartidor .empty-icon {
        font-size: 1.5rem;
        margin-bottom: 8px;
        opacity: 0.5;
    }

    /* Pedidos en repartidor */
    .repartidor-pedidos .order-card {
        margin-bottom: 8px;
        font-size: 0.875rem;
    }

    .repartidor-pedidos .order-card:last-child {
        margin-bottom: 0;
    }
    </style>

</head>

<body>
    <div id="main-wrapper" class="dlab-overflow">

        @include('partials.header')
        @include('partials.sidebar')

        <!--**********************************
            Content body start
        ***********************************-->

        <div class="content-body">
            <div class="container-fluid">

                <!-- Dashboard Header -->
                <div class="dashboard-header">
                    <div>
                        <div class="dashboard-title">DASHBOARD ORGANIZAR REPARTO</div>
                        <div class="dashboard-date">
                            {{ strtoupper(Carbon\Carbon::now()->locale('es')->isoFormat('dddd D MMMM')) }}
                        </div>
                    </div>
                </div>

                <!-- Stats Summary -->
                <div class="stats-container">
                    <div class="stat-card stat-por-preparar">
                        <div class="stat-number" id="stat-por-preparar">0</div>
                        <div class="stat-label">Preparados</div>
                    </div>
                    <div class="stat-card stat-preparados">
                        <div class="stat-number" id="stat-preparados">0</div>
                        <div class="stat-label">Sin asignar</div>
                    </div>
                    <div class="stat-card stat-en-reparto">
                        <div class="stat-number" id="stat-en-reparto">0</div>
                        <div class="stat-label">En Reparto</div>
                    </div>
                    <div class="stat-card stat-total">
                        <div class="stat-number" id="stat-total">0</div>
                        <div class="stat-label">Total Pedidos</div>
                    </div>
                </div>

                <!-- Kanban Board -->
                <div class="kanban-board">
                    <!-- Por Preparar Column -->
                    <div class="kanban-column por-preparar">
                        <div class="column-header">
                            <span class="column-title">Preparados</span>
                            <span class="column-count" id="count-por-preparar">0</span>
                        </div>
                        <div id="column-por-preparar" class="column-content">
                            <div class="empty-column" id="empty-por-preparar">
                                <div class="empty-icon">🍳</div>
                                <div>No hay pedidos por preparar</div>
                            </div>
                        </div>
                    </div>

                    <!-- Preparados Column -->
                    <div class="kanban-column preparados">
                        <div class="column-header">
                            <span class="column-title">Sin Asignar</span>
                            <span class="column-count" id="count-preparados">0</span>
                        </div>
                        <div id="column-preparados" class="column-content">
                            <div class="empty-column" id="empty-preparados">
                                <div class="empty-icon">✅</div>
                                <div>No hay pedidos preparados</div>
                            </div>
                        </div>
                    </div>

                    <!-- En Reparto Column -->
                    <div class="kanban-column en-reparto">
                        <div class="column-header">
                            <span class="column-title">En Reparto</span>
                            <span class="column-count" id="count-en-reparto">0</span>
                        </div>
                        <div id="column-en-reparto" class="column-content">
                            <!-- Aquí irán los repartidores activos -->
                            @foreach($motorizados as $motorizado)
                                @if($motorizado->estado == 1)
                                <div class="repartidor-container" data-moto-id="{{ $motorizado->id }}">
                                    <div class="repartidor-header">
                                        <div class="repartidor-info">
                                            <div class="repartidor-icon">🚴</div>
                                            <div class="repartidor-details">
                                                <div class="repartidor-name">{{ $motorizado->name }} {{ $motorizado->apellido }}</div>
                                                <div class="repartidor-status">Activo</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="repartidor-pedidos" id="moto-pedidos-{{ $motorizado->id }}">
                                        <div class="empty-repartidor">
                                            <div class="empty-icon">📦</div>
                                            <div>Sin pedidos asignados</div>
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
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright border-top">
                <p>estacion90 © Desarrollador por <a href="https://tinq.pe" target="_blank">Tinq Sofware</a> 2025</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>

    <!-- Required vendors -->
    <script src="{{ asset('access/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('access/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/swiper/js/swiper-bundle.min.js') }}"></script>

    <!-- Include Sortable.js for drag-and-drop -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

    <!-- Dashboard -->
    <script src="{{ asset('access/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('access/js/custom.js') }}"></script>
    <script src="{{ asset('access/js/demo.js') }}"></script>
    <!-- QZ Tray library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qz-tray/2.2.4/qz-tray.js" integrity="sha512-T5k2OQpRhsT1uWgkC8oLemP6hCysEJ6vD2Ju6sS75+0/90P8IV3N0t8Tt4N+Kk9I+8zIMa+z6BCEq1X0r1y6Ow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    let displayedOrderIds = [];
    let allPedidos = [];
    let filteredPedidos = [];
    let userInteracting = false; // Flag para evitar actualizaciones durante interacción

    // Función para crear tarjeta compacta de pedido
    function crearTarjetaCompacta(pedido, ordenEntrega = null) {
        const estado = parseInt(pedido.estado || 2);
        let estadoClass = 'por-preparar';
        let estadoText = 'Por Preparar';
        
        // Por preparar: estados 2 y 8
        if (estado === 2 || estado === 8) {
            estadoClass = 'Preparado';
            estadoText = estado === 8 ? 'Reingresado' : 'Preparado';
        } 
        // Preparados: estado 3
        else if (estado === 3) {
            estadoClass = 'Sin asignar';
            estadoText = 'Sin asignar';
        } 
        // En reparto: estados 4 y 5
        else if (estado === 4) {
            estadoClass = 'en-reparto';
            // Para pedidos asignados, mostrar "X° ASIGNADO"
            estadoText = `${ordenEntrega || 1}° ASIGNADO`;
        } 
        else if (estado === 5) {
            estadoClass = 'en-camino';
            estadoText = 'EN CAMINO';
        }
        // Estados finales: 6, 10, 11 (estos no se mostrarán en el dashboard pero manejamos por si acaso)
        else if (estado === 6) {
            estadoClass = 'entregado';
            estadoText = 'Entregado';
        } else if (estado === 10) {
            estadoClass = 'no-encontrado';
            estadoText = 'No se encontró al cliente';
        } else if (estado === 11) {
            estadoClass = 'finalizado';
            estadoText = 'Cliente finalizó el pedido';
        }

        const motoInfo = pedido.motorizado ? 
            `<div class="moto-assignment">
                <div class="moto-name">${pedido.motorizado.name} ${pedido.motorizado.apellido}</div>
                <div class="delivery-order">Orden de entrega: ${ordenEntrega || 1}</div>
            </div>` : '';

        return `
        <div class="order-card ${estadoClass}" data-pedido-id="${pedido.id}" data-estado="${estado}">
            <div class="card-header-compact">
                <div class="order-number">PEDIDO #${pedido.id}</div>
                <div class="order-time">${pedido.hora_entrega}</div>
            </div>
            
            <div class="card-body-compact">
                <div class="customer-info-compact">
                    <div class="customer-name-compact">${pedido.nombre_contacto}</div>
                    <div class="customer-phone">Tel: ${pedido.telefono_contacto}</div>
                </div>

                <div class="order-summary">
                    <div class="order-total-compact">S/ ${parseFloat(pedido.monto_total).toFixed(2)}</div>
                    <div class="payment-method">${pedido.metodo_pago}</div>
                </div>

                <div class="status-badge status-${estadoClass}">
                    <span>●</span> ${estadoText}
                </div>

                ${motoInfo}

                <div class="card-actions">
                    <button class="btn-expand" onclick="toggleDetalles(${pedido.id})">
                        <span id="toggle-icon-${pedido.id}">▼</span> Detalles
                    </button>
                    <button class="btn-print" onclick="imprimirPedido(${pedido.id})">Imprimir</button>
                    <button class="btn-print" onclick="imprimirPedidoQZ(${pedido.id})">Imprimir QZ Tray</button>
                    ${estado === 2 ? `<button class="btn-ready" onclick="marcarPreparado(${pedido.id})">Listo</button>` : ''}
                </div>

                <div class="order-details-expanded" id="details-${pedido.id}">
                    <div class="detail-section">
                        <div class="detail-title">Dirección</div>
                        <div class="detail-content">
                            ${pedido.direccion}<br>
                            ${pedido.referencia || ''}<br>
                            ${pedido.distrito || ''}
                        </div>
                    </div>

                    <div class="detail-section">
                        <div class="detail-title">Pedido</div>
                        <div class="detail-content">
                            <ul class="order-items-list">
                                ${pedido.comensales.map(comensal => 
                                    `<li><strong>${comensal.nombre}:</strong> S/ ${parseFloat(comensal.total).toFixed(2)}
                                        <ul>${comensal.items.map(item => 
                                            `<li class="order-item-compact">- ${item.nombre} (S/ ${parseFloat(item.precio).toFixed(2)})</li>`
                                        ).join('')}</ul>
                                    </li>`
                                ).join('')}
                            </ul>
                            <div style="margin-top: 8px; padding-top: 8px; border-top: 1px solid #e5e7eb;">
                                <strong>Delivery: S/ 1.00</strong><br>
                                <strong>TOTAL: S/ ${parseFloat(pedido.monto_total).toFixed(2)}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="detail-section">
                        <div class="detail-title">Información de Pago</div>
                        <div class="detail-content">
                            Método: ${pedido.metodo_pago}<br>
                            ${pedido.vuelto ? `Vuelto de: ${pedido.vuelto} soles<br>` : ''}
                            Comprobante: ${pedido.comprobante || 'Sin especificar'}<br>
                            ${pedido.comentarios ? `Comentarios: ${pedido.comentarios}` : ''}
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
    }

    // Función para mostrar/ocultar detalles
    function toggleDetalles(pedidoId) {
        const details = document.getElementById(`details-${pedidoId}`);
        const icon = document.getElementById(`toggle-icon-${pedidoId}`);
        
        if (details.style.display === 'none' || details.style.display === '') {
            details.style.display = 'block';
            icon.textContent = '▲';
        } else {
            details.style.display = 'none';
            icon.textContent = '▼';
        }
    }

    // Función para marcar pedido como preparado
    function marcarPreparado(pedidoId) {
        $.ajax({
            url: "{{ route('despacho.actualizar-estado') }}",
            type: "POST",
            data: {
                pedido_id: pedidoId,
                estado: 3,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    // Mover el pedido de "Por Preparar" a "Preparados"
                    const pedidoCard = document.querySelector(`[data-pedido-id="${pedidoId}"]`);
                    if (pedidoCard) {
                        pedidoCard.remove();
                        
                        // Actualizar el estado en los datos locales
                        const pedido = allPedidos.find(p => p.id === pedidoId);
                        if (pedido) {
                            pedido.estado = 3;
                            
                            // Limpiar mensaje vacío de la columna preparados si existe
                            const preparadosColumn = document.getElementById('column-preparados');
                            const emptyMessage = preparadosColumn.querySelector('.empty-column');
                            if (emptyMessage) {
                                emptyMessage.remove();
                            }
                            
                            // Recrear la tarjeta y agregarla a la columna de preparados
                            const nuevaTarjeta = crearTarjetaCompacta(pedido);
                            preparadosColumn.insertAdjacentHTML('beforeend', nuevaTarjeta);
                        }
                        
                        actualizarContadores();
                        
                        Swal.fire({
                            title: 'Pedido actualizado',
                            text: 'El pedido ha sido marcado como preparado',
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo actualizar el estado del pedido',
                    icon: 'error',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    }

    // Función para distribuir pedidos en columnas
    function distribuirPedidos(pedidos) {
        // Limpiar columnas
        document.getElementById('column-por-preparar').innerHTML = '';
        document.getElementById('column-preparados').innerHTML = '';
        
        // Limpiar solo los pedidos de los repartidores, no el contenedor
        const repartidorContainers = document.querySelectorAll('.repartidor-pedidos');
        repartidorContainers.forEach(container => {
            container.innerHTML = `
                <div class="empty-repartidor">
                    <div class="empty-icon">📦</div>
                    <div>Sin pedidos asignados</div>
                </div>
            `;
        });

        let porPreparar = 0, preparados = 0, enReparto = 0;

        // Agrupar pedidos por motorizado para calcular orden de entrega
        const pedidosPorMotorizado = {};

        pedidos.forEach(pedido => {
            const estado = parseInt(pedido.estado || 2);
            
            // Por preparar: estados 2 y 8
            if (estado === 2 || estado === 8) {
                const tarjeta = crearTarjetaCompacta(pedido);
                document.getElementById('column-por-preparar').insertAdjacentHTML('beforeend', tarjeta);
                porPreparar++;
            } 
            // Preparados: estado 3
            else if (estado === 3) {
                const tarjeta = crearTarjetaCompacta(pedido);
                document.getElementById('column-preparados').insertAdjacentHTML('beforeend', tarjeta);
                preparados++;
            } 
            // En reparto: estados 4 y 5 - agrupar por motorizado
            else if (estado === 4 || estado === 5) {
                if (pedido.motorizado && pedido.motorizado.id) {
                    if (!pedidosPorMotorizado[pedido.motorizado.id]) {
                        pedidosPorMotorizado[pedido.motorizado.id] = [];
                    }
                    pedidosPorMotorizado[pedido.motorizado.id].push(pedido);
                }
            }
            // Los estados 6, 10, 11 no se muestran en el dashboard (pedidos finalizados)
            // Estos pedidos se filtran automáticamente y no aparecen en la vista
        });

        // Distribuir pedidos de motorizados con orden calculado
        Object.keys(pedidosPorMotorizado).forEach(motoId => {
            const pedidosMotorizado = pedidosPorMotorizado[motoId];
            const motoPedidosContainer = document.getElementById(`moto-pedidos-${motoId}`);
            
            if (motoPedidosContainer) {
                // Remover mensaje vacío si existe
                const emptyMessage = motoPedidosContainer.querySelector('.empty-repartidor');
                if (emptyMessage) {
                    emptyMessage.remove();
                }

                // Ordenar pedidos: primero estado 4 (asignados), luego estado 5 (en camino)
                pedidosMotorizado.sort((a, b) => {
                    if (a.estado !== b.estado) {
                        return a.estado - b.estado; // 4 antes que 5
                    }
                    return a.id - b.id; // Por ID si tienen mismo estado
                });

                // Asignar orden de entrega dinámicamente
                pedidosMotorizado.forEach((pedido, index) => {
                    const ordenEntrega = index + 1;
                    const tarjeta = crearTarjetaCompacta(pedido, ordenEntrega);
                    motoPedidosContainer.insertAdjacentHTML('beforeend', tarjeta);
                    enReparto++;
                });
            }
        });

        // Mostrar mensajes de columnas vacías si es necesario
        mostrarEstadosVacios(porPreparar, preparados, enReparto);
        actualizarContadores();
    }

    // Función para mostrar estados vacíos
    function mostrarEstadosVacios(porPreparar, preparados, enReparto) {
        // Agregar mensaje de columna vacía para "Por Preparar"
        if (porPreparar === 0) {
            document.getElementById('column-por-preparar').innerHTML = `
                <div class="empty-column">
                    <div class="empty-icon">🍳</div>
                    <div>No hay pedidos prepararados</div>
                </div>
            `;
        }

        // Agregar mensaje de columna vacía para "Preparados"
        if (preparados === 0) {
            document.getElementById('column-preparados').innerHTML = `
                <div class="empty-column">
                    <div class="empty-icon">✅</div>
                    <div>No hay pedidos por asignar</div>
                </div>
            `;
        }

        // Para repartidores, el mensaje ya se maneja individualmente en distribuirPedidos
    }

    // Función para actualizar contadores
    function actualizarContadores() {
        const porPreparar = document.querySelectorAll('#column-por-preparar .order-card').length;
        const preparados = document.querySelectorAll('#column-preparados .order-card').length;
        
        // Contar pedidos en todos los repartidores
        let enReparto = 0;
        const repartidorContainers = document.querySelectorAll('.repartidor-pedidos');
        repartidorContainers.forEach(container => {
            enReparto += container.querySelectorAll('.order-card').length;
        });
        
        const total = porPreparar + preparados + enReparto;

        document.getElementById('count-por-preparar').textContent = porPreparar;
        document.getElementById('count-preparados').textContent = preparados;
        document.getElementById('count-en-reparto').textContent = enReparto;

        document.getElementById('stat-por-preparar').textContent = porPreparar;
        document.getElementById('stat-preparados').textContent = preparados;
        document.getElementById('stat-en-reparto').textContent = enReparto;
        document.getElementById('stat-total').textContent = total;
    }

    // Función para aplicar filtros (deshabilitada - no hay filtros en UI)
    function aplicarFiltros() {
        // Los filtros han sido eliminados, mantener todos los pedidos
        filteredPedidos = [...allPedidos];
        distribuirPedidos(filteredPedidos);
    }

    // Función para actualizar pedidos desde el servidor
    function actualizarPedidos() {
        // No actualizar si el usuario está interactuando
        if (userInteracting) {
            console.log('Saltando actualización - usuario interactuando');
            return;
        }

        $.ajax({
            url: "{{ route('despacho.pedidos-nuevos') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log('Pedidos actualizados desde servidor:', data.length);
                
                // NO sobrescribir completamente allPedidos, solo actualizar nuevos
                let nuevosEncontrados = false;
                
                data.forEach(function(pedidoServidor) {
                    const pedidoExistente = allPedidos.find(p => p.id === pedidoServidor.id);
                    
                    if (!pedidoExistente) {
                        // Nuevo pedido, agregarlo
                        allPedidos.push(pedidoServidor);
                        displayedOrderIds.push(pedidoServidor.id);
                        nuevosEncontrados = true;
                    } else {
                        // Pedido existente, solo actualizar campos específicos sin tocar motorizado
                        pedidoExistente.estado = pedidoServidor.estado;
                        pedidoExistente.monto_total = pedidoServidor.monto_total;
                        // NO actualizar motorizado para mantener asignaciones locales
                    }
                });

                // Actualizar filteredPedidos
                filteredPedidos = [...allPedidos];
                
                // Solo redistribuir si hay nuevos pedidos
                if (nuevosEncontrados) {
                    distribuirPedidos(filteredPedidos);
                    
                    Swal.fire({
                        title: '¡Nuevos pedidos!',
                        text: 'Se han agregado nuevos pedidos',
                        icon: 'info',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener pedidos:", error);
            }
        });
    }

    // Función para asignar pedido a moto 
    function asignarPedidoAMoto(pedidoId, motoId) {
        $.ajax({
            url: "{{ route('despacho.asignar-moto') }}",
            type: "POST",
            data: {
                pedido_id: pedidoId,
                moto_id: motoId,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    console.log('Pedido asignado exitosamente');
                    
                    // Actualizar el pedido en los datos locales
                    const pedido = allPedidos.find(p => p.id == pedidoId);
                    if (pedido) {
                        if (motoId == 0) {
                            pedido.motorizado = null;
                            pedido.estado = 3;
                        } else {
                            // Buscar información del motorizado
                            const motorizados = @json($motorizados);
                            const motorizado = motorizados.find(m => m.id == motoId);
                            if (motorizado) {
                                pedido.motorizado = {
                                    id: motorizado.id,
                                    name: motorizado.name,
                                    apellido: motorizado.apellido
                                };
                            }
                            pedido.estado = 4;
                        }
                        
                        // Actualizar datos filtrados
                        const filteredIndex = filteredPedidos.findIndex(p => p.id == pedidoId);
                        if (filteredIndex !== -1) {
                            filteredPedidos[filteredIndex] = pedido;
                        }
                        
                        // Redistribuir pedidos
                        distribuirPedidos(filteredPedidos);
                        
                        Swal.fire({
                            title: 'Pedido actualizado',
                            text: motoId == 0 ? 'Pedido sin asignar' : `Pedido asignado correctamente`,
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al asignar pedido:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo completar la acción',
                    icon: 'error',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                
                // Recargar para revertir cambios visuales
                distribuirPedidos(filteredPedidos);
            }
        });
    }

    function imprimirPedido(pedidoId) {
        const imprimirWindow = window.open("{{ url('despacho/pedido/imprimir') }}/" + pedidoId, '_blank');
        
        if (imprimirWindow) {
            imprimirWindow.focus();
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Por favor, permita ventanas emergentes para imprimir el pedido',
                icon: 'error',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        }
    }

    // =====================
    // QZ Tray Integration
    // =====================
    let qzConnected = false;
    let qzConnecting = false;

    // Configure QZ security (certificate, signature) from backend endpoints
    (function configureQzSecurity(){
        if (!window.qz || !qz.security) return;
        try {
            qz.security.setCertificatePromise(function() {
                return fetch("{{ route('qz.certificate') }}", { credentials: 'same-origin' })
                    .then(function(resp){ if(!resp.ok) throw new Error('No se pudo obtener el certificado QZ'); return resp.text(); });
            });
            qz.security.setSignaturePromise(function(toSign) {
                return fetch("{{ route('qz.sign') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ request: toSign })
                }).then(function(resp){ if(!resp.ok) throw new Error('No se pudo firmar la solicitud QZ'); return resp.text(); });
            });
        } catch (e) {
            console.warn('QZ security setup failed', e);
        }
    })();

    function ensureQzConnected() {
        if (!window.qz) return Promise.reject(new Error('QZ Tray no está cargado'));
        if (qz.websocket && qz.websocket.isActive()) { qzConnected = true; return Promise.resolve(); }
        if (qzConnecting) {
            return new Promise((resolve, reject) => {
                let tries = 0;
                const id = setInterval(() => {
                    tries++;
                    if (qz.websocket.isActive()) { clearInterval(id); qzConnected = true; resolve(); }
                    else if (tries > 30) { clearInterval(id); reject(new Error('Timeout conectando a QZ')); }
                }, 200);
            });
        }
        qzConnecting = true;
        return qz.websocket.connect().then(function(){
            qzConnected = true; qzConnecting = false;
        }).catch(function(err){ qzConnecting = false; return Promise.reject(err); });
    }

    function getPrinterName() {
        const saved = localStorage.getItem('qzPrinterName');
        if (saved) return Promise.resolve(saved);
        return qz.printers.getDefault();
    }

    // Intenta imprimir con QZ (HTML directo); si falla, usa la impresión del navegador
    function imprimirPedidoQZ(pedidoId) {
        ensureQzConnected()
            .then(getPrinterName)
            .then(function(printerName){
                if (!printerName) throw new Error('No hay impresora seleccionada');
                const cfg = qz.configs.create(printerName, {
                    copies: 1
                });
                const url = "{{ url('despacho/pedido/imprimir') }}/" + pedidoId;
                const data = [{ type: 'html', format: 'file', data: url }];
                return qz.print(cfg, data);
            })
            .then(function(){
                Swal.fire({ title: 'Impresión enviada', icon: 'success', toast: true, position: 'top-end', timer: 1800, showConfirmButton: false });
            })
            .catch(function(err){
                console.warn('Fallo QZ con certificados, intentando modo inseguro...', err);
                
                // Intentar modo inseguro como fallback
                tryInsecureQzPrint(pedidoId)
                    .then(function() {
                        Swal.fire({ title: 'Impresión enviada (modo inseguro)', icon: 'warning', toast: true, position: 'top-end', timer: 2000, showConfirmButton: false });
                    })
                    .catch(function(err2) {
                        console.warn('Fallo QZ completamente, usando navegador', err2);
                        Swal.fire({ title: 'QZ no disponible', text: 'Usando impresión del navegador', icon: 'info', toast: true, position: 'top-end', timer: 1500, showConfirmButton: false });
                        imprimirPedido(pedidoId);
                    });
            });
    }
    
    // Función auxiliar para intentar impresión en modo inseguro
    function tryInsecureQzPrint(pedidoId) {
        return new Promise((resolve, reject) => {
            if (!window.qz) return reject(new Error('QZ no disponible'));
            
            // Limpiar configuración de seguridad
            qz.security.setCertificatePromise(null);
            qz.security.setSignaturePromise(null);
            
            // Reconectar e imprimir
            const reconnectAndPrint = () => {
                qz.websocket.connect()
                    .then(() => qz.printers.getDefault())
                    .then(printerName => {
                        if (!printerName) throw new Error('No hay impresora');
                        const cfg = qz.configs.create(printerName, { copies: 1 });
                        const url = "{{ url('despacho/pedido/imprimir') }}/" + pedidoId;
                        const data = [{ type: 'html', format: 'file', data: url }];
                        return qz.print(cfg, data);
                    })
                    .then(() => resolve())
                    .catch(err => reject(err));
            };
            
            if (qz.websocket.isActive()) {
                qz.websocket.disconnect().then(reconnectAndPrint).catch(reconnectAndPrint);
            } else {
                reconnectAndPrint();
            }
        });
    }

    // Inicialización del documento
    $(document).ready(function() {
        // Cargar datos iniciales
        @php
        $pedidosJs = isset($pedidos) ? json_encode($pedidos) : '[]';
        $pedidosPorAsignarJs = isset($pedidosPorAsignar) ? json_encode($pedidosPorAsignar) : '[]';
        $pedidosMotorizadosJs = isset($pedidosMotorizados) ? json_encode($pedidosMotorizados) : '{}';
        @endphp
        
        const pedidosIniciales = {!!$pedidosJs!!}; // Estados 2 y 8
        const pedidosPorAsignar = {!!$pedidosPorAsignarJs!!}; // Estado 3
        const pedidosMotorizados = {!!$pedidosMotorizadosJs!!}; // Estados 4 y 5

        // Combinar todos los pedidos en un solo array
        allPedidos = [];
        
        // Agregar pedidos por preparar (estados 2 y 8)
        if (pedidosIniciales && pedidosIniciales.length > 0) {
            pedidosIniciales.forEach(pedido => {
                pedido.estado = pedido.estado || 2;
                allPedidos.push(pedido);
            });
        }
        
        // Agregar pedidos preparados (estado 3)
        if (pedidosPorAsignar && pedidosPorAsignar.length > 0) {
            pedidosPorAsignar.forEach(pedido => {
                pedido.estado = 3;
                allPedidos.push(pedido);
            });
        }

        // Agregar pedidos de motorizados (estados 4 y 5)
        @foreach($motorizados as $motorizado)
            @if($motorizado->estado == 1)
            if (pedidosMotorizados[{{ $motorizado->id }}] && pedidosMotorizados[{{ $motorizado->id }}].length > 0) {
                pedidosMotorizados[{{ $motorizado->id }}].forEach(function(pedido) {
                    pedido.motorizado = {
                        id: {{ $motorizado->id }},
                        name: "{{ $motorizado->name }}",
                        apellido: "{{ $motorizado->apellido }}"
                    };
                    // No asignar orden_entrega aquí, se calculará dinámicamente
                    pedido.estado = pedido.estado || 4;
                    allPedidos.push(pedido);
                });
            }
            @endif
        @endforeach

        // Marcar IDs como mostrados
        allPedidos.forEach(pedido => {
            displayedOrderIds.push(pedido.id);
        });

        console.log('Pedidos cargados:', allPedidos.length);
        console.log('Datos:', allPedidos);

        // Distribución inicial
        filteredPedidos = [...allPedidos];
        distribuirPedidos(filteredPedidos);

        // Configurar actualización automática (frecuencias reducidas)
        setInterval(actualizarPedidos, 60000); // Cada 60 segundos en lugar de 30
        setInterval(actualizarEstadoPedidos, 30000); // Cada 30 segundos en lugar de 10

        // Configurar drag & drop
        initializeKanbanDragDrop();
    });

    // Inicializar drag and drop para kanban
    function initializeKanbanDragDrop() {
        // Configurar sortable para la columna de preparados (origen)
        const preparadosColumn = document.getElementById('column-preparados');
        if (preparadosColumn) {
            new Sortable(preparadosColumn, {
                group: {
                    name: 'pedidos',
                    pull: 'clone',
                    put: false
                },
                animation: 150,
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                dragClass: 'sortable-drag',
                sort: false, // No permitir reordenar dentro de preparados
                onStart: function(evt) {
                    userInteracting = true;
                    console.log('Usuario iniciando drag & drop');
                },
                onEnd: function(evt) {
                    setTimeout(() => {
                        userInteracting = false;
                        console.log('Usuario terminó interacción');
                    }, 2000); // 2 segundos de pausa después del drag
                }
            });
        }

        // Configurar sortable para cada repartidor (destino)
        const repartidorContainers = document.querySelectorAll('.repartidor-pedidos');
        repartidorContainers.forEach(container => {
            const motoId = container.id.replace('moto-pedidos-', '');
            
            new Sortable(container, {
                group: {
                    name: 'pedidos',
                    pull: false,
                    put: true
                },
                animation: 150,
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                dragClass: 'sortable-drag',
                onAdd: function(evt) {
                    const pedidoCard = evt.item;
                    const pedidoId = pedidoCard.getAttribute('data-pedido-id');
                    
                    console.log(`Asignando pedido ${pedidoId} a moto ${motoId}`);
                    
                    // Marcar que el usuario está interactuando
                    userInteracting = true;
                    
                    // Asignar pedido al repartidor
                    asignarPedidoAMoto(pedidoId, motoId);
                    
                    // Desmarcar después de un tiempo
                    setTimeout(() => {
                        userInteracting = false;
                    }, 3000);
                }
            });
        });
    }

    // Función para actualizar estado de pedidos desde servidor
    function actualizarEstadoPedidos() {
        // No actualizar si el usuario está interactuando
        if (userInteracting) {
            console.log('Saltando verificación de estados - usuario interactuando');
            return;
        }
        
        console.log('Verificando estados de pedidos...');
        
        // Solo verificar cambios de estado críticos sin sobrescribir datos
        $.ajax({
            url: "{{ route('despacho.pedidos-nuevos') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let cambiosDetectados = false;
                let pedidosEliminados = false;
                
                data.forEach(function(pedidoServidor) {
                    const pedidoLocal = allPedidos.find(p => p.id === pedidoServidor.id);
                    
                    if (pedidoLocal && pedidoLocal.estado !== pedidoServidor.estado) {
                        console.log(`Estado actualizado para pedido ${pedidoLocal.id}: ${pedidoLocal.estado} -> ${pedidoServidor.estado}`);
                        
                        // Verificar si el pedido llega a un estado final (6, 10, 11)
                        if ([6, 10, 11].includes(parseInt(pedidoServidor.estado))) {
                            console.log(`Pedido ${pedidoLocal.id} completado con estado ${pedidoServidor.estado}, eliminando de vista`);
                            
                            // Eliminar del array de pedidos
                            const index = allPedidos.indexOf(pedidoLocal);
                            if (index > -1) {
                                allPedidos.splice(index, 1);
                            }
                            
                            // Eliminar del array filtrado
                            const filteredIndex = filteredPedidos.indexOf(pedidoLocal);
                            if (filteredIndex > -1) {
                                filteredPedidos.splice(filteredIndex, 1);
                            }
                            
                            pedidosEliminados = true;
                            cambiosDetectados = true;
                            
                            // Mostrar notificación según el estado final
                            let mensaje = '';
                            if (pedidoServidor.estado == 6) {
                                mensaje = `Pedido #${pedidoLocal.id} entregado exitosamente`;
                            } else if (pedidoServidor.estado == 10) {
                                mensaje = `Pedido #${pedidoLocal.id} - No se encontró al cliente`;
                            } else if (pedidoServidor.estado == 11) {
                                mensaje = `Pedido #${pedidoLocal.id} finalizado por el cliente`;
                            }
                            
                            Swal.fire({
                                title: 'Pedido Completado',
                                text: mensaje,
                                icon: pedidoServidor.estado == 6 ? 'success' : 'info',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000
                            });
                        } else {
                            // Solo actualizar estado para estados activos, mantener toda la demás información
                            pedidoLocal.estado = pedidoServidor.estado;
                            cambiosDetectados = true;
                        }
                    }
                });
                
                if (cambiosDetectados) {
                    // Redistribuir si hubo cambios de estado o eliminaciones
                    distribuirPedidos(filteredPedidos);
                    
                    if (pedidosEliminados) {
                        console.log('Pedidos eliminados, vista actualizada');
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error("Error al verificar estados:", error);
            }
        });
    }
    </script>
</body>

</html>