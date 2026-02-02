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

    <style>
    .nombre-producto-header {
        font-size: 16px;
        font-weight: 700;
        color: #2c3e50;
    }

    .nombre-producto-cell {
        font-weight: 800;
        font-size: 15px;
        color: #2c3e50;
    }
    .col-descripcion {
        width: 100%;
        white-space: normal;
    }
    .col-nombre {
        width: 280px;
        max-width: 280px;
        white-space: normal;
    }

    .productos-table {
        table-layout: auto;
        width: 100%;
    }
    .productos-table th,
    .productos-table td {
        white-space: nowrap;
    }
    .productos-table th.col-nombre,
    .productos-table td.col-nombre,
    .productos-table th.col-descripcion,
    .productos-table td.col-descripcion {
        white-space: normal;
    }
    .productos-table th.sortable {
        cursor: pointer;
        user-select: none;
    }
    .productos-table th.sortable::after {
        content: " \2195";
        font-size: 0.85em;
        color: #9aa0a6;
    }
    .productos-table th.sortable.sort-asc::after {
        content: " \2191";
        color: #495057;
    }
    .productos-table th.sortable.sort-desc::after {
        content: " \2193";
        color: #495057;
    }

    .filter-third {
        max-width: 33%;
        min-width: 220px;
    }
    @media (max-width: 768px) {
        .filter-third {
            max-width: 100%;
        }
    }
    .filter-wrap {
        position: relative;
    }
    .search-icon {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #6c757d;
        pointer-events: none;
    }
    .filter-wrap input {
        padding-left: 36px;
    }

    .product-image-wrapper {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        overflow: hidden;
        background: #f7f7f7;
        border: 1px solid #e0e0e0;
    }
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
    }
    .product-image-fallback {
        display: none;
        color: #c0392b;
        font-weight: 700;
        font-size: 18px;
        line-height: 1;
    }
    .product-image-wrapper.is-empty .product-image-fallback {
        display: flex;
    }
    .product-image-wrapper.is-empty .product-image {
        display: none;
    }
    .producto-nombre,
    .producto-desc {
        word-wrap: break-word;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .producto-desc {
        white-space: pre-line;
    }
    #modal-producto-descripcion {
        white-space: pre-line;
    }
    </style>

</head>

<body>
    <div id="main-wrapper" class="dlab-overflow menu-toggle">

        @include('partials.header')
        @include('partials.sidebar')
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
                            <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="card-title mb-0">Productos por Categoría</h4>
    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
        data-bs-target="#agregarProductoModal">
        <i class="fas fa-plus-circle me-2"></i>AGREGAR PRODUCTO
    </button>
