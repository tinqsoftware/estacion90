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

    <!-- Mobile Specific 
	<meta name="viewport" content="width=device-width, initial-scale=1">-->
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
                <!-- Diálogo de confirmación (inicialmente oculto) -->
                <div id="confirmDialog" class="confirmation-dialog">
                    <div class="confirmation-content">
                        <p>Estas seguro</p>
                        <div class="confirmation-buttons">
                            <button id="btnEliminar" class="btn-eliminar">Eliminar</button>
                            <button id="btnCancelar" class="btn-cancelar">Cancelar</button>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <!-- Contenido principal -->
                    <div class="col-12">
                        <h2 class="mb-4">Lunes 5 MAYO</h2>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Entrada S/15.00</th>
                                        <th>Entrada S/20.00</th>
                                        <th>Fondo S/15.00</th>
                                        <th>Fondo S/20.00</th>
                                        <th>Extras</th>
                                        <th>Combos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="menu-item">
                                                <button class="delete-btn"></button>
                                                <span>20 - Pollo a la braza</span>
                                            </div>
                                        </td>
                                        <td>20 - Pollo a la braza</td>
                                        <td>20 - Pollo a la braza</td>
                                        <td>20 - Pollo a la braza</td>
                                        <td>20 – Chupete Fresa (S/5)</td>
                                        <td>20 – Combo 1 (S/55)</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="menu-item">
                                                <button class="delete-btn"></button>
                                                <span>30 - Pollo a la braza</span>
                                            </div>
                                        </td>
                                        <td>30 - Pollo a la braza</td>
                                        <td>30 - Pollo a la braza</td>
                                        <td>30 - Pollo a la braza</td>
                                        <td>20 – Chupete Fresa (S/5)</td>
                                        <td>20 – Combo 2 (S/50)</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="menu-item">
                                                <button class="delete-btn"></button>
                                                <span>20 - Pollo a la braza</span>
                                            </div>
                                        </td>
                                        <td>20 - Pollo a la braza</td>
                                        <td>20 - Pollo a la braza</td>
                                        <td>20 - Pollo a la braza</td>
                                        <td>20 – Chupete Fresa (S/5)</td>
                                        <td>20 – Combo 3 (S/25)</td>
                                    </tr>
                                    <tr>
                                        <td>45 - ceviche</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Sección de búsqueda y añadir productos -->
                        <div class="row mt-4">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Buscar producto ▼</button>
                                    <input type="text" class="form-control" placeholder="Stock" aria-label="Stock">
                                </div>
                                <button class="btn btn-secondary w-100">AÑADIR EL MENU</button>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Buscar producto ▼</button>
                                    <input type="text" class="form-control" placeholder="Stock" aria-label="Stock">
                                </div>
                                <button class="btn btn-secondary w-100">AÑADIR EL MENU</button>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Buscar producto ▼</button>
                                    <input type="text" class="form-control" placeholder="Stock" aria-label="Stock">
                                </div>
                                <button class="btn btn-secondary w-100">AÑADIR EL MENU</button>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Buscar producto ▼</button>
                                    <input type="text" class="form-control" placeholder="Stock" aria-label="Stock">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Precio" aria-label="Precio">
                                </div>
                                <button class="btn btn-secondary w-100">AÑADIR EL MENU</button>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Buscar producto ▼</button>
                                    <input type="text" class="form-control" placeholder="Stock" aria-label="Stock">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Precio" aria-label="Precio">
                                </div>
                                <button class="btn btn-secondary w-100">AÑADIR EL MENU</button>
                            </div>
                        </div>

                        <p class="mt-4 text-muted">Cuando añades que no se refrezque la página, que cargue el producto
                            en la tabla, y que aparezca otro grupo de inputs</p>
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
    <!-- At the bottom of the file -->
    <script src="{{ asset('access/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('access/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/swiper/js/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard -->
    <script src="{{ asset('access/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('access/js/custom.js') }}"></script>
    <script src="{{ asset('access/js/demo.js') }}"></script>


</body>