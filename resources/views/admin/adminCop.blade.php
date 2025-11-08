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
                    <!-- Distritos disponibles -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h4 class="card-title mb-0">Distritos disponibles</h4>
                                <button type="button" id="btnAdministrarDistritos" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDistritos">
                                    <i class="fa fa-pen"></i> Administrar
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tablaDistritosActivos" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <small class="text-muted">Se muestran solo los distritos activos. Para activar o desactivar distritos, usa el botón "Administrar".</small>
                            </div>
                        </div>
                    </div>

                    <!-- Configuración de Flujo de Pedidos -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Configuración de Flujo de Pedidos</h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-warning mb-3">
                                    <strong>Importante:</strong> Esta configuración define si los pedidos van directo a cocina o saltan directo a despacho.
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Modo de Operación Actual:</label>
                                            <div class="form-check form-switch form-check-lg">
                                                <input class="form-check-input" type="checkbox" id="switchFlujoPedidos">
                                                <label class="form-check-label" for="switchFlujoPedidos" id="labelFlujoPedidos">
                                                    Pedidos van a Cocina
                                                </label>
                                            </div>
                                            <small class="text-muted" id="descripcionFlujo">
                                                Los pedidos seguirán el flujo normal: Pedido → Cocina → Despacho
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="alert alert-info">
                                            <h6>Modos de Operación:</h6>
                                            <ul class="mb-0">
                                                <li><strong>Cocina:</strong> Pedido → Cocina → Despacho</li>
                                                <li><strong>Despacho Directo:</strong> Pedido → Despacho (automático)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Configuración de Impresiones -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Configuración de Impresiones</h4>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info mb-3">
                                    <strong>Información:</strong> Configura el comportamiento de las impresiones en el módulo de despacho.
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Método de Impresión:</label>
                                        <select id="selectMetodoImpresion" class="form-select">
                                            <option value="qztray">QZ Tray (Desktop)</option>
                                            <option value="servicio">Servicio Directo (Servidor)</option>
                                        </select>
                                        <small class="text-muted">Elige cómo se enviarán las impresiones.</small>
                                    </div>
                                    <div class="col-md-6" id="qzActions" style="display:none;">
                                        <label class="form-label">QZ Tray - Certificados</label>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <a class="btn btn-outline-primary" href="{{ route('qz.certificate') }}?download=1">
                                                <i class="fa fa-download"></i> Descargar Certificado
                                            </a>
                                            <a class="btn btn-outline-secondary" href="{{ url('/qz-test') }}" target="_blank">
                                                <i class="fa fa-vial"></i> Probar QZ Tray
                                            </a>
                                            <button type="button" id="btnInstruccionesQZ" class="btn btn-outline-info">
                                                <i class="fa fa-circle-info"></i> Instrucciones
                                            </button>
                                        </div>
                                        <small class="text-muted d-block mt-2">Importa el certificado en QZ Tray y autoriza el origen.</small>
                                    </div>
                                </div>

                                <!-- Nueva sección para configuración de impresora -->
                                <div class="row mb-4" id="sectionImpresoraPrincipal">
                                    <div class="col-md-8">
                                        <label class="form-label">Impresora Principal del Sistema:</label>
                                        <div class="input-group">
                                            <select id="selectImpresoraPrincipal" class="form-select">
                                                <option value="">Seleccionar impresora...</option>
                                            </select>
                                            <button type="button" id="btnCargarImpresoras" class="btn btn-outline-secondary">
                                                <i class="fa fa-sync"></i> Cargar
                                            </button>
                                        </div>
                                        <small class="text-muted">Esta impresora se usará automáticamente en el módulo de despacho. <span id="statusImpresora" class="text-info"></span></small>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Estado de Conexión:</label>
                                        <div class="d-flex align-items-center">
                                            <span id="estadoQzTray" class="badge bg-secondary">Cargando script...</span>
                                            <button type="button" id="btnTestConexion" class="btn btn-sm btn-outline-primary ms-2">
                                                <i class="fa fa-plug"></i> Probar
                                            </button>
                                        </div>
                                        <small class="text-muted">Verifica la conexión con QZ Tray.</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Impresión Automática:</label>
                                            <div class="form-check form-switch form-check-lg">
                                                <input class="form-check-input" type="checkbox" id="switchImpresionAutomatica">
                                                <label class="form-check-label" for="switchImpresionAutomatica" id="labelImpresionAutomatica">
                                                    No
                                                </label>
                                            </div>
                                            <small class="text-muted" id="descripcionImpresionAutomatica">
                                                Las boletas no se imprimen automáticamente al hacer clic
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Mostrar PDF:</label>
                                            <div class="form-check form-switch form-check-lg">
                                                <input class="form-check-input" type="checkbox" id="switchMostrarPdf">
                                                <label class="form-check-label" for="switchMostrarPdf" id="labelMostrarPdf">
                                                    No
                                                </label>
                                            </div>
                                            <small class="text-muted" id="descripcionMostrarPdf">
                                                No se muestra el PDF en pantalla al imprimir
                                            </small>
                                        </div>
                                    </div>
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
        <!-- Modal Distritos -->
        <div class="modal fade" id="modalDistritos">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Administrar Distritos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tablaDistritosAdmin" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalHoraLlegada">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Hora de Llegada</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formHoraLlegada">
                        <div class="modal-body">
                            <input type="hidden" id="horaId" name="id">

                            <div class="form-group mb-3">
                            <label class="text-black font-w500">Tipo</label>
                            <select id="horaTipo" name="tipo" class="form-control">
                                <option value="hora" selected>Minutos (ej. 15, 30, 45)</option>
                                <option value="rango">Rango horario (HH:MM - HH:MM)</option>
                            </select>
                            <div class="invalid-feedback" id="horaTipoError"></div>
                            </div>

                            <!-- Minutos -->
                            <div class="form-group mb-3 campo-hora">
                            <label class="text-black font-w500">Valor (minutos)</label>
                            <input type="number" id="horaValor" name="valor" class="form-control" min="1" max="1440" placeholder="Ej. 15">
                            <div class="invalid-feedback" id="horaValorError"></div>
                            </div>

                            <!-- Rango -->
                            <div class="row campo-rango" style="display:none;">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                <label class="text-black font-w500">Inicio</label>
                                <input type="time" id="horaInicio" name="inicio_rango" class="form-control" step="60">
                                <div class="invalid-feedback" id="horaInicioError"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                <label class="text-black font-w500">Fin</label>
                                <input type="time" id="horaFin" name="fin_rango" class="form-control" step="60">
                                <div class="invalid-feedback" id="horaFinError"></div>
                                </div>
                            </div>
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

        <!-- Modal Contraseña Flujo Pedidos -->
        <div class="modal fade" id="modalPasswordFlujo">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Autorización Requerida</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formPasswordFlujo">
                        <div class="modal-body">
                            <div class="alert alert-warning">
                                <strong>Atención:</strong> Se requiere contraseña especial para cambiar el flujo de pedidos.
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Contraseña:</label>
                                <input type="password" id="passwordFlujo" name="password" class="form-control" placeholder="Ingrese la contraseña especial">
                                <div class="invalid-feedback" id="passwordFlujoError"></div>
                            </div>
                            <input type="hidden" id="nuevoModoFlujo" name="modo">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Confirmar Cambio</button>
                        </div>
                    </form>
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
    
    <!-- QZ Tray Script -->
    <script src="https://cdn.jsdelivr.net/npm/qz-tray@2.2.4/qz-tray.min.js"></script>

    <!-- Datatable -->
    <script src="{{ asset('access/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('access/js/plugins-init/datatables.init.js') }}"></script>

    <!-- Dashboard -->
    <script src="{{ asset('access/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('access/js/custom.js') }}"></script>
    <script src="{{ asset('access/js/demo.js') }}"></script>

    <script>
    // Variables globales para QZ
    window.qzLoaded = false;
    window.qzSecurityConfigured = false;
    window.qzTrusted = false;

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Esperar a que QZ esté disponible
        function esperarQzTray() {
            return new Promise((resolve, reject) => {
                let intentos = 0;
                const maxIntentos = 20;
                
                function verificarQz() {
                    if (window.qz && qz.websocket) {
                        console.log('✅ QZ Tray script cargado y disponible');
                        window.qzLoaded = true;
                        resolve();
                    } else if (intentos < maxIntentos) {
                        intentos++;
                        setTimeout(verificarQz, 100);
                    } else {
                        reject('QZ Tray no se cargó después de 2 segundos');
                    }
                }
                
                verificarQz();
            });
        }

        // Inicializar QZ cuando esté listo
        esperarQzTray()
            .then(() => {
                console.log('🔧 QZ Tray listo para usar');
                $('#estadoQzTray').removeClass().addClass('badge bg-info').text('QZ Disponible');
                
                // Auto-restaurar estado después de que QZ esté listo
                setTimeout(() => {
                    autoReconectarYCargarImpresoras();
                }, 500);
            })
            .catch(error => {
                console.error('❌ Error cargando QZ Tray:', error);
                $('#estadoQzTray').removeClass().addClass('badge bg-warning').text('QZ no disponible');
            });

        // Función para auto-reconectar y cargar impresoras al recargar página
        function autoReconectarYCargarImpresoras() {
            // Solo auto-reconectar si el método es QZ Tray
            if ($('#selectMetodoImpresion').val() !== 'qztray') {
                return;
            }
            
            console.log('🔄 Auto-reconectando QZ Tray...');
            $('#estadoQzTray').removeClass().addClass('badge bg-warning').text('Reconectando...');
            
            configurarSeguridadQzAdmin()
                .then(() => {
                    return qz.websocket.connect();
                })
                .then(() => {
                    console.log('✅ QZ reconectado automáticamente');
                    $('#estadoQzTray').removeClass().addClass('badge bg-success').text('Conectado ✓');
                    
                    // Auto-cargar impresoras
                    return autoCargarImpresoras();
                })
                .catch(error => {
                    console.log('⚠️ No se pudo auto-reconectar QZ:', error);
                    $('#estadoQzTray').removeClass().addClass('badge bg-info').text('QZ Disponible');
                });
        }

        // Función para auto-cargar impresoras sin afectar UI
        function autoCargarImpresoras() {
            return qz.printers.find()
                .then(printers => {
                    console.log('🖨️ Auto-cargando', printers.length, 'impresoras...');
                    
                    // Limpiar y cargar opciones
                    $('#selectImpresoraPrincipal').empty().append('<option value="">Seleccionar impresora...</option>');
                    printers.forEach(printer => {
                        $('#selectImpresoraPrincipal').append(new Option(printer, printer));
                    });
                    
                    // Restaurar impresora configurada desde la base de datos
                    var impresoraConfigurada = $('#selectImpresoraPrincipal').data('current');
                    if (impresoraConfigurada && printers.includes(impresoraConfigurada)) {
                        $('#selectImpresoraPrincipal').val(impresoraConfigurada);
                        $('#statusImpresora').text('Configurada: ' + impresoraConfigurada).removeClass('text-warning text-danger').addClass('text-success');
                    }
                    
                    console.log('✅ Impresoras auto-cargadas y estado restaurado');
                })
                .catch(error => {
                    console.log('⚠️ Error auto-cargando impresoras:', error);
                });
        }

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
        var tablaDistritosActivos = $('#tablaDistritosActivos').DataTable($.extend(true, {}, opcionesTabla, {
            pageLength: 5,
            lengthChange: false
        }));
        var tablaDistritosAdmin = $('#tablaDistritosAdmin').DataTable(opcionesTabla);

        // Cargar datos iniciales
        cargarTiposPago();
        cargarComprobantes();
        cargarHorasLlegada();
        cargarConfiguracionFlujo();
        cargarConfiguracionImpresiones();
        cargarDistritosActivos();
        function cargarDistritosActivos() {
            $.ajax({
                url: '{{ route("admin.distritos.activos") }}',
                method: 'GET',
                success: function(response) {
                    tablaDistritosActivos.clear();
                    $.each(response, function(index, item) {
                        var estadoBadge = item.estado == 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>';
                        tablaDistritosActivos.row.add([
                            item.id,
                            item.nombre,
                            estadoBadge
                        ]).draw(false);
                    });
                }
            });
        }

        function cargarDistritosAdmin() {
            $.ajax({
                url: '{{ route("admin.distritos.listar") }}',
                method: 'GET',
                success: function(response) {
                    tablaDistritosAdmin.clear();
                    $.each(response, function(index, item) {
                        var estadoBadge = item.estado == 1 ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>';
                        var btn = '<button class="btn btn-info btn-sm toggleEstadoDistrito" data-id="'+ item.id +'">Cambiar estado</button>';
                        tablaDistritosAdmin.row.add([
                            item.id,
                            item.nombre,
                            estadoBadge,
                            btn
                        ]).draw(false);
                    });
                }
            });
        }

        // Abrir modal y cargar distritos
        $('#modalDistritos').on('shown.bs.modal', function(){
            cargarDistritosAdmin();
        });

        // Cambiar estado distrito
        $(document).on('click', '.toggleEstadoDistrito', function(){
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.distritos.cambiarEstado") }}',
                method: 'POST',
                data: { id: id },
                success: function(resp){
                    Swal.fire({
                        title: 'Éxito',
                        text: resp.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    cargarDistritosAdmin();
                    cargarDistritosActivos();
                }
            });
        });

        // Toggle de campos por tipo (hora vs rango)
        function toggleCamposHoraTipo() {
            var tipo = $('#horaTipo').val();
            if (tipo === 'rango') {
                $('.campo-hora').hide();
                $('.campo-rango').show();
            } else {
                $('.campo-rango').hide();
                $('.campo-hora').show();
            }
        }
        $(document).on('change', '#horaTipo', toggleCamposHoraTipo);
        $('#modalHoraLlegada').on('show.bs.modal', toggleCamposHoraTipo);

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

                        $('#horaTipo, #horaValor, #horaInicio, #horaFin').removeClass('is-invalid');
                        $('#horaTipoError, #horaValorError, #horaInicioError, #horaFinError').text('');

                        if (errors.tipo) {
                            $('#horaTipo').addClass('is-invalid');
                            $('#horaTipoError').text(errors.tipo[0]);
                        }
                        if (errors.valor) {
                            $('#horaValor').addClass('is-invalid');
                            $('#horaValorError').text(errors.valor[0]);
                        }
                        if (errors.inicio_rango) {
                            $('#horaInicio').addClass('is-invalid');
                            $('#horaInicioError').text(errors.inicio_rango[0]);
                        }
                        if (errors.fin_rango) {
                            $('#horaFin').addClass('is-invalid');
                            $('#horaFinError').text(errors.fin_rango[0]);
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
                            (function(){
                                var badge = (item.tipo === 'rango')
                                    ? '<span class="badge bg-secondary me-1">Rango</span>'
                                    : '<span class="badge bg-primary me-1">Min</span>';
                                var texto = (item.tipo === 'rango')
                                    ? ((item.inicio_rango || '').toString().substring(0,5) + ' - ' + (item.fin_rango || '').toString().substring(0,5))
                                    : (((item.valor != null) ? item.valor : '') + ' min');
                                return badge + texto;
                            })(),
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

        function cargarConfiguracionFlujo() {
            $.ajax({
                url: '{{ route("admin.configuracion.obtenerFlujo") }}',
                method: 'GET',
                success: function(response) {
                    var esCocina = response.flujo === 'cocina';
                    $('#switchFlujoPedidos').prop('checked', !esCocina); // Invertido porque switch off = cocina
                    
                    if (esCocina) {
                        $('#labelFlujoPedidos').text('Pedidos van a Cocina');
                        $('#descripcionFlujo').text('Los pedidos seguirán el flujo normal: Pedido → Cocina → Despacho');
                    } else {
                        $('#labelFlujoPedidos').text('Pedidos van Directo a Despacho');
                        $('#descripcionFlujo').text('Los pedidos saltarán cocina y irán directo: Pedido → Despacho');
                    }
                },
                error: function() {
                    console.error('Error al cargar configuración de flujo');
                }
            });
        }

        function cargarConfiguracionImpresiones() {
            $.ajax({
                url: '{{ route("admin.configuracion.obtenerImpresiones") }}',
                method: 'GET',
                success: function(response) {
                    var impresionAutomatica = response.impresion_automatica === '1';
                    var mostrarPdf = response.mostrar_pdf === '1';
                    var metodo = response.metodo_impresion || 'qztray';
                    var impresoraPrincipal = response.impresora_principal || '';
                    
                    $('#switchImpresionAutomatica').prop('checked', impresionAutomatica);
                    $('#switchMostrarPdf').prop('checked', mostrarPdf);
                    $('#selectMetodoImpresion').val(metodo);
                    toggleQzActions(metodo);
                    toggleSeccionImpresora(metodo);
                    
                    // Configurar impresora principal
                    if (impresoraPrincipal) {
                        // Guardar como data attribute para restaurar después
                        $('#selectImpresoraPrincipal').data('current', impresoraPrincipal);
                        $('#selectImpresoraPrincipal').append(new Option(impresoraPrincipal, impresoraPrincipal, true, true));
                        $('#statusImpresora').text('Configurada: ' + impresoraPrincipal).removeClass('text-danger').addClass('text-success');
                    } else {
                        $('#selectImpresoraPrincipal').data('current', '');
                        $('#statusImpresora').text('No configurada').removeClass('text-success').addClass('text-warning');
                    }
                    
                    // Actualizar labels
                    $('#labelImpresionAutomatica').text(impresionAutomatica ? 'Sí' : 'No');
                    $('#labelMostrarPdf').text(mostrarPdf ? 'Sí' : 'No');
                    
                    // Actualizar descripciones
                    $('#descripcionImpresionAutomatica').text(
                        impresionAutomatica 
                            ? 'Las boletas se imprimen automáticamente al hacer clic'
                            : 'Las boletas no se imprimen automáticamente al hacer clic'
                    );
                    
                    $('#descripcionMostrarPdf').text(
                        mostrarPdf 
                            ? 'Se muestra el PDF en pantalla al imprimir'
                            : 'No se muestra el PDF en pantalla al imprimir'
                    );
                },
                error: function() {
                    console.error('Error al cargar configuración de impresiones');
                }
            });
        }

        function toggleQzActions(metodo) {
            if (metodo === 'qztray') {
                $('#qzActions').slideDown(150);
            } else {
                $('#qzActions').slideUp(150);
            }
        }

        function toggleSeccionImpresora(metodo) {
            if (metodo === 'qztray') {
                $('#sectionImpresoraPrincipal').slideDown(150);
            } else {
                $('#sectionImpresoraPrincipal').slideUp(150);
            }
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
                    $('#horaTipo, #horaValor, #horaInicio, #horaFin').removeClass('is-invalid');
                    $('#horaTipoError, #horaValorError, #horaInicioError, #horaFinError').text('');

                    $('#horaId').val(response.id);
                    $('#horaTipo').val(response.tipo || 'hora').trigger('change');

                    if ((response.tipo || 'hora') === 'hora') {
                        $('#horaValor').val(response.valor || '');
                        $('#horaInicio').val('');
                        $('#horaFin').val('');
                    } else {
                        $('#horaValor').val('');
                        $('#horaInicio').val(response.inicio_rango || '');
                        $('#horaFin').val(response.fin_rango || '');
                    }

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
            $('#horaId').val('');
            $('#horaTipo').val('hora');
            $('.campo-rango').hide();
            $('.campo-hora').show();
            $('#horaTipo, #horaValor, #horaInicio, #horaFin').removeClass('is-invalid');
            $('#horaTipoError, #horaValorError, #horaInicioError, #horaFinError').text('');
            $('#modalHoraLlegada .modal-title').text('Agregar Hora de Llegada');
        });

        // Cambiar configuración de impresión automática
        $('#switchImpresionAutomatica').on('change', function() {
            var isChecked = $(this).is(':checked');
            
            $.ajax({
                url: '{{ route("admin.configuracion.cambiarImpresionAutomatica") }}',
                method: 'POST',
                data: { impresion_automatica: isChecked ? '1' : '0' },
                success: function(response) {
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    // Actualizar label y descripción
                    $('#labelImpresionAutomatica').text(isChecked ? 'Sí' : 'No');
                    $('#descripcionImpresionAutomatica').text(
                        isChecked 
                            ? 'Las boletas se imprimen automáticamente al hacer clic'
                            : 'Las boletas no se imprimen automáticamente al hacer clic'
                    );
                },
                error: function() {
                    // Revertir el switch si hay error
                    $('#switchImpresionAutomatica').prop('checked', !isChecked);
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo cambiar la configuración',
                        icon: 'error'
                    });
                }
            });
        });

        // Cambiar configuración de mostrar PDF
        $('#switchMostrarPdf').on('change', function() {
            var isChecked = $(this).is(':checked');
            
            $.ajax({
                url: '{{ route("admin.configuracion.cambiarMostrarPdf") }}',
                method: 'POST',
                data: { mostrar_pdf: isChecked ? '1' : '0' },
                success: function(response) {
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    // Actualizar label y descripción
                    $('#labelMostrarPdf').text(isChecked ? 'Sí' : 'No');
                    $('#descripcionMostrarPdf').text(
                        isChecked 
                            ? 'Se muestra el PDF en pantalla al imprimir'
                            : 'No se muestra el PDF en pantalla al imprimir'
                    );
                },
                error: function() {
                    // Revertir el switch si hay error
                    $('#switchMostrarPdf').prop('checked', !isChecked);
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo cambiar la configuración',
                        icon: 'error'
                    });
                }
            });
        });

        // Cambiar método de impresión
        $('#selectMetodoImpresion').on('change', function() {
            var metodo = $(this).val();
            $.ajax({
                url: '{{ route("admin.configuracion.cambiarMetodoImpresion") }}',
                method: 'POST',
                data: { metodo_impresion: metodo },
                success: function(response) {
                    toggleQzActions(metodo);
                    toggleSeccionImpresora(metodo);
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function() {
                    Swal.fire({ title:'Error', text:'No se pudo cambiar el método', icon:'error' });
                    // revertir
                    cargarConfiguracionImpresiones();
                }
            });
        });

        // Instrucciones QZ
        $('#btnInstruccionesQZ').on('click', function() {
            var qzTestUrl = "{{ url('/qz-test') }}";
            var certificateUrl = "{{ url('/qz/certificate?download=1') }}";
            Swal.fire({
                title: 'Configurar QZ Tray',
                html: '<div style="text-align:left">'
                    + '<h6>📋 Pasos de configuración:</h6>'
                    + '<ol>'
                    + '<li><strong>Descargar QZ Tray:</strong> Instala desde <a href="https://qz.io/download/" target="_blank">qz.io/download</a></li>'
                    + '<li><strong>Descargar certificado:</strong> <a href="' + certificateUrl + '" target="_blank">Haz clic aquí para descargar</a></li>'
                    + '<li><strong>Instalar certificado:</strong> En QZ Tray → Advanced → Trusted Sites → Add Certificate</li>'
                    + '<li><strong>Reiniciar QZ Tray:</strong> Cierra y abre QZ Tray completamente</li>'
                    + '<li><strong>Autorizar sitio:</strong> Ve a <a href="' + qzTestUrl + '" target="_blank">página de prueba QZ</a> y autoriza</li>'
                    + '<li><strong>Configurar aquí:</strong> Regresa y usa "Cargar Impresoras"</li>'
                    + '</ol>'
                    + '<div class="alert alert-success mt-2">'
                    + '<strong>✅ Certificado Multi-Dominio:</strong> Funciona tanto para desarrollo (estacion90.test) como producción (estacion90.pe).'
                    + '</div>'
                    + '<div class="alert alert-info mt-2">'
                    + '<strong>🔄 Automático:</strong> El mismo certificado funcionará en ambos entornos sin cambios.'
                    + '</div>'
                    + '<div class="alert alert-warning mt-2">'
                    + '<strong>⚠️ Importante:</strong> Si ya tenías un certificado anterior, elimínalo primero.'
                    + '</div>'
                    + '</div>',
                icon: 'info',
                width: '700px',
                confirmButtonText: 'Entendido',
                showCancelButton: true,
                cancelButtonText: 'Ir a página de prueba'
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.cancel) {
                    window.open(qzTestUrl, '_blank');
                }
            });
        });

        // Cargar impresoras desde QZ Tray
        $('#btnCargarImpresoras').on('click', function() {
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Cargando...');
            $('#estadoQzTray').removeClass().addClass('badge bg-warning').text('Conectando...');
            
            // Verificar si QZ está disponible
            if (!window.qzLoaded || !window.qz) {
                $('#estadoQzTray').removeClass().addClass('badge bg-danger').text('QZ no disponible');
                btn.prop('disabled', false).html('<i class="fa fa-sync"></i> Cargar');
                Swal.fire({
                    title: 'QZ Tray no disponible',
                    text: 'El script QZ no se ha cargado completamente. Espera unos segundos e inténtalo de nuevo.',
                    icon: 'warning',
                    confirmButtonText: 'Abrir QZ Test',
                    showCancelButton: true,
                    cancelButtonText: 'Reintentar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open('{{ url("/qz-test") }}', '_blank');
                    } else if (result.isDismissed) {
                        // Reintentar después de un momento
                        setTimeout(() => {
                            if (window.qz) {
                                window.qzLoaded = true;
                                $('#btnCargarImpresoras').click();
                            }
                        }, 1000);
                    }
                });
                return;
            }
            
            // Si ya está conectado, solo recargar impresoras
            if (qz.websocket.isActive()) {
                console.log('QZ ya conectado, recargando impresoras...');
                $('#estadoQzTray').removeClass().addClass('badge bg-success').text('Conectado ✓');
                listarImpresorasDisponibles(btn);
                return;
            }
            
            conectarYCargarImpresoras(btn);
        });

        // Configurar seguridad QZ para admin (simplificado)
        function configurarSeguridadQzAdmin() {
            // Solo configurar si QZ está disponible y no se ha configurado ya
            if (!window.qz || !qz.security) {
                console.log('QZ no disponible para configurar seguridad');
                return Promise.reject('QZ no disponible');
            }
            
            // Verificar si ya está configurado globalmente
            if (window.qzSecurityConfigured && window.qzTrusted) {
                console.log('QZ ya configurado globalmente');
                return Promise.resolve();
            }
            
            return new Promise((resolve, reject) => {
                try {
                    qz.security.setCertificatePromise(function() {
                        return function(resolveInner, rejectInner) {
                            fetch('{{ route("qz.certificate") }}', {
                                credentials: 'same-origin',
                                headers: { 'Accept': 'text/plain' }
                            })
                            .then(resp => resp.ok ? resp.text() : Promise.reject('Error obteniendo certificado'))
                            .then(cert => resolveInner(cert))
                            .catch(err => rejectInner(err));
                        };
                    });
                    
                    qz.security.setSignaturePromise(function(toSign) {
                        return function(resolveInner, rejectInner) {
                            fetch('{{ route("qz.sign") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'text/plain',
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    'Accept': 'text/plain'
                                },
                                body: toSign
                            })
                            .then(resp => resp.ok ? resp.text() : Promise.reject('Error firmando'))
                            .then(sig => resolveInner(sig.trim()))
                            .catch(err => rejectInner(err));
                        };
                    });
                    
                    resolve();
                } catch (e) {
                    reject(e);
                }
            });
        }

        function conectarYCargarImpresoras(btn) {
            // Verificar si ya está conectado
            if (qz.websocket.isActive()) {
                console.log('QZ ya está conectado, listando impresoras...');
                $('#estadoQzTray').removeClass().addClass('badge bg-success').text('Conectado ✓');
                listarImpresorasDisponibles(btn);
                return;
            }
            
            // Configurar seguridad y conectar
            configurarSeguridadQzAdmin()
                .then(() => {
                    console.log('Seguridad configurada, conectando...');
                    return qz.websocket.connect();
                })
                .then(() => {
                    console.log('Conexión establecida, listando impresoras...');
                    $('#estadoQzTray').removeClass().addClass('badge bg-success').text('Conectado ✓');
                    return listarImpresorasDisponibles(btn);
                })
                .catch(error => {
                    console.error('Error en conexión QZ:', error);
                    $('#estadoQzTray').removeClass().addClass('badge bg-danger').text('Error');
                    Swal.fire({
                        title: 'Error de Conexión', 
                        text: 'No se pudo conectar con QZ Tray. Asegúrate de que esté ejecutándose y que hayas autorizado el certificado.',
                        icon: 'error',
                        footer: '<a href="{{ url("/qz-test") }}" target="_blank">Abrir página de prueba QZ</a>'
                    });
                    btn.prop('disabled', false).html('<i class="fa fa-sync"></i> Cargar');
                });
        }
        
        function listarImpresorasDisponibles(btn) {
            return qz.printers.find()
                .then(printers => {
                    console.log('Impresoras encontradas:', printers);
                    
                    // Guardar selección actual antes de limpiar
                    var seleccionActual = $('#selectImpresoraPrincipal').val();
                    var impresoraConfigurada = $('#selectImpresoraPrincipal').data('current');
                    
                    $('#selectImpresoraPrincipal').empty().append('<option value="">Seleccionar impresora...</option>');
                    
                    printers.forEach(printer => {
                        $('#selectImpresoraPrincipal').append(new Option(printer, printer));
                    });
                    
                    // Restaurar selección en orden de prioridad: actual > configurada
                    var impresoraARestaurar = seleccionActual || impresoraConfigurada;
                    if (impresoraARestaurar && printers.includes(impresoraARestaurar)) {
                        $('#selectImpresoraPrincipal').val(impresoraARestaurar);
                        if (impresoraARestaurar === impresoraConfigurada) {
                            $('#statusImpresora').text('Configurada: ' + impresoraARestaurar).removeClass('text-warning text-danger').addClass('text-success');
                        }
                    }
                    
                    Swal.fire({
                        title: 'Éxito',
                        text: `Se encontraron ${printers.length} impresora(s) disponible(s)`,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                })
                .catch(error => {
                    console.error('Error listando impresoras:', error);
                    Swal.fire('Error', 'No se pudieron listar las impresoras: ' + error.message, 'error');
                })
                .finally(() => {
                    if (btn) {
                        btn.prop('disabled', false).html('<i class="fa fa-sync"></i> Cargar');
                    }
                });
        }

        // Test de conexión QZ
        $('#btnTestConexion').on('click', function() {
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $('#estadoQzTray').removeClass().addClass('badge bg-warning').text('Probando...');
            
            if (!window.qzLoaded || !window.qz) {
                $('#estadoQzTray').removeClass().addClass('badge bg-danger').text('QZ no cargado');
                btn.prop('disabled', false).html('<i class="fa fa-plug"></i> Probar');
                Swal.fire({
                    title: 'QZ Tray no disponible',
                    text: 'El script QZ no se ha cargado completamente. Espera unos segundos o abre la página de prueba QZ.',
                    icon: 'warning',
                    confirmButtonText: 'Abrir QZ Test',
                    showCancelButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open('{{ url("/qz-test") }}', '_blank');
                    }
                });
                return;
            }
            
            // Si ya está conectado, solo verificar
            if (qz.websocket.isActive()) {
                $('#estadoQzTray').removeClass().addClass('badge bg-success').text('✓ Conectado');
                btn.prop('disabled', false).html('<i class="fa fa-plug"></i> Probar');
                Swal.fire({
                    title: 'Conexión Activa',
                    text: 'QZ Tray ya está conectado y funcionando correctamente.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
                return;
            }
            
            // Intentar conectar
            configurarSeguridadQzAdmin()
                .then(() => qz.websocket.connect())
                .then(() => {
                    $('#estadoQzTray').removeClass().addClass('badge bg-success').text('✓ Conectado');
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Conexión con QZ Tray establecida correctamente',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                })
                .catch(error => {
                    $('#estadoQzTray').removeClass().addClass('badge bg-danger').text('✗ Error');
                    Swal.fire({
                        title: 'Error de Conexión', 
                        text: 'No se pudo conectar: ' + error.message,
                        icon: 'error',
                        footer: '<a href="{{ url("/qz-test") }}" target="_blank">Abrir página de prueba QZ</a>'
                    });
                })
                .finally(() => {
                    btn.prop('disabled', false).html('<i class="fa fa-plug"></i> Probar');
                });
        });

        // Cambio de impresora principal
        $('#selectImpresoraPrincipal').on('change', function() {
            var impresora = $(this).val();
            
            if (!impresora) {
                $('#statusImpresora').text('No seleccionada').removeClass('text-success').addClass('text-warning');
                return;
            }
            
            $.ajax({
                url: '{{ route("admin.configuracion.cambiarImpresoraPrincipal") }}',
                method: 'POST',
                data: { impresora_principal: impresora },
                success: function(response) {
                    $('#statusImpresora').text('Configurada: ' + impresora).removeClass('text-warning text-danger').addClass('text-success');
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function() {
                    $('#statusImpresora').text('Error al configurar').removeClass('text-success text-warning').addClass('text-danger');
                    Swal.fire('Error', 'No se pudo configurar la impresora principal', 'error');
                }
            });
        });

         // Cambiar flujo de pedidos - solicitar contraseña
        $('#switchFlujoPedidos').on('change', function() {
            var isChecked = $(this).is(':checked');
            var modo = isChecked ? 'despacho' : 'cocina';
            
            // Guardar el modo que se quiere cambiar
            $('#nuevoModoFlujo').val(modo);
            
            // Revertir el switch temporalmente
            $(this).prop('checked', !isChecked);
            
            // Mostrar modal de contraseña
            $('#modalPasswordFlujo').modal('show');
            $('#passwordFlujo').val('').focus();
            $('#passwordFlujo').removeClass('is-invalid');
            $('#passwordFlujoError').text('');
        });

        // Procesar cambio de flujo con contraseña
        $('#formPasswordFlujo').on('submit', function(e) {
            e.preventDefault();
            
            var password = $('#passwordFlujo').val();
            var modo = $('#nuevoModoFlujo').val();
            
            $.ajax({
                url: '{{ route("admin.configuracion.cambiarFlujo") }}',
                method: 'POST',
                data: { 
                    modo: modo,
                    password: password
                },
                success: function(response) {
                    $('#modalPasswordFlujo').modal('hide');
                    
                    Swal.fire({
                        title: 'Éxito',
                        text: response.message,
                        icon: 'success',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    
                    // Recargar configuración
                    cargarConfiguracionFlujo();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;

                    $('#horaTipo, #horaValor, #horaInicio, #horaFin').removeClass('is-invalid');
                    $('#horaTipoError, #horaValorError, #horaInicioError, #horaFinError').text('');

                    if (errors.tipo) {
                        $('#horaTipo').addClass('is-invalid');
                        $('#horaTipoError').text(errors.tipo[0]);
                    }
                    if (errors.valor) {
                        $('#horaValor').addClass('is-invalid');
                        $('#horaValorError').text(errors.valor[0]);
                    }
                    if (errors.inicio_rango) {
                        $('#horaInicio').addClass('is-invalid');
                        $('#horaInicioError').text(errors.inicio_rango[0]);
                    }
                    if (errors.fin_rango) {
                        $('#horaFin').addClass('is-invalid');
                        $('#horaFinError').text(errors.fin_rango[0]);
                    }
                    } else if (xhr.status === 403) {
                        $('#passwordFlujo').addClass('is-invalid');
                        $('#passwordFlujoError').text('Contraseña incorrecta');
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo cambiar la configuración',
                            icon: 'error'
                        });
                    }
                }
            });
        });

        // Reset modal contraseña
        $('#modalPasswordFlujo').on('hidden.bs.modal', function() {
            $('#formPasswordFlujo')[0].reset();
            $('#passwordFlujo').removeClass('is-invalid');
            $('#passwordFlujoError').text('');
        });

        // Formatear fecha
        function formatFecha(fecha) {
            if (!fecha) return 'N/A';
            var date = new Date(fecha);
            return date.toLocaleString();
        }
    });

    function toggleCamposHoraTipo() {
        var tipo = $('#horaTipo').val();
        if (tipo === 'rango') {
            $('.campo-hora').hide();
            $('.campo-rango').show();
        } else {
            $('.campo-rango').hide();
            $('.campo-hora').show();
        }
    }
    $(document).on('change', '#horaTipo', toggleCamposHoraTipo);
    $('#modalHoraLlegada').on('show.bs.modal', function () {
        if (!$('#horaTipo').val()) $('#horaTipo').val('hora');
        toggleCamposHoraTipo();
    });

    </script>
</body>

</html>