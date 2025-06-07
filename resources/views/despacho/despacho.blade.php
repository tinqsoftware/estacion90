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
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        
        .dashboard-title {
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .dashboard-date {
            font-size: 1.2rem;
            font-weight: 500;
        }
        
        .order-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
            position: relative;
        }
        
        .order-header {
            background-color: #f8f8f8;
            margin: -15px -15px 10px;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            display: flex;
            justify-content: space-between;
        }
        
        .order-ready-check {
            position: absolute;
            right: 15px;
            top: 15px;
        }
        
        .order-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .order-details {
            margin-bottom: 10px;
        }
        
        .order-total {
            font-weight: bold;
            border-top: 1px solid #ddd;
            margin-top: 10px;
            padding-top: 10px;
        }
        
        .section-title {
            background-color: #f0f0f0;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 15px;
            display: inline-block;
        }
        
        .print-btn {
            background-color: #6b6b6b;
            color: white;
            border: none;
            padding: 5px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .moto-header {
            background-color: #b7562a;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        .status-indicator {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        
        .status-circle {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: #b7562a;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }
        
        .status-text {
            color: #b7562a;
            font-weight: bold;
        }
        
        #orders-pending, #orders-assigned {
            min-height: 500px;
        }
        
        .draggable {
            cursor: move;
        }
        
        .drag-container {
            border: 2px dashed #ddd;
            padding: 10px;
            min-height: 100px;
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
                    <div class="dashboard-title">DASHBOARD ORGANIZAR REPARTO</div>
                    <div class="dashboard-date">JUEVES 29 MAYO</div>
                </div>

                <div class="row">
                    <!-- Left Side - Pedidos Preparados -->
                    <div class="col-lg-6">
                        <div class="section-title">
                            3 PEDIDOS PREPARADOS
                        </div>

                        <div id="orders-pending">
                            <!-- Pedido #001 -->
                            <div class="order-card">
                                <div class="order-header">
                                    <div>PEDIDO #001 - 15 Junio 2025</div>
                                    <div>
                                        <span>Hora pedido: <strong>15 Junio 12:15 PM</strong></span> 
                                        <span style="margin-left: 10px;">Hora entrega aprox: <strong>15 Junio 1:00 PM</strong></span>
                                    </div>
                                </div>
                                <div class="order-ready-check">
                                    <label>PEDIDO LISTO</label>
                                    <input type="checkbox">
                                </div>
                                <div class="order-info">
                                    <div>
                                        <div><strong>Diego: s/ 21.00</strong></div>
                                        <div class="order-details">
                                            - Solo segundo: Milanesa de pollo (s/ 13.00)<br>
                                            - A la carta: Tequeños (s/ 8.00)
                                        </div>
                                    </div>
                                    <div>
                                        <div><strong>Lucía: s/ 34.00</strong></div>
                                        <div class="order-details">
                                            - Solo entrada: Crema de zapallo (s/ 12.00)<br>
                                            - Combo: Hamburguesa + Papas + Gaseosa (s/ 22.00)
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>JUAN CARLOS</strong><br>
                                        TEL:957362484<br>
                                        Av. Primavera 123, Dpto. 402<br>
                                        Frente a Plaza Vea<br>
                                        Surco</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Método pago: <strong>Efectivo</strong><br>
                                        Vuelto de: <strong>100 soles</strong><br>
                                        Comprobante pago: <strong>Boleta</strong><br>
                                        Nº documento: <strong>10456789011</strong></p>
                                        <p>Comentario cliente:</p>
                                    </div>
                                </div>

                                <div class="order-total">
                                    <div>Delivery: s/1.00</div>
                                    <div>TOTAL: s/56.00</div>
                                    <button class="print-btn mt-2">Imprimir</button>
                                </div>
                            </div>

                            <!-- Pedido #002 -->
                            <div class="order-card">
                                <div class="order-header">
                                    <div>PEDIDO #002 - 15 Junio 2025</div>
                                    <div>
                                        <span>Hora pedido: <strong>15 Junio 12:15 PM</strong></span> 
                                        <span style="margin-left: 10px;">Hora entrega aprox: <strong>15 Junio 1:00 PM</strong></span>
                                    </div>
                                </div>
                                <div class="order-ready-check">
                                    <label>PEDIDO LISTO</label>
                                    <input type="checkbox">
                                </div>
                                <div class="order-info">
                                    <div>
                                        <div><strong>Diego: s/ 21.00</strong></div>
                                        <div class="order-details">
                                            - Solo segundo: Milanesa de pollo (s/ 13.00)<br>
                                            - A la carta: Tequeños (s/ 8.00)
                                        </div>
                                    </div>
                                    <div>
                                        <div><strong>Lucía: s/ 34.00</strong></div>
                                        <div class="order-details">
                                            - Solo entrada: Crema de zapallo (s/ 12.00)<br>
                                            - Combo: Hamburguesa + Papas + Gaseosa (s/ 22.00)
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>JUAN CARLOS</strong><br>
                                        TEL:957362484<br>
                                        Av. Primavera 123, Dpto. 402<br>
                                        Frente a Plaza Vea<br>
                                        Surco</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Método pago: <strong>Efectivo</strong><br>
                                        Vuelto de: <strong>100 soles</strong><br>
                                        Comprobante pago: <strong>Boleta</strong><br>
                                        Nº documento: <strong>10456789011</strong></p>
                                        <p>Comentario cliente:</p>
                                    </div>
                                </div>

                                <div class="order-total">
                                    <div>Delivery: s/1.00</div>
                                    <div>TOTAL: s/56.00</div>
                                    <button class="print-btn mt-2">Imprimir</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Asignaciones -->
                    <div class="col-lg-6">
                        <div class="section-title">
                            2 POR ASIGNAR
                        </div>

                        <div id="orders-assigned">
                            <div id="unassigned-orders" class="drag-container mb-4">
                                <!-- Pedido #003 -->
                                <div class="order-card draggable mb-3">
                                    <div class="order-header">
                                        <div>PEDIDO #003 - 15 Junio 2025</div>
                                        <div>
                                            <span>Hora pedido: <strong>15 Junio 12:15 PM</strong></span>
                                            <span style="margin-left: 10px;">Hora entrega aprox: <strong>15 Junio 1:00 PM</strong></span>
                                        </div>
                                    </div>
                                    
                                    <div class="order-info">
                                        <div>
                                            <div><strong>Diego: s/ 21.00</strong></div>
                                            <div><strong>Lucía: s/ 34.00</strong></div>
                                        </div>
                                        <div>
                                            <p><strong>JUAN CARLOS</strong><br>
                                            TEL:957362484<br>
                                            Av. Primavera 123, Dpto. 402<br>
                                            Frente a Plaza Vea<br>
                                            Surco</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Método pago: <strong>Efectivo</strong><br>
                                            Vuelto de: <strong>100 soles</strong></p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="order-total mb-0">
                                                <div>Delivery: s/1.00</div>
                                                <div>TOTAL: s/56.00</div>
                                                <button class="print-btn mt-2">Imprimir</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pedido #004 -->
                                <div class="order-card draggable">
                                    <div class="order-header">
                                        <div>PEDIDO #004 - 15 Junio 2025</div>
                                        <div>
                                            <span>Hora pedido: <strong>15 Junio 12:15 PM</strong></span>
                                            <span style="margin-left: 10px;">Hora entrega aprox: <strong>15 Junio 1:00 PM</strong></span>
                                        </div>
                                    </div>
                                    
                                    <div class="order-info">
                                        <div>
                                            <div><strong>Diego: s/ 21.00</strong></div>
                                            <div><strong>Lucía: s/ 34.00</strong></div>
                                        </div>
                                        <div>
                                            <p><strong>JUAN CARLOS</strong><br>
                                            TEL:957362484<br>
                                            Av. Primavera 123, Dpto. 402<br>
                                            Frente a Plaza Vea<br>
                                            Surco</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Método pago: <strong>Efectivo</strong><br>
                                            Vuelto de: <strong>100 soles</strong></p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="order-total mb-0">
                                                <div>Delivery: s/1.00</div>
                                                <div>TOTAL: s/56.00</div>
                                                <button class="print-btn mt-2">Imprimir</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Moto 1 -->
                            <div class="moto-header">MOTO 1 (JUAN)</div>
                            <div id="moto1-container" class="drag-container mb-4">
                                <div class="order-card draggable">
                                    <div class="order-header">
                                        <div>PEDIDO #003 - 15 Junio 2025</div>
                                        <div>
                                            <span>Hora pedido: <strong>15 Junio 12:15 PM</strong></span>
                                            <span style="margin-left: 10px;">Hora entrega aprox: <strong>15 Junio 1:00 PM</strong></span>
                                        </div>
                                    </div>
                                    
                                    <div class="order-info">
                                        <div>
                                            <div><strong>Diego: s/ 21.00</strong></div>
                                            <div><strong>Lucía: s/ 34.00</strong></div>
                                        </div>
                                        <div>
                                            <p><strong>JUAN CARLOS</strong><br>
                                            TEL:957362484<br>
                                            Av. Primavera 123, Dpto. 402<br>
                                            Frente a Plaza Vea<br>
                                            Surco</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Método pago: <strong>Efectivo</strong><br>
                                            Vuelto de: <strong>100 soles</strong></p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="order-total mb-0">
                                                <div>Delivery: s/1.00</div>
                                                <div>TOTAL: s/56.00</div>
                                                <button class="print-btn mt-2">Imprimir</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="status-indicator">
                                        <div class="status-circle">1</div>
                                        <div class="status-text">EN CAMINO</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Moto 2 -->
                            <div class="moto-header">MOTO 2 (JUAN)</div>
                            <div id="moto2-container" class="drag-container">
                                <div class="order-card draggable">
                                    <div class="order-header">
                                        <div>PEDIDO #003 - 15 Junio 2025</div>
                                        <div>
                                            <span>Hora pedido: <strong>15 Junio 12:15 PM</strong></span>
                                            <span style="margin-left: 10px;">Hora entrega aprox: <strong>15 Junio 1:00 PM</strong></span>
                                        </div>
                                    </div>
                                    
                                    <div class="order-info">
                                        <div>
                                            <div><strong>Diego: s/ 21.00</strong></div>
                                            <div><strong>Lucía: s/ 34.00</strong></div>
                                        </div>
                                        <div>
                                            <p><strong>JUAN CARLOS</strong><br>
                                            TEL:957362484<br>
                                            Av. Primavera 123, Dpto. 402<br>
                                            Frente a Plaza Vea<br>
                                            Surco</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Método pago: <strong>Efectivo</strong><br>
                                            Vuelto de: <strong>100 soles</strong></p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="order-total mb-0">
                                                <div>Delivery: s/1.00</div>
                                                <div>TOTAL: s/56.00</div>
                                                <button class="print-btn mt-2">Imprimir</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="status-indicator">
                                        <div class="status-circle">1</div>
                                    </div>
                                </div>
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

    <!-- Include Sortable.js for drag-and-drop -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

    <!-- Dashboard -->
    <script src="{{ asset('access/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('access/js/custom.js') }}"></script>
    <script src="{{ asset('access/js/demo.js') }}"></script>

    <script>
        // Inicializar Sortable para permitir arrastrar y soltar
        document.addEventListener('DOMContentLoaded', function() {
            // Contenedores donde se pueden arrastrar las tarjetas
            var containers = [
                document.getElementById('unassigned-orders'),
                document.getElementById('moto1-container'),
                document.getElementById('moto2-container')
            ];

            containers.forEach(function(container) {
                new Sortable(container, {
                    group: 'orders',
                    animation: 150,
                    ghostClass: 'order-card-ghost',
                    chosenClass: 'order-card-chosen',
                    dragClass: 'order-card-drag'
                });
            });
        });
    </script>
</body>
</html>