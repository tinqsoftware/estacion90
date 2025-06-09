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

    #orders-pending,
    #orders-assigned {
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


    /* Calendar Styles */
    .calendar-container {
        width: 100%;
        max-width: 300px;
        margin: 0 auto 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .month-selector {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 15px;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .month-nav {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0 15px;
        color: #3366ff;
    }

    #currentMonth {
        min-width: 150px;
        text-align: center;
    }

    .days-column {
        display: flex;
        justify-content: space-between;
        overflow: hidden;
    }

    .day-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px 0;
        width: 14.28%;
    }

    .day-name {
        font-weight: bold;
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .day {
        height: 40px;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
    }

    .day.current {
        background-color: rgb(255, 111, 0);
    }

    .day.selected {
        background-color: #3366ff;
        color: white;
    }

    .day.other-month {
        color: #ccc;
    }

    .day-slider-controls {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
    }

    .day-nav {
        background-color: #3366ff;
        color: white;
        border: none;
        padding: 5px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .orders-container {
    max-width: 1200px;
    margin: 0 auto;
}

.card-container {
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #fff;
    margin-bottom: 15px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    position: relative;
}

.card-header {
    padding: 10px 15px;
    background-color: #f5f5f5;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.card-title {
    font-weight: bold;
    font-size: 16px;
    margin-bottom: 5px;
}

.card-times {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    font-size: 14px;
}

.card-time-label {
    font-weight: bold;
    display: block;
}

.card-time-value {
    display: block;
}

.card-time-delivery {
    color: #ff6f00;
}

.card-body {
    display: flex;
    flex-wrap: wrap;
}

.card-column {
    padding: 15px;
    flex: 1;
    min-width: 300px;
}

.card-column-left {
    border-right: 1px solid #dee2e6;
}

.customer-info {
    border: 1px solid #dee2e6;
    padding: 15px;
    margin-bottom: 15px;
}

.customer-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.customer-name {
    font-weight: bold;
}

.customer-address {
    margin-bottom: 5px;
}

.payment-info {
    border: 1px solid #dee2e6;
    padding: 15px;
    margin-bottom: 15px;
}

.payment-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
}

.payment-label {
    font-weight: normal;
}

.payment-value {
    font-weight: bold;
}

.order-items {
    margin-bottom: 15px;
}

.order-person {
    margin-bottom: 10px;
}

.order-person-name {
    font-weight: bold;
    margin-bottom: 5px;
}

.order-item {
    padding-left: 15px;
    margin-bottom: 3px;
}

.order-totals {
    text-align: right;
    border-top: 1px solid #dee2e6;
    padding-top: 10px;
    margin-top: 10px;
}

.order-delivery {
    margin-bottom: 5px;
}

.order-total {
    font-weight: bold;
    font-size: 16px;
}

.print-button {
    background-color: #343a40;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 4px;
    font-weight: bold;
    cursor: pointer;
    width: 120px;
    margin-top: 10px;
}

.status-indicator {
    position: absolute;
    bottom: 15px;
    left: 15px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #ff8c00;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

/* Section Headers */
.section-header {
    background-color: #f0f0f0;
    padding: 8px 12px;
    border-radius: 5px;
    margin-bottom: 15px;
    display: inline-block;
    font-weight: bold;
}

.moto-section {
    background-color: #b7562a;
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    margin-bottom: 15px;
    font-weight: bold;
}

/* Drag containers */
.drag-area {
    border: 2px dashed #ddd;
    padding: 15px;
    min-height: 100px;
    margin-bottom: 20px;
    border-radius: 5px;
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

                <!-- Calendar Component -->
                <div class="calendar-container mb-4">
                    <div class="month-selector">
                        <button class="month-nav" id="prevMonth">&lt;</button>
                        <span
                            id="currentMonth">{{ strtoupper(Carbon\Carbon::now()->locale('es')->format('F Y')) }}</span>
                        <button class="month-nav" id="nextMonth">&gt;</button>
                    </div>
                    <div class="days-column" id="calendarDays"></div>

                </div>
                <!-- Dashboard Header -->
                <div class="dashboard-header">
                    <div class="dashboard-title">DASHBOARD ORGANIZAR REPARTO</div>
                    <div class="dashboard-date">
                        {{ strtoupper(Carbon\Carbon::now()->locale('es')->isoFormat('dddd D MMMM')) }}</div>
                </div>



                <div class="row">
                    <!-- Left Side - Pedidos Preparados -->
                    <div class="col-lg-6">
                        <div class="section-header">3 PEDIDOS PREPARADOS</div>

                        <div id="orders-pending">
                            <!-- Pedido #001 -->
                            <div class="card-container">
                                <div class="card-header">
                                    <div class="card-title">PEDIDO #001 - 15 Junio 2025</div>
                                    <div class="card-times">
                                        <div>
                                            <span class="card-time-label">Hora pedido:</span>
                                            <span class="card-time-value">15 Junio 12:15 PM</span>
                                        </div>
                                        <div>
                                            <span class="card-time-label">Hora entrega aprox:</span>
                                            <span class="card-time-value card-time-delivery">15 Junio 1:00 PM</span>
                                        </div>
                                    </div>
                                    <div>PEDIDO LISTO <input type="checkbox" style="width: 20px; height: 20px;"></div>
                                </div>

                                <div class="card-body">
                                    <!-- Left column - Order items -->
                                    <div class="card-column card-column-left">
                                        <div class="order-items">
                                            <!-- Diego's order -->
                                            <div class="order-person">
                                                <div class="order-person-name">Diego: (s/ 21.00)</div>
                                                <div class="order-item">- Solo segundo: Milanesa de pollo (s/ 13.00)
                                                </div>
                                                <div class="order-item">- A la carta: Tequeños (s/ 8.00)</div>
                                            </div>

                                            <!-- Lucía's order -->
                                            <div class="order-person">
                                                <div class="order-person-name">Lucía: (s/ 34.00)</div>
                                                <div class="order-item">- Solo entrada: Crema de zapallo (s/ 12.00)
                                                </div>
                                                <div class="order-item">- Combo: Hamburguesa + Papas + Gaseosa (s/
                                                    22.00)</div>
                                            </div>

                                            <!-- Total section -->
                                            <div class="order-totals">
                                                <div class="order-delivery">Delivery: s/1.00</div>
                                                <div class="order-total">TOTAL: s/56.00</div>
                                            </div>
                                        </div>

                                        <button class="print-button">Imprimir</button>
                                    </div>

                                    <!-- Right column - Customer info -->
                                    <div class="card-column">
                                        <!-- Customer contact info section -->
                                        <div class="customer-info">
                                            <div class="customer-header">
                                                <div class="customer-name">JUAN CARLOS</div>
                                                <div>TEL:957362484</div>
                                            </div>
                                            <div class="customer-address">Av. Primavera 123, Dpto. 402</div>
                                            <div class="customer-address">Frente a Plaza Vea</div>
                                            <div class="customer-address">Surco</div>
                                        </div>

                                        <!-- Payment details section -->
                                        <div class="payment-info">
                                            <div class="payment-row">
                                                <div class="payment-label">Método pago:</div>
                                                <div class="payment-value">Efectivo</div>
                                            </div>
                                            <div class="payment-row">
                                                <div class="payment-label">Vuelto de:</div>
                                                <div class="payment-value">100 soles</div>
                                            </div>
                                            <div class="payment-row">
                                                <div class="payment-label">Comprobante pago:</div>
                                                <div class="payment-value">Sí</div>
                                            </div>
                                            <div class="payment-row">
                                                <div class="payment-label">Tipo:</div>
                                                <div class="payment-value">Boleta</div>
                                            </div>
                                            <div class="payment-row">
                                                <div class="payment-label">Nº documento:</div>
                                                <div class="payment-value">10456789011</div>
                                            </div>
                                        </div>

                                        <!-- Customer comment section -->
                                        <div class="customer-info">
                                            <div style="margin-bottom: 5px;">Comentario cliente</div>
                                            <div style="height: 50px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Asignaciones -->
                    <div class="col-lg-6">
                        <div class="section-header">2 POR ASIGNAR</div>

                        <div id="orders-assigned">
                            <div id="unassigned-orders" class="drag-area mb-4">
                                <!-- Draggable order card -->
                                <div class="card-container draggable mb-3">
                                   <div
                                        style="padding: 10px; background-color: #f5f5f5; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; align-items: center;">
                                        <div style="font-weight: bold; font-size: 16px;">PEDIDO #003 - 15 Junio 2025
                                        </div>
                                        <div>
                                            <span style="margin-right: 15px;">Hora pedido: <strong>15 Junio 12:15
                                                    PM</strong></span>
                                            <span style="color: #ff6f00;"><strong> 1:00
                                                    PM</strong></span>
                                        </div>
                                    </div>

                                    <div style="display: flex;">
                                        <!-- Left column - Order summary -->
                                        <div style="width: 50%; padding: 15px; border-right: 1px solid #dee2e6;">
                                            <div style="text-align: right; margin-bottom: 20px;">
                                                <div style="font-size: 16px; margin-bottom: 10px;">
                                                    <strong>Diego:</strong> s/ 21.00
                                                </div>
                                                <div style="font-size: 16px; margin-bottom: 15px;">
                                                    <strong>Lucía:</strong> s/ 34.00
                                                </div>
                                            </div>

                                            <div
                                                style="border: 1px s olid #dee2e6; padding: 10px; text-align: center; margin-bottom: 20px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                                    <div>Delivery:</div>
                                                    <div>s/1.00</div>
                                                </div>
                                                <div
                                                    style="display: flex; justify-content: space-between; font-weight: bold; font-size: 18px;">
                                                    <div>TOTAL:</div>
                                                    <div>s/56.00</div>
                                                </div>
                                            </div>

                                            <div>
                                                <button class="btn btn-dark"
                                                    style="width: 180px; font-weight: bold; padding: 8px 0; font-size: 16px;">Imprimir</button>
                                            </div>
                                           
                                        </div>

                                        <!-- Right column - Customer info -->
                                        <div style="width: 50%; padding: 15px;">
                                            <!-- Customer contact info section -->
                                            <div style="border: 1px solid #dee2e6; padding: 15px; margin-bottom: 15px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                                    <div style="font-weight: bold; font-size: 16px;">JUAN CARLOS</div>
                                                    <div>TEL:957362484</div>
                                                </div>
                                                <div style="margin-bottom: 5px;">Av. Primavera 123, Dpto. 402</div>
                                                <div style="margin-bottom: 5px;">Frente a Plaza Vea</div>
                                                <div>Surco</div>
                                            </div>

                                            <!-- Payment details section - simplified -->
                                            <div style="border: 1px solid #dee2e6; padding: 15px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                                    <div>Método pago:</div>
                                                    <div style="font-weight: bold;">Efectivo</div>
                                                </div>
                                                <div style="display: flex; justify-content: space-between;">
                                                    <div>Vuelto de:</div>
                                                    <div style="font-weight: bold;">100 soles</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Moto 1 -->
                            <div class="moto-section">MOTO 1 (JUAN)</div>
                            <div id="moto1-container" class="drag-area mb-4">
                                <div class="card-container draggable">
                                    <div
                                        style="padding: 10px; background-color: #f5f5f5; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; align-items: center;">
                                        <div style="font-weight: bold; font-size: 16px;">PEDIDO #003 - 15 Junio 2025
                                        </div>
                                        <div>
                                            <span style="margin-right: 15px;">Hora pedido: <strong>15 Junio 12:15
                                                    PM</strong></span>
                                            <span style="color: #ff6f00;"><strong> 1:00
                                                    PM</strong></span>
                                        </div>
                                    </div>

                                    <div style="display: flex;">
                                        <!-- Left column - Order summary -->
                                        <div style="width: 50%; padding: 15px; border-right: 1px solid #dee2e6;">
                                            <div style="text-align: right; margin-bottom: 20px;">
                                                <div style="font-size: 16px; margin-bottom: 10px;">
                                                    <strong>Diego:</strong> s/ 21.00
                                                </div>
                                                <div style="font-size: 16px; margin-bottom: 15px;">
                                                    <strong>Lucía:</strong> s/ 34.00
                                                </div>
                                            </div>

                                            <div
                                                style="border: 1px s olid #dee2e6; padding: 10px; text-align: center; margin-bottom: 20px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                                    <div>Delivery:</div>
                                                    <div>s/1.00</div>
                                                </div>
                                                <div
                                                    style="display: flex; justify-content: space-between; font-weight: bold; font-size: 18px;">
                                                    <div>TOTAL:</div>
                                                    <div>s/56.00</div>
                                                </div>
                                            </div>

                                            <div>
                                                <button class="btn btn-dark"
                                                    style="width: 180px; font-weight: bold; padding: 8px 0; font-size: 16px;">Imprimir</button>
                                            </div>
                                            <!-- Status indicator -->
                                            <div style="position: absolute; bottom: 0; left: 0; margin-top: 10px;">
                                                <div
                                                    style="width: 30px; height: 30px; border-radius: 50%; background-color: #ff8c00; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                                    2
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right column - Customer info -->
                                        <div style="width: 50%; padding: 15px;">
                                            <!-- Customer contact info section -->
                                            <div style="border: 1px solid #dee2e6; padding: 15px; margin-bottom: 15px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                                    <div style="font-weight: bold; font-size: 16px;">JUAN CARLOS</div>
                                                    <div>TEL:957362484</div>
                                                </div>
                                                <div style="margin-bottom: 5px;">Av. Primavera 123, Dpto. 402</div>
                                                <div style="margin-bottom: 5px;">Frente a Plaza Vea</div>
                                                <div>Surco</div>
                                            </div>

                                            <!-- Payment details section - simplified -->
                                            <div style="border: 1px solid #dee2e6; padding: 15px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                                    <div>Método pago:</div>
                                                    <div style="font-weight: bold;">Efectivo</div>
                                                </div>
                                                <div style="display: flex; justify-content: space-between;">
                                                    <div>Vuelto de:</div>
                                                    <div style="font-weight: bold;">100 soles</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Moto 2 -->
                            <div class="moto-header">MOTO 2 (JUAN)</div>
                            <div id="moto2-container" class="drag-container">
                                <div class="order-card draggable">
                                    <div
                                        style="padding: 10px; background-color: #f5f5f5; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; align-items: center;">
                                        <div style="font-weight: bold; font-size: 16px;">PEDIDO #003 - 15 Junio 2025
                                        </div>
                                        <div>
                                            <span style="margin-right: 15px;">Hora pedido: <strong>15 Junio 12:15
                                                    PM</strong></span>
                                            <span style="color: #ff6f00;"><strong> 1:00
                                                    PM</strong></span>
                                        </div>
                                    </div>

                                    <div style="display: flex;">
                                        <!-- Left column - Order summary -->
                                        <div style="width: 50%; padding: 15px; border-right: 1px solid #dee2e6;">
                                            <div style="text-align: right; margin-bottom: 20px;">
                                                <div style="font-size: 16px; margin-bottom: 10px;">
                                                    <strong>Diego:</strong> s/ 21.00
                                                </div>
                                                <div style="font-size: 16px; margin-bottom: 15px;">
                                                    <strong>Lucía:</strong> s/ 34.00
                                                </div>
                                            </div>

                                            <div
                                                style="border: 1px s olid #dee2e6; padding: 10px; text-align: center; margin-bottom: 20px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                                    <div>Delivery:</div>
                                                    <div>s/1.00</div>
                                                </div>
                                                <div
                                                    style="display: flex; justify-content: space-between; font-weight: bold; font-size: 18px;">
                                                    <div>TOTAL:</div>
                                                    <div>s/56.00</div>
                                                </div>
                                            </div>

                                            <div>
                                                <button class="btn btn-dark"
                                                    style="width: 180px; font-weight: bold; padding: 8px 0; font-size: 16px;">Imprimir</button>
                                            </div>
                                            <!-- Status indicator -->
                                            <div style="position: absolute; bottom: 0; left: 0; margin-top: 10px;">
                                                <div
                                                    style="width: 30px; height: 30px; border-radius: 50%; background-color: #ff8c00; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                                    2
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right column - Customer info -->
                                        <div style="width: 50%; padding: 15px;">
                                            <!-- Customer contact info section -->
                                            <div style="border: 1px solid #dee2e6; padding: 15px; margin-bottom: 15px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                                    <div style="font-weight: bold; font-size: 16px;">JUAN CARLOS</div>
                                                    <div>TEL:957362484</div>
                                                </div>
                                                <div style="margin-bottom: 5px;">Av. Primavera 123, Dpto. 402</div>
                                                <div style="margin-bottom: 5px;">Frente a Plaza Vea</div>
                                                <div>Surco</div>
                                            </div>

                                            <!-- Payment details section - simplified -->
                                            <div style="border: 1px solid #dee2e6; padding: 15px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                                    <div>Método pago:</div>
                                                    <div style="font-weight: bold;">Efectivo</div>
                                                </div>
                                                <div style="display: flex; justify-content: space-between;">
                                                    <div>Vuelto de:</div>
                                                    <div style="font-weight: bold;">100 soles</div>
                                                </div>
                                            </div>
                                        </div>
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

        initCalendar();
    });

    function initCalendar() {
        const today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();
        let currentDayIndex = today.getDate() - 1; // Start at today

        renderCalendar(currentMonth, currentYear, currentDayIndex);

        document.getElementById('prevMonth').addEventListener('click', function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            currentDayIndex = 0; // Reset to start of month
            renderCalendar(currentMonth, currentYear, currentDayIndex);
        });

        document.getElementById('nextMonth').addEventListener('click', function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            currentDayIndex = 0; // Reset to start of month
            renderCalendar(currentMonth, currentYear, currentDayIndex);
        });

        document.getElementById('prevDays').addEventListener('click', function() {
            currentDayIndex = Math.max(0, currentDayIndex - 7);
            renderCalendar(currentMonth, currentYear, currentDayIndex);
        });

        document.getElementById('nextDays').addEventListener('click', function() {
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            currentDayIndex = Math.min(currentDayIndex + 7, daysInMonth - 7);
            renderCalendar(currentMonth, currentYear, currentDayIndex);
        });
    }

    function renderCalendar(month, year, startDayIndex) {
        const monthNames = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE',
            'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
        ];
        const dayNames = ['LU', 'MA', 'MI', 'JU', 'VI', 'SA', 'DO'];

        document.getElementById('currentMonth').innerText = `${monthNames[month]} ${year}`;

        const calendarDays = document.getElementById('calendarDays');
        calendarDays.innerHTML = '';

        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();

        // Show 7 days at a time, starting from startDayIndex
        const endDayIndex = Math.min(startDayIndex + 7, daysInMonth);

        // Get the day of the week for the first visible day
        let firstDayDate = new Date(year, month, startDayIndex + 1);

        // Display 7 days, or fewer if we're at the end of the month
        for (let i = startDayIndex; i < endDayIndex; i++) {
            let date = new Date(year, month, i + 1);
            let dayOfWeek = date.getDay();
            dayOfWeek = dayOfWeek === 0 ? 6 : dayOfWeek - 1; // Convert to 0 = Monday

            const dayItem = document.createElement('div');
            dayItem.className = 'day-item';

            // Add day name (Mon, Tue, etc)
            const dayNameElem = document.createElement('div');
            dayNameElem.className = 'day-name';
            dayNameElem.innerText = dayNames[dayOfWeek];
            dayItem.appendChild(dayNameElem);

            // Add day number
            const day = document.createElement('div');
            day.className = 'day';
            day.innerText = i + 1;

            // Check if this day is today
            if (today.getDate() === (i + 1) && today.getMonth() === month && today.getFullYear() === year) {
                day.classList.add('current');
            }

            day.addEventListener('click', function() {
                const selectedDays = document.querySelectorAll('.day.selected');
                selectedDays.forEach(d => d.classList.remove('selected'));
                this.classList.add('selected');
            });

            dayItem.appendChild(day);
            calendarDays.appendChild(dayItem);
        }
    }
    </script>
</body>

</html>