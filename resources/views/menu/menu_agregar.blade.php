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
                                            <button class="delete-btn"
                                                data-id="{{ $menuItems[$categoriaId][$i]->id }}"></button>
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
        // Add menu item without page refresh
        $('.btn-secondary').click(function() {
            const column = $(this).closest('.col');
            const categoria = column.index() + 1; // Category based on column position
            const producto = column.find('input').first().val();
            const precio = column.find('input[placeholder="Precio"]').val() || null;
            const fecha = '{{ $fecha }}';
            
            if (!producto) {
                alert('Por favor seleccione un producto');
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
                    location.reload(); // Temporary - should be replaced with DOM manipulation
                });
            });
            
            $('#btnCancelar').click(function() {
                $('#confirmDialog').hide();
            });
        });
    });
</script>


</body>