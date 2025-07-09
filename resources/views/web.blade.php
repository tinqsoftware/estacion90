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
	<style>


		.banner-logo{
			height: 65px;
		}

		.bannerSwiper {
			top: 24px;
			width: 100%;
			aspect-ratio: 17 / 7;
			margin-bottom: -30px;

		}

		.swiper-slide {
			padding-bottom: 30px;
		}

		.swiper-slide img {
			object-fit: cover;
			height: 100%;
			width: 100%;
			display: block;
		}

		.banner-dual{
			padding-top:25px;
		}

		.franjas-colores-center {
			position: absolute;
			top: -85px;
			left: 50%;
			transform: translateX(-50%);
			height: 100%;
			width: 80px;
			display: flex;
			flex-direction: column;
			align-items: center;
			z-index: 10;
			pointer-events: none;
		}

		.franjas-horizontales {
			height: 100%;
			width: 80px; /* 5 franjas x 6px = 30px */
			display: flex;
			flex-direction: row;
			overflow: hidden; /* curva inferior derecha */
		}

		.franja {
			height: calc(100% + 80px);
			position: absolute;
			right:0px;
			border-bottom-left-radius: 160px;
		}

		.franja.rojo { 
			border-left: #cb141b solid 80px; 
			border-bottom: #cb141b solid 80px; 
			z-index:0; 
			margin-top:80px;
		}
		.franja.naranja { 
			border-left: #f94519 solid 64px; 
			border-bottom: #f94519 solid 64px; 
			z-index:1; 
			margin-top:64px;
		}
		.franja.anaranjado { 
			border-left: #ff7e0c solid 48px; 
			border-bottom: #ff7e0c solid 48px; 
			z-index:2; 
			margin-top:48px;
		}
		.franja.amarillo { 
			border-left: #ffb80a solid 32px; 
			border-bottom: #ffb80a solid 32px; 
			z-index:3; 
			margin-top:32px;
		}
		.franja.mostaza { 
			border-left: #fff161 solid 16px; 
			border-bottom: #fff161 solid 16px; 
			z-index:4; 
			margin-top:16px;
		}

		.btn-red{
			padding: 0.7875rem 1.319rem;
			border-radius: 0.5rem;
			font-weight: 500;
			font-size: 19px;
			line-height: 1.5;
			background-color:red;
			color:white;
			width: 160px;
			box-shadow: 0 0.3em 1em rgba(0, 0, 0, 0.3);
			text-align:center;
		}


		.franjas-verticales {
			height: 0px;
			width:calc(50% - 40px); /* 5 franjas x 6px = 30px */
			left: calc(50% + 39px);
			display: flex;
			flex-direction: row;
			position:relative;
			top:26px;
			z-index: 10;
		}

		.franjav {
			width: 100%;
			position: absolute;
			margin-top:-1px;
		}

		.franjav.rojo { 
			border-bottom: #cb141b solid 80px; 
		}
		.franjav.naranja { 
			border-bottom: #f94519 solid 64px; 
		}
		.franjav.anaranjado { 
			border-bottom: #ff7e0c solid 48px; 
		}
		.franjav.amarillo { 
			border-bottom: #ffb80a solid 32px; 
		}
		.franjav.mostaza { 
			border-bottom: #fff161 solid 16px; 
		}

		.btn-banner {
			position: absolute;
			top: 42%;
			left: 50%;
			transform: translateX(-50%);
			z-index: 20;
			text-align:center;
		}


		.menu-dia-section {
			background-color: #fff5e8;
			padding: 50px 0;
			position: relative;
			overflow: hidden;
		}

		.titulo-menu-dia {
			font-size: 6rem;
			font-weight: 700;
			color: #4d2c1a;
			line-height: 1.1;
			z-index:5;
		}

		.franjas-horizontal {
			display: flex;
			justify-content: center;
			overflow: hidden;
			height: 6px;
			width: 100%;
		}

		.marquee-container {
			overflow: hidden;
			width: 100%;
			margin-top:-33px;
			left:0px;
		}

		.marquee {
			display: inline-flex;
			animation: scroll-left 50s linear infinite;
		}

		.cuadro-menu{
			border-radius:40px;
			box-shadow: 0 0.3em 1em rgba(0, 0, 0, 0.3);
			height:280px;
			width: 239px;
			position:relative;
			z-index:4;
		}

		.izquierda{
			left: calc(50% - 680px);
		}
		
		.platos-izquierda{
			left: calc(50% - 500px);
			position:absolute;
			top:150px;
			width: 100%;
			z-index:1;
		}

		.derecha{
			left: calc(50% + 442px);
		}

		.platos-derecha{
			right: calc(50% - 500px);
			position:absolute;
			bottom:100px;
			width: 100%;
			z-index:1;
		}

		.nombre-plato {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			display: block;
			width: 100%;
		}

		@keyframes scroll-left {
			0% { transform: translateX(0); }
			100% { transform: translateX(-100%); }
		}

		.plato{
			background-color:white;
			height: 135px;
			width: 170px;
			padding:10px;
			border-radius:20px;
			z-index:1;
		}

		.plato img {
			height: 90px;
			width: 140px;
			object-fit: cover;
			margin-top: 2px;
		}

		.plato .small {
			font-size: 0.9rem;
		}

		.confeti {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			pointer-events: none;
			z-index: 0;
			overflow: hidden;
		}

		.confeti span {
			position: absolute;
			width: 8px;
			height:22px;
			border-radius: 2px;
			opacity: 0.8;
			z-index: 0;
			animation: none; /* ⛔ sin caída */
		}


		.seccion-carta {
			background: linear-gradient(to bottom,rgb(246, 219, 191),rgb(244, 193, 126)); /* degradado naranja suave */
			position: relative;
			padding: 800px 0px 80px 0px;
		}

		.titulo-seccion {
			color: #8B0000;
			font-size: 1.8rem;
			font-weight: 700;
		}

		.subtitulo-seccion {
			color: #8B0000;
			font-size: 1rem;
			font-weight: 400;
		}

		.card-carta {
			background-color: #ff8000;
			border-radius: 25px;
			padding: 25px 25px;
			width: 285px;
			height: auto;
			margin: auto;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
		}

		.img-carta {
			width: 240px !important;
			height: 240px !important;
			object-fit: cover;
			border-radius: 15px;
		}

		.img-carta-pop {
			border-radius: 0px !important;
		}

		.nombre-plato{
			text-align:left;
			font-size:16pt;
		}
		.plato-precio{
			text-align:left;
			font-size:16pt;
		}

		.btn-comprar {
			background: white;
			color: #ff8000;
			border: none;
			padding: 5px 20px;
			border-radius: 10px;
			margin-top:12px;
			font-weight: bold;
			box-shadow: 0px 2px 3px rgba(0,0,0,0.2);
			width: 100%;
			font-size:17px;
			cursor:pointer;
			text-align:center;
		}

		.btn-comprar-popup {
			background: #ff8000 ;
			color: white;
			border: none;
			margin-top:12px;
			padding: 7px 9px;
			border-radius: 5px;
			font-weight: bold;
			font-size:17px;
			width: 100%;
			cursor:pointer;
			text-align:center;
		}


		.btn-ver-todo {
			background-color: #2d1d12;
			color: white;
			padding: 6px 22px;
			border-radius: 7px;
			font-weight: 550;
			text-decoration: none;
			font-size:13px;
		}

		.swiper-pagination-bullet {
			background: #ff8000;
			opacity: 1;
		}

		.swiper-pagination-bullet-active {
			background: #8B0000;
		}

		.btn-carta-nav {
			color: #ff8000;
			background-color: #fff;
			width: 50px;
			height: 50px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
		}

		.swiper-button-prev::after,
		.swiper-button-next::after {
			font-size: 1.2rem;
			font-weight: bold;
		}

		/* Alternar la altura */
		.slide-item.arriba {
			transform: translateY(0px);
		}
		.slide-item.abajo {
			transform: translateY(40px);
		}

		/* Transición suave si deseas animación */
		.slide-item {
			transition: transform 0.3s ease;
		}

		.cartaSwiper-wrapper {
			position: relative;
			overflow: hidden;
			padding: 0 60px; /* Reservar espacio para las flechas a ambos lados */
			
		}

		.cartaSwiper {
			margin: 0px 11%;
			position: relative;
			overflow: hidden;
			height: 540px;
		}

		.cartaSwiper-wrapper .swiper-button-prev,
		.cartaSwiper-wrapper .swiper-button-next {
			top: 45%;
			transform: translateY(-50%);
			position: absolute;
			z-index: 10;
		}

		.cartaSwiper-wrapper .swiper-button-prev {
			left: 10%; /* visible dentro del wrapper */
		}

		.cartaSwiper-wrapper .swiper-button-next {
			right: 10%;
		}


		.flecha-circular {
			width: 50px;
			height: 50px;
			border-radius: 50%;
			background: white;
			display: flex;
			align-items: center;
			justify-content: center;
			box-shadow: 0 0 10px rgba(0,0,0,0.1);
			cursor: pointer;
			transition: transform 0.2s;
		}

		.flecha-circular:hover {
			transform: scale(1.05);
		}

		/* Flecha izquierda */
		.flecha-izquierda {
			width: 10px;
			height: 10px;
			border-left: 3px solid #ff8000;
			border-bottom: 3px solid #ff8000;
			transform: rotate(45deg);
			margin-left: 2px;
		}

		/* Flecha derecha (invertida) */
		.flecha-derecha {
			width: 10px;
			height: 10px;
			border-right: 3px solid #ff8000;
			border-bottom: 3px solid #ff8000;
			transform: rotate(-45deg);
			margin-right: 2px;
		}

		
		.popup-carta-overlay {
			position: fixed;
			top: 0; left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.7);
			display: none;
			align-items: center;
			justify-content: center;
			z-index: 1000;
			padding: 20px;
		}

		.popup-carta-content {
			background: white;
			border-radius: 20px;
			width: 100%;
			max-width: 1200px;
			height: 83%;
			display: flex;
			flex-direction: column;
			position: relative;
			overflow: hidden;
			box-shadow: 0 8px 20px rgba(0,0,0,0.3);
			padding: 0;
		}

		/* Cabecera fija */
		.popup-carta-header {
			padding: 20px 30px;
			position: sticky;
			top: 0;
			z-index: 10;
		}

		/* Botón cerrar */
		.cerrar-popup-carta , .cerrar-popup-caldos , .cerrar-popup-desayunos {
			background: white;
			color: #8c0000;
			border: none;
			font-size: 2rem;
			cursor: pointer;
			padding: 0 12px;
			border-radius: 50%;
		}

		/* Scroll de platos */
		.popup-carta-scroll {
			overflow-y: auto;
			padding: 0px 40px;
			flex-grow: 1;
		}

		/* Grid responsive */
		.popup-carta-grid {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			gap: 30px;
		}

		.card-popup {
			background-color: #FFF;
			padding: 0px;
			width: 242px !important;
			border-radius: 0px !important;
			border: solid 0.2px #BBB !important;
			box-shadow: none !important;
		}

		/* Texto estilo popup */
		.texto-popup {
			color: black;
			font-size: 14px;
			line-height: 1.2;
			text-align: left;
			margin-bottom: 4px;
			text-align:center;
		}

		.nombres-popup{
			width: 100%;
			padding:12px;
		}

		@media (max-width: 991px) {
			.popup-carta-grid {
				grid-template-columns: repeat(3, 1fr);
				gap:15px;
			}
			.texto-popup {
				font-size: 12px;
			}
			.popup-carta-header {
				padding: 15px 20px;
			}
			.popup-carta-scroll {
				padding: 10px;
			}

			.card-popup {
				background-color:#ffffff73 !important;
				padding: 0px !important;
				border-radius: 0px !important;
				box-shadow: 0 4px 12px rgba(0,0,0,0.15);
				padding:8px;
				width: 105px !important;
			}

			.nombres-popup{
				width: 100%;
				padding:6px;
			}

			.btn-ver-todo {
				padding: 3px 12px;
				border-radius: 4px;
				font-weight: 350;
				font-size:10px;
			}


		}





		@media (max-width: 767px) {
			.bannerSwiper {
				height: 24rem;
				width: calc(100% - 40px);
				left: 20px;
				top: 6px;
			}

			.franjas-colores-center {
				top: -224px;
				left: 20px;
				width: 40px;
			}

			.franjas-horizontales {
				height: 100%;
				width: 40px; /* 5 franjas x 6px = 30px */
			}
			.franja {
				height: calc(100% + 200px);
				border-bottom-left-radius: 200px;
			}

			.franja.rojo { 
				border-left: #cb141b solid 40px; 
				border-bottom: #cb141b solid 40px; 
				margin-top:40px;
			}
			.franja.naranja { 
				border-left: #f94519 solid 32px; 
				border-bottom: #f94519 solid 32px; 
				margin-top:32px;
			}
			.franja.anaranjado { 
				border-left: #ff7e0c solid 24px; 
				border-bottom: #ff7e0c solid 24px; 
				margin-top:24px;
			}
			.franja.amarillo { 
				border-left: #ffb80a solid 16px; 
				border-bottom: #ffb80a solid 16px; 
				margin-top:16px;
			}
			.franja.mostaza { 
				border-left: #fff161 solid 8px; 
				border-bottom: #fff161 solid 8px; 
				margin-top:8px;
			}

			.franjas-verticales {
				width:calc(100% - 40px); /* 5 franjas x 6px = 30px */
				left: 40px;
				top:4px;
			}

			.franjav {
				margin-top:2px;
			}

			.franjav.rojo { 
				border-bottom: #cb141b solid 40px; 
			}
			.franjav.naranja { 
				border-bottom: #f94519 solid 32px; 
			}
			.franjav.anaranjado { 
				border-bottom: #ff7e0c solid 24px; 
			}
			.franjav.amarillo { 
				border-bottom: #ffb80a solid 16px; 
			}
			.franjav.mostaza { 
				border-bottom: #fff161 solid 8px; 
			}

			.banner-logo{
				height: 40px;
			}

			.banner-dual{
				padding-top:20px;
			}


			/* */
			.plato{
				background-color:white;
				height: 84px;
				width: 95px;
				padding:7px;
				border-radius:17px;
				z-index:1;
				margin-right: 0.9rem !important;
			}

			.plato img {
				height: 50px;
				width: 78px;
				object-fit: cover;
				margin-top: 2px;
			}

			.plato .small {
				font-size: 0.7rem;
			}
			
			.cuadro-menu{
				border-radius:20px;
				box-shadow: 0 0.3em 1em rgba(0, 0, 0, 0.3);
				height:157px;
				width: 134px;
				position:relative;
				z-index:4;
			}

			.izquierda{
				left: calc(50% - 175px);
			}
			
			.platos-izquierda{
				left: calc(50% - 50px);
				position:absolute;
				top:105px;
				width: 100%;
				z-index:1;
			}

			.derecha{
				left: calc(50% + 40px);
			}

			.platos-derecha{
				right: calc(50% - 50px);
				position:absolute;
				bottom:45px;
				width: 100%;
				z-index:1;
			}


			.confeti span {
				position: absolute;
				width: 4px;
				height:11px;
				border-radius: 1px;
				opacity: 0.8;
				z-index: 0;
				animation: none; /* ⛔ sin caída */
			}

			.titulo-menu-dia {
				font-size: 3rem;
				margin-top:20px;
			}


			.card-carta {
				background-color: #ff8000;
				border-radius: 12px;
				padding: 12px 12px;
				width: 130px;
				margin: auto;
				box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
			}

			.img-carta {
				width: 103px !important;
				height: 103px !important;
				object-fit: cover;
				border-radius: 5px;
			}



			.nombre-plato{
				text-align:left;
				font-size:9pt;
			}
			.plato-precio{
				text-align:left;
				font-size:11pt;
			}

			.btn-comprar {
				background: white;
				color: #ff8000;
				border: none;
				padding: 3px 9px;
				width:100%;
				border-radius: 8px;
				font-weight: bold;
				font-size:10px;
				box-shadow: 0px 4px 6px rgba(0,0,0,0.2);
				cursor:pointer;
				text-align:center;
			}

			.btn-comprar-popup {
				padding: 2px 9px;
				border-radius: 3px;
				font-size:12px;
				cursor:pointer;
				text-align:center;
			}


			/* Alternar la altura */
			.slide-item.arriba {
				transform: translateY(0px);
			}
			.slide-item.abajo {
				transform: translateY(0px);
			}

			.btn-carta-nav {
				color: #ff8000;
				background-color: #fff;
				width: 30px;
				height: 30px;
				border-radius: 50%;
				display: flex;
				align-items: center;
				justify-content: center;
				box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
			}

			.cartaSwiper-wrapper {
				position: relative;
				overflow: hidden;
				padding: 0px; /* Reservar espacio para las flechas a ambos lados */
			}

			.cartaSwiper {
				margin: 0px 14%;
				height: 120%;
			}

			.cartaSwiper-wrapper .swiper-button-prev {
				left: 5%; /* visible dentro del wrapper */
			}

			.cartaSwiper-wrapper .swiper-button-next {
				right: 5%;
			}



		}




	</style>

	
