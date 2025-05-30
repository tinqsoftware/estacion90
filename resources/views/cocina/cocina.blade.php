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


            <div class="dashboard">
                

                <div class="section">
                    <div class="section-header">3 EN PROCESO</div>
                    <div class="cards-container" id="proceso-container">
                        <div class="card" draggable="true">
                            <div class="drag-handle">⋮⋮</div>
                            <div class="card-header">
                                <span class="order-number">016</span>
                                <span class="time">1:45M</span>
                            </div>
                            <div class="customer-name">CAUSA RELLENA</div>
                            <div class="dish-name">Mesa 1</div>
                            <div class="status-indicators">
                                <div class="status-dot status-blue"></div>
                                <div class="status-dot status-red"></div>
                            </div>
                        </div>

                        <div class="card" draggable="true">
                            <div class="drag-handle">⋮⋮</div>
                            <div class="card-header">
                                <span class="order-number">017</span>
                                <span class="time">2:15M</span>
                            </div>
                            <div class="customer-name">ARROZ CHAUFA</div>
                            <div class="dish-name">Mesa 3</div>
                            <div class="status-indicators">
                                <div class="status-dot status-blue"></div>
                                <div class="status-dot status-red"></div>
                            </div>
                        </div>

                        <div class="card" draggable="true">
                            <div class="drag-handle">⋮⋮</div>
                            <div class="card-header">
                                <span class="order-number">018</span>
                                <span class="time">0:30M</span>
                            </div>
                            <div class="customer-name">JUEGO MARACUYA</div>
                            <div class="dish-name">Mesa 5</div>
                            <div class="status-indicators">
                                <div class="status-dot status-blue"></div>
                                <div class="status-dot status-red"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-header">6 PENDIENTES</div>
                    <div class="cards-container" id="pendientes-container">
                        <div class="empty-slot">Arrastrar orden aquí</div>
                        <div class="empty-slot">Arrastrar orden aquí</div>
                        <div class="empty-slot">Arrastrar orden aquí</div>
                        <div class="empty-slot">Arrastrar orden aquí</div>
                        <div class="empty-slot">Arrastrar orden aquí</div>
                        <div class="empty-slot">Arrastrar orden aquí</div>
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
        let draggedElement = null;
        let draggedFromContainer = null;

        // Agregar event listeners a todas las cartas
        function initializeDragAndDrop() {
            const cards = document.querySelectorAll('.card');
            const containers = document.querySelectorAll('.cards-container');

            cards.forEach(card => {
                card.addEventListener('dragstart', handleDragStart);
                card.addEventListener('dragend', handleDragEnd);
            });

            containers.forEach(container => {
                container.addEventListener('dragover', handleDragOver);
                container.addEventListener('drop', handleDrop);
                container.addEventListener('dragenter', handleDragEnter);
                container.addEventListener('dragleave', handleDragLeave);
            });
        }

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
            // Solo remover la clase si realmente salimos del container
            if (!this.contains(e.relatedTarget)) {
                this.classList.remove('drag-over');
            }
        }

        function handleDrop(e) {
            e.preventDefault();
            this.classList.remove('drag-over');

            if (draggedElement && this !== draggedFromContainer) {
                // Encontrar el primer slot vacío o agregar al final
                const emptySlot = this.querySelector('.empty-slot');
                
                if (emptySlot) {
                    // Reemplazar el slot vacío con la carta
                    this.replaceChild(draggedElement, emptySlot);
                } else {
                    // Agregar al final del container
                    this.appendChild(draggedElement);
                }

                // Crear un slot vacío en el container original si es necesario
                if (draggedFromContainer.id === 'pendientes-container') {
                    const newEmptySlot = document.createElement('div');
                    newEmptySlot.className = 'empty-slot';
                    newEmptySlot.textContent = 'Arrastrar orden aquí';
                    draggedFromContainer.appendChild(newEmptySlot);
                }

                // Actualizar contadores
                updateCounters();
            }
        }

        function updateCounters() {
            const procesoContainer = document.getElementById('proceso-container');
            const pendientesContainer = document.getElementById('pendientes-container');
            
            const procesoCards = procesoContainer.querySelectorAll('.card').length;
            const pendientesCards = pendientesContainer.querySelectorAll('.card').length;
            
            document.querySelector('.section:first-of-type .section-header').textContent = `${procesoCards} EN PROCESO`;
            document.querySelector('.section:last-of-type .section-header').textContent = `${pendientesCards} PENDIENTES`;
        }

        // Función para agregar nuevas cartas dinámicamente
        function addNewCard(container, orderData) {
            const card = document.createElement('div');
            card.className = 'card';
            card.draggable = true;
            card.innerHTML = `
                <div class="drag-handle">⋮⋮</div>
                <div class="card-header">
                    <span class="order-number">${orderData.number}</span>
                    <span class="time">${orderData.time}</span>
                </div>
                <div class="customer-name">${orderData.dish}</div>
                <div class="dish-name">${orderData.table}</div>
                <div class="status-indicators">
                    <div class="status-dot status-blue"></div>
                    <div class="status-dot status-red"></div>
                </div>
            `;
            
            // Agregar event listeners a la nueva carta
            card.addEventListener('dragstart', handleDragStart);
            card.addEventListener('dragend', handleDragEnd);
            
            // Reemplazar un slot vacío o agregar al final
            const emptySlot = container.querySelector('.empty-slot');
            if (emptySlot) {
                container.replaceChild(card, emptySlot);
            } else {
                container.appendChild(card);
            }
            
            updateCounters();
        }

        // Inicializar cuando la página carga
        document.addEventListener('DOMContentLoaded', function() {
            initializeDragAndDrop();
            
            // Ejemplo de cómo agregar una nueva carta (puedes llamar esta función cuando llegue una nueva orden)
            // setTimeout(() => {
            //     addNewCard(document.getElementById('pendientes-container'), {
            //         number: '019',
            //         time: '0:00M',
            //         dish: 'LOMO SALTADO',
            //         table: 'Mesa 7'
            //     });
            // }, 3000);
        });
    </script>




    <style>
   

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
        cursor: move;
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
    </style>

</body>

</html>