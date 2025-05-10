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
                            <div class="card-header">
                                <h4 class="card-title">Productos por Categoría</h4>
                            </div>
                            <div class="card-body">
                                <!-- Tab panel dinámico -->
                                <div class="default-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach($categorias as $key => $categoria)
                                        <li class="nav-item">
                                            <a class="nav-link {{ (isset($activeTabId) && $activeTabId == $categoria->id) || ($activeTabId == 0 && $key === 0) ? 'active' : '' }}"
                                                data-bs-toggle="tab" href="#categoria-{{ $categoria->id }}"
                                                data-categoria-id="{{ $categoria->id }}">
                                                {{ $categoria->nombre }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content">
                                        @foreach($categorias as $key => $categoria)
                                        <div class="tab-pane fade {{ (isset($activeTabId) && $activeTabId == $categoria->id) || ($activeTabId == 0 && $key === 0) ? 'show active' : '' }}"
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
                                                            @if(isset($categoria->productosPaginados) &&
                                                            $categoria->productosPaginados->count() > 0)
                                                            @foreach($categoria->productosPaginados as $producto)
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
                                                    <!-- Añadir links de paginación -->
                                                    <div class="d-flex justify-content-center mt-4">
                                                        @if(isset($categoria->productosPaginados))
                                                        {{ $categoria->productosPaginados->withPath(request()->url())->appends(['tab_id' => $categoria->id])->links() }}
                                                        @endif
                                                    </div>
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
                                <textarea class="form-control" name="descripcion" id="descripcion" rows="3"
                                    required></textarea>
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
                $('#verProductoModal').data('producto-id', productoId);
                $('#modal-producto-nombre').text(response.nombre || 'SIN REGISTRO');

                // Descripción del producto
                $('#modal-producto-descripcion').text(response.descripcion || 'SIN REGISTRO');

                // Precio y stock
                $('#modal-producto-precio').text(parseFloat(response.precio).toFixed(2));
                $('#modal-producto-stock').text(response.stock);

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

        // Cuando se cambia de tab, actualizar la URL
        $('.nav-tabs a').on('shown.bs.tab', function(e) {
            const categoriaId = $(this).data('categoria-id');
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('tab_id', categoriaId);
            window.history.replaceState({}, '', currentUrl.toString());
        });

        // Si hay un tab_id en la URL, activarlo
        const urlParams = new URLSearchParams(window.location.search);
        const tabId = urlParams.get('tab_id');
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