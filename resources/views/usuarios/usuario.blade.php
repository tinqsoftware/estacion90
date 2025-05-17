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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Lista de Usuarios y Roles</h4>
                        <button type="button" class="btn btn-primary" id="btnAgregarUsuario">
                            <i class="fas fa-plus"></i> Agregar Usuario
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha Creacion</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>ROL</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th>Creado por</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->id }}</td>
                                        <td>{{ $usuario->created_at->locale('es')->translatedFormat('d F Y') }}</td>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->apellido }}</td>
                                        <td>
                                            @switch($usuario->id_rol)
                                            @case(1)
                                            Administrador
                                            @break
                                            @case(3)
                                            Repartidor
                                            @break
                                            @case(4)
                                            Chef
                                            @break
                                            @default
                                            {{ $usuario->id_rol }}
                                            @endswitch
                                        </td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>
                                            @if($usuario->estado == 1)
                                            <span class="badge bg-success">Activo</span>
                                            @else
                                            <span class="badge bg-danger">Desactivado</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                            $creador = \App\Models\User::find($usuario->id_user_create);
                                            @endphp
                                            {{ $creador ? $creador->name : 'User Default' }}
                                        </td>

                                        <td>
                                            <div class="d-flex">
                                                <a href="#"
                                                    class="btn btn-primary shadow btn-xs sharp me-1 btn-ver-detalle"
                                                    data-id="{{ $usuario->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#detalleUsuarioModal" title="Ver detalles">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-info shadow btn-xs sharp me-1 btn-editar"
                                                    data-id="{{ $usuario->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#editarUsuarioModal" title="Editar">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp btn-eliminar"
                                                    data-id="{{ $usuario->id }}" title="Eliminar">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $usuarios->appends(request()->query())->links('pagination::bootstrap-4') }}
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

    <!-- Modal Ver Detalles -->
    <div class="modal fade" id="detalleUsuarioModal" tabindex="-1" aria-labelledby="detalleUsuarioModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detalleUsuarioModalLabel">Detalles del Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">ID:</label>
                            <p id="detalle-id"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nombre:</label>
                            <p id="detalle-nombre"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Apellido:</label>
                            <p id="detalle-apellido"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email:</label>
                            <p id="detalle-email"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Rol:</label>
                            <p id="detalle-rol"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Teléfono:</label>
                            <p id="detalle-telefono"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Dirección:</label>
                            <p id="detalle-direccion"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Creado por:</label>
                            <p id="detalle-creador"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Fecha de creación:</label>
                            <p id="detalle-fecha"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Usuario -->
    <div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="editarUsuarioModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarUsuarioModalLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditarUsuario">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="usuario-id" name="id">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="editar-nombre" name="name" required>
                                <span class="text-danger" id="editar-name-error"></span>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="editar-apellido" name="apellido" required>
                                <span class="text-danger" id="editar-apellido-error"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editar-email" name="email" required>
                                <span class="text-danger" id="editar-email-error"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="rol" class="form-label">Rol</label>
                                <select class="form-select" id="editar-rol" name="id_rol" required>
                                    <option value="1">Administrador</option>
                                    <option value="3">Repartidor</option>
                                    <option value="4">Chef</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="editar-telefono" name="telefono">
                                <span class="text-danger" id="editar-telefono-error"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="editar-estado" name="estado" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Desactivado</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        @if(auth()->user()->id_rol == 1)
                        <button type="button" class="btn btn-warning me-2" id="btn-reset-password" data-user-id="' + response.id + '">Restablecer Contraseña</button>
                        @endif
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para agregar usuario -->
    <div class="modal fade" id="agregarUsuarioModal" tabindex="-1" aria-labelledby="agregarUsuarioModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarUsuarioModalLabel">Agregar Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarUsuario">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <span class="text-danger" id="name-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="name">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                            <span class="text-danger" id="apellido-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <span class="text-danger" id="email-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="id_rol">Rol</label>
                            <select class="form-control" id="id_rol" name="id_rol" required>
                                <option value="">Seleccionar rol</option>
                                <option value="1">Administrador</option>
                                <option value="3">Repartidor</option>
                                <option value="4">Chef</option>
                            </select>
                            <span class="text-danger" id="id_rol-error"></span>
                        </div>


                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono">
                            <span class="text-danger" id="telefono-error"></span>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarUsuario">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        // Fix for "Add User" button - connect it to the modal
        $("#btnAgregarUsuario").on('click', function() {
            var agregarModal = new bootstrap.Modal(document.getElementById('agregarUsuarioModal'));
            agregarModal.show();
        });

        // Fix the close button to use Bootstrap 5 syntax
        $("#agregarUsuarioModal .btn-close, #agregarUsuarioModal .btn-secondary").on('click', function() {
            var agregarModal = bootstrap.Modal.getInstance(document.getElementById(
                'agregarUsuarioModal'));
            if (agregarModal) {
                agregarModal.hide();
            }
        });

        // Save new user
        $("#btnGuardarUsuario").on('click', function() {
            var formData = $("#formAgregarUsuario").serialize();
            formData += '&_token={{ csrf_token() }}';

            $.ajax({
                url: '/usuarios/guardar',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#agregarUsuarioModal').modal('hide');
                    alert('Usuario creado exitosamente');
                    location.reload();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '-error').text(value[0]);
                        });
                    } else {
                        alert('Error al crear el usuario');
                        console.log(xhr.responseText);
                    }
                }
            });
        });

        // Fix for the reset password button - correct ID retrieval
        $(document).on('click', '#btn-reset-password', function(e) {
            e.preventDefault();

            // Find the ID value in the modal content directly
            var userId = $('#detalle-id').text();

            if (confirm(
                    '¿Está seguro que desea restablecer la contraseña de este usuario a "12345678"? Esta acción no se puede deshacer.'
                )) {
                $.ajax({
                    url: '/usuarios/' + userId + '/reset-password',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert('Contraseña restablecida exitosamente a "12345678"');
                        $('#detalleUsuarioModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Error al restablecer la contraseña');
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        // Fix the edit user form
        $('#editarUsuarioModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var userId = button.data('id');
            var modal = $(this);

            // Restablecer formulario
            modal.find('form')[0].reset();

            // Cargar datos
            $.ajax({
                url: '/usuarios/' + userId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#usuario-id').val(response.id);
                    $('#editar-nombre').val(response.name);
                    $('#editar-apellido').val(response.apellido || '');
                    $('#editar-email').val(response.email);
                    $('#editar-rol').val(response.id_rol);
                    $('#editar-telefono').val(response.telefono || '');
                    $('#editar-direccion').val(response.id_direccion || '');

                    
                },
                error: function(xhr) {
                    modal.find('.modal-body').prepend(
                        '<div class="alert alert-danger">Error al cargar los datos del usuario</div>'
                    );
                    console.log(xhr.responseText);
                }
            });
        });

        $("#formEditarUsuario").on('submit', function(e) {
            e.preventDefault();

            var userId = $('#usuario-id').val();
            var formData = $(this).serialize();

            $.ajax({
                url: '/usuarios/guardar/' + userId,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    $('#editarUsuarioModal').modal('hide');
                    alert('Usuario actualizado exitosamente');
                    location.reload();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        // Limpiar errores anteriores
                        $('.text-danger').text('');

                        $.each(errors, function(key, value) {
                            $('#editar-' + key + '-error').text(value[0]);
                        });
                    } else {
                        alert('Error al actualizar el usuario');
                        console.log(xhr.responseText);
                    }
                }
            });
        });

        // Add button to reset password in the details modal
        $('#detalleUsuarioModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var userId = button.data('id');
            var modal = $(this);

            // Mostrar indicador de carga
            modal.find('.modal-body').html(
                '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Cargando...</span></div><p class="mt-2">Cargando datos...</p></div>'
            );

            // Cargar datos
            $.ajax({
                url: '/usuarios/' + userId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var content = `
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">ID:</label>
                        <p id="detalle-id">${response.id}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nombre:</label>
                        <p>${response.name}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Apellido:</label>
                        <p>${response.apellido || 'No especificado'}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email:</label>
                        <p>${response.email}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Rol:</label>
                        <p>${response.id_rol}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Teléfono:</label>
                        <p>${response.telefono || 'No especificado'}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Dirección:</label>
                        <p>${response.id_direccion || 'No especificada'}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Creado por:</label>
                        <p>${response.id_user_create || 'No especificado'}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Fecha de creación:</label>
                        <p>${response.created_at}</p>
                    </div>
                </div>`;

                    modal.find('.modal-body').html(content);

                    
                },
                error: function(xhr) {
                    modal.find('.modal-body').html(
                        '<div class="alert alert-danger">Error al cargar los datos del usuario</div>'
                    );
                    console.log(xhr.responseText);
                }
            });
        });

        $(".btn-eliminar").on('click', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "El usuario será desactivado. Esta acción cambiará su estado a inactivo.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, desactivar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/usuarios/eliminar/' + userId,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Usuario desactivado correctamente',
                                confirmButtonColor: '#3085d6'
                            }).then((result) => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo desactivar el usuario: ' +
                                    xhr.responseJSON.error,
                                confirmButtonColor: '#3085d6'
                            });
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    });
    </script>

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