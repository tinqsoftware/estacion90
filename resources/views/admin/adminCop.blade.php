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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Mobile Specific -->
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

    <!-- Datatable -->
    <link href="{{ asset('access/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">

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

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Administración</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Configuración Operativa</a></li>
                    </ol>
                </div>

                <!-- Row -->
                <div class="row">
                    <!-- Tipos de Pago -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tipos de Pago</h4>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalTipoPago">
                                    <i class="fa fa-plus"></i> Agregar Tipo de Pago
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tablaTiposPago" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Creado por</th>
                                                <th>Fecha creación</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comprobantes de Pago -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Comprobantes de Pago</h4>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalComprobante">
                                    <i class="fa fa-plus"></i> Agregar Comprobante
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tablaComprobantes" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Creado por</th>
                                                <th>Fecha creación</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Horas de Llegada -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Horas de Llegada</h4>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalHoraLlegada">
                                    <i class="fa fa-plus"></i> Agregar Hora
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info mb-3">
                                    <strong>Nota:</strong> Estos valores representan los minutos de llegada desde que se
                                    realiza el pedido hasta la entrega.
                                </div>
                                <div class="table-responsive">
                                    <table id="tablaHorasLlegada" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Valor</th>
                                                <th>Creado por</th>
                                                <th>Fecha creación</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tipo de Pago -->
        <div class="modal fade" id="modalTipoPago">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Tipo de Pago</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formTipoPago">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="text-black font-w500">Nombre</label>
                                <input type="text" id="tipoPagoNombre" name="nombre" class="form-control">
                                <div class="invalid-feedback" id="tipoPagoNombreError"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Comprobante -->
        <div class="modal fade" id="modalComprobante">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Comprobante de Pago</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formComprobante">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="text-black font-w500">Nombre</label>
                                <input type="text" id="comprobanteNombre" name="nombre" class="form-control">
                                <div class="invalid-feedback" id="comprobanteNombreError"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Hora Llegada -->
        <div class="modal fade" id="modalHoraLlegada">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Hora de Llegada</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formHoraLlegada">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="text-black font-w500">Valor</label>
                                <input type="hidden" id="horaId" name="id">
                                <input type="text" id="horaValor" name="valor" class="form-control">
                                <div class="invalid-feedback" id="horaValorError"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer start -->
        <div class="footer">
            <div class="copyright border-top">
                <p>estacion90 © Desarrollador por <a href="https://tinq.pe" target="_blank">Tinq Sofware</a> 2025</p>
            </div>
        </div>
        <!-- Footer end -->

    </div>

    <!-- Required vendors -->
    <script src="{{ asset('access/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('access/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/swiper/js/swiper-bundle.min.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('access/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('access/js/plugins-init/datatables.init.js') }}"></script>

    <!-- Dashboard -->
    <script src="{{ asset('access/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('access/js/custom.js') }}"></script>
    <script src="{{ asset('access/js/demo.js') }}"></script>

    <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // DataTables Inicialización
        var opcionesTabla = {
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json',
                paginate: {
                    previous: '<',
                    next: '>'
                }
            }
        };

        var tablaTiposPago = $('#tablaTiposPago').DataTable(opcionesTabla);
        var tablaComprobantes = $('#tablaComprobantes').DataTable(opcionesTabla);
        var tablaHorasLlegada = $('#tablaHorasLlegada').DataTable(opcionesTabla);

        // Cargar datos iniciales
        cargarTiposPago();
        cargarComprobantes();
        cargarHorasLlegada();

        // Formulario Tipo Pago
        $('#formTipoPago').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route("admin.tipoPago.guardar") }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#modalTipoPago').modal('hide');
                    $('#formTipoPago')[0].reset();

                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    cargarTiposPago();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        if (errors.nombre) {
                            $('#tipoPagoNombre').addClass('is-invalid');
                            $('#tipoPagoNombreError').text(errors.nombre[0]);
                        }
                    }
                }
            });
        });

        // Formulario Comprobante
        $('#formComprobante').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route("admin.comprobante.guardar") }}',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#modalComprobante').modal('hide');
                    $('#formComprobante')[0].reset();

                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    cargarComprobantes();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        if (errors.nombre) {
                            $('#comprobanteNombre').addClass('is-invalid');
                            $('#comprobanteNombreError').text(errors.nombre[0]);
                        }
                    }
                }
            });
        });

        // Formulario Hora Llegada
        $('#formHoraLlegada').on('submit', function(e) {
            e.preventDefault();

            var horaId = $('#horaId').val();
            var url = horaId ?
                '{{ route("admin.horaLlegada.actualizar") }}' :
                '{{ route("admin.horaLlegada.guardar") }}';

            $.ajax({
                url: url,
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#modalHoraLlegada').modal('hide');
                    $('#formHoraLlegada')[0].reset();

                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    cargarHorasLlegada();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        if (errors.valor) {
                            $('#horaValor').addClass('is-invalid');
                            $('#horaValorError').text(errors.valor[0]);
                        }
                    }
                }
            });
        });

        // Funciones para cargar datos
        function cargarTiposPago() {
            $.ajax({
                url: '{{ route("admin.tipoPago.listar") }}',
                method: 'GET',
                success: function(response) {
                    tablaTiposPago.clear();

                    $.each(response, function(index, item) {
                        var estadoBtn = item.estado == 1 ?
                            '<button class="btn btn-success btn-sm cambiarEstadoTipoPago" data-id="' +
                            item.id + '">Activo</button>' :
                            '<button class="btn btn-danger btn-sm cambiarEstadoTipoPago" data-id="' +
                            item.id + '">Inactivo</button>';

                        tablaTiposPago.row.add([
                            item.id,
                            item.nombre,
                            item.creador ? item.creador.name : 'N/A',
                            formatFecha(item.created_at),
                            estadoBtn,
                            '<button class="btn btn-info btn-sm toggleEstadoTipoPago" data-id="' +
                            item.id +
                            '"><i class="fa fa-sync"></i> Cambiar estado</button>'
                        ]).draw(false);
                    });
                }
            });
        }

        function cargarComprobantes() {
            $.ajax({
                url: '{{ route("admin.comprobante.listar") }}',
                method: 'GET',
                success: function(response) {
                    tablaComprobantes.clear();

                    $.each(response, function(index, item) {
                        var estadoBtn = item.estado == 1 ?
                            '<button class="btn btn-success btn-sm">Activo</button>' :
                            '<button class="btn btn-danger btn-sm">Inactivo</button>';

                        tablaComprobantes.row.add([
                            item.id,
                            item.nombre,
                            item.creador ? item.creador.name : 'N/A',
                            formatFecha(item.created_at),
                            estadoBtn,
                            '<button class="btn btn-info btn-sm toggleEstadoComprobante" data-id="' +
                            item.id +
                            '"><i class="fa fa-sync"></i> Cambiar estado</button>'
                        ]).draw(false);
                    });
                }
            });
        }

        function cargarHorasLlegada() {
            $.ajax({
                url: '{{ route("admin.horaLlegada.listar") }}',
                method: 'GET',
                success: function(response) {
                    tablaHorasLlegada.clear();

                    $.each(response, function(index, item) {
                        var estadoBtn = item.estado == 1 ?
                            '<button class="btn btn-success btn-sm">Activo</button>' :
                            '<button class="btn btn-danger btn-sm">Inactivo</button>';

                        tablaHorasLlegada.row.add([
                            item.id,
                            item.valor,
                            item.creador ? item.creador.name : 'N/A',
                            formatFecha(item.created_at),
                            estadoBtn,
                            '<div class="d-flex">' +
                            '<button class="btn btn-primary btn-sm editarHoraLlegada me-1" data-id="' +
                            item.id + '"><i class="fa fa-edit"></i></button>' +
                            '<button class="btn btn-info btn-sm toggleEstadoHoraLlegada" data-id="' +
                            item.id + '"><i class="fa fa-sync"></i></button>' +
                            '</div>'
                        ]).draw(false);
                    });
                }
            });
        }

        // Acciones en tablas
        $(document).on('click', '.toggleEstadoTipoPago', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '{{ route("admin.tipoPago.cambiarEstado") }}',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    cargarTiposPago();
                }
            });
        });

        $(document).on('click', '.toggleEstadoComprobante', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '{{ route("admin.comprobante.cambiarEstado") }}',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    cargarComprobantes();
                }
            });
        });

        $(document).on('click', '.editarHoraLlegada', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '{{ route("admin.horaLlegada.obtener") }}',
                method: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    $('#horaId').val(response.id);
                    $('#horaValor').val(response.valor);
                    $('#modalHoraLlegada').modal('show');
                    $('#modalHoraLlegada .modal-title').text('Editar Hora de Llegada');
                }
            });
        });

        $(document).on('click', '.toggleEstadoHoraLlegada', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '{{ route("admin.horaLlegada.cambiarEstado") }}',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    cargarHorasLlegada();
                }
            });
        });

        // Reset modals
        $('#modalTipoPago').on('hidden.bs.modal', function() {
            $('#formTipoPago')[0].reset();
            $('#tipoPagoNombre').removeClass('is-invalid');
        });

        $('#modalComprobante').on('hidden.bs.modal', function() {
            $('#formComprobante')[0].reset();
            $('#comprobanteNombre').removeClass('is-invalid');
        });

        $('#modalHoraLlegada').on('hidden.bs.modal', function() {
            $('#formHoraLlegada')[0].reset();
            $('#horaValor').removeClass('is-invalid');
            $('#horaId').val('');
            $('#modalHoraLlegada .modal-title').text('Agregar Hora de Llegada');
        });

        // Formatear fecha
        function formatFecha(fecha) {
            if (!fecha) return 'N/A';
            var date = new Date(fecha);
            return date.toLocaleString();
        }
    });
    </script>
</body>

</html>