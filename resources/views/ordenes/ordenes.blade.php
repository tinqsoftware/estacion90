<!DOCTYPE html>
<html lang="en">
<head>
    
	<!-- All Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="Tinq Sofware" />
	<meta name="robots" content="" />
	<meta name="description" content="estacion90"/>
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

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
	
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper" class="dlab-overflow">
       
	@include('partials.header')
	@include('partials.sidebar')


		@php use Carbon\Carbon; @endphp
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container mt-3" style=" ">
				<div class="row">

                    <div class="col-xl-12 col-xxl-12 p-10">
						<div class=" row">
							
                            @foreach($pedidos as $pedido)
                                @php
                                    $fechaPedido = Carbon::parse($pedido->created_at)->locale('es')->isoFormat('dddd D MMMM YYYY');
                                    $horaPedido = Carbon::parse($pedido->created_at)->format('H:i');
                                    $horaLlegada = Carbon::parse($pedido->hora_programada);
                                    $ahora = Carbon::now();
                                    $diferenciaSegundos = $horaLlegada->diffInSeconds($ahora, false); // negativo si aún no ha llegado
                                @endphp

                                <div class="card mb-4 col-xl-3 col-xxl-3 col-12">
                                    <div class="card-body">
                                        <h4 class="mb-2">Pedido #{{ $pedido->id }} - <span>{{ $fechaPedido }}</span></h4>

                                        <p><b>Estado:</b>
                                            @switch($pedido->estado)
                                                @case(0) <span class="badge bg-warning text-dark">Pendiente</span> @break
                                                @case(1) <span class="badge bg-info text-dark">En preparación</span> @break
                                                @case(2) <span class="badge bg-success">Preparado</span> @break
                                                @case(3) <span class="badge bg-primary">En traslado</span> @break
                                            @endswitch
                                        </p>

                                        <p><b>Dirección:</b> {{ $pedido->direccion_contacto }} - {{ $pedido->direccionDistrito->nombre ?? '' }}</p>
                                        <p><b>Hora de pedido:</b> {{ $horaPedido }}<br>
                                        <b>Hora estimada de llegada:</b> {{ $horaLlegada->format('H:i') }}
                                        </p>

                                        @if($diferenciaSegundos > 0)
                                            <p class="text-success">Pedido entregado</p>
                                        @else
                                            <div id="countdown-{{ $pedido->id }}" class="text-danger mb-2" style="font-weight:bold;"></div>
                                            <script>
                                                const countdown{{ $pedido->id }} = () => {
                                                    const now = new Date().getTime();
                                                    const target = new Date("{{ $horaLlegada->format('Y-m-d H:i:s') }}").getTime();
                                                    const distance = target - now;

                                                    if (distance <= 0) {
                                                        document.getElementById("countdown-{{ $pedido->id }}").innerHTML = "¡En cualquier momento llega!";
                                                        clearInterval(timer{{ $pedido->id }});
                                                        return;
                                                    }

                                                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                    document.getElementById("countdown-{{ $pedido->id }}").innerHTML = `Llega estimada en ${minutes}m ${seconds}s`;
                                                };

                                                const timer{{ $pedido->id }} = setInterval(countdown{{ $pedido->id }}, 1000);
                                                countdown{{ $pedido->id }}(); // ejecutar inmediatamente
                                            </script>
                                        @endif

                                        @foreach($pedido->comensales as $comensal)
                                            <hr>
                                            <h5>{{ $comensal->nombre_comensal }}</h5>
                                            <ul>
                                                @foreach($comensal->detalles as $detalle)
                                                    <li class="d-flex align-items-center mb-3 border-bottom pb-2">
                                                        <div class="me-3">
                                                            <img src="{{ asset($detalle->producto->imagen ?? 'images/sin-imagen.png') }}"
                                                                alt="{{ $detalle->producto->nombre ?? 'Sin nombre' }}"
                                                                class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="mb-1 font-w600">{{ $detalle->producto->nombre ?? 'Producto eliminado' }}</h5>
                                                            <p class="mb-0 text-muted">Cantidad: {{ $detalle->cantidad }} x S/ {{ number_format($detalle->precio, 2) }}</p>
                                                        </div>
                                                        <div>
                                                            <span class="text-primary font-w600">S/ {{ number_format($detalle->precio * $detalle->cantidad, 2) }}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endforeach

                                        <p class="mt-3"><b>Total:</b> <h4 class="mb-0 text-primary">S/ {{ number_format($pedido->monto_total, 2) }}</h4></p>
                                    </div>
                                </div>
                            @endforeach

						</div>
					</div>

				</div>
            </div>
        </div>

		




	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
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
		

    </script>

</body>
</html>