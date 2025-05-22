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

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            /* Remove min-height: calc(100vh - 70px); */
            position: sticky;
            top: 20px; /* Adjust based on your header height */
            max-height: calc(100vh - 120px);
            overflow-y: auto;
        }

        .calendar-container {
            height: 30%;
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
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
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
                                            <th>Carta</th>
                                            <th>Combos</th>
                                            <th>Extra</th>
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
                                const activeDay = document.querySelector('.calendar-day.active');
                                if (activeDay) {
                                    // Scroll the sidebar to position the active day
                                    const sidebar = document.querySelector('.sidebar');
                                    const calendarContainer = document.querySelector('.calendar-container');
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
            '<tr><td colspan="6" class="text-center mt-3"><a href="/menusemana/agregar/' + date + '" class="btn btn-primary mt-2">' +
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



</body>