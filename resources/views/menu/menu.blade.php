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
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

                <h1>Gestión de Menú</h1>

                <!-- Botón para crear nuevo -->
                <div class="mb-4">
                    <button type="button" class="btn btn-primary" id="createMenuBtn">
                        <i class="fas fa-plus"></i> CREAR NUEVO ELEMENTO
                    </button>
                </div>

                <!-- Tabla de Menús -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="20%">Imagen</th>
                                <th width="25%">Nombre</th>
                                <th width="15%">Precio</th>
                                <th width="15%">Categorías</th>
                                <th width="15%">Fecha Creación</th>
                                <th width="20%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="menuTableBody">
                            @forelse($menus as $menu)
                            <tr class="menu-row align-middle" data-menu-id="{{ $menu->id }}">
                                <td class="text-center">{{ $menu->id }}</td>
                                <td class="text-center">
                                    @if($menu->url_imagen)
                                    <img src="{{ asset('access/images/menu/' . $menu->url_imagen) }}" alt="Menu"
                                        class="img-thumbnail rounded"
                                        style="width: 80px; height: 60px; object-fit: cover; cursor: pointer;"
                                        onclick="previewImage('{{ asset('access/images/menu/' . $menu->url_imagen) }}')">
                                    @else
                                    <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td>{{ $menu->nombre }}</td>
                                <td class="text-center">S/ {{ number_format($menu->precio, 2) }}</td>
                                <td>{{ $menu->categorias_nombres }}</td>
                                <td class="text-center">{{ $menu->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <button class="btn btn-primary shadow btn-sm view-menu-btn"
                                            data-menu-id="{{ $menu->id }}" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-info shadow btn-sm edit-menu-btn"
                                            data-menu-id="{{ $menu->id }}" title="Editar">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button class="btn btn-danger shadow btn-sm delete-menu-btn"
                                            data-menu-id="{{ $menu->id }}" title="Eliminar">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No hay elementos de menú disponibles</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Modal para crear menú -->
                <div class="modal fade" id="crearMenuModal" tabindex="-1" aria-labelledby="crearMenuModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="crearMenuModalLabel">Crear Nuevo Elemento de Menú</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="formCrearMenu" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="nombre" class="form-label">Nombre *</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="precio" class="form-label">Precio *</label>
                                            <input type="number" step="0.01" class="form-control" id="precio"
                                                name="precio" required>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Categorías</label>

                                            <!-- Categorías existentes -->
                                            <div class="mb-3">
                                                <label class="form-label">Seleccionar categorías existentes:</label>
                                                <select class="form-control selectpicker"
                                                    id="categorias_existentes_crear" name="categorias_existentes[]"
                                                    multiple data-live-search="true" data-actions-box="true"
                                                    title="Selecciona categorías..."
                                                    data-selected-text-format="count > 2">
                                                    @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Nuevas categorías -->
                                            <div class="mb-3">
                                                <label class="form-label">Crear nuevas categorías:</label>
                                                <div id="nuevas-categorias-container">
                                                    <!-- Aquí se agregarán dinámicamente las nuevas categorías -->
                                                </div>
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    id="agregar-categoria">
                                                    <i class="fas fa-plus"></i> Agregar Nueva Categoría
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="imagen" class="form-label">Archivo</label>
                                            <input type="file" class="form-control" id="imagen" name="imagen">
                                            <small class="form-text text-muted">Todos los tipos de archivo permitidos.
                                                Tamaño máximo: 10MB</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="preview-imagen" class="text-center" style="display: none;">
                                                <img id="img-preview" src="" alt="Preview" class="img-thumbnail"
                                                    style="max-width: 300px;">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="password_create" class="form-label">Confirma tu contraseña
                                                *</label>
                                            <input type="password" class="form-control" id="password_create"
                                                name="password" required>
                                            <small class="form-text text-muted">Por seguridad, confirma tu contraseña
                                                para crear el elemento</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Elemento</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para editar menú -->
                <div class="modal fade" id="editarMenuModal" tabindex="-1" aria-labelledby="editarMenuModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarMenuModalLabel">Editar Elemento de Menú</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="formEditarMenu" enctype="multipart/form-data">
                                <input type="hidden" id="edit_menu_id" name="menu_id">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="edit_nombre" class="form-label">Nombre *</label>
                                            <input type="text" class="form-control" id="edit_nombre" name="nombre"
                                                required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="edit_precio" class="form-label">Precio *</label>
                                            <input type="number" step="0.01" class="form-control" id="edit_precio"
                                                name="precio" required>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Categorías</label>

                                            <!-- Categorías existentes -->
                                            <div class="mb-3">
                                                <label class="form-label">Seleccionar categorías existentes:</label>
                                                <select class="form-control selectpicker"
                                                    id="categorias_existentes_editar" name="categorias_existentes[]"
                                                    multiple data-live-search="true" data-actions-box="true"
                                                    title="Selecciona categorías..."
                                                    data-selected-text-format="count > 2">
                                                    @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Nuevas categorías -->
                                            <div class="mb-3">
                                                <label class="form-label">Crear nuevas categorías:</label>
                                                <div id="nuevas-categorias-container">
                                                    <!-- Aquí se agregarán dinámicamente las nuevas categorías -->
                                                </div>
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    id="agregar-categoria">
                                                    <i class="fas fa-plus"></i> Agregar Nueva Categoría
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="edit_imagen" class="form-label">Archivo</label>
                                            <input type="file" class="form-control" id="edit_imagen" name="imagen">
                                            <small class="form-text text-muted">Dejar vacío para mantener el archivo
                                                actual</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="edit-preview-imagen" class="text-center">
                                                <img id="edit-img-preview" src="" alt="Imagen actual"
                                                    class="img-thumbnail" style="max-width: 300px;">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="password_edit" class="form-label">Confirma tu contraseña
                                                *</label>
                                            <input type="password" class="form-control" id="password_edit"
                                                name="password" required>
                                            <small class="form-text text-muted">Por seguridad, confirma tu contraseña
                                                para guardar los cambios</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Actualizar Elemento</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para ver menú -->
                <div class="modal fade" id="verMenuModal" tabindex="-1" aria-labelledby="verMenuModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="verMenuModalLabel">Detalles del Elemento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="menuModalContent">
                                <!-- Contenido se carga dinámicamente -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para preview de imagen -->
                <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imagePreviewModalLabel">Vista Previa de Imagen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="previewImageSrc" src="" alt="Preview" class="img-fluid rounded">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- jQuery primero -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Required vendors -->
    <script src="access/vendor/global/global.min.js"></script>
    <script src="access/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="access/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="access/vendor/swiper/js/swiper-bundle.min.js"></script>

    <!-- Dashboard -->
    <script src="access/js/dlabnav-init.js"></script>
    <script src="access/js/custom.js"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <script>
    $(document).ready(function() {
        // CSRF Token para Ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize Bootstrap modals
        const createModal = new bootstrap.Modal(document.getElementById('crearMenuModal'));
        const editModal = new bootstrap.Modal(document.getElementById('editarMenuModal'));
        const viewModal = new bootstrap.Modal(document.getElementById('verMenuModal'));
        const previewModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));

        // Función para preview de imagen
        window.previewImage = function(src) {
            $('#previewImageSrc').attr('src', src);
            previewModal.show();
        }

        // Botón crear menú
        $('#createMenuBtn').click(function() {
            $('#formCrearMenu')[0].reset();
            $('#preview-imagen').hide();
            createModal.show();
        });

        // Preview imagen al crear
        $('#imagen').change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#img-preview').attr('src', e.target.result);
                    $('#preview-imagen').show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#preview-imagen').hide();
            }
        });

        // Preview imagen al editar
        $('#edit_imagen').change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#edit-img-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        // Ver menú
        $(document).on('click', '.view-menu-btn', function() {
            const menuId = $(this).data('menu-id');
            const menuRow = $(this).closest('tr');

            const imagen = menuRow.find('td:eq(1) img').attr('src') || '';
            const nombre = menuRow.find('td:eq(2)').text();
            const precio = menuRow.find('td:eq(3)').text();
            const fechaCreacion = menuRow.find('td:eq(4)').text();

            const contenidoModal = `
                    <div class="row">
                        <div class="col-md-6">
                            <h6><strong>ID:</strong></h6>
                            <p>${menuId}</p>
                            
                            <h6><strong>Nombre:</strong></h6>
                            <p>${nombre}</p>
                            
                            <h6><strong>Precio:</strong></h6>
                            <p>${precio}</p>
                            
                            <h6><strong>Fecha de Creación:</strong></h6>
                            <p>${fechaCreacion}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Archivo:</strong></h6>
                            ${imagen ? `
                                <div class="text-center">
                                    <img src="${imagen}" alt="Menu" class="img-fluid rounded shadow" style="max-width: 100%; height: auto; max-height: 300px;">
                                    <br><br>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="previewImage('${imagen}')">
                                        <i class="fas fa-expand"></i> Ver en tamaño completo
                                    </button>
                                </div>
                            ` : '<p class="text-muted">Sin archivo</p>'}
                        </div>
                    </div>
                `;

            $('#menuModalContent').html(contenidoModal);
            viewModal.show();
        });

        // Editar menú
        $(document).on('click', '.edit-menu-btn', function() {
            const menuId = $(this).data('menu-id');

            $.get(`/menu/${menuId}/edit`, function(response) {
                $('#edit_menu_id').val(response.menu.id);
                $('#edit_nombre').val(response.menu.nombre);
                $('#edit_precio').val(response.menu.precio);

                // Limpiar y seleccionar categorías
                $('#categorias_existentes_editar').selectpicker('deselectAll');
                if (response.categorias_asociadas && response.categorias_asociadas.length > 0) {
                    $('#categorias_existentes_editar').selectpicker('val', response
                        .categorias_asociadas);
                }

                if (response.menu.url_imagen) {
                    $('#edit-img-preview').attr('src',
                        `/access/images/menu/${response.menu.url_imagen}`);
                    $('#edit-preview-imagen').show();
                } else {
                    $('#edit-preview-imagen').hide();
                }

                editModal.show();
            }).fail(function() {
                Swal.fire('Error', 'No se pudo cargar la información del elemento', 'error');
            });
        });

        // Formulario crear menú
        $('#formCrearMenu').submit(function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                url: '/menu',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#formCrearMenu button[type="submit"]').prop('disabled', true).text(
                        'Guardando...');
                },
                success: function(response) {
                    if (response.success) {
                        createModal.hide();
                        Swal.fire('Éxito', response.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Ocurrió un error al crear el elemento';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire('Error', errorMessage, 'error');
                },
                complete: function() {
                    $('#formCrearMenu button[type="submit"]').prop('disabled', false).text(
                        'Guardar Elemento');
                }
            });
        });

        // Formulario editar menú
        $('#formEditarMenu').submit(function(e) {
            e.preventDefault();

            const menuId = $('#edit_menu_id').val();
            const formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: `/menu/${menuId}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#formEditarMenu button[type="submit"]').prop('disabled', true).text(
                        'Actualizando...');
                },
                success: function(response) {
                    if (response.success) {
                        editModal.hide();
                        Swal.fire('Éxito', response.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Ocurrió un error al actualizar el elemento';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire('Error', errorMessage, 'error');
                },
                complete: function() {
                    $('#formEditarMenu button[type="submit"]').prop('disabled', false).text(
                        'Actualizar Elemento');
                }
            });
        });

        // Eliminar menú
        $(document).on('click', '.delete-menu-btn', function() {
            const menuId = $(this).data('menu-id');
            const menuName = $(this).closest('tr').find('td:eq(2)').text();

            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Deseas eliminar "${menuName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                input: 'password',
                inputPlaceholder: 'Confirma tu contraseña',
                inputAttributes: {
                    required: true
                },
                preConfirm: (password) => {
                    if (!password) {
                        Swal.showValidationMessage('Debes ingresar tu contraseña');
                    }
                    return password;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/menu/${menuId}`,
                        type: 'DELETE',
                        data: {
                            password: result.value
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Eliminado', response.message, 'success')
                                    .then(() => {
                                        location.reload();
                                    });
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function(xhr) {
                            let errorMessage =
                                'Ocurrió un error al eliminar el elemento';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire('Error', errorMessage, 'error');
                        }
                    });
                }
            });
        });

        // Limpiar formularios al cerrar modales
        document.getElementById('crearMenuModal').addEventListener('hidden.bs.modal', function() {
            $('#formCrearMenu')[0].reset();
            $('#preview-imagen').hide();
            $('#nuevas-categorias-container').empty();
            $('#categorias_existentes_crear').selectpicker('deselectAll');
        });

        document.getElementById('editarMenuModal').addEventListener('hidden.bs.modal', function() {
            $('#formEditarMenu')[0].reset();
            $('#edit-preview-imagen').hide();
            $('#categorias_existentes_editar').selectpicker('deselectAll');
        });

        let contadorCategorias = 0;

        $('#agregar-categoria').click(function() {
            contadorCategorias++;
            const nuevaCategoriaHtml = `
        <div class="row mb-2 nueva-categoria" data-index="${contadorCategorias}">
            <div class="col-md-5">
                <input type="text" class="form-control" name="nuevas_categorias[${contadorCategorias}][nombre]" placeholder="Nombre de categoría" required>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="nuevas_categorias[${contadorCategorias}][descripcion]" placeholder="Descripción (opcional)">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm eliminar-categoria">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
            $('#nuevas-categorias-container').append(nuevaCategoriaHtml);
        });

        // Eliminar categoría
        $(document).on('click', '.eliminar-categoria', function() {
            $(this).closest('.nueva-categoria').remove();
        });

        $('.selectpicker').selectpicker({
            size: 5,
            liveSearch: true,
            actionsBox: true,
            selectedTextFormat: 'count > 2',
            noneSelectedText: 'Selecciona categorías...',
            countSelectedText: function(numSelected, numTotal) {
                return (numSelected == 1) ? numSelected + ' categoría seleccionada' : numSelected +
                    ' categorías seleccionadas';
            }
        });

        // Refrescar al abrir modales
        document.getElementById('crearMenuModal').addEventListener('shown.bs.modal', function() {
            $('#categorias_existentes_crear').selectpicker('refresh');
        });

        document.getElementById('editarMenuModal').addEventListener('shown.bs.modal', function() {
            $('#categorias_existentes_editar').selectpicker('refresh');
        });
    });
    </script>

</body>

</html>