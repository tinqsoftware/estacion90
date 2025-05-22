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
                                        <th>Descripción</th>
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
                                            @if($popup->imagen)
                                            <img src="{{ asset('storage/' . $popup->imagen) }}"
                                                alt="{{ $popup->nombre }}" class="img-thumbnail" width="100">
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @php
                                            $cantidad = $popup->popupdias?->first()?->cantidad ?? 0;
                                            @endphp
                                            {{ $cantidad }}
                                        </td>
                                        <td>
                                            @if($popup->link)
                                            <a href="{{ $popup->link }}" target="_blank">
                                                {{ Str::limit($popup->link, 20) }}
                                            </a>
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($popup->descripcion, 50) }}</td>
                                        <td>{{ optional($popup->creador)->name }}</td>
                                        <td>{{ $popup->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-primary edit-popup-btn"
                                                data-popup-id="{{ $popup->id }}">EDITAR</a>
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
        <div class="modal fade" id="popupModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalle del Popup</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="popupModalContent">
                        <!-- Contenido dinámico del popup -->
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
                <form id="createPopupForm" action="{{ route('popups.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="fecha_visible" class="form-label">Fecha de Publicación <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="fecha_visible" name="fecha_visible" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="link" class="form-label">Link</label>
                            <input type="url" class="form-control" id="link" name="link">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="veces_dia" class="form-label">Cantidad por día <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="veces_dia" name="veces_dia" value="1" min="0" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen">
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
                            <label for="edit_nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="edit_fecha_visible" class="form-label">Fecha de Publicación <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="edit_fecha_visible" name="fecha_visible" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_link" class="form-label">Link</label>
                            <input type="url" class="form-control" id="edit_link" name="link">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="edit_veces_dia" class="form-label">Cantidad por día <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="edit_veces_dia" name="veces_dia" min="0" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="edit_descripcion" name="descripcion" rows="4"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_imagen" class="form-label">Imagen</label>
                        <div id="current_image_container" class="mb-2"></div>
                        <input type="file" class="form-control" id="edit_imagen" name="imagen">
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
    // Existing code for showing popup details
    $('.popup-row').on('click', function(e) {
        if (!$(e.target).is('a')) {
            const popupId = $(this).data('popup-id');
            loadPopupDetails(popupId);
        }
    });

    function loadPopupDetails(popupId) {
        $.ajax({
            url: `/popups/${popupId}/view`,
            type: 'GET',
            success: function(response) {
                $('#popupModalContent').html(response);
                $('#popupModal').modal('show');
            },
            error: function(error) {
                console.error('Error al cargar el popup:', error);
            }
        });
    }

    // Open Create Popup Modal
    $('#createPopupBtn').on('click', function() {
        $('#createPopupModal').modal('show');
    });

    // Open Edit Popup Modal
    $('.edit-popup-btn').on('click', function(e) {
        e.stopPropagation(); // Prevent row click event
        const popupId = $(this).data('popup-id');
        
        // Reset form
        $('#editPopupForm')[0].reset();
        $('#current_image_container').empty();
        
        // Set form action
        $('#editPopupForm').attr('action', `/popups/${popupId}`);
        
        // Load popup data
        $.ajax({
            url: `/popups/${popupId}/edit`,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Fill form with popup data
                $('#edit_nombre').val(data.popup.nombre);
                $('#edit_fecha_visible').val(data.popup.fecha_visible);
                $('#edit_link').val(data.popup.link);
                $('#edit_descripcion').val(data.popup.descripcion);
                
                // Set cantidad value
                const cantidad = data.popup.popupdias && data.popup.popupdias.length > 0 
                    ? data.popup.popupdias[0].cantidad 
                    : data.popup.veces_dia;
                $('#edit_veces_dia').val(cantidad);
                
                // Show current image if exists
                if (data.popup.imagen) {
                    const imgUrl = `/storage/${data.popup.imagen}`;
                    $('#current_image_container').html(`
                        <img src="${imgUrl}" alt="${data.popup.nombre}" class="img-thumbnail" style="max-height: 150px;">
                        <p class="mt-1">Imagen actual</p>
                    `);
                }
                
                // Show the modal
                $('#editPopupModal').modal('show');
            },
            error: function(error) {
                console.error('Error al cargar los datos del popup:', error);
                Swal.fire('Error', 'No se pudieron cargar los datos del popup', 'error');
            }
        });
    });

    // Handle form submissions
    $('#createPopupForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url:`/popups/crear`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#createPopupModal').modal('hide');
                Swal.fire('Éxito', 'Popup creado correctamente', 'success')
                    .then(() => {
                        window.location.reload();
                    });
            },
            error: function(xhr) {
                if (xhr.status === 422) { // Validation errors
                    let errorsHtml = '<ul>';
                    const errors = xhr.responseJSON.errors;
                    
                    for (const field in errors) {
                        errors[field].forEach(error => {
                            errorsHtml += `<li>${error}</li>`;
                        });
                    }
                    
                    errorsHtml += '</ul>';
                    
                    Swal.fire('Error de validación', errorsHtml, 'error');
                } else {
                    Swal.fire('Error', 'Ocurrió un error al crear el popup', 'error');
                }
            }
        });
    });
    
    $('#editPopupForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#editPopupModal').modal('hide');
                Swal.fire('Éxito', 'Popup actualizado correctamente', 'success')
                    .then(() => {
                        window.location.reload();
                    });
            },
            error: function(xhr) {
                if (xhr.status === 422) { // Validation errors
                    let errorsHtml = '<ul>';
                    const errors = xhr.responseJSON.errors;
                    
                    for (const field in errors) {
                        errors[field].forEach(error => {
                            errorsHtml += `<li>${error}</li>`;
                        });
                    }
                    
                    errorsHtml += '</ul>';
                    
                    Swal.fire('Error de validación', errorsHtml, 'error');
                } else {
                    Swal.fire('Error', 'Ocurrió un error al actualizar el popup', 'error');
                }
            }
        });
    });
});
    </script>

</body>