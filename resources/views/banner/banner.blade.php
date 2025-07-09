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

<body>
    <div id="main-wrapper" class="dlab-overflow">

        @include('partials.header')
        @include('partials.sidebar')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">

                <h1>Gestión de Banners</h1>

                <!-- Tabla de Banners -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Imagen</th>
                                <th width="12%">Fecha Inicio</th>
                                <th width="12%">Fecha Fin</th>
                                <th width="10%">Estado</th>
                                <th width="15%">Creado por</th>
                                <th width="12%">Fecha Creación</th>
                                <th width="19%">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($banners as $banner)
                            <tr class="banner-row align-middle" data-banner-id="{{ $banner->id }}">
                                <td class="text-center">{{ $banner->id }}</td>
                                <td class="text-center">
                                    @if($banner->url_imagen)
                                    <img src="{{ asset('access/images/banners/' . $banner->url_imagen) }}" alt="Banner"
                                        class="img-thumbnail rounded"
                                        style="width: 80px; height: 50px; object-fit: cover; cursor: pointer;"
                                        onclick="previewImage('{{ asset('access/images/banners/' . $banner->url_imagen) }}')">
                                    @else
                                    <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($banner->fecha_inicio)->format('d M Y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($banner->fecha_fin)->format('d M Y') }}
                                </td>
                                <td class="text-center">
                                    @php
                                    $hoy = \Carbon\Carbon::now()->format('Y-m-d');
                                    $inicio = $banner->fecha_inicio;
                                    $fin = $banner->fecha_fin;
                                    @endphp
                                    @if($hoy >= $inicio && $hoy <= $fin) <span class="badge bg-success">Activo</span>
                                        @elseif($hoy < $inicio) <span class="badge bg-warning">Programado</span>
                                            @else
                                            <span class="badge bg-secondary">Expirado</span>
                                            @endif
                                </td>
                                <td class="text-center">
                                    @if($banner->id_user_create)
                                    {{ optional($banner->creator)->name ?? 'Usuario no encontrado' }}
                                    @else
                                    Sin registro
                                    @endif
                                </td>
                                <td class="text-center">{{ $banner->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="javascript:void(0);"
                                            class="btn btn-primary shadow btn-sm view-banner-btn"
                                            data-banner-id="{{ $banner->id }}" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-info shadow btn-sm edit-banner-btn"
                                            data-banner-id="{{ $banner->id }}" title="Editar">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger shadow btn-sm delete-banner-btn"
                                            data-banner-id="{{ $banner->id }}" title="Eliminar">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No hay banners disponibles</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <button type="button" class="btn btn-secondary" id="createBannerBtn">
                        <i class="fas fa-plus"></i> CREAR BANNER
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal para crear banner -->
        <div class="modal fade" id="crearBannerModal" tabindex="-1" aria-labelledby="crearBannerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearBannerModalLabel">Crear Nuevo Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formCrearBanner" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="imagen" class="form-label">Imagen del Banner *</label>
                                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*"
                                        required>
                                    <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño
                                        máximo: 2MB</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_inicio" class="form-label">Fecha Inicio *</label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_fin" class="form-label">Fecha Fin *</label>
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para editar banner -->
        <div class="modal fade" id="editarBannerModal" tabindex="-1" aria-labelledby="editarBannerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarBannerModalLabel">Editar Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formEditarBanner" enctype="multipart/form-data">
                        <input type="hidden" id="edit_banner_id" name="banner_id">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="edit_imagen" class="form-label">Imagen del Banner</label>
                                    <input type="file" class="form-control" id="edit_imagen" name="imagen"
                                        accept="image/*">
                                    <small class="form-text text-muted">Dejar vacío para mantener la imagen
                                        actual</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_fecha_inicio" class="form-label">Fecha Inicio *</label>
                                    <input type="date" class="form-control" id="edit_fecha_inicio" name="fecha_inicio"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="edit_fecha_fin" class="form-label">Fecha Fin *</label>
                                    <input type="date" class="form-control" id="edit_fecha_fin" name="fecha_fin"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="edit-preview-imagen" class="text-center">
                                        <img id="edit-img-preview" src="" alt="Imagen actual" class="img-thumbnail"
                                            style="max-width: 300px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Actualizar Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para ver banner -->
        <div class="modal fade" id="verBannerModal" tabindex="-1" aria-labelledby="verBannerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verBannerModalLabel">Detalles del Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="bannerModalContent">
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    <!-- Remover demo.js que causa error 404 -->

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/heic2any@0.0.4/dist/heic2any.min.js"></script>

    <script>
    $(document).ready(function() {
        // CSRF Token para Ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize Bootstrap modals properly
        const createModal = new bootstrap.Modal(document.getElementById('crearBannerModal'));
        const editModal = new bootstrap.Modal(document.getElementById('editarBannerModal'));
        const viewModal = new bootstrap.Modal(document.getElementById('verBannerModal'));
        const previewModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));

        // Función para preview de imagen
        window.previewImage = function(src) {
            $('#previewImageSrc').attr('src', src);
            previewModal.show();
        }

        // Botón crear banner
        $('#createBannerBtn').click(function() {
            $('#formCrearBanner')[0].reset();
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

        // Ver banner - fix event delegation
        $(document).on('click', '.view-banner-btn', function() {
            const bannerId = $(this).data('banner-id');

            // Buscar los datos del banner en la tabla actual
            const bannerRow = $(this).closest('tr');
            const bannerId_val = bannerRow.data('banner-id');

            // Obtener datos de la fila
            const imagen = bannerRow.find('td:eq(1) img').attr('src') || '';
            const fechaInicio = bannerRow.find('td:eq(2)').text();
            const fechaFin = bannerRow.find('td:eq(3)').text();
            const estado = bannerRow.find('td:eq(4)').html();
            const creador = bannerRow.find('td:eq(5)').text();
            const fechaCreacion = bannerRow.find('td:eq(6)').text();

            // Crear contenido HTML para el modal
            const contenidoModal = `
                    <div class="row">
                        <div class="col-md-6">
                            <h6><strong>ID:</strong></h6>
                            <p>${bannerId_val}</p>
                            
                            <h6><strong>Fecha Inicio:</strong></h6>
                            <p>${fechaInicio}</p>
                            
                            <h6><strong>Fecha Fin:</strong></h6>
                            <p>${fechaFin}</p>
                            
                            <h6><strong>Estado:</strong></h6>
                            <p>${estado}</p>
                            
                            <h6><strong>Creado por:</strong></h6>
                            <p>${creador}</p>
                            
                            <h6><strong>Fecha de Creación:</strong></h6>
                            <p>${fechaCreacion}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Vista Previa del Banner:</strong></h6>
                            ${imagen ? `
                                <div class="text-center">
                                    <img src="${imagen}" alt="Banner" class="img-fluid rounded shadow" style="max-width: 100%; height: auto; max-height: 300px;">
                                    <br><br>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="previewImage('${imagen}')">
                                        <i class="fas fa-expand"></i> Ver en tamaño completo
                                    </button>
                                </div>
                            ` : '<p class="text-muted">Sin imagen</p>'}
                        </div>
                    </div>
                `;

            $('#bannerModalContent').html(contenidoModal);
            viewModal.show();
        });

        // Editar banner - fix event delegation and image path
        $(document).on('click', '.edit-banner-btn', function() {
            const bannerId = $(this).data('banner-id');

            $.get(`/banners/${bannerId}/edit`, function(response) {
                $('#edit_banner_id').val(response.id);
                $('#edit_fecha_inicio').val(response.fecha_inicio);
                $('#edit_fecha_fin').val(response.fecha_fin);

                if (response.url_imagen) {
                    $('#edit-img-preview').attr('src',
                        `{{ asset('access/images/banners/') }}/${response.url_imagen}`);
                    $('#edit-preview-imagen').show();
                } else {
                    $('#edit-preview-imagen').hide();
                }

                editModal.show();
            }).fail(function() {
                Swal.fire('Error', 'No se pudo cargar la información del banner', 'error');
            });
        });

        // Formulario crear banner
        $('#formCrearBanner').submit(function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            // Validar que se haya seleccionado una imagen
            if (!formData.get('imagen') || formData.get('imagen').size === 0) {
                Swal.fire('Error', 'Debe seleccionar una imagen para el banner', 'error');
                return;
            }

            // Validar fechas
            const fechaInicio = new Date(formData.get('fecha_inicio'));
            const fechaFin = new Date(formData.get('fecha_fin'));

            if (fechaFin < fechaInicio) {
                Swal.fire('Error', 'La fecha fin no puede ser anterior a la fecha inicio', 'error');
                return;
            }

            $.ajax({
                url: '/banners',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    // Deshabilitar el botón de envío
                    $('#formCrearBanner button[type="submit"]').prop('disabled', true).text(
                        'Guardando...');
                },
                success: function(response) {
                    console.log('Response:', response); // Para debug
                    if (response.success) {
                        createModal.hide();
                        Swal.fire('Éxito', response.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        mostrarErrores(response.errors);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseText); // Para debug
                    let errorMessage = 'Ocurrió un error al crear el banner';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        try {
                            const errorData = JSON.parse(xhr.responseText);
                            if (errorData.errors) {
                                mostrarErrores(errorData.errors);
                                return;
                            }
                        } catch (e) {
                            // No es JSON válido
                        }
                    }

                    Swal.fire('Error', errorMessage, 'error');
                },
                complete: function() {
                    // Rehabilitar el botón de envío
                    $('#formCrearBanner button[type="submit"]').prop('disabled', false)
                        .text('Guardar Banner');
                }
            });
        });

        // Formulario editar banner
        $('#formEditarBanner').submit(function(e) {
            e.preventDefault();

            const bannerId = $('#edit_banner_id').val();
            const formData = new FormData(this);
            formData.append('_method', 'PUT');

            $.ajax({
                url: `/banners/${bannerId}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        editModal.hide();
                        Swal.fire('Éxito', response.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        mostrarErrores(response.errors);
                    }
                },
                error: function(xhr) {
                    Swal.fire('Error', 'Ocurrió un error al actualizar el banner', 'error');
                }
            });
        });

        // Eliminar banner - fix event delegation
        $(document).on('click', '.delete-banner-btn', function() {
            const bannerId = $(this).data('banner-id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esta acción",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/banners/${bannerId}`,
                        type: 'DELETE',
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
                        error: function() {
                            Swal.fire('Error',
                                'Ocurrió un error al eliminar el banner',
                                'error');
                        }
                    });
                }
            });
        });

        // Limpiar formulario al cerrar modal crear
        document.getElementById('crearBannerModal').addEventListener('hidden.bs.modal', function() {
            $('#formCrearBanner')[0].reset();
            $('#preview-imagen').hide();
        });
    });

    function mostrarErrores(errors) {
        let mensaje = 'Se encontraron los siguientes errores:\n';
        $.each(errors, function(campo, errores) {
            $.each(errores, function(i, error) {
                mensaje += '- ' + error + '\n';
            });
        });
        Swal.fire('Errores de validación', mensaje, 'error');
    }
    </script>


</body>