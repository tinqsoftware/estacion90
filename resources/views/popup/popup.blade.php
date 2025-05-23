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

        <div class="content-body">
            <div class="container-fluid">
                <h1>Popups</h1>

                <!-- Tabs -->
                <div class="tabs mb-3">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->input('tab', 'pendientes') == 'pendientes' ? 'active' : '' }}"
                                href="{{ route('popups.index', ['tab' => 'pendientes']) }}">Pendientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->input('tab') == 'pasados' ? 'active' : '' }}"
                                href="{{ route('popups.index', ['tab' => 'pasados']) }}">Pasados</a>
                        </li>
                    </ul>
                </div>

                <!-- Current Tab Content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Fecha popup</th>
                                        <th>Nombre</th>
                                        <th>Foto</th>
                                        <th>Cantidad<br>Por día</th>
                                        <th>Link</th>
                                        <th>Usuario</th>
                                        <th>Fecha creación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($popups as $popup)
                                    <tr class="popup-row" data-popup-id="{{ $popup->id }}">
                                        <td>{{ \Carbon\Carbon::parse($popup->fecha_visible)->format('d M Y') }}</td>
                                        <td>{{ $popup->nombre }}</td>
                                        <td>
                                            @if($popup->url_imagen)
                                            <img src="{{ asset($popup->url_imagen) }}" alt="{{ $popup->nombre }}"
                                                class="img-thumbnail" width="100">
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $popup->veces_dia }}
                                        </td>
                                        <td>
                                            @if($popup->link)
                                            <a href="{{ $popup->link }}" target="_blank">
                                                {{ Str::limit($popup->link, 20) }}
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($popup->id_user_create)
                                            {{ optional($popup->creator)->name ?? 'Usuario no encontrado' }}
                                            @else
                                            Sin registro
                                            @endif
                                        </td>
                                        <td>{{ $popup->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="javascript:void(0);"
                                                    class="btn btn-primary shadow btn-xs sharp me-1 view-popup-btn"
                                                    data-popup-id="{{ $popup->id }}" title="Ver detalles">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    class="btn btn-info shadow btn-xs sharp me-1 edit-popup-btn"
                                                    data-popup-id="{{ $popup->id }}" title="Editar">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    class="btn btn-danger shadow btn-xs sharp delete-popup-btn"
                                                    data-popup-id="{{ $popup->id }}" title="Eliminar">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No hay popups disponibles</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                {{ $popups->links() }}
                            </div>
                            <div>
                                {{ $popups->total() }} registros
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="javascript:void(0);" class="btn btn-secondary" id="createPopupBtn">CREAR POPUP</a>
                </div>
            </div>
        </div>

        <!-- Modal para ver el detalle del popup -->
        <div class="modal fade" id="verPopupModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalle del Popup</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="popupModalContent">
                        <div class="popup-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Información del Popup</h5>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Nombre:</th>
                                            <td>{{ $popup->nombre }}</td>
                                        </tr>
                                        <tr>
                                            <th>Fecha de publicación:</th>
                                            <td>{{ \Carbon\Carbon::parse($popup->fecha_visible)->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Veces por día:</th>
                                            <td>{{ $popup->veces_dia }}</td>
                                        </tr>
                                        <tr>
                                            <th>Link:</th>
                                            <td>
                                                @if($popup->link)
                                                <a href="{{ $popup->link }}" target="_blank">{{ $popup->link }}</a>
                                                @else
                                                <span class="text-muted">No definido</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Creado por:</th>
                                            <td>
                                                @if($popup->id_user_create)
                                                {{ optional($popup->creator)->name ?? 'Usuario no encontrado' }}
                                                @else
                                                Sin registro
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Fecha de creación:</th>
                                            <td>{{ $popup->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6 text-center">
                                    @if($popup->url_imagen)
                                    <h5>Imagen</h5>
                                    <img src="{{ asset($popup->url_imagen) }}" alt="{{ $popup->nombre }}"
                                        class="img-fluid img-thumbnail mt-2" style="max-height: 300px;">
                                    @else
                                    <div class="alert alert-info mt-4">
                                        <i class="fas fa-info-circle"></i> Este popup no tiene imagen asociada.
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="text-right mt-4">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para crear popup -->
        <div class="modal fade" id="createPopupModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear Nuevo Popup</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="createPopupForm" action="{{ route('popups.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Nombre <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="fecha_visible" class="form-label">Fecha de Publicación <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="fecha_visible" name="fecha_visible"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="link" class="form-label">Link</label>
                                    <input type="url" class="form-control" id="link" name="link">
                                </div>

                                <div class="col-md-6">
                                    <label for="veces_dia" class="form-label">Cantidad por día <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="veces_dia" name="veces_dia" value="1"
                                        min="0" required>
                                </div>
                            </div>



                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen</label>
                                <input type="file" class="form-control" id="imagen" name="imagen">
                                <div id="image-preview-container" class="mt-2"></div>
                                <small class="text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                            </div>

                            <div class="mt-4 text-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar Popup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para editar popup -->
        <div class="modal fade" id="editPopupModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Popup</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editPopupForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="edit_nombre" class="form-label">Nombre <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="edit_fecha_visible" class="form-label">Fecha de Publicación <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="edit_fecha_visible" name="fecha_visible"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="edit_link" class="form-label">Link</label>
                                    <input type="url" class="form-control" id="edit_link" name="link">
                                </div>

                                <div class="col-md-6">
                                    <label for="edit_veces_dia" class="form-label">Cantidad por día <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="edit_veces_dia" name="veces_dia"
                                        min="0" required>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="edit_imagen" class="form-label">Imagen</label>
                                <div id="current_image_container" class="mb-2"></div>
                                <input type="file" class="form-control" id="edit_imagen" name="imagen">
                                <div id="edit-image-preview-container" class="mt-2"></div>
                                <small class="text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                            </div>

                            <div class="mt-4 text-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Actualizar Popup</button>
                            </div>
                        </form>
                    </div>
                </div>
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
    $(document).ready(function() {

        $('.modal .close, .modal .btn-secondary[data-dismiss="modal"]').on('click', function() {
            $(this).closest('.modal').modal('hide');
        });
        // Image preview functionality
        $('#imagen, #edit_imagen').on('change', function() {
            const containerId = $(this).attr('id') === 'imagen' ?
                'image-preview-container' : 'edit-image-preview-container';
            previewImage(this, containerId);
        });

        function previewImage(input, containerId) {
            const container = $(`#${containerId}`);
            container.empty();

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    container.html(`
                        <div class="mt-2 mb-2">
                            <p><strong>Vista previa:</strong></p>
                            <img src="${e.target.result}" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    `);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        // Modal controls
        $('#createPopupBtn').on('click', function() {
            $('#createPopupModal').modal('show');
        });


        // Create form submission
        $('#createPopupForm').on('submit', function(e) {
            e.preventDefault();
            handleFormSubmit(this, '/popups/crear', 'Popup creado correctamente');
        });

        // Form submission handling
        function handleFormSubmit(form, url, successMessage) {
            const formData = new FormData(form);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $(form).closest('.modal').modal('hide');
                    Swal.fire('Éxito', successMessage, 'success')
                        .then(() => {
                            window.location.reload();
                        });
                },
                error: function(xhr) {
                    console.error('Error status:', xhr.status);
                    console.error('Error details:', xhr.responseText);

                    try {
                        let errorDetails = JSON.parse(xhr.responseText);
                        console.log('Error parsed:', errorDetails);

                        if (xhr.status === 422) { // Validation errors
                            let errorsHtml = '<ul>';
                            const errors = errorDetails.errors;

                            for (const field in errors) {
                                errors[field].forEach(error => {
                                    errorsHtml += `<li>${error}</li>`;
                                });
                            }

                            errorsHtml += '</ul>';
                            Swal.fire('Error de validación', errorsHtml, 'error');
                        } else {
                            Swal.fire('Error',
                                `Ocurrió un error en la operación: ${errorDetails.message || 'Error desconocido'}`,
                                'error');
                        }
                    } catch (e) {
                        Swal.fire('Error',
                            'Ocurrió un error en la operación. Revise la consola para más detalles.',
                            'error');
                    }
                }
            });
        }

        // Detalles #

        $('.view-popup-btn').on('click', function() {
            const popupId = $(this).data('popup-id');

            // Show loading indicator
            $('#popupModalContent').html(
                '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i><p class="mt-2">Cargando...</p></div>'
            );

            // Open the modal
            $('#verPopupModal').modal('show');

            // Fetch popup details
            $.ajax({
                url: `/popups/${popupId}/view`,
                type: 'GET',
                success: function(response) {
                    $('#popupModalContent').html(response);
                },
                error: function(xhr) {
                    $('#popupModalContent').html(`
                    <div class="alert alert-danger">
                        <h5>Error al cargar los detalles</h5>
                        <p>No se pudieron cargar los detalles del popup. Por favor, intente nuevamente.</p>
                    </div>
                `);
                    console.error('Error loading popup details:', xhr.responseText);
                }
            });
        });


        // Edit Popup
        $('.edit-popup-btn').on('click', function() {
            const popupId = $(this).data('popup-id');

            // Reset form and clear preview
            $('#editPopupForm')[0].reset();
            $('#edit-image-preview-container').empty();
            $('#current_image_container').empty();

            // Set form action URL
            $('#editPopupForm').attr('action', `/popups/${popupId}`);

            // Fetch popup data
            $.ajax({
                url: `/popups/${popupId}/edit`,
                type: 'GET',
                success: function(popup) {
                    // Populate form fields
                    $('#edit_nombre').val(popup.nombre);
                    $('#edit_fecha_visible').val(popup.fecha_visible);
                    $('#edit_link').val(popup.link);
                    $('#edit_veces_dia').val(popup.veces_dia);

                    // Show current image if exists
                    if (popup.url_imagen) {
                        $('#current_image_container').html(`
                    <p><strong>Imagen actual:</strong></p>
                    <img src="${popup.url_imagen}" class="img-thumbnail" style="max-height: 150px;">
                `);
                    }

                    // Show modal
                    $('#editPopupModal').modal('show');
                },
                error: function(xhr) {
                    Swal.fire('Error', 'No se pudo cargar la información del popup',
                        'error');
                    console.error('Error loading popup details:', xhr.responseText);
                }
            });
        });

        // Edit form submission
        $('#editPopupForm').on('submit', function(e) {
            e.preventDefault();
            handleFormSubmit(this, $(this).attr('action'), 'Popup actualizado correctamente');
        });

        // Delete Popup
        $('.delete-popup-btn').on('click', function() {
            const popupId = $(this).data('popup-id');
            const popupRow = $(this).closest('tr.popup-row');

            // Show confirmation dialog
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará el popup permanentemente y no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, send delete request
                    $.ajax({
                        url: `/popups/${popupId}`,
                        type: 'POST', // Change to POST instead of DELETE
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'DELETE' // Add this line for method spoofing
                        },
                        success: function(response) {
                            // Show success message
                            Swal.fire(
                                'Eliminado',
                                'El popup ha sido eliminado correctamente',
                                'success'
                            ).then(() => {
                                // Remove the row from the table
                                popupRow.fadeOut(400, function() {
                                    $(this).remove();

                                    // If no more rows, show "no popups" message
                                    if ($('.popup-row').length ===
                                        0) {
                                        $('tbody').html(
                                            '<tr><td colspan="9" class="text-center">No hay popups disponibles</td></tr>'
                                        );
                                    }
                                });
                            });
                        },
                        error: function(xhr) {
                            console.error('Error deleting popup:', xhr
                                .responseText);

                            // Show error message
                            Swal.fire(
                                'Error',
                                'No se pudo eliminar el popup. Por favor, intente nuevamente.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

    });
    </script>

</body>