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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Clientes y Ventas</h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createClienteModal">
                        <i class="fas fa-plus"></i> Nuevo Cliente
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha Creación</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Dirección actual</th>
                                    <th>Cant Pedidos</th>
                                    <th>Total Pagado</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->id }}</td>
                                    <td>{{ $cliente->created_at->format('d M Y') }}</td>
                                    <td>{{ $cliente->name }}</td>
                                    <td>{{ $cliente->apellido }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                    <td>{{ $cliente->direccion ? $cliente->direccion->direccion : 'Sin dirección' }}</td>
                                    <td>{{ $cliente->pedidos_count }}</td>
                                    <td>${{ number_format($cliente->total_pagado, 2) }}</td>
                                    <td>
                                        @if($cliente->estado == 1)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Desactivado</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-warning" onclick="viewCliente({{ $cliente->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-info" onclick="editCliente({{ $cliente->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteCliente({{ $cliente->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Cliente -->
<div class="modal fade" id="createClienteModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="createClienteForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido *</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña *</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña *</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Cliente</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Cliente -->
<div class="modal fade" id="editClienteModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editClienteForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" id="edit_cliente_id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Nombre *</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_apellido" class="form-label">Apellido *</label>
                                <input type="text" class="form-control" id="edit_apellido" name="apellido" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="edit_telefono" name="telefono">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_estado" class="form-label">Estado</label>
                        <select class="form-select" id="edit_estado" name="estado">
                            <option value="1">Activo</option>
                            <option value="0">Desactivado</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ver Cliente -->
<div class="modal fade" id="viewClienteModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información del Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="clienteInfo"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
// Crear cliente
document.getElementById('createClienteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('{{ route("clientes.store") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData // Cambié a FormData en lugar de JSON
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Cliente creado exitosamente'
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Error al crear cliente'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al crear cliente'
        });
        console.error('Error:', error);
    });
});

// Editar cliente
function editCliente(id) {
    fetch(`{{ url('clientes') }}/${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_cliente_id').value = data.id;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_apellido').value = data.apellido;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('edit_telefono').value = data.telefono || '';
            document.getElementById('edit_estado').value = data.estado;
            
            new bootstrap.Modal(document.getElementById('editClienteModal')).show();
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al cargar los datos del cliente'
            });
        });
}

// Actualizar cliente
document.getElementById('editClienteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const id = document.getElementById('edit_cliente_id').value;
    const formData = new FormData(this);
    
    fetch(`{{ url('clientes') }}/${id}`, {
        method: 'POST', // Cambié a POST
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Cliente actualizado exitosamente'
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message || 'Error al actualizar cliente'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al actualizar cliente'
        });
        console.error('Error:', error);
    });
});

// Ver cliente
function viewCliente(id) {
    fetch(`{{ url('clientes') }}/${id}`)
        .then(response => response.json())
        .then(data => {
            const html = `
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID:</strong> ${data.id}</p>
                        <p><strong>Nombre:</strong> ${data.name}</p>
                        <p><strong>Apellido:</strong> ${data.apellido}</p>
                        <p><strong>Email:</strong> ${data.email}</p>
                        <p><strong>Teléfono:</strong> ${data.telefono || 'No especificado'}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Estado:</strong> ${data.estado == 1 ? 'Activo' : 'Desactivado'}</p>
                        <p><strong>Fecha de registro:</strong> ${new Date(data.created_at).toLocaleDateString()}</p>
                        <p><strong>Cantidad de pedidos:</strong> ${data.pedidos_count || 0}</p>
                        <p><strong>Total pagado:</strong> $${data.total_pagado || 0}</p>
                    </div>
                </div>
            `;
            
            document.getElementById('clienteInfo').innerHTML = html;
            new bootstrap.Modal(document.getElementById('viewClienteModal')).show();
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al cargar los datos del cliente'
            });
        });
}

// Eliminar cliente
function deleteCliente(id) {
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
            fetch(`{{ url('clientes') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado',
                        text: 'Cliente eliminado exitosamente'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Error al eliminar cliente'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al eliminar cliente'
                });
                console.error('Error:', error);
            });
        }
    });
}
</script>

</body>
</html>