</div>
                            <div class="card-body">
                                <!-- Tab panel dinámico -->
                                <div class="default-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <!-- Nuevo tab "Todos" al inicio -->
                                        <li class="nav-item">
                                            <a class="nav-link {{ (!isset($activeTabId) || $activeTabId == 'todos') ? 'active' : '' }}"
                                                data-bs-toggle="tab" href="#todos-productos" data-categoria-id="todos">
                                                Todos
                                            </a>
                                        </li>
                                        @foreach($categorias as $key => $categoria)
                                        <li class="nav-item">
                                            <a class="nav-link {{ (isset($activeTabId) && $activeTabId == $categoria->id) ? 'active' : '' }}"
                                                data-bs-toggle="tab" href="#categoria-{{ $categoria->id }}"
                                                data-categoria-id="{{ $categoria->id }}">
                                                {{ $categoria->nombre }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade {{ (!isset($activeTabId) || $activeTabId == 'todos') ? 'show active' : '' }}"
                                            id="todos-productos" role="tabpanel">
                                            <div class="pt-4">
                                                <!-- Filtro dinámico -->
                                                <div class="mb-3">
                                                    <div class="filter-wrap filter-third">
                                                        <span class="search-icon"><i class="fas fa-search"></i></span>
                                                        <input type="text" class="form-control filtro-tabla"
                                                            id="filtro-todos-productos"
                                                            data-target="#todos-productos tbody tr"
                                                            placeholder="Buscar en esta ficha">
                                                    </div>
                                                </div>

                                                <!-- Tabla de todos los productos -->
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-md table-hover productos-table">
                                                        <thead>
                                                            <tr>
                                                                <th class="sortable" data-sort="date"><strong>Fecha</strong></th>
                                                                <th class="sortable" data-sort="text"><strong>Categoría</strong></th>
                                                                <th><strong>Foto</strong></th>
                                                                <th class="nombre-producto-header col-nombre sortable" data-sort="text">
                                                                    <strong>Nombre</strong></th>
                                                                <th class="col-descripcion sortable" data-sort="text"><strong>Descripción</strong></th>
                                                                <!-- Siempre mostramos el encabezado de precio para el tab "todos" -->
                                                                <th class="sortable" data-sort="price"><strong>Precio</strong></th>
                                                                <th class="sortable" data-sort="text"><strong>Usuario</strong></th>
                                                                <th><strong>Opciones</strong></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($todosProductos) && $todosProductos->count() > 0)
                                                            @foreach($todosProductos as $producto)
                                                            <tr class="fila-producto">
                                                                <td>{{ $producto->updated_at ? $producto->updated_at->format('d/m/Y H:i') : 'N/A' }}
                                                                </td>
                                                                <td>
                                                                    @if($producto->categoria)
                                                                    @php
                                                                    // Create a color map based on category IDs
                                                                    $categoryColors = [
                                                                    1 => 'primary', // Entrada S/15.00
                                                                    2 => 'info', // Entrada S/20.00
                                                                    3 => 'success', // Fondo S/15.00
                                                                    4 => 'warning', // Fondo S/20.00
                                                                    5 => 'danger', // Carta
                                                                    6 => 'secondary', // Extras
                                                                    7 => 'dark', // Combos
                                                                    // Default color for any other categories
                                                                    'default' => 'light'
                                                                    ];

                                                                    // Get color based on category ID or use default
                                                                    $color = $categoryColors[$producto->categoria->id]
                                                                    ?? $categoryColors['default'];
                                                                    @endphp
                                                                    <span
                                                                        class="badge bg-{{ $color }} px-2 py-1">{{ $producto->categoria->nombre }}</span>
                                                                    @else
                                                                    <span class="badge bg-light text-dark px-2 py-1">Sin
                                                                        categoría</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div
                                                                        class="product-image-wrapper {{ $producto->imagen ? '' : 'is-empty' }}">
                                                                        @if($producto->imagen)
                                                                        <img src="{{ $producto->imagen }}"
                                                                            class="product-image"
                                                                            alt="{{ $producto->nombre }}"
                                                                            onerror="this.onerror=null; this.closest('.product-image-wrapper').classList.add('is-empty'); this.style.display='none';">
                                                                        @endif
                                                                        <span class="product-image-fallback">X</span>
                                                                    </div>
                                                                </td>
                                                                <td class="nombre-producto-cell col-nombre">
                                                                    <div class="producto-nombre">
                                                                        {{ $producto->nombre }}
                                                                    </div>
                                                                </td>
                                                                <td class="col-descripcion">
                                                                    <div class="producto-desc">
                                                                        {{ $producto->descripcion }}
                                                                    </div>
                                                                </td>
                                                                <!-- Mostramos precio o guion según la categoría -->
                                                                <td>
                                                                    @if(in_array($producto->id_categoria, [5, 6, 7, 8,
                                                                    9]))
                                                                    S/ {{ number_format($producto->precio, 2) }}
                                                                    @else
                                                                    -
                                                                    @endif
                                                                </td>
                                                                <td>{{ $producto->creador ? $producto->creador->name : '-' }}
                                                                </td>
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
                                                                <td colspan="9" class="text-center">No hay productos
                                                                    disponibles</td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                        @foreach($categorias as $key => $categoria)
                                        <div class="tab-pane fade {{ (isset($activeTabId) && $activeTabId == $categoria->id) || ($activeTabId == 0 && $key === 0) ? 'show active' : '' }}"
                                            id="categoria-{{ $categoria->id }}" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="mb-3">
                                                    <div class="filter-wrap filter-third">
                                                        <span class="search-icon"><i class="fas fa-search"></i></span>
                                                        <input type="text" class="form-control filtro-tabla"
                                                            id="filtro-categoria-{{ $categoria->id }}"
                                                            data-target="#categoria-{{ $categoria->id }} tbody tr.fila-producto"
                                                            placeholder="Buscar en esta ficha">
                                                    </div>
                                                </div>
                                                <!-- Tabla de productos para esta categoría -->
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-md table-hover productos-table">
                                                        <thead>
                                                            <tr>
                                                                <th class="sortable" data-sort="date"><strong>Fecha</strong></th>
                                                                <th><strong>Foto</strong></th>
                                                                <th class="nombre-producto-header col-nombre sortable" data-sort="text">
                                                                    <strong>Nombre</strong>
                                                                </th>
                                                                <th class="col-descripcion sortable" data-sort="text"><strong>Descripción</strong></th>
                                                                <!-- Mostrar precio solo para categorías específicas -->
                                                                @if(in_array($categoria->id, [1, 2, 3, 4, 5, 6, 7, 8, 9]))
                                                                <th class="sortable" data-sort="price"><strong>Precio</strong></th>
                                                                @endif
                                                                <th class="sortable" data-sort="text"><strong>Usuario</strong></th>
                                                                <th><strong>Opciones</strong></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if(isset($categoria->productosListado) &&
                                                            $categoria->productosListado->count() > 0)
                                                            @foreach($categoria->productosListado as $producto)
                                                            <tr class="fila-producto">
                                                                <td>{{ $producto->updated_at ? $producto->updated_at->format('d/m/Y H:i') : 'N/A' }}
                                                                </td>
                                                                <td>
                                                                    <div
                                                                        class="product-image-wrapper {{ $producto->imagen ? '' : 'is-empty' }}">
                                                                        @if($producto->imagen)
                                                                        <img src="{{ $producto->imagen }}"
                                                                            class="product-image"
                                                                            alt="{{ $producto->nombre }}"
                                                                            onerror="this.onerror=null; this.closest('.product-image-wrapper').classList.add('is-empty'); this.style.display='none';">
                                                                        @endif
                                                                        <span class="product-image-fallback">X</span>
                                                                    </div>
                                                                </td>
                                                                <td class="nombre-producto-cell col-nombre">
                                                                    <div class="producto-nombre">
                                                                        {{ $producto->nombre }}
                                                                    </div>
                                                                </td>
                                                                <td class="col-descripcion">
                                                                    <div class="producto-desc">
                                                                        {{ $producto->descripcion }}
                                                                    </div>
                                                                </td>
                                                                <!-- Mostrar precio solo para categorías específicas -->
                                                                @if(in_array($categoria->id, [1, 2, 3, 4, 5, 6, 7, 8, 9]))
                                                                <td>S/ {{ number_format($producto->precio, 2) }}</td>
                                                                @endif
                                                                <td>{{ $producto->creador ? $producto->creador->name : '-' }}
                                                                </td>
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
                    <a href="#" class="btn btn-info shadow btn-xs sharp me-1 btn-editar-modal" title="Editar">
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
                            <!-- El precio solo se mostrará para categorías específicas -->
                            <div id="precio-container" style="display: none;">
                                <h5 class="text-primary">S/ <span id="modal-producto-precio"></span></h5>
                            </div>
                           
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
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3" id="precio-container">
                                <label class="form-label">Precio</label>
                                <input type="number" step="0.01" class="form-control" name="precio" id="precio"
                                    required>
                            </div>
                            <input type="hidden" name="stock" id="stock" value="">
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
    <script src="https://unpkg.com/heic2any@0.0.4/dist/heic2any.min.js"></script>

    <script>
    // Cargar detalles de producto en el modal
    function verProductoDetalle(productoId) {
    $.ajax({
        url: `/productos/${productoId}`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Nombre del producto
            $('#verProductoModal').data('producto-id', productoId);
            $('#modal-producto-nombre').text(response.nombre || 'SIN REGISTRO');

            // Descripción del producto
            $('#modal-producto-descripcion').text(response.descripcion || 'SIN REGISTRO');

            // Precio - Mostrar solo para categorías específicas
            if ([5, 6, 7, 8, 9].includes(response.id_categoria)) {
                $('#precio-container').show();
                $('#modal-producto-precio').text(parseFloat(response.precio).toFixed(2));
            } else {
                $('#precio-container').hide();
            }

            // Se eliminó la asignación del stock

            // Imagen del producto
            if (response.imagen) {
                $('#modal-producto-imagen').attr('src', response.imagen);
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

            const modalEl = document.getElementById('verProductoModal');
            if (modalEl && typeof bootstrap !== 'undefined' && typeof bootstrap.Modal === 'function') {
                const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.show();
            } else {
                $('#verProductoModal').modal('show');
            }
        },
        error: function() {
            alert('Error al cargar los datos del producto');
        }
    });
}

    function initTabFilters() {
        $(".filtro-tabla").each(function() {
            const $input = $(this);
            const targetSelector = $input.data("target");
            if (!targetSelector) {
                return;
            }
            $input.on("input", function() {
                const term = $input.val().toLowerCase().trim();
                $(targetSelector).each(function() {
                    const text = $(this).text().toLowerCase();
                    $(this).toggle(text.indexOf(term) !== -1);
                });
            });
        });
    }

    function initTableSorting() {
        function parseDate(value) {
            if (!value || value === 'N/A') return 0;
            const parts = value.trim().split(' ');
            const dateParts = (parts[0] || '').split('/');
            if (dateParts.length !== 3) return 0;
            const day = parseInt(dateParts[0], 10);
            const month = parseInt(dateParts[1], 10) - 1;
            const year = parseInt(dateParts[2], 10);
            let hours = 0;
            let minutes = 0;
            if (parts[1]) {
                const timeParts = parts[1].split(':');
                hours = parseInt(timeParts[0] || '0', 10);
                minutes = parseInt(timeParts[1] || '0', 10);
            }
            return new Date(year, month, day, hours, minutes).getTime() || 0;
        }

        function parsePrice(value) {
            if (!value) return 0;
            const num = value.replace(/[^0-9.]/g, '');
            return parseFloat(num) || 0;
        }

        $(".productos-table").each(function() {
            const $table = $(this);
            $table.find("th.sortable").each(function() {
                const $th = $(this);
                $th.off("click").on("click", function() {
                    const sortType = $th.data("sort") || "text";
                    const colIndex = $th.index();
                    const $tbody = $table.find("tbody");
                    const $rows = $tbody.find("tr.fila-producto");
                    if ($rows.length === 0) return;

                    const currentDir = $th.data("sortDir") || "asc";
                    const nextDir = currentDir === "asc" ? "desc" : "asc";

                    $table.find("th.sortable").removeClass("sort-asc sort-desc").removeData("sortDir");
                    $th.data("sortDir", nextDir).addClass(nextDir === "asc" ? "sort-asc" : "sort-desc");

                    const rowsArray = $rows.get();
                    rowsArray.sort(function(a, b) {
                        const aText = $(a).children("td").eq(colIndex).text().trim();
                        const bText = $(b).children("td").eq(colIndex).text().trim();

                        let aVal = aText;
                        let bVal = bText;

                        if (sortType === "date") {
                            aVal = parseDate(aText);
                            bVal = parseDate(bText);
                        } else if (sortType === "price") {
                            aVal = parsePrice(aText);
                            bVal = parsePrice(bText);
                        } else {
                            aVal = aText.toLowerCase();
                            bVal = bText.toLowerCase();
                        }

                        if (aVal < bVal) return nextDir === "asc" ? -1 : 1;
                        if (aVal > bVal) return nextDir === "asc" ? 1 : -1;
                        return 0;
                    });

                    $tbody.append(rowsArray);
                });
            });
        });
    }

   	// Asignar evento a los botones de ver detalle
    $(document).ready(function() {
        const $todosFilter = $("#filtro-todos-productos");

        function refreshSearchParam() {
            const urlParams = new URLSearchParams(window.location.search);
            const searchParam = urlParams.get('search');
            if (searchParam) {
                $todosFilter.val(searchParam);
                $todosFilter.trigger('input');
            }
        }

        initTabFilters();
        initTableSorting();
        refreshSearchParam();

        $('#agregarProductoModal').on('shown.bs.modal', function() {
            handleCategoryChange();
        });

        $('#categoria_id').on('change', handleCategoryChange);

        $(document).on('click', '.btn-editar', function() {
            setTimeout(handleCategoryChange, 300);
        });

        $(document).on('click', '.btn-ver-detalle', function() {
            const productoId = $(this).data('id');
            verProductoDetalle(productoId);
        });

        $('.nav-tabs a').on('shown.bs.tab', function(e) {
            const categoriaId = $(this).data('categoria-id');
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('tab_id', categoriaId);
            window.history.replaceState({}, '', currentUrl.toString());
        });

        const tabParams = new URLSearchParams(window.location.search);
        const tabId = tabParams.get('tab_id');
        if (tabId) {
            $('.nav-tabs a[data-categoria-id="' + tabId + '"]').tab('show');
        }
    });

    $(document).on('click', '.btn-editar-modal', function() {
        // Obtener el ID del producto actual del modal
        const productoId = $('#verProductoModal').data('producto-id');
        // Cerrar el modal de detalles
        $('#verProductoModal').modal('hide');
        // Abrir modal de edición
        editarProducto(productoId);
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
                    $('#imagen-preview').attr('src', response.imagen);
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

    let imageProcessing = false;
    const $saveBtn = $('#btn-guardar');

    function setImageProcessing(state) {
        imageProcessing = state;
        $saveBtn.prop('disabled', state);
        if (state) {
            $saveBtn.data('original-text', $saveBtn.text());
            $saveBtn.text('Procesando imagen...');
        } else {
            $saveBtn.text($saveBtn.data('original-text') || 'Guardar Producto');
        }
    }

    async function blobFromFile(file) {
        const isHeic = file.name.toLowerCase().endsWith('.heic') || file.type === 'image/heic' || file.type === 'image/heif';
        if (!isHeic) return file;
        const conversionResult = await heic2any({
            blob: file,
            toType: 'image/jpeg',
            quality: 0.8
        });
        return conversionResult;
    }

    async function compressImage(blob, fileName) {
        const maxSize = 900;
        const img = await new Promise((resolve, reject) => {
            const image = new Image();
            image.onload = () => resolve(image);
            image.onerror = reject;
            image.src = URL.createObjectURL(blob);
        });

        let { width, height } = img;
        const ratio = Math.min(maxSize / width, maxSize / height, 1);
        const targetW = Math.round(width * ratio);
        const targetH = Math.round(height * ratio);

        const canvas = document.createElement('canvas');
        canvas.width = targetW;
        canvas.height = targetH;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0, targetW, targetH);

        const isPng = fileName.toLowerCase().endsWith('.png');
        const outputType = isPng ? 'image/png' : 'image/jpeg';
        const quality = isPng ? undefined : 0.7;

        const outBlob = await new Promise((resolve) => {
            canvas.toBlob(resolve, outputType, quality);
        });

        return { blob: outBlob, type: outputType };
    }

    // Previsualización + conversión/compresión en frontend
    $('#imagen').change(async function() {
        const file = this.files[0];
        if (!file) {
            $('#imagen-preview-container').hide();
            setImageProcessing(false);
            return;
        }

        try {
            setImageProcessing(true);
            $('#imagen-preview-container').show();
            $('#imagen-preview').attr('src', 'access/images/loadings.gif');

            const sourceBlob = await blobFromFile(file);
            const { blob: compressedBlob, type } = await compressImage(sourceBlob, file.name);

            const ext = type === 'image/png' ? 'png' : 'jpg';
            const newName = file.name.replace(/\.[^/.]+$/, '') + `.${ext}`;
            const compressedFile = new File([compressedBlob], newName, { type });

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(compressedFile);
            document.getElementById('imagen').files = dataTransfer.files;

            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagen-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(compressedFile);
        } catch (error) {
            console.error('Error procesando imagen:', error);
            $('#imagen-preview').attr('src', 'access/images/image-not-supported.jpg');
            document.getElementById('imagen').value = '';
        } finally {
            setImageProcessing(false);
        }
    });

    $('#productoForm').on('submit', function(e) {
        if (imageProcessing) {
            e.preventDefault();
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
