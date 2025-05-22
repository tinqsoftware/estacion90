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
                    foreach ([1, 2, 3, 4, 5, 6, 7] as $cat) {
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
                                    <th width="14.28%">Entrada S/15.00</th>
                                    <th width="14.28%">Entrada S/20.00</th>
                                    <th width="14.28%">Fondo S/15.00</th>
                                    <th width="14.28%">Fondo S/20.00</th>
                                    <th width="14.28%">Carta</th>
                                    <th width="14.28%">Combos</th>
                                    <th width="14.28%">Extras</th>
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
                                count($menuItems[6] ?? []),
                                count($menuItems[7] ?? [])
                                );
                                @endphp

                                @for ($i = 0; $i < $maxRows; $i++)
                                <tr>
                                    @foreach ([1, 2, 3, 4, 5, 6, 7] as $categoriaId)
                                    <td>
                                        @if(isset($menuItems[$categoriaId][$i]))
                                        <div>{{ $menuItems[$categoriaId][$i]->producto_nombre }}</span>
                                        <div class="menu-item" data-id="{{ $menuItems[$categoriaId][$i]->id }}" data-producto-id="{{ $menuItems[$categoriaId][$i]->producto_id }}">
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp btn-eliminar"
                                                data-id="{{ $menuItems[$categoriaId][$i]->id }}" title="Eliminar">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <span> <b>{{ $menuItems[$categoriaId][$i]->stock_diario }}</b> - (S/{{ $menuItems[$categoriaId][$i]->precio }}) </span>
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
                        <div class="col custom-col" data-categoria="1">
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
                            <input type="text" class="form-control form-control-sm mb-2 stock-input" placeholder="Stock">
                            <input type="text" class="form-control form-control-sm mb-2 precio-input"  placeholder="Precio">
                            <button class="btn btn-secondary btn-sm w-100 btn-anadir">AÑADIR</button>
                        </div>

                        <!-- Columna 2 - Entrada S/20.00 -->
                        <div class="col custom-col" data-categoria="2">
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
                            <input type="text" class="form-control form-control-sm mb-2 stock-input" placeholder="Stock">
                            <input type="text" class="form-control form-control-sm mb-2 precio-input"  placeholder="Precio">
                            <button class="btn btn-secondary btn-sm w-100 btn-anadir">AÑADIR</button>
                        </div>

                        <!-- Columna 3 - Fondo S/15.00 -->
                        <div class="col custom-col" data-categoria="3">
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
                            <input type="text" class="form-control form-control-sm mb-2 stock-input" placeholder="Stock">
                            <input type="text" class="form-control form-control-sm mb-2 precio-input"  placeholder="Precio">
                            <button class="btn btn-secondary btn-sm w-100 btn-anadir">AÑADIR</button>
                        </div>

                        <!-- Columna 4 - Fondo S/20.00 -->
                        <div class="col custom-col" data-categoria="4">
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
                            <input type="text" class="form-control form-control-sm mb-2 stock-input" placeholder="Stock">
                            <input type="text" class="form-control form-control-sm mb-2 precio-input"  placeholder="Precio">
                            <button class="btn btn-secondary btn-sm w-100 btn-anadir">AÑADIR</button>
                        </div>

                        <!-- Columna 5 - Carta (con campo de precio) -->
                        <div class="col custom-col" data-categoria="5">
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
                            <input type="text" class="form-control form-control-sm mb-2 stock-input" placeholder="Stock">
                            <input type="text" class="form-control form-control-sm mb-2 precio-input"  placeholder="Precio">
                            <button class="btn btn-secondary btn-sm w-100 btn-anadir">AÑADIR</button>
                        </div>

                        <!-- Columna 6 - Combo (con campo de precio) -->

                        <div class="col custom-col" data-categoria="6">
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
                            <input type="text" class="form-control form-control-sm mb-2 stock-input" placeholder="Stock">
                            <input type="text" class="form-control form-control-sm mb-2 precio-input"  placeholder="Precio">
                            <button class="btn btn-secondary btn-sm w-100 btn-anadir">AÑADIR</button>
                        </div>

                        <!-- Columna 7 - Extras (con campo de precio) -->
                         <div class="col custom-col" data-categoria="7">
                            <select class="form-select form-select-sm producto-select mb-2" data-live-search="true">
                                <option value="" selected disabled>Productos</option>
                                @foreach($productos->where('id_categoria', 7) as $producto)
                                <option value="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}">
                                    {{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                            <br><br>
                            <input type="hidden" class="producto-id" value="">
                            <input type="hidden" class="producto-nombre" value="">
                            <input type="text" class="form-control form-control-sm mb-2 stock-input"  placeholder="Stock">
                            <input type="text" class="form-control form-control-sm mb-2 precio-input"  placeholder="Precio">
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
    const container = $(this).closest('.custom-col');
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

    if ( (!precio || isNaN(precio) || precio <= 0)) {
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
    const columnIndex = categoriaId - 1;

    
    
    // Create the item HTML with data-producto-id attribute
    let itemHtml = `
        <div>${item.producto_nombre}</span>
        <div class="menu-item" data-id="${item.id}" data-producto-id="${item.producto_id}">
            <a href="#" class="btn btn-danger shadow btn-xs sharp btn-eliminar" 
               data-id="${item.id}" title="Eliminar">
                <i class="fa fa-trash"></i>
            </a>
            <span><b> ${item.stock_diario}</b> - (S/ ${item.precio} ) </span>
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
        for(let i = 0; i < 7; i++) {
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
    
    // Obtener el ID del producto directamente del atributo data
    const productoId = menuItem.data('producto-id');
    
    // Extraer el nombre del producto de manera segura
    let productoNombre = "producto";
    const spanText = menuItem.find('span').text().trim();
    
    // Intentar extraer el nombre con manejo de errores
    try {
        // Primera estrategia: buscar el patrón "cantidad - nombre (precio)"
        if (spanText.includes(' - ')) {
            const parts = spanText.split(' - ');
            if (parts.length > 1) {
                // Si hay un paréntesis de precio, quitarlo
                if (parts[1].includes(' (')) {
                    productoNombre = parts[1].split(' (')[0].trim();
                } else {
                    productoNombre = parts[1].trim();
                }
            }
        } else {
            // Estrategia alternativa: usar todo el texto después de quitar números iniciales
            productoNombre = spanText.replace(/^\d+\s*/, '').trim();
        }
    } catch (error) {
        console.error("Error al extraer el nombre del producto:", error);
    }
    
    // Determinar la categoría basada en la posición de la celda
    const categoriaId = menuItem.closest('td').index() + 1;
    
    // Mostrar un indicador visual de que se está procesando
    menuItem.addClass('deleting');
    menuItem.find('.btn-eliminar').prop('disabled', true);
    
    // Enviar solicitud AJAX para eliminar
    $.ajax({
        url: '/api/menu/eliminar/' + itemId,
        type: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                // Usar el producto_id de la respuesta o el que obtuvimos del DOM
                const idProducto = response.producto_id || productoId;
                
                if (idProducto) {
                    // Buscar el selector correspondiente a esta categoría
                    const select = $(`.col-md-2[data-categoria="${categoriaId}"] .producto-select`);
                    
                    // Verificar si ya existe esta opción para evitar duplicados
                    if (select.find(`option[value="${idProducto}"]`).length === 0) {
                        // Crear y añadir nueva opción
                        const newOption = new Option(productoNombre, idProducto, false, false);
                        $(newOption).data('nombre', productoNombre);
                        select.append(newOption);
                        
                        // Refrescar Select2 si está en uso
                        if ($.fn.select2) {
                            select.trigger('change');
                        }
                    }
                }
                
                showNotification(`Producto "${productoNombre}" eliminado correctamente`, 'danger');
                
                // Eliminar el elemento de la UI con animación
                menuItem.fadeOut(300, function() {
                    $(this).remove();
                    reorganizarTabla();
                });
            } else {
                menuItem.removeClass('deleting');
                alert('Error al eliminar: ' + (response.message || 'Error desconocido'));
                menuItem.find('.btn-eliminar').prop('disabled', false);
            }
        },
        error: function(xhr) {
            menuItem.removeClass('deleting');
            alert('Error al eliminar: ' + xhr.responseText);
            menuItem.find('.btn-eliminar').prop('disabled', false);
        }
    });
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
.custom-col {
    flex: 0 0 13.28% !important;  /* More precise width calculation for 7 columns */
    max-width: 13.28% !important; /* Must match the flex value */
    margin-right: 0.5% !important;  
    margin-left: 0.5% !important;   
    padding-left: 5px !important;  /* Reduced padding to avoid overflow */
    padding-right: 5px !important; 
    margin-bottom: 1rem !important;
    display: inline-block !important;
    vertical-align: top !important;
}

/* Container adjustments */
.row.mt-4.justify-content-center {
    display: flex !important;
    flex-wrap: wrap !important;
    justify-content: center !important;
    align-items: flex-start !important;
    padding: 0 15px !important;
}

/* Consistent form control spacing */
.form-select, .form-control, select, input {
    height: 34px !important;
    margin-bottom: 8px !important;
    width: 100% !important;
}

/* Select2 container width fix */
.select2-container {
    width: 100% !important;
    margin-bottom: 12px !important;
}

/* Completely remove <br> tags */
br {
    display: none !important;
}

/* Fix for mobile displays */
@media (max-width: 992px) {
    .custom-col {
        flex: 0 0 22% !important;
        max-width: 22% !important;
        margin-right: 1.5% !important;
        margin-left: 1.5% !important;
    }
}
</style>


</body>