</head>
<body>

	<!-- HEADER FIJO -->
	<header id="main-header" class="fixed-top bg-white shadow-sm py-3 z-50">
		<div class="d-flex justify-content-between align-items-center" style="padding:0px 30px" >
			<a href="/inicio" class="btn-red btn-sm d-none d-md-block" style="cursor:pointer;">ORDENA AQUÍ</a>
			<img src="{{ asset('access/images/logo-full.png') }}" class="banner-logo">
			<nav class="d-none d-md-block">
				<a href="#menu-dia" class="mx-2">MENU</a>
				<a href="#platos-carta" class="mx-2">CARTA</a>
			</nav>
			

		</div>
	</header>

	<!-- BANNERS CON SEPARADOR -->
	<section class="mt-5 banner-dual">
		<div class="container-fluid px-0 position-relative">
			<a href="/inicio" class="btn-red mt-2 btn-banner d-none d-md-block" style="cursor:pointer;">ORDENA AQUÍ</a>
			<!-- Franja siempre al centro (visible solo en desktop) -->
			<div class="franjas-colores-center d-md-flex">
				<div class="franjas-horizontales">
					<div class="franja rojo"></div>
					<div class="franja naranja"></div>
					<div class="franja anaranjado"></div>
					<div class="franja amarillo"></div>
					<div class="franja mostaza curva"></div> <!-- última con curva -->
				</div>
			</div>
			<!-- Swiper Carousel -->
			<div class="swiper bannerSwiper">
    <div class="swiper-wrapper">
        @foreach($banners as $banner)
            <div class="swiper-slide position-relative">
                <!-- Franja móvil (solo en mobile) -->
                <a >
                    <img src="{{ asset($banner->url_imagen) }}" class="w-100 h-100 object-fit-cover" />
                </a>
            </div>
        @endforeach
    </div>
