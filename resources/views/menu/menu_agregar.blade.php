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
<link href="{{ asset('access/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
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


        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <div class="logo-abbr" width="39" height="31" viewBox="0 0 39 31" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <img src="{{ asset('access/images/logo_white.png') }}" style="height: 50px;" alt="" />
                </div>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->



        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="container d-block my-0">
                        <div class="d-flex align-items-center justify-content-sm-between justify-content-end">



                            <ul class="navbar-nav header-right ">

                                <li class="nav-item d-flex align-items-center">

                                </li>
                                <li>

                                    <div class="dropdown header-profile2 " @if(Auth::user()) @else style="height:30px;"
                                        @endif>

                                        <a class="nav-link " href="javascript:void(0);" role="button"
                                            data-bs-toggle="dropdown">
                                            <div class="header-info2 d-flex align-items-center">
                                                @if(Auth::user())
                                                <img src="access/images/banner-img/user.png" alt="">
                                                @endif
                                                <div class="d-flex align-items-center sidebar-info">
                                                    <div>
                                                        <h6 class="font-w500 mb-0 ms-2">
                                                            @if(Auth::user())
                                                            {{Auth::user()->name}}
                                                            @else
                                                            Sin usuario
                                                            @endif
                                                        </h6>
                                                    </div>
                                                    <i class="fas fa-chevron-down"></i>
                                                </div>

                                            </div>
                                        </a>
                                        @if(Auth::user())
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="./app-profile.html" class="dropdown-item ai-icon ">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                <span class="ms-2">Perfil</span>
                                            </a>

                                            <a href="./notification.html" class="dropdown-item ai-icon ">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1"
                                                    class="svg-main-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                            fill="var(--primary)" />
                                                        <circle fill="var(--primary)" opacity="0.3" cx="19.5" cy="17.5"
                                                            r="2.5" />
                                                    </g>
                                                </svg>
                                                <span class="ms-2">Notificaciones </span>
                                            </a>

                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                class="dropdown-item ai-icon ms-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                    <polyline points="16 17 21 12 16 7"></polyline>
                                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                                </svg>
                                                <span class="ms-1">Salir </span>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                        @else
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="/login" class="dropdown-item ai-icon ">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                <span class="ms-2">Iniciar sesión</span>
                                            </a>
                                        </div>
                                        @endif

                                    </div>

                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav border-right">
            <div class="dlabnav-scroll">
                <p class="menu-title style-1">Usuario</p>
                <ul class="metismenu" id="menu">
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-grid"></i>
                            <span class="nav-text">Cliente</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/">Inicio</a></li>
                            <li><a href="food-order.html">Mis ordenes</a></li>
                            <li><a href="favorite-menu.html">Mis favoritos</a></li>
                            <!--
							<li><a href="message.html">Message</a></li>	
							<li><a href="order-history.html">Mis favoritos</a></li>	
                            -->
                            <li><a href="bill.html">Historial</a></li>
                            <li><a href="notification.html">Notificaciones</a></li>
                            <li><a href="setting.html">Configuraciones</a></li>
                        </ul>

                    </li>
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">

                            <i class="bi bi-shop-window"></i>
                            <span class="nav-text">Estacion90</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="dashboard.html">Dashboard</a></li>
                            <li><a href="menu.html">Menu</a></li>
                            <li><a href="orders.html">Ordenes</a></li>
                            <li><a href="customer-reviews.html">Comentarios</a></li>
                            <li><a href="restro-setting.html">Configuraciones</a></li>
                            <li><a href="/productos">Productos</a></li>
                            <li><a href="/menuSemal">Menu Semanal</a></li>
                            <li><a href="/usuarios">Usuarios</a></li>

                        </ul>

                    </li>
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-bicycle"></i>

                            <span class="nav-text">Delivery</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="deliver-main.html">Inicio</a></li>
                            <li><a href="deliver-order.html">Ordenes</a></li>
                            <li><a href="feedback.html">Comentario</a></li>
                        </ul>

                    </li>


                </ul>

            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

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