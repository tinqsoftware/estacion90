<!DOCTYPE html>
<html>

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
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />


</head>

<body>

    <div id="main-wrapper" class="dlab-overflow">

        @include('partials.header')
        @include('partials.sidebar')



        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="sidebar-calendar">
                <div class="calendar-header">
                    <button id="prev-month">&lt;</button>
                    <span id="current-month">Mayo 2025</span>
                    <button id="next-month">&gt;</button>
                </div>
                <div class="weekdays">
                    <div>Lu</div>
                    <div>Ma</div>
                    <div>Mi</div>
                    <div>Ju</div>
                    <div>Vi</div>
                    <div>Sa</div>
                    <div>Do</div>
                </div>
                <div class="calendar-grid" id="calendar-days">

                </div>
                <div class="calendar-footer">
                    <button id="today-btn">Hoy</button>
                </div>
            </div>

            <div class="dashboard">

                <div class="section">
                    <div class="section-header" id="proceso-header">0 EN PROCESO</div>
                    <div class="cards-container" id="proceso-container">
                    </div>
                </div>

                <div class="section">
                    <div class="section-header" id="pendientes-header">0 PENDIENTES</div>
                    <div class="cards-container" id="pendientes-container">
                    </div>
                </div>
            </div>
        </div>

    </div>





    <!-- Required vendors -->
    <script src="access/vendor/global/global.min.js"></script>
    <script src="access/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="access/vendor/chart.js/chart.bundle.min.js"></script>
    <script src="access/vendor/swiper/js/swiper-bundle.min.js"></script>
    <script src="access/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="access/js/dlabnav-init.js"></script>
    <script src="access/js/custom.js"></script>



    <script src="access/vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="access/vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Form validate init -->
    <script src="access/js/plugins-init/jquery.validate-init.js"></script>


    <!-- Form Steps -->
    <script src="access/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
    // Calendar functionality
    let currentDate = new Date();
    let selectedDate = new Date();

    // Format date as YYYY-MM-DD
    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Spanish month names
    const monthNames = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    // Generate calendar
    function generateCalendar(date) {
        const year = date.getFullYear();
        const month = date.getMonth();

        // Update header
        document.getElementById('current-month').textContent = `${monthNames[month]} ${year}`;

        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);

        // Get first displayed date (might be from previous month)
        // In Spain, the week starts on Monday (day 1)
        let startDay = new Date(firstDay);
        const firstDayOfWeek = firstDay.getDay() || 7; // Convert Sunday (0) to 7
        startDay.setDate(startDay.getDate() - (firstDayOfWeek - 1));

        const calendarGrid = document.getElementById('calendar-days');
        calendarGrid.innerHTML = '';

        // Create 42 days (6 weeks)
        for (let i = 0; i < 42; i++) {
            const currentDay = new Date(startDay);
            currentDay.setDate(startDay.getDate() + i);

            const dayEl = document.createElement('div');
            dayEl.className = 'calendar-day';
            dayEl.textContent = currentDay.getDate();

            // Check if the day is from another month
            if (currentDay.getMonth() !== month) {
                dayEl.classList.add('other-month');
            }

            // Check if it's today
            const today = new Date();
            if (currentDay.getDate() === today.getDate() &&
                currentDay.getMonth() === today.getMonth() &&
                currentDay.getFullYear() === today.getFullYear()) {
                dayEl.classList.add('today');
            }

            // Check if it's selected day
            if (currentDay.getDate() === selectedDate.getDate() &&
                currentDay.getMonth() === selectedDate.getMonth() &&
                currentDay.getFullYear() === selectedDate.getFullYear()) {
                dayEl.classList.add('selected');
            }

            // Store the date as data attribute
            const dateString = formatDate(currentDay);
            dayEl.dataset.date = dateString;

            // Add click event
            dayEl.addEventListener('click', function() {
                // Remove selected class from all days
                document.querySelectorAll('.calendar-day.selected').forEach(el => {
                    el.classList.remove('selected');
                });

                // Add selected class to this day
                this.classList.add('selected');

                // Update selected date
                selectedDate = new Date(dateString);

                // Load orders for this date
                loadOrdersByDate(dateString);
            });

            calendarGrid.appendChild(dayEl);

            // Stop after last day of month and we've completed the week
            if (currentDay.getDate() === lastDay.getDate() &&
                currentDay.getMonth() === lastDay.getMonth() &&
                (i + 1) % 7 === 0) {
                break;
            }
        }

        // Mark days with orders
        checkDaysWithOrders(year, month);
    }

    // Function to load orders for a specific date
    function loadOrdersByDate(dateString) {
        // Show loading state
        document.getElementById('proceso-container').innerHTML = '<div class="loading">Cargando...</div>';
        document.getElementById('pendientes-container').innerHTML = '<div class="loading">Cargando...</div>';

        // Update counters
        document.getElementById('proceso-header').textContent = '0 EN PROCESO';
        document.getElementById('pendientes-header').textContent = '0 PENDIENTES';

        fetch(`/cocina/orders-by-date?date=${dateString}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(pedidos => {
                const pendientesContainer = document.getElementById('pendientes-container');
                const procesoContainer = document.getElementById('proceso-container');

                // Clear existing cards
                pendientesContainer.innerHTML = '';
                procesoContainer.innerHTML = '';

                let pendientesCount = 0;
                let procesoCount = 0;

                pedidos.forEach(pedido => {
                    // Only process orders with status 0 or 1
                    if (pedido.estado === '0' || pedido.estado === '1') {
                        const card = createOrderCard(pedido);
                        if (card) {
                            if (pedido.estado === '1') {
                                procesoContainer.appendChild(card);
                                procesoCount++;
                            } else { // Status 0 goes to pendientes
                                pendientesContainer.appendChild(card);
                                pendientesCount++;
                            }

                            if (pedido.id > lastOrderId) {
                                lastOrderId = pedido.id;
                            }
                        }
                    }
                });

                // Add empty slots to pendientes if needed
                const emptySlotsPendientes = Math.max(8 - pendientesCount, 0);
                for (let i = 0; i < emptySlotsPendientes; i++) {
                    const emptySlot = document.createElement('div');
                    emptySlot.className = 'empty-slot';
                    pendientesContainer.appendChild(emptySlot);
                }

                // Add empty slots to proceso if needed
                const emptySlotsProcess = Math.max(8 - procesoCount, 0);
                for (let i = 0; i < emptySlotsProcess; i++) {
                    const emptySlot = document.createElement('div');
                    emptySlot.className = 'empty-slot';
                    procesoContainer.appendChild(emptySlot);
                }

                // Update counters
                document.getElementById('proceso-header').textContent = `${procesoCount} EN PROCESO`;
                document.getElementById('pendientes-header').textContent = `${pendientesCount} PENDIENTES`;

            })
            .catch(error => {
                console.error('Error loading orders:', error);
                document.getElementById('proceso-container').innerHTML =
                    '<div class="error">Error al cargar órdenes</div>';
                document.getElementById('pendientes-container').innerHTML =
                    '<div class="error">Error al cargar órdenes</div>';
            });
    }

    // Function to check which days in the current month have orders
    function checkDaysWithOrders(year, month) {
        // Get first and last day of month
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);

        const startDate = formatDate(firstDay);
        const endDate = formatDate(lastDay);

        fetch(`/cocina/days-with-orders?start=${startDate}&end=${endDate}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                // data should be an array of dates that have orders
                data.forEach(date => {
                    const dayEl = document.querySelector(`.calendar-day[data-date="${date}"]`);
                    if (dayEl) {
                        dayEl.classList.add('has-orders');
                    }
                });
            })
            .catch(error => console.error('Error checking days with orders:', error));
    }

    // Function to mark an order as completed (state 9) and remove it from view
    function completeOrder(orderId, cardElement, finalStatus = '9') {
        // Get the current container
        const container = cardElement.parentNode;
        const containerId = container.id;

        // Replace with an empty slot
        const emptySlot = document.createElement('div');
        emptySlot.className = 'empty-slot';
        container.replaceChild(emptySlot, cardElement);

        // Reorder cards to eliminate gaps
        reorderCards(containerId);

        // Update counters
        updateCounters();

        // Send update to server to change status
        fetch('/pedidos/update-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    order_id: orderId,
                    status: finalStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Error completing order');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Add event listeners for calendar navigation
    document.getElementById('prev-month').addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        generateCalendar(currentDate);
    });

    document.getElementById('next-month').addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        generateCalendar(currentDate);
    });

    document.getElementById('today-btn').addEventListener('click', function() {
        currentDate = new Date();
        selectedDate = new Date();
        generateCalendar(currentDate);
        loadOrdersByDate(formatDate(selectedDate));
    });

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Generate the calendar
        generateCalendar(currentDate);

        // Load today's orders
        loadOrdersByDate(formatDate(selectedDate));

        // Check for new orders every 30 seconds (only if viewing today's date)
        setInterval(function() {
            const today = new Date();
            const todayString = formatDate(today);
            const selectedString = formatDate(selectedDate);

            if (todayString === selectedString) {
                checkForNewOrders();
            }
        }, 30000);
    });
    </script>

    <script>
    let draggedElement = null;
    let draggedFromContainer = null;
    let lastOrderId = 0;



    // Funciones para drag & drop (manteniendo las mismas)
    function handleDragStart(e) {
        draggedElement = this;
        draggedFromContainer = this.parentNode;
        this.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
    }

    function handleDragEnd(e) {
        this.classList.remove('dragging');
        draggedElement = null;
        draggedFromContainer = null;
    }

    function handleDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
    }

    function handleDragEnter(e) {
        e.preventDefault();
        this.classList.add('drag-over');
    }

    function handleDragLeave(e) {
        if (!this.contains(e.relatedTarget)) {
            this.classList.remove('drag-over');
        }
    }

    function handleOrderCompletion(cardElement, orderId, status) {
        // Add animation class
        cardElement.classList.add(status === '9' ? 'order-completed-combined' : 'order-completed');

        // After animation, remove card and update backend
        setTimeout(() => {
            completeOrder(orderId, cardElement, status);
        }, 1500);
    }

    function handleDrop(e) {
        e.preventDefault();
        this.classList.remove('drag-over');

        if (draggedElement && this !== draggedFromContainer) {
            const emptySlot = this.querySelector('.empty-slot');

            if (emptySlot) {
                this.replaceChild(draggedElement, emptySlot);
            } else {
                this.appendChild(draggedElement);
            }

            // Add an empty slot to the origin container (regardless of which it was)
            const newEmptySlot = document.createElement('div');
            newEmptySlot.className = 'empty-slot';
            draggedFromContainer.appendChild(newEmptySlot);

            // Save the state change to the server
            const orderId = draggedElement.dataset.orderId;
            const newStatus = this.id === 'proceso-container' ? '2' : '1';
            updateOrderStatus(orderId, newStatus);

            updateCounters();
        }
    }

    // Function to update button styles based on status
    function updateButtonStyles(itemElement, status) {
        const leftButton = itemElement.querySelector('[data-cycle-button]');
        const rightButton = itemElement.querySelector('.status-btn:not([data-cycle-button])');

        // Reset all classes first
        leftButton.className = 'status-btn';
        leftButton.classList.remove('active');
        rightButton.classList.remove('active');

        // Set appropriate classes based on new status
        if (status === '1') {
            leftButton.classList.add('status-blue', 'active');
            rightButton.className = 'status-btn status-red-unpainted';
        } else if (status === '2') {
            leftButton.classList.add('status-green', 'active');
            rightButton.className = 'status-btn status-red-unpainted';
        } else if (status === '9') { // Changed from '3' to '9'
            leftButton.className = 'status-btn status-gray';
            rightButton.className = 'status-btn status-red active';
        } else {
            // Status 0 or default
            leftButton.className = 'status-btn status-gray';
            rightButton.className = 'status-btn status-red-unpainted';
        }
    }

    // Function to update individual product status
    function updateProductStatus(orderId, productId, status, cardElement) {
        fetch('/cocina/update-item-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    order_id: orderId,
                    product_id: productId,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // If server reports a change in overall order status
                    if (data.new_order_status) {
                        // Update card appearance based on overall order status
                        updateCardStatus(cardElement, data.new_order_status);

                        // If the order is now completed, combined, or mixed status, show success animation
                        if (data.new_order_status === '2' || data.new_order_status === '8' || data
                            .new_order_status === '9') {
                            handleOrderCompletion(cardElement, orderId, data.new_order_status);
                        }

                        // If the order status changed to "in process", move to proceso container
                        if (data.new_order_status === '1') {
                            moveCardToProcess(orderId, cardElement);
                        }
                    } else {
                        // Special case: If any item is marked as rejected (status 9), 
                        // move the order to "En Proceso" (status 1)
                        if (status === '9') {
                            // Only if the card is not already in the proceso container
                            if (cardElement.parentNode.id !== 'proceso-container') {
                                // Move card to proceso and update order status to 1
                                moveCardToProcess(orderId, cardElement);
                            }
                        }

                        // Check if the order should be completed due to mixed states
                        checkForCompletedOrder(cardElement);
                    }
                } else {
                    console.error('Error updating item status:', data.message || 'Unknown error');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function updateCardStatus(cardElement, status) {
        // Remove all status classes first
        cardElement.classList.remove('card-pending', 'card-in-process', 'card-completed', 'card-combined');

        // Add appropriate class based on status
        if (status === '1') {
            cardElement.classList.add('card-in-process');
        } else if (status === '2') {
            cardElement.classList.add('card-completed');
        } else if (status === '9') {
            cardElement.classList.add('card-combined');
        } else {
            cardElement.classList.add('card-pending');
        }

        // Update data attribute
        cardElement.dataset.orderStatus = status;
    }

    // Function to update individual item status
    function updateItemStatus(orderId, itemElement, status) {
        // Get item name
        const itemName = itemElement.querySelector('.item-name').textContent.split(' x')[0].trim();

        // Update visual status
        const blueBtn = itemElement.querySelector('.status-btn.status-blue');
        const redBtn = itemElement.querySelector('.status-btn.status-red');

        if (status === 'en_proceso') {
            blueBtn.classList.add('active');
            redBtn.classList.remove('active');
        } else {
            blueBtn.classList.remove('active');
            redBtn.classList.add('active');
        }

        // Send update to server (you'll need to modify your backend to handle individual items)
        fetch('/pedidos/update-item-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    order_id: orderId,
                    item_name: itemName,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Error updating item status');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Function to update the entire order status and move the card
    function updateFullOrderStatus(orderId, newStatus, cardElement) {
        // Get the current container and the target container
        const currentContainer = cardElement.parentNode;
        const procesoContainer = document.getElementById('proceso-container');
        const pendientesContainer = document.getElementById('pendientes-container');

        // Update all status buttons on the card
        const blueButtons = cardElement.querySelectorAll('.status-btn.status-blue');
        const redButtons = cardElement.querySelectorAll('.status-btn.status-red');

        if (newStatus === '2') { // En Proceso
            // Update buttons visual state
            blueButtons.forEach(btn => btn.classList.add('active'));
            redButtons.forEach(btn => btn.classList.remove('active'));

            // Add in-process class to card
            cardElement.classList.add('card-in-process');

            // Move card to proceso container if it's not already there
            if (currentContainer.id !== 'proceso-container') {
                currentContainer.removeChild(cardElement);

                // Find an empty slot in the proceso container if available
                const emptySlot = procesoContainer.querySelector('.empty-slot');
                if (emptySlot) {
                    procesoContainer.replaceChild(cardElement, emptySlot);
                } else {
                    procesoContainer.appendChild(cardElement);
                }

                // Add an empty slot to pendientes container
                const newEmptySlot = document.createElement('div');
                newEmptySlot.className = 'empty-slot';
                pendientesContainer.appendChild(newEmptySlot);
            }
        } else { // Pendiente
            // Update buttons visual state
            blueButtons.forEach(btn => btn.classList.remove('active'));
            redButtons.forEach(btn => btn.classList.add('active'));

            // Remove in-process class from card
            cardElement.classList.remove('card-in-process');

            // Move card to pendientes container if it's not already there
            if (currentContainer.id !== 'pendientes-container') {
                currentContainer.removeChild(cardElement);

                // Find an empty slot in the pendientes container
                const emptySlot = pendientesContainer.querySelector('.empty-slot');
                if (emptySlot) {
                    pendientesContainer.replaceChild(cardElement, emptySlot);
                } else {
                    pendientesContainer.appendChild(cardElement);
                }

                // Add an empty slot to proceso container
                const newEmptySlot = document.createElement('div');
                newEmptySlot.className = 'empty-slot';
                procesoContainer.appendChild(newEmptySlot);
            }
        }

        // Update data attribute
        cardElement.dataset.orderStatus = newStatus;

        // Update counters
        updateCounters();

        // Send update to server
        updateOrderStatus(orderId, newStatus);

        // Add visual feedback for status change
        cardElement.classList.add('status-updated');
        setTimeout(() => {
            cardElement.classList.remove('status-updated');
        }, 1000);
    }

    function updateCounters() {
        const procesoContainer = document.getElementById('proceso-container');
        const pendientesContainer = document.getElementById('pendientes-container');

        const procesoCards = procesoContainer.querySelectorAll('.card').length;
        const pendientesCards = pendientesContainer.querySelectorAll('.card').length;

        document.getElementById('proceso-header').textContent = `${procesoCards} EN PROCESO`;
        document.getElementById('pendientes-header').textContent = `${pendientesCards} PENDIENTES`;
    }

    // Function to update order status in the database
    function updateOrderStatus(orderId, newStatus) {
        fetch('/pedidos/update-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    order_id: orderId,
                    status: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Error updating order status');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Create a card for an order
    function createOrderCard(order) {
        if (!order || !order.detalles || order.detalles.length === 0) return null;

        // Calculate entry and exit time
        const createdDate = new Date(order.created_at);
        const entryTime = createdDate.toLocaleTimeString('es-ES', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        }).toUpperCase();

        // Calculate estimated delivery time based on horallegada if available
        let exitTime = "";
        if (order.hora_programada) {
            exitTime = order.hora_programada;
        } else if (order.id_horallegada && order.horaLlegada) {
            // Calculate based on horaLlegada
            const minutesToAdd = parseInt(order.horaLlegada.minutos || 30);
            const exitDate = new Date(createdDate.getTime() + minutesToAdd * 60000);
            exitTime = exitDate.toLocaleTimeString('es-ES', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            }).toUpperCase();
        } else {
            // Default to 30 minutes if no specific time
            const exitDate = new Date(createdDate.getTime() + 30 * 60000);
            exitTime = exitDate.toLocaleTimeString('es-ES', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            }).toUpperCase();
        }

        // Group items by product name with quantity
        const itemsByProduct = {};
        order.detalles.forEach(detalle => {
            if (!detalle.producto) return;

            const productName = detalle.producto.nombre;
            if (!itemsByProduct[productName]) {
                itemsByProduct[productName] = {
                    count: 0,
                    producto: detalle.producto,
                    estado: detalle.estado || '0' // Store the estado from database
                };
            } else {
                // If we have multiple items with the same product name, keep the highest status
                // This handles cases where the same product appears multiple times with different statuses
                const currentStatus = itemsByProduct[productName].estado || '0';
                const newStatus = detalle.estado || '0';

                // Higher priority: 2 > 1 > 9 > 0
                if (newStatus === '2' ||
                    (newStatus === '1' && currentStatus !== '2') ||
                    (newStatus === '9' && currentStatus !== '2' && currentStatus !== '1')) {
                    itemsByProduct[productName].estado = newStatus;
                }
            }
            itemsByProduct[productName].count += detalle.cantidad || 1;
        });



        // Customer comments
        const customerComments = order.comentarios || '';

        const card = document.createElement('div');
        card.className = 'card';
        card.dataset.orderId = order.id;

        if (order.id > lastOrderId) {
            lastOrderId = order.id;
        }

        // Build HTML for ordered items
        let itemsHTML = '';
        Object.keys(itemsByProduct).forEach(productName => {
            const item = itemsByProduct[productName];
            const quantityText = item.count > 1 ? ` x${item.count}` : ' x1';
            const productId = item.producto.id || '';

            // Generate proper image HTML instead of "FOTO" text placeholder
            let imageHtml = '';
            if (item.producto.imagen) {
                imageHtml =
                    `<div class="item-image"><img src="/${item.producto.imagen}" alt="${productName}"></div>`;
            } else {
                imageHtml = `<div class="item-image-placeholder"><i class="fa fa-image"></i></div>`;
            }

            // Determine initial status based on data from pedido_detalles
            // Default is state 0 (gray/unpainted)
            const itemStatus = item.estado || '0';

            // Set button classes based on status
            let leftButtonClass, rightButtonClass;

            // Left button (for states 0->1->2 cycle)
            if (itemStatus === '1') {
                leftButtonClass = 'status-btn status-blue active';
            } else if (itemStatus === '2') {
                leftButtonClass = 'status-btn status-green active';
            } else {
                leftButtonClass = 'status-btn status-gray';
            }

            // Right button (for state 9 - rejected)
            rightButtonClass = itemStatus === '9' ? 'status-btn status-red active' :
                'status-btn status-red-unpainted';

            itemsHTML += `
<div class="order-item" data-product-id="${productId}" data-status="${itemStatus}">
    ${imageHtml}
    <div class="item-name">${productName} ${quantityText}</div>
    <div class="status-buttons">
        <div class="${leftButtonClass}" data-cycle-button="true" title="Ciclar estados: Pendiente → En Proceso → Completado"></div>
        <div class="${rightButtonClass}" title="Rechazado"></div>
    </div>
</div>`;
        });

        card.innerHTML = `
        <div class="card-header">
            <span class="entry-time">${entryTime}</span>
            <span class="order-number">ORDEN #${order.id}</span>
            <span class="exit-time">${exitTime}</span>
        </div>
        <div class="order-items">
            ${itemsHTML}
        </div>
        <div class="customer-comment">
            <div class="comment-label">COMENTARIO DEL CLIENTE</div>
            <div class="comment-text">${customerComments}</div>
        </div>
        
    `;

        // Add click handler for status buttons
        const statusButtons = card.querySelectorAll('.status-btn');
        statusButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get the item element, card element, and order ID
                const itemElement = this.closest('.order-item');
                const cardElement = this.closest('.card');
                const orderId = cardElement.dataset.orderId;
                const productId = itemElement.dataset.productId;

                // Get current status from the item element's data attribute
                let currentStatus = itemElement.dataset.status || '0';
                let newStatus;

                // Determine which button was clicked
                if (this.dataset.cycleButton) {
                    // Left button - cycles through states 0->1->2 (no going back from 2)
                    switch (currentStatus) {
                        case '0':
                            newStatus = '1'; // Pending -> In Process
                            updateButtonStyles(itemElement, newStatus);
                            break;
                        case '1':
                            newStatus = '2'; // In Process -> Completed
                            updateButtonStyles(itemElement, newStatus);
                            break;
                        case '2':
                            // No change - completed items stay completed
                            newStatus = '2';
                            return; // Exit without doing anything
                        case '9': // Changed from '3' to '9'
                            newStatus = '1'; // If was rejected, set to In Process
                            updateButtonStyles(itemElement, newStatus);
                            break;
                        default:
                            newStatus = '1';
                            updateButtonStyles(itemElement, newStatus);
                    }
                } else {
                    // Right button - toggles rejected state
                    if (currentStatus === '9') {
                        newStatus = '0'; // If already rejected, set back to pending
                    } else {
                        newStatus = '9'; // Set to rejected (this is always allowed, even for estado=2)
                        updateButtonStyles(itemElement, newStatus);
                    }
                }

                // Update the data attribute for future reference
                itemElement.dataset.status = newStatus;

                // Send update to server
                updateProductStatus(orderId, productId, newStatus, cardElement);

                // Visual feedback for the updated item
                itemElement.classList.add('item-updated');
                setTimeout(() => {
                    itemElement.classList.remove('item-updated');
                }, 1000);
            });
        });

        card.className = 'card';
        if (order.estado === '1') {
            card.classList.add('card-in-process');
        } else if (order.estado === '2') {
            card.classList.add('card-completed');
        } else if (order.estado === '8' || order.estado === '9') {
            card.classList.add('card-combined');
        }

        // Also set the order status data attribute for future reference
        card.dataset.orderStatus = order.estado;

        return card;
    }

    // Load initial orders
    function loadInitialOrders() {
        const pedidos = @json($pedidos);
        const pendientesContainer = document.getElementById('pendientes-container');
        const procesoContainer = document.getElementById('proceso-container');

        // Clear existing cards and reset tracking
        pendientesContainer.innerHTML = '';
        procesoContainer.innerHTML = '';
        displayedOrderIds = new Set();

        let pendientesCount = 0;
        let procesoCount = 0;

        pedidos.forEach(pedido => {
            // Only process orders with status 0 or 1
            if (pedido.estado === '0' || pedido.estado === '1') {
                displayedOrderIds.add(pedido.id); // Track this order ID

                const card = createOrderCard(pedido);
                if (card) {
                    // Orders with status 1 go to proceso container
                    if (pedido.estado === '1') {
                        procesoContainer.appendChild(card);
                        procesoCount++;
                    } else { // Orders with status 0 go to pendientes container
                        pendientesContainer.appendChild(card);
                        pendientesCount++;
                    }

                    if (pedido.id > lastOrderId) {
                        lastOrderId = pedido.id;
                    }
                }
            }
        });

        // Add empty slots to pendientes if needed
        const emptySlotsPendientes = Math.max(6 - pendientesCount, 0);
        for (let i = 0; i < emptySlotsPendientes; i++) {
            const emptySlot = document.createElement('div');
            emptySlot.className = 'empty-slot';
            pendientesContainer.appendChild(emptySlot);
        }

        // Add empty slots to proceso if needed
        const emptySlotsProcess = Math.max(6 - procesoCount, 0);
        for (let i = 0; i < emptySlotsProcess; i++) {
            const emptySlot = document.createElement('div');
            emptySlot.className = 'empty-slot';
            procesoContainer.appendChild(emptySlot);
        }

        document.getElementById('proceso-header').textContent = `${procesoCount} EN PROCESO`;
        document.getElementById('pendientes-header').textContent = `${pendientesCount} PENDIENTES`;
    }

    // Function to move a card to the process container
    function moveCardToProcess(orderId, cardElement) {
        const currentContainer = cardElement.parentNode;

        // Skip if card is already in the proceso container
        if (currentContainer.id === 'proceso-container') {
            return;
        }

        const procesoContainer = document.getElementById('proceso-container');
        const pendientesContainer = document.getElementById('pendientes-container');

        // Add in-process class to card
        cardElement.classList.add('card-in-process');

        // Move card to proceso container
        currentContainer.removeChild(cardElement);

        // Find an empty slot in the proceso container if available
        const emptySlot = procesoContainer.querySelector('.empty-slot');
        if (emptySlot) {
            procesoContainer.replaceChild(cardElement, emptySlot);
        } else {
            procesoContainer.appendChild(cardElement);
        }

        // Add an empty slot to pendientes container
        const newEmptySlot = document.createElement('div');
        newEmptySlot.className = 'empty-slot';
        pendientesContainer.appendChild(newEmptySlot);

        // Update data attribute - changed from '2' to '1' to represent "En Proceso"
        cardElement.dataset.orderStatus = '1';

        // Update counters
        updateCounters();

        // Send update to server - changed from '2' to '1'
        updateOrderStatus(orderId, '1');

        // Add visual feedback for status change
        cardElement.classList.add('status-updated');
        setTimeout(() => {
            cardElement.classList.remove('status-updated');
        }, 1000);
    }

    // Function to reorder cards after one is removed
    function reorderCards(containerId) {
        const container = document.getElementById(containerId);

        // Get all cards and empty slots
        const cards = Array.from(container.querySelectorAll('.card'));
        const emptySlots = Array.from(container.querySelectorAll('.empty-slot'));

        // Clear the container
        container.innerHTML = '';

        // First add all cards back in order
        cards.forEach(card => {
            container.appendChild(card);
        });

        // Then add empty slots at the end
        emptySlots.forEach(slot => {
            container.appendChild(slot);
        });
    }

    let displayedOrderIds = new Set();
    // Check for new orders periodically
    function checkForNewOrders() {
        fetch(`/cocina/new-orders?last_id=${lastOrderId}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(newOrders => {
                if (newOrders.length > 0) {
                    const pendientesContainer = document.getElementById('pendientes-container');
                    let hasNewOrders = false;

                    newOrders.forEach(order => {
                        // Check if this order has already been displayed
                        if (!displayedOrderIds.has(order.id)) {
                            displayedOrderIds.add(order.id);

                            const card = createOrderCard(order);
                            if (card) {
                                // Replace an empty slot if one exists
                                const emptySlot = pendientesContainer.querySelector('.empty-slot');
                                if (emptySlot) {
                                    pendientesContainer.replaceChild(card, emptySlot);
                                } else {
                                    pendientesContainer.appendChild(card);
                                }

                                hasNewOrders = true;
                            }
                        }

                        // Always update lastOrderId to avoid re-fetching
                        if (order.id > lastOrderId) {
                            lastOrderId = order.id;
                        }
                    });

                    // Only play sound if we actually added new orders
                    if (hasNewOrders) {
                        // Play a sound for new orders
                        const audio = new Audio('/access/sounds/new-order.mp3');
                        audio.play();

                        updateCounters();
                    }
                }
            })
            .catch(error => console.error('Error checking for new orders:', error));
    }

    function checkForCompletedOrder(cardElement) {
        const allItems = cardElement.querySelectorAll('.order-item');
        let allCompleted = true;
        let allRejected = true;

        // Tracking variables for mixed status detection
        let hasCompleted = false;
        let hasRejected = false;
        let hasPending = false;
        let hasInProcess = false;

        // Check status of all items
        allItems.forEach(item => {
            const currentStatus = item.dataset.status;

            // Check for each possible status
            if (currentStatus === '0') {
                hasPending = true;
                allCompleted = false;
                allRejected = false;
            } else if (currentStatus === '1') {
                hasInProcess = true;
                allCompleted = false;
                allRejected = false;
            } else if (currentStatus === '2') {
                hasCompleted = true;
                allRejected = false;
            } else if (currentStatus === '9') {
                hasRejected = true;
                allCompleted = false;
            }
        });

        // Case 1: If all items are completed (estado 2)
        if (allCompleted) {
            // Visual feedback - highlight the whole card
            cardElement.classList.add('order-completed');
            setTimeout(() => {
                const orderId = cardElement.dataset.orderId;
                completeOrder(orderId, cardElement, '2');
            }, 1500);
        }
        // Case 2: If all items are rejected (estado 9)
        else if (allRejected) {
            cardElement.classList.add('order-completed');
            setTimeout(() => {
                const orderId = cardElement.dataset.orderId;
                completeOrder(orderId, cardElement, '9');
            }, 1500);
        }
        // Case 3: Mixed status - both completed and rejected items exist, with NO pending or in-process items
        else if (hasCompleted && hasRejected && !hasPending && !hasInProcess) {
            cardElement.classList.add('order-completed');
            setTimeout(() => {
                const orderId = cardElement.dataset.orderId;
                completeOrder(orderId, cardElement, '8');
            }, 1500);
        }
    }

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        loadInitialOrders();

        // Check for new orders every 30 seconds
        setInterval(checkForNewOrders, 30000);
    });
    </script>




    <style>
    .content-body {
        display: flex;
        gap: 20px;
    }

    .sidebar-calendar {
        width: 280px;
        background: white;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 20px;
        align-self: flex-start;
        margin-bottom: 20px;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .calendar-header button {
        background: #2c5aa0;
        color: white;
        border: none;
        border-radius: 4px;
        width: 30px;
        height: 30px;
        font-size: 16px;
        cursor: pointer;
    }

    #current-month {
        font-weight: bold;
        font-size: 16px;
    }

    .weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 12px;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }

    .calendar-day {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
        position: relative;
        font-size: 14px;
    }

    .calendar-day:hover {
        background-color: #f0f0f0;
    }

    .calendar-day.today {
        background-color: #2c5aa0;
        color: white;
    }

    .calendar-day.selected {
        background-color: #4a90e2;
        color: white;
    }

    .calendar-day.has-orders::after {
        content: '';
        position: absolute;
        bottom: 2px;
        width: 4px;
        height: 4px;
        background-color: #e74c3c;
        border-radius: 50%;
    }

    .calendar-day.other-month {
        color: #ccc;
    }

    .calendar-footer {
        margin-top: 15px;
        text-align: center;
    }

    #today-btn {
        background: #2c5aa0;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 5px 15px;
        cursor: pointer;
    }

    .dashboard {
        flex-grow: 1;
    }

    @media (max-width: 992px) {
        .content-body {
            flex-direction: column;
        }

        .sidebar-calendar {
            width: 100%;
            margin-bottom: 20px;
            position: static;
        }
    }


    /* Estilos personalizados para la carta */
    .dashboard {
        max-width: 1200px;
        margin: 0 auto;
    }



    .date {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .section {
        margin-bottom: 30px;
    }

    .section-header {
        background-color: #2c5aa0;
        color: white;
        padding: 10px 20px;
        font-weight: bold;
        margin-bottom: 15px;
        display: inline-block;
        min-width: 200px;
        text-align: center;
    }

    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
        min-height: 200px;
        padding: 10px;
        border: 2px dashed #ddd;
        border-radius: 8px;
        background-color: #fafafa;
    }

    .card {
        background-color: white;
        border: 2px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        transition: all 0.3s ease;
        position: relative;
        min-height: 120px;
    }

    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .card.dragging {
        opacity: 0.5;
        transform: rotate(5deg);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .order-number {
        background-color: #666;
        color: white;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 12px;
    }

    .entry-time,
    .exit-time {
        font-weight: bold;
        font-size: 12px;
        color: #2c5aa0;
    }

    .time {
        font-weight: bold;
        color: #2c5aa0;
    }

    .customer-name {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .dish-name {
        color: #666;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .status-indicators {
        display: flex;
        gap: 5px;
    }

    .status-green {
        background-color: #2ecc71;
    }

    .order-number {
        background-color: #fff;
        color: #333;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: bold;
    }

    .order-items {
        margin-bottom: 12px;
    }

    .order-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 13px;
    }

    .item-image {
        width: 40px;
        height: 40px;
        min-width: 40px;
        margin-right: 8px;
        border-radius: 4px;
        overflow: hidden;
        background-color: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-image-placeholder {
        width: 40px;
        height: 40px;
        min-width: 40px;
        margin-right: 8px;
        border-radius: 4px;
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
    }

    .item-name {
        flex-grow: 1;
        font-weight: bold;
    }

    .status-buttons {
        display: flex;
        gap: 5px;
    }


    .status-blue {
        background-color: #4a90e2;
    }

    .status-red {
        background-color: #e74c3c;
    }

    .customer-comment {
        margin-top: 10px;
        padding-top: 8px;
        border-top: 1px solid #eee;
        font-size: 12px;
    }

    .comment-label {
        font-weight: bold;
        margin-bottom: 4px;
    }

    .comment-text {
        color: #666;
        font-style: italic;
    }

    .location-info {
        position: absolute;
        bottom: 8px;
        right: 8px;
        font-size: 11px;
        color: #666;
        font-weight: bold;
    }

    /* Animation for new orders */
    .card.new-order {
        animation: highlight 2s ease-in-out;
    }

    @keyframes highlight {
        0% {
            box-shadow: 0 0 0 0 rgba(44, 90, 160, 0.7);
        }

        50% {
            box-shadow: 0 0 0 10px rgba(44, 90, 160, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(44, 90, 160, 0);
        }
    }



    .status-dot {
        width: 20px;
        height: 20px;
        border-radius: 3px;
    }

    .status-blue {
        background-color: #4a90e2;
    }

    .status-red {
        background-color: #e74c3c;
    }

    .drag-handle {
        position: absolute;
        top: 5px;
        right: 5px;
        cursor: grab;
        color: #999;
        font-size: 18px;
    }

    .drag-handle:active {
        cursor: grabbing;
    }

    .cards-container.drag-over {
        border-color: #2c5aa0;
        background-color: #e8f0fe;
    }

    .empty-slot {
        border: 2px dashed #ccc;
        background-color: #f9f9f9;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-style: italic;
        min-height: 120px;
    }

    .sidebar {
        position: fixed;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        width: 200px;
    }

    .calendar {
        text-align: center;
    }

    .calendar-header {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 2px;
        font-size: 12px;
    }

    .calendar-day {
        padding: 5px;
        text-align: center;
    }

    .calendar-day.today {
        background-color: #2c5aa0;
        color: white;
        border-radius: 3px;
    }

    @media (max-width: 768px) {
        .sidebar {
            position: static;
            transform: none;
            width: 100%;
            margin-bottom: 20px;
        }

        .cards-container {
            grid-template-columns: 1fr;
        }
    }


    .item-updated {
        animation: item-flash 1s ease;
    }

    @keyframes item-flash {

        0%,
        100% {
            background-color: transparent;
        }

        50% {
            background-color: rgba(74, 144, 226, 0.2);
        }
    }

    .order-completed {
        animation: complete-flash 1.5s ease;
    }

    @keyframes complete-flash {
        0% {
            background-color: white;
            transform: scale(1);
        }

        50% {
            background-color: #c5e1ff;
            transform: scale(1.05);
        }

        100% {
            background-color: #4a90e2;
            transform: scale(0.9);
            opacity: 0;
        }
    }

    /* Make the status buttons more clickable */
    .status-btn {
        width: 25px;
        height: 25px;
        border-radius: 4px;
        cursor: pointer;
        border: 1px solid #ddd;
        transition: all 0.2s ease;
        opacity: 0.5;
    }

    .status-btn:hover {
        opacity: 1;
        transform: scale(1.1);
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    }

    .status-btn.active {
        opacity: 1;
        border: 2px solid #000;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

    /* Change animation for rejected orders */
    .order-completed.rejected {
        animation: reject-flash 1.5s ease;
    }

    @keyframes reject-flash {
        0% {
            background-color: white;
            transform: scale(1);
        }

        50% {
            background-color: #ffcccc;
            transform: scale(1.05);
        }

        100% {
            background-color: #e74c3c;
            transform: scale(0.9);
            opacity: 0;
        }
    }

    .status-btn.status-blue-unpainted {
        background-color: #ffffff;
        border: 1px solid #4a90e2;
    }

    .status-btn.status-red-unpainted {
        background-color: #ffffff;
        border: 1px solid #e74c3c;
    }

    .status-btn.status-blue.active {
        background-color: #4a90e2;
        opacity: 1;
        border: 2px solid #000;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

    .status-btn.status-red.active {
        background-color: #e74c3c;
        opacity: 1;
        border: 2px solid #000;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }
    </style>

</body>

</html>