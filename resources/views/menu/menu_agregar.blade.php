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
    <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                <!-- Contenedor de notificaciones -->
<div id="notification-container" style="position: fixed; top: 80px; right: 20px; z-index: 9999; width: 300px;"></div>

<!-- Botón volver -->
<div class="row mb-3 align-items-center">
    <div class="col-md-6">
        <!-- Título dinámico basado en si hay datos en la tabla -->
        <h5 class="m-0">
            <span class="badge bg-primary p-2">
                @php
                    $hayProductos = false;
                    foreach ([1, 2, 3, 4, 5, 6] as $cat) {
                        if (isset($menuItems[$cat]) && count($menuItems[$cat]) > 0) {
                            $hayProductos = true;
                            break;
                        }
                    }
                @endphp
                <i class="fa {{ $hayProductos ? 'fa-edit' : 'fa-plus-circle' }}"></i>
                {{ $hayProductos ? 'Editando menú' : 'Agregando nuevo menú' }}
            </span>
        </h5>
    </div>
    <div class="col-md-6 text-end">
        <a href="#" id="btn-volver" class="btn btn-primary btn-sm">
            <i class="fa fa-arrow-left"></i> Volver
        </a>
    </div>
</div>

                <div class="row mt-4">
                    <!-- Contenido principal -->
                    <div class="col-12">
                        <div class="table-responsive"></div>
                        <h2 class="mb-4">{{ $fechaFormateada }}</h2>

                        <!-- Update the table to use dynamic data -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="16.66%">Entrada S/15.00</th>
                        <th width="16.66%">Entrada S/20.00</th>
                        <th width="16.66%">Fondo S/15.00</th>
                        <th width="16.66%">Fondo S/20.00</th>
                        <th width="16.66%">Extras</th>
                        <th width="16.66%">Combos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $maxRows = max(
                                count($menuItems[1] ?? []),
                                count($menuItems[2] ?? []),
                                count($menuItems[3] ?? []),
                                count($menuItems[4] ?? []),
                                count($menuItems[5] ?? []),
                                count($menuItems[6] ?? [])
                                );
                                @endphp

                                @for ($i = 0; $i < $maxRows; $i++) <tr>
                                    @foreach ([1, 2, 3, 4, 5, 6] as $categoriaId)
                                    <td>
                                        @if(isset($menuItems[$categoriaId][$i]))
                                        <div class="menu-item" data-id="{{ $menuItems[$categoriaId][$i]->id }}">
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp btn-eliminar"
                                                data-id="{{ $menuItems[$categoriaId][$i]->id }}" title="Eliminar">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <span>
                                                {{ $menuItems[$categoriaId][$i]->stock_diario }} -
                                                {{ $menuItems[$categoriaId][$i]->producto_nombre }}
                                                @if($categoriaId >= 5 || $menuItems[$categoriaId][$i]->precio)
                                                (S/{{ $menuItems[$categoriaId][$i]->precio }})
                                                @endif
                                            </span>
                                        </div>
                                        @endif
                                    </td>
                                    @endforeach
                                    </tr>
                                    @endfor
                            </tbody>
                        </table>
                    </div>

                     <!-- Sección de búsqueda y añadir productos -->
                    <div class="row mt-4 justify-content-center">
                        <!-- Columna 1 - Entrada S/15.00 -->
                        <div class="col-md-2 mb-3" data-categoria="1">
                            <select class="form-select form-select-sm producto-select mb-2" data-live-search="true">
                                <option value="" selected disabled>Productos</option>
                                @php
                                    // Get product IDs already in menu for this category
                                    $existingProductIds = isset($menuItems[1]) 
                                        ? $menuItems[1]->pluck('producto_id')->toArray() 
                                        : [];
                                @endphp
                                @foreach($productos->where('id_categoria', 1)->whereNotIn('id', $existingProductIds) as $producto)
                                <option value="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}">
                                    {{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                            <br><br>
                            <input type="hidden" class="producto-id" value="">
                            <input type="hidden" class="producto-nombre" value="">
                            <input type="text" class="form-control form-control-sm mb-2 stock-input"
                                placeholder="Stock">
                            <button class="btn btn-secondary btn-sm w-100 btn-anadir">AÑADIR</button>
                        </div>

                        <!-- Columna 2 - Entrada S/20.00 -->
                        <div class="col-md-2 mb-3" data-categoria="2">
                            <select class="form-select form-select-sm producto-select mb-2" data-live-search="true">
                                <option value="" selected disabled>Productos</option>
                                @php
                                    $existingProductIds = isset($menuItems[2]) 
                                        ? $menuItems[2]->pluck('producto_id')->toArray() 
                                        : [];
                                @endphp
                                @foreach($productos->where('id_categoria', 2)->whereNotIn('id', $existingProductIds) as $producto)
                                <option value="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}">
                                    {{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                            <br><br>
                            <input type="hidden" class="producto-id" value="">
                            <input type="hidden" class="producto-nombre" value="">
                            <input type="text" class="form-control form-control-sm mb-2 stock-input"
                                placeholder="Stock">
                            <button class="btn btn-secondary btn-sm w-100 btn-anadir">AÑADIR</button>
                        </div>

                        <!-- Columna 3 - Fondo S/15.00 -->
                        <div class="col-md-2 mb-3" data-categoria="3">
                            <select class="form-select form-select-sm producto-select mb-2" data-live-search="true">
                                <option value="" selected disabled>Productos</option>
                                @php
                                    $existingProductIds = isset($menuItems[3]) 
                                        ? $menuItems[3]->pluck('producto_id')->toArray() 
                                        : [];
                                @endphp
                                @foreach($productos->where('id_categoria', 3)->whereNotIn('id', $existingProductIds) as $producto)
                                <option value="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}">
                                    {{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                            <br><br>
                            <input type="hidden" class="producto-id" value="">
                            <input type="hidden" class="producto-nombre" value="">
                            <input type="text" class="form-control form-control-sm mb-2 stock-input"
                                placeholder="Stock">
                            <button class="btn btn-secondary btn-sm w-100 btn-anadir">AÑADIR</button>
                        </div>

                        <!-- Columna 4 - Fondo S/20.00 -->
                        <div class="col-md-2 mb-3" data-categoria="4">
                            <select class="form-select form-select-sm producto-select mb-2" data-live-search="true">
                                <option value="" selected disabled>Productos</option>
                                @foreach($productos->where('id_categoria', 4) as $producto)
                                <option value="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}">
                                    {{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                            <br><br>
                            <input type="hidden" class="producto-id" value="">
                            <input type="hidden" class="producto-nombre" value="">
                            <input type="text" class="form-control form-control-sm mb-2 stock-input"
                                placeholder="Stock">
                            <button class="btn btn-secondary btn-sm w-100 btn-anadir">AÑADIR</button>
                        </div>

                        <!-- Columna 5 - Extras (con campo de precio) -->
                        <div class="col-md-2 mb-3" data-categoria="5">
                            <select class="form-select form-select-sm producto-select mb-2" data-live-search="true">
                                <option value="" selected disabled>Productos</option>
                                @foreach($productos->where('id_categoria', 5) as $producto)
                                <option value="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}">
                                    {{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                            <br><br>
                            <input type="hidden" class="producto-id" value="">
                            <input type="hidden" class="producto-nombre" value="">
                            <input type="text" class="form-control form-control-sm mb-2 stock-input"
                                placeholder="Stock">
                            <input type="text" class="form-control form-control-sm mb-2 precio-input"
                                placeholder="Precio">
                            <button class="btn btn-secondary btn-sm w-100 btn-anadir">AÑADIR</button>
                        </div>

                        <!-- Columna 6 - Combos (con campo de precio) -->
                        <div class="col-md-2 mb-3" data-categoria="6">
                            <select class="form-select form-select-sm producto-select mb-2" data-live-search="true">
                                <option value="" selected disabled>Productos</option>
                                @foreach($productos->where('id_categoria', 6) as $producto)
                                <option value="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}">
                                    {{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                            <br><br>
                            <input type="hidden" class="producto-id" value="">
                            <input type="hidden" class="producto-nombre" value="">
                            <input type="text" class="form-control form-control-sm mb-2 stock-input"
                                placeholder="Stock">
                            <input type="text" class="form-control form-control-sm mb-2 precio-input"
                                placeholder="Precio">
                            <button class="btn btn-secondary btn-sm w-100 btn-anadir">AÑADIR</button>
                        </div>
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

    <!-- Required vendors -->
    <!-- At the bottom of the file -->
    <script src="{{ asset('access/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('access/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/swiper/js/swiper-bundle.min.js') }}"></script>
    <!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Dashboard -->
    <script src="{{ asset('access/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('access/js/custom.js') }}"></script>
    <script src="{{ asset('access/js/demo.js') }}"></script>


    <script>
    $(document).ready(function() {

        $('#btn-volver').on('click', function(e) {
        e.preventDefault();
        // Verificar si hay un referrer (página anterior)
        if(document.referrer && document.referrer.includes('menuSemanal')) {
            // Si la página anterior es el menú semanal, recargar esa URL
            window.location.href = document.referrer;
        } else {
            // Si no hay referrer o no es el menú semanal, ir a la página de menú semanal
            window.location.href = '/menuSemanal';
        }
    });

        $('.producto-select').select2({
        placeholder: 'Buscar producto...',
        allowClear: true,
        width: '100%',
        language: {
            noResults: function() {
                return "No se encontraron resultados";
            },
            searching: function() {
                return "Buscando...";
            }
        }
    });

    // Usar el evento change nativo
    $('.producto-select').on('select2:select', function(e) {
        const container = $(this).closest('div[data-categoria]');
        const productoId = $(this).val();
        const productoNombre = $(this).find('option:selected').text().trim();
        
        container.find('.producto-id').val(productoId);
        container.find('.producto-nombre').val(productoNombre);
        
        console.log("Producto seleccionado:", productoId, productoNombre);
    });

        let nuevosItems = [];

        

        // Handle the "AÑADIR" button click
        $('.btn-anadir').click(function() {
    const container = $(this).closest('.col-md-2');
    const categoriaId = container.data('categoria');
    
    // Obtener directamente del select en lugar de los campos ocultos
    const select = container.find('.producto-select');
    const productoId = select.val();
    const productoNombre = select.find('option:selected').text().trim();
    
    const stock = container.find('.stock-input').val();
    const precio = container.find('.precio-input').val();

    console.log("Datos obtenidos directamente:", {
        categoriaId, 
        productoId, // Ahora debería tener el valor correcto
        productoNombre,
        stock,
        precio
    });
    // Validation
    if (!productoId) {
        alert('Por favor elija un producto');
        return;
    }

    if (!stock || isNaN(stock) || stock <= 0) {
        alert('Por favor ingrese un valor válido para stock');
        return;
    }

    // For categories 5 and 6 (Extras and Combos), validate price
    if ((categoriaId == 5 || categoriaId == 6) && (!precio || isNaN(precio) || precio <= 0)) {
        alert('Por favor ingrese un precio válido');
        return;
    }

    // Show loading state
    $(this).prop('disabled', true);
    $(this).html('<i class="fa fa-spinner fa-spin"></i> Añadiendo...');

    // Get current date from page
    const fecha = '{{ $fecha }}';

    // Prepare data for AJAX request
    const itemData = {
        categoria_id: categoriaId,
        producto_id: productoId,
        stock_diario: stock,
        precio: precio || null
    };

    // Send AJAX request
    $.ajax({
        url: '/api/menu/registrar',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            fecha: fecha,
            items: [itemData]
        },
        success: function(response) {
    if (response.success) {
        // Update the item with real ID from server
        const newItem = {
            id: response.item_id,
            categoria_id: categoriaId,
            producto_id: productoId,
            producto_nombre: productoNombre,
            stock_diario: stock,
            precio: precio || null
        };

        // Add the item to the UI
        addItemToTable(newItem);

        showNotification(`Producto "${productoNombre}" añadido correctamente`, 'success');

        // Remove the product from the dropdown to prevent duplicates
        container.find('.producto-select option[value="' + productoId + '"]').remove();

        // Reset the form fields - solo resetear los valores sin usar selectpicker
        container.find('.producto-select').val('');
        container.find('.producto-id').val('');
        container.find('.producto-nombre').val('');
        container.find('.stock-input').val('');
        if (container.find('.precio-input').length) {
            container.find('.precio-input').val('');
        }
    } else {
        alert('Error al guardar el producto: ' + (response.message || 'Error desconocido'));
    }
},
        error: function(xhr) {
            alert('Error al guardar el producto: ' + xhr.responseText);
        },
        complete: function() {
            // Reset button state
            container.find('.btn-anadir').prop('disabled', false);
            container.find('.btn-anadir').html('AÑADIR');
        }
    });
});

        // Function to add an item to the table
        function addItemToTable(item) {
    const categoriaId = item.categoria_id;
    
    // Find the column in the table for this category (index is 0-based)
    const columnIndex = categoriaId - 1;
    
    // Create the item HTML
    let itemHtml = `
        <div class="menu-item" data-id="${item.id}">
            <a href="#" class="btn btn-danger shadow btn-xs sharp btn-eliminar" 
               data-id="${item.id}" title="Eliminar">
                <i class="fa fa-trash"></i>
            </a>
            <span>
                ${item.stock_diario} - ${item.producto_nombre}
                ${categoriaId >= 5 || item.precio ? ' (S/' + item.precio + ')' : ''}
            </span>
        </div>
    `;

    // Find the first empty cell in this column or create a new row if needed
    let emptyCell = false;
    let tableRows = $('table tbody tr');
    
    for(let i = 0; i < tableRows.length; i++) {
        let cell = $(tableRows[i]).find('td').eq(columnIndex);
        if(cell.find('.menu-item').length === 0) {
            cell.append(itemHtml);
            emptyCell = true;
            break;
        }
    }
    
    // If no empty cell was found, add a new row
    if(!emptyCell) {
        let newRow = $('<tr></tr>');
        for(let i = 0; i < 6; i++) {
            newRow.append('<td></td>');
        }
        $('table tbody').append(newRow);
        
        // Add the item to the right cell in the new row
        newRow.find('td').eq(columnIndex).append(itemHtml);
    }
}

$(document).on('click', '.btn-eliminar', function(e) {
    e.preventDefault();
    
    // Obtener el ID del elemento a eliminar
    const itemId = $(this).data('id');
    const menuItem = $(this).closest('.menu-item');
    
    // Mostrar confirmación
    if (confirm('¿Estás seguro que deseas eliminar este producto del menú?')) {
        // Deshabilitar el botón para evitar clics múltiples
        $(this).prop('disabled', true);
        
        // Enviar solicitud AJAX para eliminar
        $.ajax({
            url: '/api/menu/eliminar/' + itemId,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {

                    showNotification('Producto eliminado correctamente', 'danger');
                    // Eliminar el elemento de la UI con una animación suave
                    menuItem.fadeOut(300, function() {
                        // Eliminar el elemento del DOM
                        $(this).remove();
                        
                        // Reorganizar la tabla si es necesario
                        reorganizarTabla();
                    });
                } else {
                    alert('Error al eliminar: ' + (response.message || 'Error desconocido'));
                    // Restaurar el botón
                    menuItem.find('.btn-eliminar').prop('disabled', false);
                }
            },
            error: function(xhr) {
                alert('Error al eliminar: ' + xhr.responseText);
                // Restaurar el botón
                menuItem.find('.btn-eliminar').prop('disabled', false);
            }
        });
    }
});

function showNotification(message, type = 'success') {
    // Crear elemento de notificación
    const notification = $(`
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `);
    
    // Añadir al contenedor
    $('#notification-container').append(notification);
    
    // Auto-ocultar después de 2 segundos
    setTimeout(function() {
        notification.alert('close');
    }, 2000);
}

// Función para reorganizar la tabla después de eliminar elementos
function reorganizarTabla() {
    // Obtener todas las filas de la tabla
    const tableRows = $('table tbody tr');
    
    // Recorrer cada columna (categoría)
    for (let col = 0; col < 6; col++) {
        // Obtener todos los elementos de esta columna
        const items = [];
        tableRows.each(function() {
            const cell = $(this).find('td').eq(col);
            const menuItem = cell.find('.menu-item');
            if (menuItem.length > 0) {
                items.push(menuItem);
                menuItem.detach(); // Quitar temporalmente sin eliminar
            }
        });
        
        // Reinsertarlos desde arriba hacia abajo
        for (let i = 0; i < items.length; i++) {
            const row = i < tableRows.length ? tableRows.eq(i) : null;
            if (!row) {
                // Si no hay suficientes filas, ya no hay qué hacer
                break;
            }
            row.find('td').eq(col).append(items[i]);
        }
    }
    
    // Eliminar filas vacías desde abajo hacia arriba
    for (let i = tableRows.length - 1; i >= 0; i--) {
        const row = tableRows.eq(i);
        let isEmpty = true;
        
        row.find('td').each(function() {
            if ($(this).find('.menu-item').length > 0) {
                isEmpty = false;
                return false; // Romper el bucle
            }
        });
        
        if (isEmpty) {
            row.remove();
        } else {
            // Si encontramos una fila no vacía, podemos detenernos
            break;
        }
    }
}

    

           
        

    });
    </script>

    <style>
    /* Custom styling for select elements */
    .producto-select {
        font-size: 0.75rem !important;
        height: 28px !important;
        padding: 2px 8px !important;
        max-width: 100% !important;
    }
    
    /* Style for Bootstrap Select elements */
    .bootstrap-select .dropdown-toggle {
        font-size: 0.75rem !important;
        height: 28px !important;
        padding: 2px 8px !important;
        border-radius: 0.2rem !important;
    }
    
    /* Fix dropdown menu scrolling */
    .bootstrap-select .dropdown-menu {
        font-size: 0.75rem !important;
        min-width: 100% !important;
        max-height: 250px !important;
        overflow-y: auto !important;
    }
    
    /* Ensure dropdown content is scrollable */
    .bootstrap-select .dropdown-menu .inner {
        max-height: 200px !important;
        overflow-y: auto !important;
        overflow-x: hidden;
    }
    
    /* Style dropdown items */
    .bootstrap-select .dropdown-menu li a {
        padding: 3px 8px !important;
        white-space: normal;
    }
    
    /* Fix button text overflow */
    .bootstrap-select .filter-option-inner-inner {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        line-height: 1.2 !important;
    }
    
    /* Make the search box smaller */
    .bootstrap-select .bs-searchbox .form-control {
        height: 28px !important;
        font-size: 0.75rem !important;
        padding: 3px 8px !important;
    }
    
    /* Adjust styling for mobile devices */
    @media (max-width: 767.98px) {
        .producto-select, 
        .bootstrap-select .dropdown-toggle,
        .bootstrap-select .dropdown-menu,
        .bootstrap-select .bs-searchbox .form-control {
            font-size: 0.7rem !important;
        }
        
        .col-md-2 {
            padding-left: 5px;
            padding-right: 5px;
        }
    }


    #notification-container .alert {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border-left: 4px solid;
    animation: fadeIn 0.3s;
}

#notification-container .alert-success {
    border-left-color: #28a745;
}

#notification-container .alert-danger {
    border-left-color: #dc3545;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Estilo para el botón volver */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

.select2-container--default .select2-selection--single {
    height: 32px;
    font-size: 0.875rem;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 30px;
    padding-left: 12px;
    color: #495057;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 30px;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #6f42c1;
}

.select2-dropdown {
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.select2-search--dropdown .select2-search__field {
    padding: 6px;
    border-radius: 3px;
}

/* Ajustes para móviles */
@media (max-width: 767.98px) {
    .select2-container {
        font-size: 0.75rem;
    }
    
    .select2-container--default .select2-selection--single {
        height: 30px;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 28px;
    }
}
</style>


</body>