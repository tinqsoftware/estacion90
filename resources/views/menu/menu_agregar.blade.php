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
                        <h2 class="mb-4">{{ $fechaFormateada }}</h2>

                        <!-- Update the table to use dynamic data -->
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

    <!-- Dashboard -->
    <script src="{{ asset('access/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('access/js/custom.js') }}"></script>
    <script src="{{ asset('access/js/demo.js') }}"></script>


    <script>
    $(document).ready(function() {

        $('.producto-select').selectpicker({
            liveSearch: true,
            size: 10,
            title: 'Productos'
        });

        // Handle product selection
        $('.producto-select').on('change', function() {
            const container = $(this).closest('.col-md-2');
            const productoId = $(this).val();
            const productoNombre = $(this).find('option:selected').text();

            // Store the selected product data in hidden inputs
            container.find('.producto-id').val(productoId);
            container.find('.producto-nombre').val(productoNombre);
        });

        let nuevosItems = [];

        // Handle clicking on a product in the dropdown
        $(document).on('click', '.dropdown-item', function(e) {
            e.preventDefault();
            const container = $(this).closest('.col-md-2');
            const productoId = $(this).data('id');
            const productoNombre = $(this).text();

            // Update the dropdown button text
            container.find('.dropdown-toggle').text(productoNombre);

            // Store the selected product data in hidden inputs
            container.find('.producto-id').val(productoId);
            container.find('.producto-nombre').val(productoNombre);
        });

        // Handle the "AÑADIR" button click
        $('.btn-anadir').click(function() {
            const container = $(this).closest('.col-md-2');
            const categoriaId = container.data('categoria');
            const productoId = container.find('.producto-id').val();
            const productoNombre = container.find('.producto-nombre').val();
            const stock = container.find('.stock-input').val();
            const precio = container.find('.precio-input').val();

            // Validation
            if (!productoId) {
                alert('Por favor Productos');
                return;
            }

            if (!stock || isNaN(stock) || stock <= 0) {
                alert('Por favor ingrese un valor válido para stock');
                return;
            }

            // For categories 5 and 6 (Extras and Combos), validate price
            if ((categoriaId === 5 || categoriaId === 6) && (!precio || isNaN(precio) || precio <= 0)) {
                alert('Por favor ingrese un precio válido');
                return;
            }

            // Create a new menu item object
            const newItem = {
                id: 'temp_' + Date.now(), // Temporary ID for DOM manipulation
                categoria_id: categoriaId,
                producto_id: productoId,
                producto_nombre: productoNombre,
                stock_diario: stock,
                precio: precio || null
            };

            // Add to our array
            nuevosItems.push(newItem);

            // Add the item to the UI
            addItemToTable(newItem);

            // Reset the form fields
            container.find('.dropdown-toggle').text('Producto');
            container.find('.producto-id').val('');
            container.find('.producto-nombre').val('');
            container.find('.stock-input').val('');
            if (container.find('.precio-input').length) {
                container.find('.precio-input').val('');
            }
        });

        // Function to add an item to the table
        function addItemToTable(item) {
            const categoriaId = item.categoria_id;

            // Find the correct column in the table
            const tableColumn = $('table tbody tr').eq(0).find('td').eq(categoriaId - 1);

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

            // Add the new item to the table
            tableColumn.append(itemHtml);
        }

        // Handle delete button click for temporary items
        $(document).on('click', '.btn-eliminar', function(e) {
            e.preventDefault();
            const itemId = $(this).data('id');

            // If it's a temporary item (starts with 'temp_')
            if (itemId.toString().startsWith('temp_')) {
                // Remove from our array
                nuevosItems = nuevosItems.filter(item => item.id !== itemId);

                // Remove from the UI
                $(this).closest('.menu-item').remove();
            } else {
                // Handle existing items with confirmation dialog
                $('#confirmDialog').show();

                $('#btnEliminar').off('click').on('click', function() {
                    $.post('/api/menu/eliminar/' + itemId, {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    }, function() {
                        $('#confirmDialog').hide();
                        $('.menu-item[data-id="' + itemId + '"]').remove();
                    });
                });

                $('#btnCancelar').click(function() {
                    $('#confirmDialog').hide();
                });
            }
        });

        // Handle the "Registrar Menu" button click
        $('#btn-registrar-menu').click(function() {
            if (nuevosItems.length === 0) {
                alert('No hay cambios para guardar');
                return;
            }

            const fecha = '{{ $fecha }}';

            // Send all new items to the server
            $.ajax({
                url: '/api/menu/registrar',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    fecha: fecha,
                    items: nuevosItems
                },
                success: function(response) {
                    alert('Menú registrado correctamente');
                    location.reload(); // Refresh the page to show the updated menu
                },
                error: function(error) {
                    alert('Error al registrar el menú');
                    console.error(error);
                }
            });
        });
        // Add menu item without page refresh
        $('.btn-secondary').click(function() {
            const column = $(this).closest('.col');
            const categoria = column.index() + 1; // Category based on column position
            const producto = column.find('input').first().val();
            const precio = column.find('input[placeholder="Precio"]').val() || null;
            const fecha = '{{ $fecha }}';

            if (!producto) {
                alert('Por favor Productos');
                return;
            }

            $.post('/api/menu/agregar', {
                fecha: fecha,
                producto_id: producto,
                stock: 20, // Default value, can be made dynamic
                precio: precio,
                _token: '{{ csrf_token() }}'
            }, function(response) {
                // Refresh the table content without full page reload
                location.reload(); // Temporary - should be replaced with DOM manipulation
            });
        });

        // Delete menu item
        $(document).on('click', '.delete-btn', function() {
            const id = $(this).data('id');
            $('#confirmDialog').show();

            $('#btnEliminar').off('click').on('click', function() {
                $.post('/api/menu/eliminar/' + id, {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                }, function() {
                    $('#confirmDialog').hide();
                    location
                        .reload(); // Temporary - should be replaced with DOM manipulation
                });
            });

            $('#btnCancelar').click(function() {
                $('#confirmDialog').hide();
            });
        });
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
</style>


</body>