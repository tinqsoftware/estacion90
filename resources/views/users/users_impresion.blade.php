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
    <meta property="og:image" content="{{ asset('access/images/logo_white.png') }}" />
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- PAGE TITLE HERE -->
    <title>estacion90</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('access/images/logo_white.png') }}" />

    <!-- Stylesheet -->
    <link href="{{ asset('access/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('access/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('access/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('access/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('access/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') }}" rel="stylesheet">

    <!-- Global Stylesheet -->
    <link href="{{ asset('access/css/style.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        /* Better table visuals */
        #tabla-impresiones {
            width: 100%;
        }
        #tabla-impresiones thead th {
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 1;
            border-bottom: 1px solid #e5e7eb;
        }
        #tabla-impresiones td, #tabla-impresiones th {
            vertical-align: middle;
        }
        .text-truncate-1 {
            max-width: 220px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .actions-cell .btn { min-width: 36px; }
        .card-title { font-weight: 700; }
        
        /* Header like image */
        .impresiones-header {
            background: #fff7ed; /* orange-50 */
            border-bottom: 1px solid #fde7d8;
            padding: 14px 16px !important;
        }
        .impresiones-title { display:flex; align-items:center; gap:10px; margin:0; font-weight:800; }
        .impresiones-title i { color:#f59e0b; }
        .header-right-tools { display:flex; align-items:center; gap:12px; }
        .status-badge { background:#fff1e6; border:1px solid #ffe1cc; color:#7c2d12; font-size:12px; border-radius:6px; padding:6px 10px; font-weight:600; }
        .pending-pill { background:#f97316; color:#fff; border-radius:9999px; padding:6px 10px; font-weight:700; font-size:12px; }

        /* Buttons + money */
        .btn-icon{ width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center; padding:0; }
        .btn-outline-orange{ color:#ea580c; border:1px solid #fdba74; background:transparent; }
        .btn-outline-orange:hover{ background:#fdba74; color:#7c2d12; }
        .btn-outline-soft{ color:#6b7280; border:1px solid #e5e7eb; background:#fff; }
        .btn-outline-soft:hover{ background:#f3f4f6; color:#374151; }
        .money{ display:inline-flex; align-items:center; gap:6px; }
        .money-symbol, .text-money{ color:#16a34a; font-weight:700; }
        
        /* Mobile stacked table */
        @media (max-width: 768px) {
            .table thead { display: none; }
            .table tbody tr {
                display: block;
                margin-bottom: 12px;
                border: 1px solid #e5e7eb;
                border-radius: 10px;
                overflow: hidden;
                background: #fff;
            }
            .table tbody td {
                display: grid;
                grid-template-columns: 38% 62%;
                gap: 6px;
                padding: 10px 12px !important;
                border-bottom: 1px solid #f3f4f6;
            }
            .table tbody td:last-child { border-bottom: 0; }
            .table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #6b7280;
            }
            .actions-cell > .btn-group, .actions-cell > .actions-flex {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }
        }
    </style>

</head>

<body>
    <div id="main-wrapper" class="dlab-overflow">
        @include('partials.header')
        @include('partials.sidebar')
        
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center impresiones-header">
                                <h4 class="card-title impresiones-title">
                                    <i class="fa-regular fa-clock"></i>
                                    <span>Cola De Impresiones (Pendientes)</span>
                                </h4>
                                <div class="header-right-tools">
                                    <span class="status-badge" id="lastRefresh">Actualizado: --:--</span>
                                    <span class="pending-pill" id="pendingCount">0 pendientes</span>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-sm align-middle mb-0" id="tabla-impresiones">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Pedido</th>
                                                <th>Generado</th>
                                                <th>Cliente</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Se rellena por JS -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
            
        </div>
    </div>
    
    <!-- Vendor Scripts -->
    <script src="{{ asset('access/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('access/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/swiper/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('access/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('access/js/custom.js') }}"></script>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const API_LIST = "{{ route('impresiones.pendientes') }}";
        const API_MARK = (id) => `{{ url('/api/impresiones') }}/${id}/marcar-impresa`;
        const URL_PREVIEW = (id) => `{{ url('/impresiones') }}/${id}/preview`;

        async function fetchPendientes() {
            try {
                const res = await fetch(API_LIST, { headers: { 'Accept': 'application/json' } });
                if (!res.ok) throw new Error('Error listando impresiones');
                const data = await res.json();
                renderTabla(data);
                document.getElementById('lastRefresh').textContent = `Actualizado: ${new Date().toLocaleTimeString()}`;
                const countEl = document.getElementById('pendingCount');
                if (countEl) countEl.textContent = `${data?.length ?? 0} pendientes`;
            } catch (e) {
                console.error(e);
            }
        }

        function renderTabla(items) {
            const tbody = document.querySelector('#tabla-impresiones tbody');
            tbody.innerHTML = '';
            if (!items || !items.length) {
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.colSpan = 6;
                td.className = 'text-center text-muted py-4';
                td.textContent = 'No hay impresiones pendientes';
                tr.appendChild(td);
                tbody.appendChild(tr);
                return;
            }
            items.forEach((imp) => {
                const tr = document.createElement('tr');
                const pedido = imp.pedido || {};
                const fecha = imp.fecha_generacion ? new Date(imp.fecha_generacion) : null;
                const totalRaw = Number(pedido.monto_total ?? 0);
                const totalFmtNumber = (isFinite(totalRaw) ? totalRaw.toLocaleString('es-PE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '0.00');

                tr.innerHTML = `
                    <td data-label="#">${imp.id}</td>
                    <td data-label="Pedido">
                        <div class="text-truncate-1" style="color:#0d6efd;"><strong>Pedido #${pedido.id ?? ''}</strong></div>
                        <small class="text-muted">${pedido.distritoContacto?.nombre ?? ''}</small>
                    </td>
                    <td data-label="Generado">${fecha ? fecha.toLocaleString() : ''}</td>
                    <td data-label="Cliente">
                        <div class="text-truncate-1">${pedido.nombre_contacto ?? '-'}</div>
                        <small class="text-muted">${pedido.telefono_contacto ?? ''}</small>
                    </td>
                    <td data-label="Total">
                        <span class="money">
                            <span class="money-symbol">S/</span>
                            <span class="text-money">${totalFmtNumber}</span>
                        </span>
                    </td>
                    <td data-label="Acciones" class="actions-cell">
                        <div class="btn-group btn-group-sm actions-flex" role="group">
                            <a class="btn btn-outline-orange btn-icon" href="${URL_PREVIEW(imp.id)}" target="_blank" title="Preview">
                                <i class="fa fa-eye"></i>
                            </a>
                            <button class="btn btn-success btn-icon" onclick="marcarImpresa(${imp.id})" title="Marcar como impresa">
                                <i class="fa fa-check"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        async function marcarImpresa(id) {
            try {
                const res = await fetch(API_MARK(id), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({})
                });
                if (!res.ok) throw new Error('No se pudo marcar como impresa');
                await fetchPendientes();
            } catch (e) {
                console.error(e);
            }
        }

        // Auto refresh cada 5s (solo reemplaza cuerpo de tabla)
        fetchPendientes();
    setInterval(fetchPendientes, 5000);
    </script>
</body>