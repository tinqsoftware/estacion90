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

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    /* Dashboard header styles */
    .moto-dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
    }

    .moto-dashboard-title {
        font-weight: bold;
        font-size: 1.5rem;
        text-transform: uppercase;
    }

    .moto-dashboard-date {
        font-size: 1.2rem;
        font-weight: 500;
        text-transform: uppercase;
    }

    /* Counter box */
    .orders-counter {
        background-color: #f0f0f0;
        border: 1px solid #ddd;
        padding: 8px 15px;
        margin-bottom: 20px;
        display: inline-block;
        font-weight: bold;
        border-radius: 4px;
    }

    /* Order card styles */
    .order-card {
        border: 1px solid #ff6f00;
        border-radius: 5px;
        margin-bottom: 20px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .order-card.active {
        border: 2px solid #ff6f00;
        box-shadow: 0 3px 10px rgba(255, 111, 0, 0.2);
    }

    .order-header {
        padding: 10px 15px;
        background-color: #f5f5f5;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
    }

    .order-title {
        font-weight: bold;
    }

    .order-time-container {
        display: flex;
        flex-direction: column;
        text-align: right;
    }

    .order-time {
        margin-bottom: 4px;
    }

    .order-time-delivery {
        color: #ff6f00;
        font-weight: bold;
    }

    .order-status-flag {
        background-color: #ff6f00;
        color: white;
        padding: 5px 15px;
        position: absolute;
        top: 10px;
        right: -30px;
        transform: rotate(45deg);
        font-size: 12px;
        font-weight: bold;
        width: 120px;
        text-align: center;
    }

    .order-body {
        display: flex;
        flex-wrap: wrap;
    }

    .order-left-column {
        flex: 1;
        min-width: 300px;
        padding: 15px;
        border-right: 1px solid #eee;
    }

    .order-right-column {
        flex: 1;
        min-width: 300px;
        padding: 15px;
    }

    .customer-section {
        border: 1px solid #eee;
        padding: 10px;
        margin-bottom: 15px;
    }

    .customer-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .customer-name {
        font-weight: bold;
    }

    .person-order {
        margin-bottom: 10px;
    }

    .person-name {
        font-weight: bold;
    }

    .order-item {
        padding-left: 15px;
    }

    .order-totals {
        border-top: 1px solid #eee;
        margin-top: 10px;
        padding-top: 10px;
        text-align: right;
    }

    .order-total {
        font-weight: bold;
        font-size: 18px;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .action-button {
        text-align: center;
        text-decoration: none;
        padding: 8px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 14px;
        text-transform: uppercase;
        cursor: pointer;
        flex: 1;
        color: #fff;
    }

    .btn-map {
        background-color: #1e88e5;
    }

    .btn-waze {
        background-color: #33ccff;
    }

    .btn-status {
        background-color: #212121;
        width: 100%;
    }

    .payment-section {
        border: 1px solid #eee;
        padding: 10px;
        margin-bottom: 15px;
    }

    .payment-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    /* Map container */
    .map-container {
        height: 500px;
        border: 1px solid #ddd;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    /* Direcciones list */
    .direcciones-container {
        margin-bottom: 20px;
    }

    .direccion-item {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .direccion-ref {
        color: #666;
        font-size: 0.9em;
        margin-top: 5px;
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
                <div class="moto-dashboard-header">
                    <div class="moto-dashboard-title">Dashboard Repartidor {{ Auth::user()->name }}</div>
                    <div class="moto-dashboard-date">{{ strtoupper($fechaActual) }}</div>
                </div>

                <!-- Orders counter -->
                <div class="orders-counter">
                    {{ count($pedidos) }} PEDIDOS ASIGNADOS
                </div>

                <div class="row">
                    <!-- Order Cards Section -->
                    <div class="col-lg-6 order-2 order-lg-1">
                        @if(count($pedidos) > 0)
                        @foreach($pedidos as $pedido)
                        <div class="order-card {{ $loop->first ? 'active' : '' }}">
                            <div class="order-status-flag">{{ $pedido['estado'] == 4 ? 'ASIGNADO' : 'EN CAMINO' }}</div>
                            <div class="order-header">
                                <div class="order-title">PEDIDO #{{ $pedido['id'] }} - {{ $pedido['fecha'] }}</div>
                                <div class="order-time-container">
                                    <div class="order-time">Hora pedido: <strong>{{ $pedido['hora_pedido'] }}</strong>
                                    </div>
                                    <div class="order-time-delivery">Hora entrega aprox:
                                        <strong>{{ $pedido['hora_entrega'] }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="order-body">
                                <div class="order-left-column">
                                    <div>
                                        @foreach($pedido['comensales'] as $comensal)
                                        <div class="person-order">
                                            <div class="person-name">{{ $comensal['nombre'] }}: (s/
                                                {{ number_format($comensal['total'], 2) }})</div>
                                            @foreach($comensal['items'] as $item)
                                            <div class="order-item">- {{ $item['nombre'] }} (s/
                                                {{ number_format($item['precio'], 2) }})</div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="order-totals">
                                        <div>Delivery: s/1.00</div>
                                        <div class="order-total">TOTAL: s/{{ number_format($pedido['total'], 2) }}</div>
                                    </div>
                                    <div class="action-buttons">
                                        <a href="https://waze.com/ul?ll={{ $pedido['lat'] }},{{ $pedido['lon'] }}&navigate=yes"
                                            target="_blank" class="action-button btn-waze">IR WAZE</a>
                                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $pedido['lat'] }},{{ $pedido['lon'] }}"
                                            target="_blank" class="action-button btn-map">IR MAPS</a>
                                    </div>
                                    <div class="action-buttons">
                                        @if($pedido['estado'] == 4)
                                        <a href="#" class="action-button btn-status"
                                            data-id="{{ $pedido['id'] }}">MARCAR EN CAMINO</a>
                                        @else
                                        <a href="#" class="action-button btn-status" data-id="{{ $pedido['id'] }}"
                                            style="background-color: #4caf50;">FINALIZAR ENTREGA</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="order-right-column">
                                    <div class="customer-section">
                                        <div class="customer-header">
                                            <div class="customer-name">{{ $pedido['nombre_contacto'] }}</div>
                                            <div>TEL: {{ $pedido['telefono_contacto'] }}</div>
                                        </div>
                                        <div>{{ $pedido['direccion'] }}</div>
                                        @if($pedido['referencia'])
                                        <div>{{ $pedido['referencia'] }}</div>
                                        @endif
                                        <div>{{ $pedido['distrito'] }}</div>
                                    </div>
                                    <div class="payment-section">
                                        <div class="payment-row">
                                            <div>Método pago:</div>
                                            <div><strong>{{ $pedido['metodo_pago'] }}</strong></div>
                                        </div>
                                        @if($pedido['vuelto'])
                                        <div class="payment-row">
                                            <div>Vuelto de:</div>
                                            <div><strong>{{ $pedido['vuelto'] }} soles</strong></div>
                                        </div>
                                        @endif
                                        <div class="payment-row">
                                            <div>Comprobante pago:</div>
                                            <div><strong>{{ $pedido['comprobante'] }}</strong></div>
                                        </div>
                                        @if($pedido['tipo_comprobante'])
                                        <div class="payment-row">
                                            <div>Tipo:</div>
                                            <div><strong>{{ $pedido['tipo_comprobante'] }}</strong></div>
                                        </div>
                                        @endif
                                        @if($pedido['documento'])
                                        <div class="payment-row">
                                            <div>Nº documento:</div>
                                            <div><strong>{{ $pedido['documento'] }}</strong></div>
                                        </div>
                                        @endif
                                    </div>
                                    @if($pedido['comentarios'])
                                    <div class="customer-section">
                                        <div style="margin-bottom: 5px;">Comentario cliente</div>
                                        <div>{{ $pedido['comentarios'] }}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="alert alert-info">No tienes pedidos asignados actualmente</div>
                        @endif
                    </div>

                    <!-- Map Section -->
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">MIS DIRECCIONES</h4>
                            </div>
                            <div class="card-body">
                                <div class="map-container" id="map"></div>
                            </div>
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

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Dashboard -->
    <script src="{{ asset('access/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('access/js/custom.js') }}"></script>
    <script src="{{ asset('access/js/demo.js') }}"></script>

    <script>
    $(document).ready(function() {
        // Variables para control de actualización
        let ultimaActualizacion = "{{ Carbon\Carbon::now()->toDateTimeString() }}";
        let actualizacionEnProceso = false;
        let mapInitialized = false;
        let map, markers = [];

        // Inicializar mapa
        function initializeMap() {
            // Crear mapa solo si no está ya inicializado
            if (!mapInitialized) {
                map = L.map('map').setView([-12.0464, -77.0428], 12); // Lima coordinates

                // Add the OpenStreetMap tiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                mapInitialized = true;
            }

            // Limpiar marcadores existentes
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            // Añadir marcadores para cada pedido
            const pedidos = @json($pedidos);
            let bounds = [];

            if (pedidos.length > 0) {
                pedidos.forEach(function(pedido) {
                    if (pedido.lat && pedido.lon) {
                        const latLng = [parseFloat(pedido.lat), parseFloat(pedido.lon)];
                        bounds.push(latLng);

                        const marker = L.marker(latLng)
                            .bindPopup(`
                            <b>PEDIDO #${pedido.id}</b><br>
                            ${pedido.nombre_contacto}<br>
                            ${pedido.direccion}<br>
                            Tel: ${pedido.telefono_contacto}
                        `)
                            .addTo(map);

                        markers.push(marker);
                    }
                });

                // Ajustar el mapa para mostrar todos los marcadores
                if (bounds.length > 0) {
                    map.fitBounds(bounds);
                }
            }
        }

        // Inicializar mapa al cargar la página
        initializeMap();

        // Función para verificar nuevos pedidos o cambios
        function verificarActualizaciones() {
            if (actualizacionEnProceso) return;

            actualizacionEnProceso = true;

            $.ajax({
                url: "{{ route('motorizado.actualizaciones') }}",
                type: "GET",
                data: {
                    ultima_actualizacion: ultimaActualizacion,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    ultimaActualizacion = response.ultima_actualizacion;

                    if (response.pedidos.length > 0) {
                        // Hay nuevos pedidos o cambios - recargar la página
                        // Opcionalmente podríamos actualizar solo la sección de pedidos
                        location.reload();
                    }

                    actualizacionEnProceso = false;
                },
                error: function(xhr, status, error) {
                    console.error("Error verificando actualizaciones:", error);
                    actualizacionEnProceso = false;
                }
            });
        }

        // Verificar actualizaciones cada 30 segundos
        setInterval(verificarActualizaciones, 30000);

        // Manejar cambios de estado de pedido
        $(document).on('click', '.btn-status', function(e) {
            e.preventDefault();

            const $button = $(this);
            const pedidoId = $button.data('id');
            const isEnCamino = $button.text() === 'MARCAR EN CAMINO';

            if (isEnCamino) {
                // Lógica existente para marcar como "En Camino"
                Swal.fire({
                    title: '¿Marcar pedido como "En Camino"?',
                    text: "El estado del pedido cambiará a En Camino",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, confirmar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('motorizado.marcar-en-camino') }}",
                            type: "POST",
                            data: {
                                pedido_id: pedidoId,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    $button.text('FINALIZAR ENTREGA');
                                    $button.css('background-color', '#4caf50');
                                    $button.closest('.order-card').find(
                                        '.order-status-flag').text('EN CAMINO');

                                    Swal.fire(
                                        'Actualizado!',
                                        'El pedido ha sido marcado como En Camino.',
                                        'success'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                handleAjaxError(xhr, status, error);
                            }
                        });
                    }
                });
            } else {
                // Nueva lógica para finalizar con múltiples opciones
                Swal.fire({
                    title: 'Finalizar entrega',
                    html: `
                <div class="mb-3">
                    <p class="mb-2">Seleccione el resultado de la entrega:</p>
                    <div class="form-check text-start mb-2">
                        <input class="form-check-input" type="radio" name="estado-entrega" id="estado-entregado" value="6" checked>
                        <label class="form-check-label" for="estado-entregado">
                            Entregado correctamente
                        </label>
                    </div>
                    <div id="foto-container" class="mb-3">
                        <label for="foto-evidencia" class="form-label text-start d-block">Foto de evidencia:</label>
                        <input type="file" id="foto-evidencia" class="form-control" accept="image/*" capture="camera">
                        <small class="text-muted">Tome una foto del pedido entregado como evidencia</small>
                    </div>
                    <div class="form-check text-start mb-2">
                        <input class="form-check-input" type="radio" name="estado-entrega" id="estado-no-encontrado" value="10">
                        <label class="form-check-label" for="estado-no-encontrado">
                            No se encontró al cliente
                        </label>
                    </div>
                    <div class="form-check text-start mb-2">
                        <input class="form-check-input" type="radio" name="estado-entrega" id="estado-rechazado" value="11">
                        <label class="form-check-label" for="estado-rechazado">
                            Cliente rechazó el pedido
                        </label>
                    </div>
                </div>
                <div id="motivo-container" class="d-none mb-3">
                    <label for="motivo-no-entrega" class="form-label text-start d-block">Motivo:</label>
                    <textarea id="motivo-no-entrega" class="form-control" rows="3"></textarea>
                </div>
                `,
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    didOpen: () => {
                        // Mostrar/ocultar campos según la opción seleccionada
                        $('input[name="estado-entrega"]').change(function() {
                            if ($(this).val() === '6') {
                                $('#motivo-container').addClass('d-none');
                                $('#foto-container').removeClass('d-none');
                            } else {
                                $('#motivo-container').removeClass('d-none');
                                $('#foto-container').addClass('d-none');
                            }
                        });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const estado = $('input[name="estado-entrega"]:checked').val();
                        const motivo = $('#motivo-no-entrega').val();

                        // Validar motivo si es necesario para estados de no entrega
                        if (estado !== '6' && !motivo.trim()) {
                            Swal.fire('Error', 'Debe ingresar un motivo', 'error');
                            return;
                        }

                        // Crear objeto FormData para enviar archivos
                        const formData = new FormData();
                        formData.append('pedido_id', pedidoId);
                        formData.append('estado', estado);
                        formData.append('motivo', motivo);
                        formData.append('_token', "{{ csrf_token() }}");

                        // Añadir foto si existe y es entrega correcta
                        if (estado === '6' && $('#foto-evidencia')[0].files.length > 0) {
                            formData.append('foto_evidencia', $('#foto-evidencia')[0].files[0]);
                        }

                        // Mostrar indicador de carga
                        Swal.fire({
                            title: 'Procesando...',
                            text: 'Guardando información del pedido',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: "{{ route('motorizado.marcar-entregado') }}",
                            type: "POST",
                            data: formData,
                            contentType: false, // Necesario para FormData
                            processData: false, // Necesario para FormData
                            success: function(response) {
                                if (response.success) {
                                    // Eliminar el pedido de la lista
                                    $button.closest('.order-card').fadeOut(300,
                                        function() {
                                            $(this).remove();

                                            // Actualizar el contador de pedidos
                                            const nuevaCantidad = $(
                                                '.order-card').length;
                                            $('.orders-counter').text(
                                                nuevaCantidad +
                                                ' PEDIDOS ASIGNADOS');

                                            // Si no quedan pedidos, mostrar mensaje
                                            if (nuevaCantidad === 0) {
                                                $('.col-lg-6.order-2').html(
                                                    '<div class="alert alert-info">No tienes pedidos asignados actualmente</div>'
                                                );
                                            }

                                            // Actualizar el mapa
                                            initializeMap();
                                        });

                                    Swal.fire(
                                        'Pedido finalizado',
                                        response.message,
                                        'success'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                handleAjaxError(xhr, status, error);
                            }
                        });
                    }
                });
            }
        });

        // Función para manejar errores de AJAX
        function handleAjaxError(xhr, status, error) {
            console.error("Error:", error);
            Swal.fire(
                'Error',
                'Ha ocurrido un problema al actualizar el pedido',
                'error'
            );
        }
    });
    </script>
</body>

</html>