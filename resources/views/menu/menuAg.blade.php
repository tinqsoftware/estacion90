<!DOCTYPE html>
<html lang="en">

<head>

    <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="Tinq Sofware" />
    <meta name="robots" content="" />
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
                                <div>L</div>
                                <div>M</div>
                                <div>X</div>
                                <div>J</div>
                                <div>V</div>
                                <div>S</div>
                                <div>D</div>
                            </div>
                            <div class="calendar-grid">
                                <!-- Days will be loaded here via AJAX -->
                                <div class="loading text-center py-3 w-100">Cargando...</div>
                            </div>
                        </div>
                        <br>
                        <div class="text-start">
                            <a href="/menusemana/agregar" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus-circle me-2"></i>AGREGAR MENU
                            </a>
                        </div>
                    </div>




                    <!-- Contenido principal -->
                    <div class="col-md-10">
                        <!-- Día 1 
                        <div class="day-menu mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h2>Lunes 5 MAYO</h2>
                                <button class="btn btn-outline-dark btn-sm">EDITAR</button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Entrada S/15.00</th>
                                            <th>Entrada S/20.00</th>
                                            <th>Fondo S/15.00</th>
                                            <th>Fondo S/20.00</th>
                                            <th>Extras</th>
                                            <th>Combos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 – Chupete Fresa (S/5)</td>
                                            <td>20 – Combo 1 (S/55)</td>
                                        </tr>
                                        <tr>
                                            <td>30 - Pollo a la braza</td>
                                            <td>30 - Pollo a la braza</td>
                                            <td>30 - Pollo a la braza</td>
                                            <td>30 - Pollo a la braza</td>
                                            <td>20 – Chupete Fresa (S/5)</td>
                                            <td>20 – Combo 2 (S/50)</td>
                                        </tr>
                                        <tr>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 – Chupete Fresa (S/5)</td>
                                            <td>20 – Combo 3 (S/25)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        Día 2
                        <div class="day-menu mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h2>Martes 6 MAYO</h2>
                                <button class="btn btn-outline-dark btn-sm">EDITAR</button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Entrada S/15.00</th>
                                            <th>Entrada S/20.00</th>
                                            <th>Fondo S/15.00</th>
                                            <th>Fondo S/20.00</th>
                                            <th>Extras</th>
                                            <th>Combos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 – Chupete Fresa (S/5)</td>
                                            <td>20 – Combo 1 (S/55)</td>
                                        </tr>
                                        <tr>
                                            <td>30 - Pollo a la braza</td>
                                            <td>30 - Pollo a la braza</td>
                                            <td>30 - Pollo a la braza</td>
                                            <td>30 - Pollo a la braza</td>
                                            <td>20 – Chupete Fresa (S/5)</td>
                                            <td>20 – Combo 2 (S/50)</td>
                                        </tr>
                                        <tr>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 - Pollo a la braza</td>
                                            <td>20 – Chupete Fresa (S/5)</td>
                                            <td>20 – Combo 3 (S/25)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        Puedes agregar más días aquí -->
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

        // Month names in Spanish
        const monthNames = [
            'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
            'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
        ];

        // Load calendar for current month on initial load
        loadCalendarMonth(currentYear, currentMonth);

        const today = new Date();
        const todayFormatted = today.getFullYear() + '-' +
            (today.getMonth() + 1).toString().padStart(2, '0') + '-' +
            today.getDate().toString().padStart(2, '0');

        // Also highlight today in the calendar
        setTimeout(() => {
            const todayCell = document.querySelector(`.calendar-day[data-date="${todayFormatted}"]`);
            if (todayCell) {
                todayCell.classList.add('active');
            }
            // Load the menu for the current week
            loadMenuForDay(todayFormatted);
        }, 500); // Small delay to ensure calendar is rendered

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

            const today = new Date();
            const firstDayOfMonth = new Date(year, month, 1);
            const lastDayOfMonth = new Date(year, month + 1, 0);

            // Get day of week of the first day (0 = Sunday, 1 = Monday, etc.)
            // Convert to Monday-first format (0 = Monday, 6 = Sunday)
            let firstWeekday = firstDayOfMonth.getDay() - 1;
            if (firstWeekday === -1) firstWeekday = 6;

            const totalDays = lastDayOfMonth.getDate();

            // Create empty cells for days before the first day of the month
            for (let i = 0; i < firstWeekday; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'calendar-day empty';
                calendarGridContainer.appendChild(emptyCell);
            }

            // Create cells for days of the month
            for (let day = 1; day <= totalDays; day++) {
                const dayCell = document.createElement('div');
                dayCell.className = 'calendar-day';

                // Check if this is today
                if (year === today.getFullYear() && month === today.getMonth() && day === today.getDate()) {
                    dayCell.classList.add('today');
                }

                // Set the day number
                dayCell.textContent = day;

                // Set data attribute for the full date
                dayCell.dataset.date =
                    `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;

                // Add click event
                dayCell.addEventListener('click', function() {
                    document.querySelectorAll('.calendar-day').forEach(el => {
                        el.classList.remove('active');
                    });
                    this.classList.add('active');
                    loadMenuForDay(this.dataset.date);
                });

                calendarGridContainer.appendChild(dayCell);
            }
        }

        // Function to load menu for a specific day
        function loadMenuForDay(date) {
            console.log(`Cargando menú para: ${date}`);

            // Mostrar indicador de carga
            const contentArea = document.querySelector('.col-md-10');
            contentArea.innerHTML =
                '<div class="text-center py-5"><div class="spinner-border" role="status"><span class="visually-hidden">Cargando...</span></div><p class="mt-2">Cargando menú semanal...</p></div>';

            // Calcular la fecha de inicio de la semana (lunes) basada en la fecha seleccionada
            const selectedDate = new Date(date);
            const dayOfWeek = selectedDate.getDay() || 7; // Convertir domingo (0) a 7
            const diff = selectedDate.getDate() - dayOfWeek + 1; // Ajustar al lunes
            const startDate = new Date(selectedDate);
            startDate.setDate(diff);

            const formattedStartDate = startDate.toISOString().split('T')[0]; // Formato YYYY-MM-DD
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
                        const date = new Date(dateStr);
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
                <button class="btn btn-outline-dark btn-sm" data-date="${dateStr}">EDITAR</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Entrada S/15.00</th>
                            <th>Entrada S/20.00</th>
                            <th>Fondo S/15.00</th>
                            <th>Fondo S/20.00</th>
                            <th>Extras</th>
                            <th>Combos</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${generateTableRows(dayData.items)}
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

                    // Scroll to the selected date's menu
                    const selectedMenu = document.getElementById(`menu-${selectedFormattedDate}`);
                    if (selectedMenu) {
                        setTimeout(() => {
                            selectedMenu.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
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
        function generateTableRows(items) {
            if (!items || items.length === 0) {
                return '<tr><td colspan="6" class="text-center">No hay menú disponible para este día</td></tr>' +
                    '<tr><td colspan="6" class="text-center mt-3"><a href="/menusemana/agregar" class="btn btn-primary mt-2">' +
                    '<i class="fas fa-plus-circle me-2"></i>AGREGAR MENU</a></td></tr>';
            }

            return items.map(row => `
        <tr>
            <td>${row.entrada_15 || '-'}</td>
            <td>${row.entrada_20 || '-'}</td>
            <td>${row.fondo_15 || '-'}</td>
            <td>${row.fondo_20 || '-'}</td>
            <td>${row.extras || '-'}</td>
            <td>${row.combos || '-'}</td>
        </tr>
    `).join('');
        }

        // Función para manejar la edición de un día de menú (implementación pendiente)
        function editMenuDay(date) {
            console.log(`Editando menú para: ${date}`);
            // Implementa aquí la lógica para editar el menú de un día
            // Por ejemplo, podría abrir un modal o redirigir a otra página
            Swal.fire({
                title: 'Editar Menú',
                text: `¿Desea editar el menú para el día ${new Date(date).toLocaleDateString()}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, editar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir a la página de edición o abrir un formulario modal
                    // window.location.href = `/editar-menu/${date}`;
                }
            });
        }
    });
    </script>


    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .sidebar {
        min-height: calc(100vh - 70px);
    }

    .calendar-container {
        height: 100%;
        background-color: #f8f9fa;
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
        gap: 2px;
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
    }

    .calendar-day:hover {
        background-color: #e9ecef;
    }

    .calendar-day.empty {
        background-color: transparent;
        cursor: default;
    }

    .calendar-day.today {
        background-color: #f8d7da;
        font-weight: bold;
    }

    .calendar-day.active {
        background-color: #d1e7dd;
        font-weight: bold;
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
    </style>

</body>
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


        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <div class="logo-abbr" width="39" height="31" viewBox="0 0 39 31" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <img src="access/images/logo_white.png" style="height: 50px;" alt="" />
                </div>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->



        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="container d-block my-0">
                        <div class="d-flex align-items-center justify-content-sm-between justify-content-end">



                            <ul class="navbar-nav header-right ">

                                <li class="nav-item d-flex align-items-center">

                                </li>
                                <li>

                                    <div class="dropdown header-profile2 " @if(Auth::user()) @else style="height:30px;"
                                        @endif>

                                        <a class="nav-link " href="javascript:void(0);" role="button"
                                            data-bs-toggle="dropdown">
                                            <div class="header-info2 d-flex align-items-center">
                                                @if(Auth::user())
                                                <img src="access/images/banner-img/user.png" alt="">
                                                @endif
                                                <div class="d-flex align-items-center sidebar-info">
                                                    <div>
                                                        <h6 class="font-w500 mb-0 ms-2">
                                                            @if(Auth::user())
                                                            {{Auth::user()->name}}
                                                            @else
                                                            Sin usuario
                                                            @endif
                                                        </h6>
                                                    </div>
                                                    <i class="fas fa-chevron-down"></i>
                                                </div>

                                            </div>
                                        </a>
                                        @if(Auth::user())
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="./app-profile.html" class="dropdown-item ai-icon ">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                <span class="ms-2">Perfil</span>
                                            </a>

                                            <a href="./notification.html" class="dropdown-item ai-icon ">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1"
                                                    class="svg-main-icon">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                            fill="var(--primary)" />
                                                        <circle fill="var(--primary)" opacity="0.3" cx="19.5" cy="17.5"
                                                            r="2.5" />
                                                    </g>
                                                </svg>
                                                <span class="ms-2">Notificaciones </span>
                                            </a>

                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                class="dropdown-item ai-icon ms-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                    <polyline points="16 17 21 12 16 7"></polyline>
                                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                                </svg>
                                                <span class="ms-1">Salir </span>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                        @else
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="/login" class="dropdown-item ai-icon ">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                <span class="ms-2">Iniciar sesión</span>
                                            </a>
                                        </div>
                                        @endif

                                    </div>

                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav border-right">
            <div class="dlabnav-scroll">
                <p class="menu-title style-1">Usuario</p>
                <ul class="metismenu" id="menu">
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-grid"></i>
                            <span class="nav-text">Cliente</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/">Inicio</a></li>
                            <li><a href="food-order.html">Mis ordenes</a></li>
                            <li><a href="favorite-menu.html">Mis favoritos</a></li>
                            <!--
							<li><a href="message.html">Message</a></li>	
							<li><a href="order-history.html">Mis favoritos</a></li>	
                            -->
                            <li><a href="bill.html">Historial</a></li>
                            <li><a href="notification.html">Notificaciones</a></li>
                            <li><a href="setting.html">Configuraciones</a></li>
                        </ul>

                    </li>
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">

                            <i class="bi bi-shop-window"></i>
                            <span class="nav-text">Estacion90</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="dashboard.html">Dashboard</a></li>
                            <li><a href="menu.html">Menu</a></li>
                            <li><a href="orders.html">Ordenes</a></li>
                            <li><a href="customer-reviews.html">Comentarios</a></li>
                            <li><a href="restro-setting.html">Configuraciones</a></li>
                            <li><a href="restro-setting.html">Productos</a></li>
                            <li><a href="restro-setting.html">Menu Semanal</a></li>

                        </ul>

                    </li>
                    <li><a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                            <i class="bi bi-bicycle"></i>

                            <span class="nav-text">Delivery</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="deliver-main.html">Inicio</a></li>
                            <li><a href="deliver-order.html">Ordenes</a></li>
                            <li><a href="feedback.html">Comentario</a></li>
                        </ul>

                    </li>


                </ul>

            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->

        <div class="content-body">
            <div class="container-fluid">
                <!-- Diálogo de confirmación (inicialmente oculto) -->
                <div id="confirmDialog" class="confirmation-dialog">
                    <div class="confirmation-content">
                        <p>Estas seguro</p>
                        <div class="confirmation-buttons">
                            <button id="btnEliminar" class="btn-eliminar">Eliminar</button>
                            <button id="btnCancelar" class="btn-cancelar">Cancelar</button>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <!-- Contenido principal -->
                    <div class="col-12">
                        <h2 class="mb-4">Lunes 5 MAYO</h2>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Entrada S/15.00</th>
                                        <th>Entrada S/20.00</th>
                                        <th>Fondo S/15.00</th>
                                        <th>Fondo S/20.00</th>
                                        <th>Extras</th>
                                        <th>Combos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="menu-item">
                                                <button class="delete-btn"></button>
                                                <span>20 - Pollo a la braza</span>
                                            </div>
                                        </td>
                                        <td>20 - Pollo a la braza</td>
                                        <td>20 - Pollo a la braza</td>
                                        <td>20 - Pollo a la braza</td>
                                        <td>20 – Chupete Fresa (S/5)</td>
                                        <td>20 – Combo 1 (S/55)</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="menu-item">
                                                <button class="delete-btn"></button>
                                                <span>30 - Pollo a la braza</span>
                                            </div>
                                        </td>
                                        <td>30 - Pollo a la braza</td>
                                        <td>30 - Pollo a la braza</td>
                                        <td>30 - Pollo a la braza</td>
                                        <td>20 – Chupete Fresa (S/5)</td>
                                        <td>20 – Combo 2 (S/50)</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="menu-item">
                                                <button class="delete-btn"></button>
                                                <span>20 - Pollo a la braza</span>
                                            </div>
                                        </td>
                                        <td>20 - Pollo a la braza</td>
                                        <td>20 - Pollo a la braza</td>
                                        <td>20 - Pollo a la braza</td>
                                        <td>20 – Chupete Fresa (S/5)</td>
                                        <td>20 – Combo 3 (S/25)</td>
                                    </tr>
                                    <tr>
                                        <td>45 - ceviche</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Sección de búsqueda y añadir productos -->
                        <div class="row mt-4">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Buscar producto ▼</button>
                                    <input type="text" class="form-control" placeholder="Stock" aria-label="Stock">
                                </div>
                                <button class="btn btn-secondary w-100">AÑADIR EL MENU</button>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Buscar producto ▼</button>
                                    <input type="text" class="form-control" placeholder="Stock" aria-label="Stock">
                                </div>
                                <button class="btn btn-secondary w-100">AÑADIR EL MENU</button>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Buscar producto ▼</button>
                                    <input type="text" class="form-control" placeholder="Stock" aria-label="Stock">
                                </div>
                                <button class="btn btn-secondary w-100">AÑADIR EL MENU</button>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Buscar producto ▼</button>
                                    <input type="text" class="form-control" placeholder="Stock" aria-label="Stock">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Precio" aria-label="Precio">
                                </div>
                                <button class="btn btn-secondary w-100">AÑADIR EL MENU</button>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">Buscar producto ▼</button>
                                    <input type="text" class="form-control" placeholder="Stock" aria-label="Stock">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Precio" aria-label="Precio">
                                </div>
                                <button class="btn btn-secondary w-100">AÑADIR EL MENU</button>
                            </div>
                        </div>

                        <p class="mt-4 text-muted">Cuando añades que no se refrezque la página, que cargue el producto
                            en la tabla, y que aparezca otro grupo de inputs</p>
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


</body>