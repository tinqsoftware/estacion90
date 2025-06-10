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

    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .sidebar {
        /* Remove min-height: calc(100vh - 70px); */
        position: sticky;
        top: 20px;
        /* Adjust based on your header height */
        max-height: calc(100vh - 120px);
        overflow-y: auto;
    }

    .calendar-container {
        height: 35%;
        background-color: #f8f9fa;
        margin-top: 90px;
    }

    .calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 4px;
    }

    .calendar-day {
        aspect-ratio: 1/1;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.9rem;
        border-radius: 4px;
        background-color: #fff;
        transition: background-color 0.2s;
        border: 1px solid #ddd;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);

    }

    .calendar-day:hover {
        background-color: #e9ecef;
        border-color: #ced4da;

    }

    .calendar-day.empty {
        background-color: transparent;
        cursor: default;
    }

    .calendar-day.today {
        background-color: #f8d7da;
        font-weight: bold;
    }

    .content-body {
        display: flex;
        flex-direction: column;
    }

    .row {
        display: flex;
        flex-wrap: nowrap;
    }

    .calendar-day.active {
        background-color: #d1e7dd;
        font-weight: bold;
        border: 2px solid #198754;
        position: relative;
        z-index: 1;
    }

    /* Animation for active day to improve visibility */
    @keyframes active-day-pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    .calendar-day.just-activated {
        animation: active-day-pulse 0.5s ease-in-out;
    }

    /* Month navigation */
    .prev-month,
    .next-month {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    #current-month {
        font-size: 1.25rem;
        margin: 0;
    }

    .loading {
        color: #6c757d;
    }

    .selected-menu {
        position: relative;
        border-left: 5px solid #17a2b8;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        background-color: #f8fdff;
        padding-left: 15px;
        animation: highlight-pulse 1.5s ease-in-out;
    }

    @keyframes highlight-pulse {
        0% {
            background-color: #f8fdff;
        }

        50% {
            background-color: #d1ecf1;
        }

        100% {
            background-color: #f8fdff;
        }
    }

    /* Indicator arrow for selected menu */
    .selected-menu::before {
        content: "▶";
        position: absolute;
        left: -25px;
        top: 50%;
        transform: translateY(-50%);
        color: #17a2b8;
        font-size: 20px;
        animation: arrow-pulse 1s infinite;
    }

    @keyframes arrow-pulse {
        0% {
            opacity: 0.5;
            left: -25px;
        }

        50% {
            opacity: 1;
            left: -20px;
        }

        100% {
            opacity: 0.5;
            left: -25px;
        }
    }


    /* Estilos para el modal de clonar menú */
    .modal-calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 4px;
    }

    .modal-calendar-grid .calendar-day {
        cursor: pointer;
        text-align: center;
        padding: 6px;
        border-radius: 4px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        aspect-ratio: 1/1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-calendar-grid .calendar-day.empty {
        background-color: transparent;
        border: none;
    }

    .modal-calendar-grid .calendar-day.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: #f5f5f5;
    }

    .modal-calendar-grid .calendar-day.has-menu {
        background-color: #d4edda;
        border-color: #c3e6cb;
        font-weight: bold;
    }

    .modal-calendar-grid .calendar-day.active {
        background-color: #007bff;
        color: white;
        border-color: #0056b3;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
        transform: scale(1.1);
        z-index: 2;
    }

    #modalClonarMenu .table-sm td {
        padding: 0.3rem;
        font-size: 0.875rem;
    }

    /* Botón Clonar Menú */
    .btn-clonar-menu {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }

    .btn-clonar-menu:hover {
        background-color: #138496;
        border-color: #117a8b;
        color: white;
    }
    </style>

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
                <header class="py-3 border-bottom">
                    <h1 class="fw-bold">MENÚ SEMANAL</h1>
                </header>

                <div class="row">
                    <!-- Sidebar con calendario -->
                    <div class="col-md-2 sidebar p-0">
                        <div class="calendar-container p-3 border">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button class="btn btn-sm btn-outline-secondary prev-month"><i
                                        class="bi bi-chevron-left"></i></button>
                                <h2 class="text-center mb-0" id="current-month">MAYO</h2>
                                <button class="btn btn-sm btn-outline-secondary next-month"><i
                                        class="bi bi-chevron-right"></i></button>
                            </div>
                            <div class="calendar-weekdays mb-1">
                                <div>D</div>
                                <div>L</div>
                                <div>M</div>
                                <div>M</div>
                                <div>J</div>
                                <div>V</div>
                                <div>S</div>
                            </div>
                            <div class="calendar-grid">
                                <!-- Days will be loaded here via AJAX -->
                                <div class="loading text-center py-3 w-100">Cargando...</div>
                            </div>
                        </div>
                        <br>

                    </div>

                    <!-- Contenido principal -->
                    <div class="col-md-10">
                        <div class="text-start">
                            <a href="javascript:void(0);" id="add-menu-btn" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus-circle me-2"></i>AGREGAR MENU
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <br>
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

        <div class="modal fade" id="modalClonarMenu" tabindex="-1" aria-labelledby="modalClonarMenuLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalClonarMenuLabel">Clonar Menú</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Calendario en el lado izquierdo -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button class="btn btn-sm btn-outline-secondary modal-prev-month">
                                                <i class="bi bi-chevron-left"></i>
                                            </button>
                                            <h5 class="mb-0" id="modal-current-month">MAYO</h5>
                                            <button class="btn btn-sm btn-outline-secondary modal-next-month">
                                                <i class="bi bi-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="calendar-weekdays mb-1">
                                            <div>D</div>
                                            <div>L</div>
                                            <div>M</div>
                                            <div>M</div>
                                            <div>J</div>
                                            <div>V</div>
                                            <div>S</div>
                                        </div>
                                        <div class="modal-calendar-grid">
                                            <!-- Días generados dinámicamente -->
                                            <div class="text-center">Cargando calendario...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabla del menú en el lado derecho -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Menú seleccionado: <span id="modal-selected-date">Seleccione
                                                una
                                                fecha</span></h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="modal-menu-content">
                                            <p class="text-center text-muted">Seleccione una fecha con menú para
                                                visualizar
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btn-copiar-menu" disabled>
                            <i class="fas fa-copy me-1"></i>Copiar este menú
                        </button>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Current date tracking
        let currentYear = new Date().getFullYear();
        let currentMonth = new Date().getMonth(); // 0-based (0 = January)

        // DOM elements
        const prevMonthButton = document.querySelector('.prev-month');
        const nextMonthButton = document.querySelector('.next-month');
        const currentMonthElement = document.getElementById('current-month');
        const calendarGridContainer = document.querySelector('.calendar-grid');

        // Variables para el modal de clonación
        let modalCurrentYear = new Date().getFullYear();
        let modalCurrentMonth = new Date().getMonth();
        let selectedMenuDate = null;
        let menuToClone = null;

        // Referencias a elementos del DOM del modal
        const modalCalendarGrid = document.querySelector('.modal-calendar-grid');
        const modalCurrentMonthElement = document.getElementById('modal-current-month');
        const modalPrevMonthButton = document.querySelector('.modal-prev-month');
        const modalNextMonthButton = document.querySelector('.modal-next-month');
        const modalSelectedDate = document.getElementById('modal-selected-date');
        const modalMenuContent = document.getElementById('modal-menu-content');
        const btnCopiarMenu = document.getElementById('btn-copiar-menu');

        // Event listeners para los botones de navegación del modal
        if (modalPrevMonthButton) {
            modalPrevMonthButton.addEventListener('click', function() {
                modalCurrentMonth--;
                if (modalCurrentMonth < 0) {
                    modalCurrentMonth = 11;
                    modalCurrentYear--;
                }
                renderModalCalendar(modalCurrentYear, modalCurrentMonth);
            });
        }

        if (modalNextMonthButton) {
            modalNextMonthButton.addEventListener('click', function() {
                modalCurrentMonth++;
                if (modalCurrentMonth > 11) {
                    modalCurrentMonth = 0;
                    modalCurrentYear++;
                }
                renderModalCalendar(modalCurrentYear, modalCurrentMonth);
            });
        }

        // Event listener para el botón "Clonar Menú"
        $(document).on('click', '.btn-clonar-menu', function() {
            const targetDate = $(this).data('date');

            // Resetear el estado del modal
            selectedMenuDate = null;
            menuToClone = null;
            btnCopiarMenu.disabled = true;
            modalMenuContent.innerHTML =
                '<p class="text-center text-muted">Seleccione una fecha con menú para visualizar</p>';
            modalSelectedDate.textContent = 'Seleccione una fecha';

            // Inicializar el calendario del modal
            const targetDateObj = new Date(targetDate + 'T12:00:00');
            modalCurrentYear = targetDateObj.getFullYear();
            modalCurrentMonth = targetDateObj.getMonth();

            renderModalCalendar(modalCurrentYear, modalCurrentMonth);

            // Mostrar el modal
            const modalClonarMenu = new bootstrap.Modal(document.getElementById('modalClonarMenu'));
            modalClonarMenu.show();
        });

        $(document).on('click', '.btn-clonar-directo', function() {
            const targetDate = $(this).data('date');

            // Format the date for display
            const targetDateObj = new Date(targetDate + 'T12:00:00');
            const targetDateFormatted = formatDateToSpanish(targetDate);

            // Show the first confirmation
            Swal.fire({
                title: 'Clonar Menú',
                html: `<p>Seleccione la fecha de origen para clonar el menú hacia <b>${targetDateFormatted}</b>:</p>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Seleccionar Fecha',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    // Show calendar picker dialog
                    return new Promise((resolve) => {
                        // Show a date picker
                        Swal.fire({
                            title: 'Seleccione Fecha de Origen',
                            html: '<div id="swal-datepicker" class="mb-3"></div>',
                            showCancelButton: true,
                            confirmButtonText: 'Continuar',
                            cancelButtonText: 'Cancelar',
                            didOpen: () => {
                                // Initialize date picker
                                let selectedDate = null;
                                let availableDates = [];

                                // Get current month/year
                                const today = new Date();
                                const currentYear = today.getFullYear();
                                const currentMonth = today.getMonth() +
                                    1; // 1-indexed for API

                                // Get all dates with menus
                                fetch(
                                        `/api/calendar-with-menu?year=${currentYear}&month=${currentMonth}`
                                        )
                                    .then(response => response.json())
                                    .then(data => {
                                        availableDates = data
                                            .days_with_menu || [];

                                        // Create calendar display
                                        const container = document
                                            .getElementById(
                                                'swal-datepicker');
                                        container.innerHTML =
                                            '<p>Cargando fechas disponibles...</p>';

                                        if (availableDates
                                            .length === 0) {
                                            container.innerHTML =
                                                '<p class="text-danger">No hay menús disponibles para clonar.</p>';
                                            return;
                                        }

                                        // Create buttons for each available date
                                        container.innerHTML =
                                            '<div class="d-flex flex-wrap gap-2 justify-content-center"></div>';
                                        const wrapper = container
                                            .querySelector('div');

                                        availableDates.forEach(
                                            date => {
                                                if (date ===
                                                    targetDate)
                                                    return; // Skip the target date

                                                const dateObj =
                                                    new Date(
                                                        date +
                                                        'T12:00:00'
                                                    );
                                                const btn =
                                                    document
                                                    .createElement(
                                                        'button'
                                                    );
                                                btn.className =
                                                    'btn btn-outline-secondary btn-sm date-option';
                                                btn.dataset
                                                    .date =
                                                    date;
                                                btn.innerHTML =
                                                    `${dateObj.getDate()}/${dateObj.getMonth()+1}`;
                                                btn.onclick =
                                                    () => {
                                                        document
                                                            .querySelectorAll(
                                                                '.date-option'
                                                            )
                                                            .forEach(
                                                                el =>
                                                                el
                                                                .classList
                                                                .remove(
                                                                    'btn-primary',
                                                                    'text-white'
                                                                )
                                                            );
                                                        btn.classList
                                                            .add(
                                                                'btn-primary',
                                                                'text-white'
                                                            );
                                                        selectedDate
                                                            =
                                                            date;
                                                    };
                                                wrapper
                                                    .appendChild(
                                                        btn);
                                            });
                                    })
                                    .catch(error => {
                                        container.innerHTML =
                                            `<p class="text-danger">Error: ${error.message}</p>`;
                                    });
                            }
                        }).then(result => {
                            if (result.isConfirmed) {
                                const selectedDate = document.querySelector(
                                        '.date-option.btn-primary')?.dataset
                                    .date;
                                if (!selectedDate) {
                                    Swal.showValidationMessage(
                                        'Por favor seleccione una fecha'
                                    );
                                    return false;
                                }
                                resolve(selectedDate);
                            } else {
                                resolve(null);
                            }
                        });
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then(result => {
                if (result.value) {
                    const sourceDate = result.value;
                    const sourceDateObj = new Date(sourceDate + 'T12:00:00');
                    const sourceDateFormatted = formatDateToSpanish(sourceDate);

                    // Final confirmation before cloning
                    Swal.fire({
                        title: 'Confirmar Clonación',
                        html: `¿Está seguro de clonar el menú de <b>${sourceDateFormatted}</b> a <b>${targetDateFormatted}</b>?
                       <p class="text-danger mt-2"><strong>¡Advertencia!</strong> Esta acción reemplazará todos los 
                       productos existentes para ${targetDateFormatted}.</p>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, Clonar',
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#d33'
                    }).then(confirmResult => {
                        if (confirmResult.isConfirmed) {
                            // Show loading
                            Swal.fire({
                                title: 'Procesando',
                                html: 'Clonando menú, por favor espere...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Perform the cloning via AJAX
                            fetch(`/api/menu-clone`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify({
                                        source_date: sourceDate,
                                        target_date: targetDate
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: '¡Completado!',
                                            text: 'El menú se ha clonado correctamente.',
                                            icon: 'success',
                                            confirmButtonText: 'Aceptar'
                                        }).then(() => {
                                            // Reload the page to show the updated menu
                                            window.location.reload();
                                        });
                                    } else {
                                        throw new Error(data.message ||
                                            'Error al clonar el menú');
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        title: 'Error',
                                        text: error.message,
                                        icon: 'error',
                                        confirmButtonText: 'Aceptar'
                                    });
                                });
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            // Manejador para cuando se abre el modal
            $('#modalClonarMenu').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const targetDate = button.data('date');

                // Guardar la fecha destino como atributo del modal
                $(this).data('target-date', targetDate);

                // Resetear el estado del modal
                selectedMenuDate = null;
                menuToClone = null;
                btnCopiarMenu.disabled = true;
                modalMenuContent.innerHTML =
                    '<p class="text-center text-muted">Seleccione una fecha con menú para visualizar</p>';
                modalSelectedDate.textContent = 'Seleccione una fecha';

                // Inicializar el calendario del modal
                const targetDateObj = new Date(targetDate + 'T12:00:00');
                modalCurrentYear = targetDateObj.getFullYear();
                modalCurrentMonth = targetDateObj.getMonth();

                renderModalCalendar(modalCurrentYear, modalCurrentMonth);
            });

            // Modificar el evento del botón copiar menú
            $('#btn-copiar-menu').on('click', function() {
                if (!selectedMenuDate) return;

                // Obtener la fecha destino del modal
                const targetDate = $('#modalClonarMenu').data('target-date');

                // Confirmar la clonación
                Swal.fire({
                    title: 'Confirmar clonación',
                    html: `¿Está seguro de clonar el menú del <b>${formatDateToSpanish(selectedMenuDate)}</b> al <b>${formatDateToSpanish(targetDate)}</b>?
                   <p class="text-danger mt-2"><strong>¡Advertencia!</strong> Esta acción reemplazará TODOS los 
                   productos existentes para ${formatDateToSpanish(targetDate)}.</p>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, clonar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Mostrar indicador de carga
                        Swal.fire({
                            title: 'Procesando',
                            text: 'Clonando menú...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Realizar la clonación mediante AJAX
                        fetch('/api/menu-clone', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    source_date: selectedMenuDate,
                                    target_date: targetDate
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: '¡Completado!',
                                        text: 'El menú se ha clonado correctamente.',
                                        icon: 'success'
                                    }).then(() => {
                                        // Recargar la página para mostrar el menú actualizado
                                        window.location.reload();
                                    });
                                } else {
                                    throw new Error(data.message ||
                                        'Error al clonar el menú');
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error',
                                    text: error.message,
                                    icon: 'error'
                                });
                            });
                    }
                });
            });
        });

        // Función para renderizar el calendario del modal
        function renderModalCalendar(year, month) {
            // Actualizar el título del mes
            modalCurrentMonthElement.textContent = monthNames[month];

            // Mostrar indicador de carga
            modalCalendarGrid.innerHTML = '<div class="text-center py-3">Cargando...</div>';

            // Hacer solicitud AJAX para obtener los días con menú
            fetch(`/api/calendar-with-menu?year=${year}&month=${month+1}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Datos recibidos del calendario:', data);
                    // Usar days_with_menu en lugar de daysWithMenu (según el formato de respuesta del API)
                    renderModalCalendarDays(year, month, data.days_with_menu || []);
                })
                .catch(error => {
                    console.error('Error cargando calendario del modal:', error);
                    modalCalendarGrid.innerHTML =
                        `<div class="alert alert-danger">Error: ${error.message}</div>`;
                    renderModalCalendarDays(year, month, []);
                });
        }

        // Función para renderizar los días en el calendario del modal
        function renderModalCalendarDays(year, month, daysWithMenu) {
            modalCalendarGrid.innerHTML = '';

            const firstDayOfMonth = new Date(year, month, 1);
            const lastDayOfMonth = new Date(year, month + 1, 0);
            let firstWeekday = firstDayOfMonth.getDay();
            const totalDays = lastDayOfMonth.getDate();

            // Añadir celdas vacías para los días antes del primer día del mes
            for (let i = 0; i < firstWeekday; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'calendar-day empty';
                modalCalendarGrid.appendChild(emptyCell);
            }

            // Crear celdas para cada día del mes
            for (let day = 1; day <= totalDays; day++) {
                const formattedDate =
                    `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                const hasMenu = daysWithMenu.includes(formattedDate);

                const dayCell = document.createElement('div');
                dayCell.className = 'calendar-day' + (hasMenu ? ' has-menu' : '');
                dayCell.textContent = day;
                dayCell.dataset.date = formattedDate;

                if (hasMenu) {
                    dayCell.addEventListener('click', function() {
                        // Marcar este día como seleccionado
                        document.querySelectorAll('.modal-calendar-grid .calendar-day').forEach(el => {
                            el.classList.remove('active');
                        });
                        this.classList.add('active');

                        // Cargar el menú para este día
                        loadMenuForModal(this.dataset.date);
                    });
                } else {
                    dayCell.classList.add('disabled');
                    dayCell.title = 'No hay menú disponible para esta fecha';
                }

                modalCalendarGrid.appendChild(dayCell);
            }
        }

        // Función para cargar el menú para el modal
        function loadMenuForModal(date) {
            selectedMenuDate = date;
            modalSelectedDate.textContent = formatDateToSpanish(date);
            modalMenuContent.innerHTML =
                '<div class="text-center py-3"><div class="spinner-border spinner-border-sm" role="status"></div> Cargando menú...</div>';

            // Hacer solicitud AJAX para obtener el menú del día seleccionado
            fetch(`/api/menu-day?date=${date}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error ${response.status}: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Datos del menú recibidos:', data);
                    if (data.items && data.items.length > 0) {
                        // Almacenar los datos del menú para clonación
                        menuToClone = data.items;

                        // Habilitar el botón de copiar
                        btnCopiarMenu.disabled = false;

                        // Renderizar la tabla del menú
                        renderMenuTable(data.items);
                    } else {
                        modalMenuContent.innerHTML =
                            '<p class="text-center text-muted">No hay menú disponible para esta fecha</p>';
                        btnCopiarMenu.disabled = true;
                    }
                })
                .catch(error => {
                    console.error('Error cargando menú para modal:', error);
                    modalMenuContent.innerHTML =
                        `<div class="alert alert-danger">Error al cargar el menú: ${error.message}</div>`;
                    btnCopiarMenu.disabled = true;
                });
        }

        // Función para renderizar la tabla de menú en el modal
        function renderMenuTable(items) {
            // Agrupar los items por categoría
            const itemsByCategory = {};
            items.forEach(item => {
                if (!itemsByCategory[item.categoria_id]) {
                    itemsByCategory[item.categoria_id] = [];
                }
                itemsByCategory[item.categoria_id].push(item);
            });

            // Crear la tabla
            let tableHtml = `
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Entrada S/15.00</th>
                        <th>Entrada S/20.00</th>
                        <th>Fondo S/15.00</th>
                        <th>Fondo S/20.00</th>
                        <th>Carta</th>
                        <th>Combos</th>
                        <th>Extras</th>
                    </tr>
                </thead>
                <tbody>`;

            // Determinar el número máximo de filas necesarias
            const maxRows = Math.max(
                (itemsByCategory[1] || []).length,
                (itemsByCategory[2] || []).length,
                (itemsByCategory[3] || []).length,
                (itemsByCategory[4] || []).length,
                (itemsByCategory[5] || []).length,
                (itemsByCategory[6] || []).length,
                (itemsByCategory[7] || []).length
            );

            // Crear filas para la tabla
            for (let i = 0; i < maxRows; i++) {
                tableHtml += '<tr>';
                for (let catId = 1; catId <= 7; catId++) {
                    const category = itemsByCategory[catId] || [];
                    const item = category[i];

                    if (item) {
                        tableHtml += `
                    <td>
                        <div>${item.producto_nombre}</div>
                        <div class="small"><b>${item.stock_diario}</b> - (S/${item.precio})</div>
                    </td>`;
                    } else {
                        tableHtml += '<td></td>';
                    }
                }
                tableHtml += '</tr>';
            }

            tableHtml += '</tbody></table></div>';

            // Insertar la tabla en el contenido del modal
            modalMenuContent.innerHTML = tableHtml;
        }

        // Event listener para el botón de copiar menú
        if (btnCopiarMenu) {
            btnCopiarMenu.addEventListener('click', function() {
                if (!selectedMenuDate || !menuToClone) return;

                // Obtener la fecha objetivo del botón que abrió el modal
                const targetDate = document.querySelector('.btn-clonar-menu').dataset.date;

                // Confirmar la clonación antes de redirigir
                Swal.fire({
                    title: 'Confirmar clonación',
                    html: `¿Está seguro de clonar el menú del <b>${formatDateToSpanish(selectedMenuDate)}</b> al <b>${formatDateToSpanish(targetDate)}</b>?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, clonar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirigir a la página de agregar menú con los parámetros
                        window.location.href =
                            `/menusemana/agregar/${targetDate}?clone_from=${selectedMenuDate}`;
                    }
                });
            });
        }

        // Función para formatear fecha en español
        function formatDateToSpanish(dateStr) {
            const date = new Date(dateStr + 'T12:00:00');
            const dayNames = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
            const monthNames = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
                'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
            ];

            return `${dayNames[date.getDay()]} ${date.getDate()} de ${monthNames[date.getMonth()]} de ${date.getFullYear()}`;
        }


        document.getElementById('add-menu-btn').addEventListener('click', function() {
            // Get currently selected date from active calendar cell
            const activeDay = document.querySelector('.calendar-day.active');
            if (activeDay && activeDay.dataset.date) {
                window.location.href = `/menusemana/agregar/${activeDay.dataset.date}`;
            } else {
                // If no date is selected, use current date
                const today = new Date();
                const todayFormatted = today.getFullYear() + '-' +
                    (today.getMonth() + 1).toString().padStart(2, '0') + '-' +
                    today.getDate().toString().padStart(2, '0');
                window.location.href = `/menusemana/agregar/${todayFormatted}`;
            }
        });
        // Month names in Spanish
        const monthNames = [
            'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
            'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
        ];

        // Load calendar for current month on initial load
        loadCalendarMonth(currentYear, currentMonth);

        const now = new Date();
        // Obtiene la fecha local correctamente
        const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        const todayFormatted = now.getFullYear() + '-' +
            (now.getMonth() + 1).toString().padStart(2, '0') + '-' +
            now.getDate().toString().padStart(2, '0');
        console.log('Fecha actual (local):', todayFormatted);

        // Also highlight today in the calendar
        // Small delay to ensure calendar is rendered

        // Event listeners for navigation buttons
        prevMonthButton.addEventListener('click', function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            loadCalendarMonth(currentYear, currentMonth);
        });

        nextMonthButton.addEventListener('click', function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            loadCalendarMonth(currentYear, currentMonth);
        });

        // Function to load calendar month via AJAX
        function loadCalendarMonth(year, month) {
            // Update the month title
            currentMonthElement.textContent = monthNames[month];

            // Show loading indicator
            calendarGridContainer.innerHTML = '<div class="loading text-center py-3 w-100">Cargando...</div>';

            // Make AJAX request to get the days
            fetch(`/api/calendar-month?year=${year}&month=${month}`)
                .then(response => response.json())
                .then(data => {
                    // Use data or fall back to local rendering
                    renderCalendarMonth(year, month);
                })
                .catch(error => {
                    console.error('Error loading calendar:', error);
                    // Fallback to local rendering if API fails
                    renderCalendarMonth(year, month);
                });
        }

        // Render calendar month locally
        function renderCalendarMonth(year, month) {
            calendarGridContainer.innerHTML = '';
            const firstDayOfMonth = new Date(year, month, 1);
            const lastDayOfMonth = new Date(year, month + 1, 0);
            let firstWeekday = firstDayOfMonth.getDay();
            if (firstWeekday === -1) firstWeekday = 6;
            const totalDays = lastDayOfMonth.getDate();

            for (let i = 0; i < firstWeekday; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'calendar-day empty';
                calendarGridContainer.appendChild(emptyCell);
            }

            for (let day = 1; day <= totalDays; day++) {
                const dayCell = document.createElement('div');
                dayCell.className = 'calendar-day';
                const nowLocal = new Date();
                // Forzamos a usar la fecha local, no UTC
                const todayLocal = nowLocal.getDate();
                const monthLocal = nowLocal.getMonth();
                const yearLocal = nowLocal.getFullYear();

                if (year === yearLocal && month === monthLocal && day === todayLocal) {
                    dayCell.classList.add('today');
                    console.log('Marcando como hoy (ajustado):', `${year}-${month + 1}-${day}`);
                }
                dayCell.textContent = day;
                dayCell.dataset.date =
                    `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                dayCell.addEventListener('click', function() {
                    document.querySelectorAll('.calendar-day').forEach(el => el.classList.remove(
                        'active'));
                    this.classList.add('active');
                    loadMenuForDay(this.dataset.date);
                });
                calendarGridContainer.appendChild(dayCell);
            }

            // Resaltar día actual y cargar su menú después de renderizar el calendario completo
            const now = new Date();
            const todayFormatted = now.getFullYear() + '-' +
                (now.getMonth() + 1).toString().padStart(2, '0') + '-' +
                now.getDate().toString().padStart(2, '0');

            console.log('Buscando día actual después de renderizar:', todayFormatted);

            // Seleccionar el día actual si estamos en el mes actual
            if (year === now.getFullYear() && month === now.getMonth()) {
                const todayCell = document.querySelector(`.calendar-day[data-date="${todayFormatted}"]`);
                if (todayCell) {
                    todayCell.classList.add('active');
                    console.log('Día actual resaltado:', todayFormatted);
                    // Cargar el menú del día actual
                    loadMenuForDay(todayFormatted);
                } else {
                    console.error('Día actual no encontrado después de renderizar:', todayFormatted);
                }
            } else {
                // Si no estamos en el mes actual, no hay día actual para resaltar
                // Cargamos el primer día del mes visualizado
                const firstDayFormatted = `${year}-${(month + 1).toString().padStart(2, '0')}-01`;
                const firstDayCell = document.querySelector(`.calendar-day[data-date="${firstDayFormatted}"]`);
                if (firstDayCell) {
                    firstDayCell.classList.add('active');
                    loadMenuForDay(firstDayFormatted);
                }
            }
        }

        // Function to load menu for a specific day
        function loadMenuForDay(date) {
            console.log(`Cargando menú para: ${date}`);
            const contentArea = document.querySelector('.col-md-10');
            contentArea.innerHTML =
                '<div class="text-center py-5"><div class="spinner-border" role="status"><span class="visually-hidden">Cargando...</span></div><p class="mt-2">Cargando menú semanal...</p></div>';

            const selectedDate = new Date(date + 'T00:00:00');
            const dayOfWeek = selectedDate.getDay();
            console.log('Día de la semana:', dayOfWeek);
            const monday = new Date(selectedDate);
            monday.setDate(selectedDate.getDate() - ((dayOfWeek === 0 ? 7 : dayOfWeek) - 1));
            console.log('Lunes calculado:', monday.toISOString().split('T')[0]);
            const formattedStartDate = monday.toISOString().split('T')[0];
            const selectedFormattedDate = date; // Store the selected date for highlighting

            // Hacer solicitud AJAX para obtener datos del menú semanal
            fetch(`/api/menusemana?start_date=${formattedStartDate}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    // Limpiar el área de contenido
                    contentArea.innerHTML = '';

                    // Ordenar las fechas
                    const sortedDates = Object.keys(data).sort();

                    // Generar HTML para cada día
                    sortedDates.forEach(dateStr => {
                        const dayData = data[dateStr];
                        // Force date interpretation without timezone shifting by adding time component:
                        const date = new Date(dateStr + 'T12:00:00');
                        const dayNames = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves',
                            'Viernes', 'Sábado'
                        ];
                        const monthNames = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
                            'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
                        ];

                        // Crear el elemento para el día
                        const dayElement = document.createElement('div');
                        dayElement.className = 'day-menu mb-4';

                        // Add ID to the element for scrolling
                        dayElement.id = `menu-${dateStr}`;

                        // Check if this is the selected date and add highlighting class
                        if (dateStr === selectedFormattedDate) {
                            dayElement.classList.add('selected-menu');
                        }

                        // Formato de fecha: "Lunes 5 MAYO"
                        const dateHeader =
                            `${dayNames[date.getDay()]} ${date.getDate()} ${monthNames[date.getMonth()]}`;

                        dayElement.innerHTML = `
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2>${dateHeader}</h2>
        ${dayData.items && dayData.items.length > 0 ? 
  `<button class="btn btn-outline-dark btn-sm me-2" data-date="${dateStr}">EDITAR</button>
           <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalClonarMenu" data-date="${dateStr}">
             <i class="fas fa-clone me-1"></i>Clonar
           </button>` : 
          `<button type="button" class="btn btn-info btn-sm btn-clonar-menu" data-date="${dateStr}">
             <i class="fas fa-clone me-1"></i>Clonar Menú
           </button>`
}
    </div>
    <div class="table-responsive">
        <table class="table table-bordered equal-width-table">
            <thead>
                <tr>
                    <th>Entrada S/15.00</th>
                    <th>Entrada S/20.00</th>
                    <th>Fondo S/15.00</th>
                    <th>Fondo S/20.00</th>
                    <th>Carta</th>
                    <th>Combos</th>
                    <th>Extras</th>
                </tr>
            </thead>
            <tbody>
                ${generateTableRows(dayData.items, dateStr)}
            </tbody>
        </table>
    </div>
`;

                        contentArea.appendChild(dayElement);
                    });

                    // Agregar event listeners a los botones de editar
                    document.querySelectorAll('.btn-outline-dark[data-date]').forEach(button => {
                        button.addEventListener('click', function() {
                            const dateToEdit = this.getAttribute('data-date');
                            editMenuDay(dateToEdit);
                        });
                    });

                    const selectedMenu = document.getElementById(`menu-${selectedFormattedDate}`);
                    if (selectedMenu) {
                        setTimeout(() => {
                            // Scroll menu into view
                            selectedMenu.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });

                            // Highlight and scroll the calendar day into view
                            setTimeout(() => {
                                // First adjust for header height
                                window.scrollBy({
                                    top: -100,
                                    behavior: 'smooth'
                                });

                                // Then make sure the calendar day is visible
                                const activeDay = document.querySelector(
                                    '.calendar-day.active');
                                if (activeDay) {
                                    // Scroll the sidebar to position the active day
                                    const sidebar = document.querySelector('.sidebar');
                                    const calendarContainer = document.querySelector(
                                        '.calendar-container');
                                    const dayPosition = activeDay.offsetTop;

                                    // Position the day in the upper portion of the calendar
                                    const offset = Math.max(0, dayPosition - 100);
                                    sidebar.scrollTop = offset;
                                }
                            }, 700);
                        }, 100);
                    }

                })
                .catch(error => {
                    console.error('Error cargando el menú:', error);
                    contentArea.innerHTML =
                        `<div class="alert alert-danger">Error al cargar el menú: ${error.message}</div>`;
                });
        }

        // Función auxiliar para generar filas de tabla desde datos
        function generateTableRows(items, date) {
            if (!items || items.length === 0) {
                return '<tr><td colspan="6" class="text-center">No hay menú disponible para este día</td></tr>' +
                    '<tr><td colspan="6" class="text-center mt-3"><a href="/menusemana/agregar/' + date +
                    '" class="btn btn-primary mt-2">' +
                    '<i class="fas fa-plus-circle me-2"></i>AGREGAR MENU</a></td></tr>';
            }

            return items.map(row => `
        <tr>
            <td>${row.entrada_15 || ' '}</td>
            <td>${row.entrada_20 || ' '}</td>
            <td>${row.fondo_15 || ' '}</td>
            <td>${row.fondo_20 || ' '}</td>
            <td>${row.carta || ' '}</td>
            <td>${row.combos || ' '}</td>
            <td>${row.extras || ' '}</td>
        </tr>
    `).join('');
        }

        // Función para manejar la edición de un día de menú (implementación pendiente)
        function editMenuDay(date) {
            console.log(`Editando menú para: ${date}`);
            // Add T12:00:00 to force correct date interpretation without timezone shifts
            const dateObj = new Date(date + 'T12:00:00');
            Swal.fire({
                title: 'Editar Menú',
                text: `¿Desea editar el menú para el día ${dateObj.toLocaleDateString()}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, editar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the edit page with date parameter
                    window.location.href = `/menusemana/agregar/${date}`;
                }
            });
        }
    });
    </script>

    <!--  Calendario  -->



    <style>
    .equal-width-table {
        table-layout: fixed;
        width: 100%;
    }

    .equal-width-table th,
    .equal-width-table td {
        width: 14.28%;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    </style>



</body>