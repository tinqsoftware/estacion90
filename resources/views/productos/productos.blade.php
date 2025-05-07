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
    <link href="access/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="access/vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet">
    <link href="access/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="access/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <!-- Form step -->
    <link href="access/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css" rel="stylesheet">

    <!-- Style css -->
    <link href="access/vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet">

    <!-- Global Stylesheet -->
    <link href="access/css/style.css" rel="stylesheet">

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
                    <img src="access/images/logo_white.png" style="height: 50px;" alt="" />
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
                            <li><a href="restro-setting.html">Productos</a></li>
                            <li><a href="restro-setting.html">Menu Semanal</a></li>

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

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" id="alertSuccess">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <strong>¡Éxito!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <script>
                setTimeout(function() {
                    $("#alertSuccess").fadeOut("slow");
                }, 3000);
                </script>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" id="alertError">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                        </polygon>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <strong>¡Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <script>
                setTimeout(function() {
                    $("#alertError").fadeOut("slow");
                }, 3000);
                </script>
                @endif
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Productos por Categoría</h4>
                            </div>
                            <div class="card-body">
                                <!-- Tab panel dinámico -->
                                <div class="default-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach($categorias as $key => $categoria)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $key === 0 ? 'active' : '' }}" data-bs-toggle="tab"
                                                href="#categoria-{{ $categoria->id }}">
                                                {{ $categoria->nombre }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content">
                                        @foreach($categorias as $key => $categoria)
                                        <div class="tab-pane fade {{ $key === 0 ? 'show active' : '' }}"
                                            id="categoria-{{ $categoria->id }}" role="tabpanel">
                                            <div class="pt-4">
                                                <h4>{{ $categoria->nombre }}</h4>
                                                <p>{{ $categoria->descripcion }}</p>

                                                <!-- Tabla de productos para esta categoría -->
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-md table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th><strong>Fecha de Actualización</strong></th>
                                                                <th><strong>Usuario</strong></th>
                                                                <th><strong>Foto</strong></th>
                                                                <th><strong>Nombre</strong></th>
                                                                <th><strong>Descripción</strong></th>
                                                                <th><strong>Precio</strong></th>
                                                                <th><strong>Stock</strong></th>
                                                                <th><strong>Opciones</strong></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($categoria->productos) &&
                                                            $categoria->productos->count() > 0)
                                                            @foreach($categoria->productos as $producto)
                                                            <tr>
                                                                <td>{{ $producto->updated_at ? $producto->updated_at->format('d/m/Y H:i') : 'N/A' }}
                                                                </td>
                                                                <td>{{ $producto->creador ? $producto->creador->name : 'SIN REGISTRO' }}
                                                                </td>
                                                                <td>
                                                                    <img src="{{ $producto->imagen ?? 'access/images/product/1.jpg' }}"
                                                                        class="rounded" width="50"
                                                                        alt="{{ $producto->nombre }}">
                                                                </td>
                                                                <td>{{ $producto->nombre }}</td>
                                                                <td>{{ \Illuminate\Support\Str::limit($producto->descripcion, 50) }}
                                                                </td>
                                                                <td>S/. {{ number_format($producto->precio, 2) }}</td>
                                                                <td>{{ $producto->stock }}</td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <a href="#"
                                                                            class="btn btn-primary shadow btn-xs sharp me-1 btn-ver-detalle"
                                                                            data-id="{{ $producto->id }}"
                                                                            title="Ver detalles">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                        <a href="#"
                                                                            class="btn btn-info shadow btn-xs sharp me-1 btn-editar"
                                                                            data-id="{{ $producto->id }}"
                                                                            title="Editar">
                                                                            <i class="fas fa-pencil-alt"></i>
                                                                        </a>
                                                                        <a href="#"
                                                                            class="btn btn-danger shadow btn-xs sharp btn-eliminar"
                                                                            data-id="{{ $producto->id }}"
                                                                            title="Eliminar">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            <tr>
                                                                <td colspan="8" class="text-center">No hay productos
                                                                    disponibles en esta categoría</td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-start">
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                                    data-bs-target="#agregarProductoModal">
                                    <i class="fas fa-plus-circle me-2"></i>AGREGAR PRODUCTO
                                </button>
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

    <!-- Modal Ver Detalle Producto -->
    <div class="modal fade" id="verProductoModal" tabindex="-1" aria-labelledby="verProductoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center w-100" id="verProductoModalLabel">Detalle del Producto</h5>
                    <a href="#" class="btn btn-info shadow btn-xs sharp me-1 btn-editar" data-id="{{ $producto->id }}"
                        title="Editar">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 id="modal-producto-nombre" class="mb-3"></h4>
                            <div class="mb-4 d-flex justify-content-center">
                                <div style="width: 250px; height: 250px; overflow: hidden;">
                                    <img id="modal-producto-imagen" src="" class="img-fluid rounded"
                                        alt="Imagen del producto" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </div>
                            <p id="modal-producto-descripcion" class="mb-3"></p>
                            <h5 class="text-primary">S/. <span id="modal-producto-precio"></span></h5>
                            <p>Stock disponible: <span id="modal-producto-stock" class="badge bg-success"></span></p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <small class="text-muted" id="modal-producto-fecha"></small>
                            <small class="text-muted" id="modal-producto-usuario"></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar/Editar Producto -->
    <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarProductoModalLabel">Agregar Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="productoForm" action="{{ route('productos.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" id="form-method" value="POST">
                    <input type="hidden" name="producto_id" id="producto_id" value="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Categoría</label>
                                <select class="form-select" name="categoria_id" id="categoria_id" required>
                                    <option value="" selected disabled>Seleccione una categoría</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Precio</label>
                                <input type="number" step="0.01" class="form-control" name="precio" id="precio"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" id="stock" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Imagen</label>
                                <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*">

                                <!-- Previsualización de imagen -->
                                <div class="mt-3 d-flex justify-content-center">
                                    <div id="imagen-preview-container"
                                        style="width: 200px; height: 200px; overflow: hidden; display: none; border: 1px solid #ddd; border-radius: 4px;">
                                        <img id="imagen-preview" src="" alt="Previsualización"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btn-guardar">Guardar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <!-- Required vendors -->
    <script src="access/vendor/global/global.min.js"></script>
    <script src="access/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="access/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="access/vendor/swiper/js/swiper-bundle.min.js"></script>

    <!-- Dashboard -->
    <script src="access/js/dlabnav-init.js"></script>
    <script src="access/js/custom.js"></script>
    <script src="access/js/demo.js"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>


    <script>
    // Cargar detalles de producto en el modal
    function verProductoDetalle(productoId) {
        $.ajax({
            url: `/productos/${productoId}`,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Nombre del producto
                $('#modal-producto-nombre').text(response.nombre || 'SIN REGISTRO');

                // Descripción del producto
                $('#modal-producto-descripcion').text(response.descripcion || 'SIN REGISTRO');

                // Precio y stock
                $('#modal-producto-precio').text(parseFloat(response.precio).toFixed(2));
                $('#modal-producto-stock').text(response.stock);

                // Imagen del producto
                if (response.imagen) {
                    $('#modal-producto-imagen').attr('src', `/storage/${response.imagen}`);
                } else {
                    $('#modal-producto-imagen').attr('src', 'access/images/product/1.jpg');
                }

                // Usuario que registró
                if (response.creador && response.creador.name) {
                    $('#modal-producto-usuario').text(`Registrado por: ${response.creador.name}`);
                } else {
                    $('#modal-producto-usuario').text('Registrado por: SIN REGISTRO');
                }

                // Formatear fecha al estilo "6 Mayo 2025"
                if (response.updated_at_formatted) {
                    const fechaParts = response.updated_at_formatted.split(' ')[0].split('/');
                    const day = parseInt(fechaParts[0], 10);
                    const month = parseInt(fechaParts[1], 10);
                    const year = fechaParts[2];

                    const meses = [
                        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ];

                    const fechaFormateada = `${day} ${meses[month-1]} ${year}`;
                    $('#modal-producto-fecha').text(fechaFormateada);
                } else {
                    $('#modal-producto-fecha').text('Fecha desconocida');
                }

                $('#verProductoModal').modal('show');
            },
            error: function() {
                alert('Error al cargar los datos del producto');
            }
        });
    }

    // Asignar evento a los botones de ver detalle
    $(document).ready(function() {
        // Modificar el evento de clic para los botones de ver detalle
        $(document).on('click', '.btn-ver-detalle', function() {
            const productoId = $(this).data('id');
            verProductoDetalle(productoId);
        });
    });



    function editarProducto(productoId) {
        // Cambiar título del modal
        $('#agregarProductoModalLabel').text('Editar Producto');

        // Cambiar método del formulario
        $('#form-method').val('PUT');

        // Cambiar acción del formulario
        $('#productoForm').attr('action', `/productos/${productoId}`);

        // Establecer ID del producto
        $('#producto_id').val(productoId);

        // Cargar datos del producto
        $.ajax({
            url: `/productos/${productoId}`,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Llenar el formulario con los datos existentes
                $('#nombre').val(response.nombre || '');
                $('#descripcion').val(response.descripcion || '');
                $('#precio').val(parseFloat(response.precio).toFixed(2));
                $('#stock').val(response.stock);
                $('#categoria_id').val(response.id_categoria);

                // Mostrar la imagen actual si existe
                if (response.imagen) {
                    $('#imagen-preview-container').show();
                    $('#imagen-preview').attr('src', `/storage/${response.imagen}`);
                } else {
                    $('#imagen-preview-container').hide();
                }

                // Abrir el modal
                $('#agregarProductoModal').modal('show');
            },
            error: function() {
                alert('Error al cargar los datos del producto para edición');
            }
        });
    }

    // Previsualización de imagen
    $('#imagen').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagen-preview').attr('src', e.target.result);
                $('#imagen-preview-container').show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#imagen-preview-container').hide();
        }
    });

    // Reset del modal cuando se cierra
    $('#agregarProductoModal').on('hidden.bs.modal', function() {
        $('#agregarProductoModalLabel').text('Agregar Nuevo Producto');
        $('#form-method').val('POST');
        $('#productoForm').attr('action', '{{ route("productos.store") }}');
        $('#producto_id').val('');
        $('#productoForm').trigger('reset');
        $('#imagen-preview-container').hide();
    });

    // Asignar evento a los botones de editar
    $(document).on('click', '.btn-editar', function() {
        const productoId = $(this).data('id');
        editarProducto(productoId);
    });

    // Evento para abrir el modal de nuevo producto
    $(document).on('click', '[data-bs-target="#agregarProductoModal"]', function() {
        // Asegurarse de que el modal esté en modo "Agregar"
        $('#agregarProductoModalLabel').text('Agregar Nuevo Producto');
        $('#form-method').val('POST');
        $('#productoForm').attr('action', '{{ route("productos.store") }}');
        $('#producto_id').val('');
        $('#productoForm').trigger('reset');
        $('#imagen-preview-container').hide();
    });

    $(document).on('click', '.btn-eliminar', function(e) {
        e.preventDefault();
        const productoId = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Crear formulario y enviar
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/productos/${productoId}`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
    </script>

</body>