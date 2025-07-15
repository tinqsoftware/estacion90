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

    <!-- Mobile Specific -->
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
    <link href="access/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css" rel="stylesheet">

    <!-- Global Stylesheet -->
    <link href="access/css/style.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 20px;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .stats-card.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .stats-card.success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        .stats-card.warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .stats-card.info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .stats-icon {
            font-size: 40px;
            opacity: 0.8;
        }
        .stats-number {
            font-size: 28px;
            font-weight: bold;
            margin: 10px 0;
        }
        .stats-label {
            font-size: 14px;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div id="main-wrapper" class="dlab-overflow">
        @include('partials.header')
        @include('partials.sidebar')
        
        <div class="content-body">
            <div class="container-fluid">
                <!-- Tarjetas de estadísticas -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="stats-card primary">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="stats-number">{{ $clientes->total() }}</div>
                                    <div class="stats-label">Total Clientes</div>
                                </div>
                                <div class="stats-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="stats-card success">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="stats-number">{{ $clientesActivos }}</div>
                                    <div class="stats-label">Clientes Activos</div>
                                </div>
                                <div class="stats-icon">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="stats-card warning">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="stats-number">S/. {{ number_format($totalVentas, 2) }}</div>
                                    <div class="stats-label">Total Ventas</div>
                                </div>
                                <div class="stats-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="stats-card info">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="stats-number">{{ $mejorCliente->name ?? 'N/A' }}</div>
                                    <div class="stats-label">Mejor Cliente</div>
                                </div>
                                <div class="stats-icon">
                                    <i class="fas fa-crown"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de clientes -->
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
                                                <td>S/. {{ number_format($cliente->total_pagado, 2) }}</td>
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
                                    <input type="text" class="form-control" id="name" name="name" required
                                           pattern="[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+"
                                           title="Solo se permiten letras y espacios"
                                           minlength="2" maxlength="255">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="apellido" class="form-label">Apellido *</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" required
                                           pattern="[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+"
                                           title="Solo se permiten letras y espacios"
                                           minlength="2" maxlength="255">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required 
                                           >
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" 
                                           
                                           pattern="[0-9+\-\s]+" 
                                           title="Solo se permiten números"
                                           minlength="9" maxlength="15">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña *</label>
                            <input type="password" class="form-control" id="password" name="password" required 
                                   
                                   minlength="8">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña *</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required 
                                   >
                            <div class="invalid-feedback"></div>
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
                                    <input type="text" class="form-control" id="edit_name" name="name" required 
                                           pattern="[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+" 
                                           title="Solo se permiten letras y espacios"
                                           minlength="2" maxlength="255">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_apellido" class="form-label">Apellido *</label>
                                    <input type="text" class="form-control" id="edit_apellido" name="apellido" required 
                                           pattern="[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+" 
                                           title="Solo se permiten letras y espacios"
                                           minlength="2" maxlength="255">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="edit_email" name="email" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="edit_telefono" name="telefono" 
                                           pattern="[0-9+\-\s]+" 
                                           title="Solo se permiten números"
                                           minlength="9" maxlength="15">
                                    <div class="invalid-feedback"></div>
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="access/vendor/global/global.min.js"></script>
    <script src="access/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="access/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="access/vendor/swiper/js/swiper-bundle.min.js"></script>
    <script src="access/js/dlabnav-init.js"></script>
    <script src="access/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <script>

        // Validación en tiempo real
        function validateForm(form) {
            const inputs = form.querySelectorAll('input[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                const feedback = input.nextElementSibling;
                input.classList.remove('is-invalid');
                
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    feedback.textContent = 'Este campo es obligatorio';
                    isValid = false;
                } else if (input.name === 'name' || input.name === 'apellido') {
                    const nameRegex = /^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/;
                    if (!nameRegex.test(input.value) || input.value.length < 2) {
                        input.classList.add('is-invalid');
                        feedback.textContent = 'Solo se permiten letras y espacios (mínimo 2 caracteres)';
                        isValid = false;
                    }
                } else if (input.name === 'telefono' && input.value) {
                    const phoneRegex = /^[0-9+\-\s]+$/;
                    if (!phoneRegex.test(input.value) || input.value.length < 9) {
                        input.classList.add('is-invalid');
                        feedback.textContent = 'Solo números (mínimo 9 dígitos)';
                        isValid = false;
                    }
                } else if (input.name === 'password') {
                    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
                    if (!passwordRegex.test(input.value)) {
                        input.classList.add('is-invalid');
                        feedback.textContent = 'Mínimo 8 caracteres con mayúscula, minúscula y número';
                        isValid = false;
                    }
                } else if (input.name === 'password_confirmation') {
                    const password = form.querySelector('input[name="password"]').value;
                    if (input.value !== password) {
                        input.classList.add('is-invalid');
                        feedback.textContent = 'Las contraseñas no coinciden';
                        isValid = false;
                    }
                }
            });
            
            return isValid;
        }
        // Crear cliente
        document.getElementById('createClienteForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateForm(this)) {
                return;
            }
            
            const formData = new FormData(this);
            
            fetch('{{ route("clientes.store") }}', {
                method: 'POST',
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
                        text: 'Cliente creado exitosamente'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    let errorMessage = data.message || 'Error al crear cliente';
                    if (data.errors) {
                        errorMessage = Object.values(data.errors).flat().join('\n');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
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
            
            if (!validateForm(this)) {
                return;
            }
            
            const id = document.getElementById('edit_cliente_id').value;
            const formData = new FormData(this);
            
            fetch(`{{ url('clientes') }}/${id}`, {
                method: 'POST',
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
                    let errorMessage = data.message || 'Error al actualizar cliente';
                    if (data.errors) {
                        errorMessage = Object.values(data.errors).flat().join('\n');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
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
                                <p><strong>Total pagado:</strong> S/. ${data.total_pagado || 0}</p>
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