</div>
		</div>
		<!-- Franja siempre al centro (visible solo en desktop) -->
		<div class="franjas-verticales">
			<div class="franjav rojo"></div>
			<div class="franjav naranja"></div>
			<div class="franjav anaranjado"></div>
			<div class="franjav amarillo"></div>
			<div class="franjav mostaza curva"></div> <!-- última con curva -->
		</div>
	</section>

			



	<!-- MENÚ DEL DÍA -->
	<section id="menu-dia" class="menu-dia-section position-relative">
		<!-- Confeti -->
		<div class="position-relative pt-5">
			<div class="justify-content-between align-items-center">
				<!-- Menú S/15 -->
				<img src="{{ asset('access/images/menu/'. $img15->url_imagen) }}" class="img-fluid cuadro-menu izquierda" alt="Menú S/15">
				<div class="text-center platos-izquierda">
					<!-- Franjas -->
					<div class="franjas-horizontal">
						<div class="franjav rojo"></div>
						<div class="franjav naranja"></div>
						<div class="franjav anaranjado"></div>
						<div class="franjav amarillo"></div>
						<div class="franjav mostaza"></div>
					</div>

					<!-- Carrusel de platos S/15 -->
					<div class="marquee-container">
						<div class="marquee">
							@foreach($entradas15 as $p)
								<div class="plato text-center me-5">
									<div class="fw-bold small nombre-plato">{{ $p->nombre }}</div>
									<img src="{{ asset($p->imagen) }}" class="rounded mb-1">
								</div>
							@endforeach

							@foreach($fondos15 as $p)
								<div class="plato text-center me-5">
									<div class="fw-bold small nombre-plato">{{ $p->nombre }}</div>
									<img src="{{ asset($p->imagen) }}" class="rounded mb-1">
								</div>
							@endforeach
						</div>
					</div>
				</div>

				<!-- Título central -->
				<div class=" text-center">
					<h2 class="titulo-menu-dia">MENÚ DEL DÍA</h2><br/>
					

				</div>

				<!-- Menú S/20 -->
				 
				<img src="{{ asset('access/images/menu/' . $img20->url_imagen) }}" class="img-fluid mt-5 cuadro-menu derecha" alt="Menú S/20">
				<div class="text-center platos-derecha">
					<!-- Franjas -->
					<div class="franjas-horizontal">
						<div class="franjav rojo"></div>
						<div class="franjav naranja"></div>
						<div class="franjav anaranjado"></div>
						<div class="franjav amarillo"></div>
						<div class="franjav mostaza"></div>
					</div>

					<!-- Carrusel de platos S/20 -->
					<div class="marquee-container">
						<div class="marquee">
							@foreach($entradas20 as $p)
								<div class="plato text-center me-5">
									<div class="fw-bold small nombre-plato">{{ $p->nombre }}</div>
									<img src="{{ asset($p->imagen) }}" class="rounded mb-1">
								</div>
							@endforeach
							@foreach($fondos20 as $p)
								<div class="plato text-center me-5">
									<div class="fw-bold small nombre-plato">{{ $p->nombre }}</div>
									<img src="{{ asset($p->imagen) }}" class="rounded mb-1">
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="confeti">
			@for($i = 0; $i < 90; $i++)
				<span style="
					top: {{ rand(0, 100) }}%;
					left: {{ rand(0, 100) }}%;
					background-color: {{ collect(['#cb141b', '#f94519', '#ff7e0c', '#ffb80a', '#fff161', '#0acfcf'])->random() }};
					transform: rotate({{ rand(0, 360) }}deg);
				"></span>
			@endfor
		</div>


	</section>

	
	<!-- PLATOS A LA CARTA -->
	<section id="platos-carta" class="seccion-carta py-5 position-relative">
		<div class=" text-left">
			<div class="position-relative">
				<div class="cartaSwiper-wrapper">
					<div class="swiper cartaSwiper">
						<div class="d-flex justify-content-between align-items-center mb-2">
							<h2 class="titulo-seccion m-0">A la carta</h2>
							<a href="javascript:void(0);" id="btn-ver-carta" class="btn-ver-todo">VER TODO</a>
						</div>
						<div class="swiper-wrapper">
							@foreach($platosCarta as $index => $plato)
							<div class="swiper-slide slide-item {{ $index % 2 == 0 ? 'arriba' : 'abajo' }}">
								<div class="card-carta">
									<img src="{{ asset($plato->imagen) }}" class="img-carta mb-2" alt="{{ $plato->nombre }}">
									<div class="text-white nombre-plato">{{ $plato->nombre }}</div>
									<div class="text-white plato-precio fw-bold">S/{{ number_format($plato->precio, 2) }}</div>
									<a href="/inicio" class="btn-comprar mt-2" style="display: block; text-decoration: none; color: inherit;">COMPRAR</a>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					<div class="swiper-button-prev btn-carta-nav"><div class="flecha-izquierda"></div></div>
					<div class="swiper-button-next btn-carta-nav"><div class="flecha-derecha"></div></div>
				</div>
				<!-- Paginación -->
				<div class="swiper-pagination mt-3"></div>
			</div>
		</div>

		<div class=" text-left">
			<div class="position-relative">
				<div class="cartaSwiper-wrapper">
					<div class="swiper cartaSwiper">
						<div class="d-flex justify-content-between align-items-center mb-2 ">
							<h2 class="titulo-seccion m-0">Sopas</h2>
							<a href="javascript:void(0);" id="btn-ver-caldos" class="btn-ver-todo">VER TODO</a>
						</div>
						<div class="swiper-wrapper">
							@foreach($caldos as $index => $plato)
							<div class="swiper-slide slide-item {{ $index % 2 == 0 ? 'arriba' : 'abajo' }}">
								<div class="card-carta">
									<img src="{{ asset($plato->imagen) }}" class="img-carta mb-2" alt="{{ $plato->nombre }}">
									<div class="text-white nombre-plato">{{ $plato->nombre }}</div>
									<div class="text-white plato-precio fw-bold">S/{{ number_format($plato->precio, 2) }}</div>
									<a href="/inicio" class="btn-comprar mt-2" style="display: block; text-decoration: none; color: inherit;">COMPRAR</a>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					<div class="swiper-button-prev btn-carta-nav"><div class="flecha-izquierda"></div></div>
					<div class="swiper-button-next btn-carta-nav"><div class="flecha-derecha"></div></div>
				</div>
				<!-- Paginación -->
				<div class="swiper-pagination mt-3"></div>
			</div>
		</div>

		<div class=" text-left">
			<div class="position-relative">
				<div class="cartaSwiper-wrapper">
					<div class="swiper cartaSwiper">
						<div class="d-flex justify-content-between align-items-center mb-2">
							<h2 class="titulo-seccion m-0">Desayunos 90</h2>
							<a href="javascript:void(0);" id="btn-ver-desayunos" class="btn-ver-todo">VER TODO</a>
						</div>
						<div class="swiper-wrapper">
							@foreach($desayunos as $index => $plato)
							<div class="swiper-slide slide-item {{ $index % 2 == 0 ? 'arriba' : 'abajo' }}">
								<div class="card-carta">
									<img src="{{ asset($plato->imagen) }}" class="img-carta mb-2" alt="{{ $plato->nombre }}">
									<div class="text-white nombre-plato">{{ $plato->nombre }}</div>
									<div class="text-white plato-precio fw-bold">S/{{ number_format($plato->precio, 2) }}</div>
									<a href="/inicio" class="btn-comprar mt-2" style="display: block; text-decoration: none; color: inherit;">COMPRAR</a>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					<div class="swiper-button-prev btn-carta-nav"><div class="flecha-izquierda"></div></div>
					<div class="swiper-button-next btn-carta-nav"><div class="flecha-derecha"></div></div>
				</div>
				<!-- Paginación -->
				<div class="swiper-pagination mt-3"></div>
			</div>

		</div>
	</section>



	<div id="popup-carta" class="popup-carta-overlay">
		<div class="popup-carta-content">
			<div class="popup-carta-header d-flex justify-content-between align-items-center">
				<h3 class="titulo-seccion m-0">A LA CARTA</h3>
				<button class="cerrar-popup-carta">&times;</button>
			</div>
			<div class="popup-carta-scroll">
				<div class="popup-carta-grid">
					@foreach($platosCarta as $plato)
						<div class="card-carta card-popup">
							<img src="{{ asset($plato->imagen) }}" class="img-carta img-carta-pop" alt="{{ $plato->nombre }}">
							<div class="nombres-popup">
								<div class="nombre-plato texto-popup fw-bold pb-2">{{ $plato->nombre }}</div>
								<div class="plato-precio texto-popup">S/{{ number_format($plato->precio, 2) }}</div>
								<a href="/inicio" class="btn-comprar mt-2" style="display: block; text-decoration: none; color: inherit;">COMPRAR</a>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<div id="popup-caldos" class="popup-carta-overlay">
		<div class="popup-carta-content">
			<div class="popup-carta-header d-flex justify-content-between align-items-center">
				<h3 class="titulo-seccion m-0">SOPAS</h3>
				<button class="cerrar-popup-caldos">&times;</button>
			</div>
			<div class="popup-carta-scroll">
				<div class="popup-carta-grid">
					@foreach($caldos as $plato)
						<div class="card-carta card-popup">
							<img src="{{ asset($plato->imagen) }}" class="img-carta img-carta-pop" alt="{{ $plato->nombre }}">
							<div class="nombres-popup">
								<div class="nombre-plato texto-popup fw-bold pb-2">{{ $plato->nombre }}</div>
								<div class="plato-precio texto-popup">S/{{ number_format($plato->precio, 2) }}</div>
								<a href="/inicio" class="btn-comprar mt-2" style="display: block; text-decoration: none; color: inherit;">COMPRAR</a>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<div id="popup-desayunos" class="popup-carta-overlay">
		<div class="popup-carta-content">
			<div class="popup-carta-header d-flex justify-content-between align-items-center">
				<h3 class="titulo-seccion m-0">DESAYUNOS 90</h3>
				<button class="cerrar-popup-desayunos">&times;</button>
			</div>
			<div class="popup-carta-scroll">
				<div class="popup-carta-grid">
					@foreach($desayunos as $plato)
						<div class="card-carta card-popup">
							<img src="{{ asset($plato->imagen) }}" class="img-carta img-carta-pop" alt="{{ $plato->nombre }}">
							<div class="nombres-popup">
								<div class="nombre-plato texto-popup fw-bold pb-2">{{ $plato->nombre }}</div>
								<div class="plato-precio texto-popup">S/{{ number_format($plato->precio, 2) }}</div>
								<a href="/inicio" class="btn-comprar mt-2" style="display: block; text-decoration: none; color: inherit;">COMPRAR</a>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>


	<footer class="bg-danger text-white text-center py-4">
		<img src="{{ asset('access/images/logo_white.png') }}" style="height:40px">
		<p class="mt-2">ESTACIÓN 90 ES UN VIAJE AL SABOR RETRO...</p>
		<p>+51 913689664 | estacion90@gmail.com</p>
		<p class="mb-0">Síguenos:
			<a href="https://www.facebook.com/estacion90restaurant" target="_blank"><i class="fab fa-facebook mx-1"></i></a>
			<a href="https://www.instagram.com/estacion90restaurant" target="_blank"><i class="fab fa-instagram mx-1"></i></a>
			<a href="https://www.tiktok.com/@estacion90restaurant" target="_blank"><i class="fab fa-youtube mx-1"></i></a>
		</p>
	</footer>
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

	<script>
		const swiper = new Swiper(".bannerSwiper", {
			slidesPerView: 2,
			spaceBetween: 80,
			breakpoints: {
				0: {
					slidesPerView: 1,
				},
				768: {
					slidesPerView: 2,
				}
			},
			loop: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			}
		});

		const swiperCarta = new Swiper(".cartaSwiper", {
			slidesPerView: 4,
			spaceBetween: 30,
			loop: true, 
			centeredSlides: false,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			autoplay: {
				delay: 1450,
				disableOnInteraction: false,
			},
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
			},
			breakpoints: {
				0: { slidesPerView: 2 },
				576: { slidesPerView: 2 },
				1100: { slidesPerView: 2 },
				1250: { slidesPerView: 3  },
				1600: { slidesPerView: 4 }
			}
		});

		//PLATOS A LA CARTA
		document.getElementById('btn-ver-carta').addEventListener('click', function() {
			document.getElementById('popup-carta').style.display = 'flex';
		});

		document.querySelector('.cerrar-popup-carta').addEventListener('click', function() {
			document.getElementById('popup-carta').style.display = 'none';
		});

		document.getElementById('popup-carta').addEventListener('click', function(e) {
			if (e.target === this) this.style.display = 'none';
		});


		//CALDOS
		document.getElementById('btn-ver-caldos').addEventListener('click', function() {
			document.getElementById('popup-caldos').style.display = 'flex';
		});

		document.querySelector('.cerrar-popup-caldos').addEventListener('click', function() {
			document.getElementById('popup-caldos').style.display = 'none';
		});
		
		document.getElementById('popup-caldos').addEventListener('click', function(e) {
			if (e.target === this) this.style.display = 'none';
		});


		//DESAYUNOS
		document.getElementById('btn-ver-desayunos').addEventListener('click', function() {
			document.getElementById('popup-desayunos').style.display = 'flex';
		});

		document.querySelector('.cerrar-popup-desayunos').addEventListener('click', function() {
			document.getElementById('popup-desayunos').style.display = 'none';
		});
		
		document.getElementById('popup-desayunos').addEventListener('click', function(e) {
			if (e.target === this) this.style.display = 'none';
		});


		function enviarPedidoWhatsApp(nombrePlato) {
			const mensaje = `Hola, qué tal. Quisiera saber si tienen "${nombrePlato}"`;
			const numero = '51913689664'; // número con código de país
			const url = `https://wa.me/${numero}?text=${encodeURIComponent(mensaje)}`;
			window.open(url, '_blank');
		}


		function solicitarCartaHoy() {
			const mensaje = "Hola, me podrían pasar la carta de hoy";
			const numero = '51913689664';
			const url = `https://wa.me/${numero}?text=${encodeURIComponent(mensaje)}`;
			window.open(url, '_blank');
		}

		
	</script>




</body>
</html>