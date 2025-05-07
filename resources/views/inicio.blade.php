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
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
				<div class="logo-abbr" width="39" height="31" viewBox="0 0 39 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <img src="access/images/logo_white.png" style="height: 50px;" alt=""/>
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
									
									<div class="dropdown header-profile2 " @if(Auth::user()) @else style="height:30px;" @endif>
										
										<a class="nav-link " href="javascript:void(0);"  role="button" data-bs-toggle="dropdown">
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
													<svg  xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
													<span class="ms-2">Perfil</span>
												</a>

												<a href="./notification.html" class="dropdown-item ai-icon ">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"/>
														<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="var(--primary)"/>
														<circle fill="var(--primary)" opacity="0.3" cx="19.5" cy="17.5" r="2.5"/>
													</g>
												</svg>
												<span class="ms-2">Notificaciones </span>
											</a>

												<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"class="dropdown-item ai-icon ms-1">
													<svg  xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
													<span class="ms-1">Salir </span>
												</a>

												<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
													@csrf
												</form>
											</div>
										@else
											<div class="dropdown-menu dropdown-menu-end">
												<a href="/login" class="dropdown-item ai-icon ">
													<svg  xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
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
							<li><a href="/productos">Productos</a></li>
							<li><a href="/menuSemanal">Menu Semanal</a></li>
							
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
            <!-- row -->
			<div class="container mt-3" style="  margin-left: -15px; padding-right: 0px;">
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="row">

							<!-- AGRUPAR EN DOS COLUMNAS PARA PONER BOTÓN MENU SEMANAL-->
							
							<div class="d-flex align-items-center justify-content-between mb-4">
								<div>
									<h1>Hoy {{ \Carbon\Carbon::now()->translatedFormat('d F') }}</h1>
								</div>
								<ul class="grid-tab nav nav-pills" id="list-tab" role="tablist">
									<li class="nav-item " style=" text-align: right; margin-right: 10px; margin-top: 3px; font-weight: 500;">
										Menu<br>semanal
									</li>
									<li class="nav-item" role="presentation">
										<span class="nav-link me-3 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-list" type="button" role="tab" aria-controls="pills-list" aria-selected="true">
											<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin: 8px;">
											<g clip-path="url(#clip0_730_817)">
											<path d="M8.03058 8.4253C7.38743 8.4253 6.74428 8.4253 6.10319 8.4253C5.08573 8.4253 4.07034 8.4253 3.05287 8.4253C2.80471 8.4253 2.54621 8.44598 2.29805 8.41909C2.37043 8.42943 2.44488 8.43977 2.51726 8.44805C2.45108 8.43771 2.39111 8.42323 2.32907 8.39841C2.39525 8.4253 2.46142 8.45425 2.5276 8.48113C2.46969 8.45425 2.41593 8.42323 2.36422 8.38394C2.42006 8.42737 2.4759 8.47079 2.53173 8.51422C2.49037 8.47907 2.45315 8.44184 2.41799 8.40048C2.46142 8.45632 2.50485 8.51215 2.54828 8.56799C2.50899 8.51629 2.47797 8.46459 2.45108 8.40462C2.47797 8.47079 2.50692 8.53697 2.5338 8.60315C2.50899 8.54111 2.49244 8.48113 2.48417 8.41496C2.49451 8.48734 2.50485 8.56179 2.51312 8.63417C2.49244 8.42943 2.50692 8.2185 2.50692 8.01376C2.50692 7.5588 2.50692 7.10384 2.50692 6.65094C2.50692 5.62521 2.50692 4.5974 2.50692 3.57167C2.50692 3.32351 2.48624 3.065 2.51312 2.81684C2.50278 2.88922 2.49244 2.96367 2.48417 3.03605C2.49451 2.96987 2.50899 2.9099 2.5338 2.84786C2.50692 2.91404 2.47797 2.98021 2.45108 3.04639C2.47797 2.98849 2.50899 2.93472 2.54828 2.88302C2.50485 2.93885 2.46142 2.99469 2.41799 3.05053C2.45315 3.00917 2.49037 2.97194 2.53173 2.93679C2.4759 2.98021 2.42006 3.02364 2.36422 3.06707C2.41593 3.02778 2.46763 2.99676 2.5276 2.96987C2.46142 2.99676 2.39525 3.02571 2.32907 3.0526C2.39111 3.02778 2.45108 3.01124 2.51726 3.00296C2.44488 3.0133 2.37043 3.02364 2.29805 3.03192C2.50278 3.01123 2.71372 3.02571 2.91845 3.02571C3.37342 3.02571 3.82838 3.02571 4.28127 3.02571C5.30701 3.02571 6.33481 3.02571 7.36055 3.02571C7.60871 3.02571 7.86721 3.00503 8.11537 3.03192C8.04299 3.02158 7.96854 3.01124 7.89616 3.00296C7.96234 3.0133 8.02231 3.02778 8.08435 3.0526C8.01818 3.02571 7.952 2.99676 7.88582 2.96987C7.94373 2.99676 7.9975 3.02778 8.0492 3.06707C7.99336 3.02364 7.93752 2.98021 7.88169 2.93679C7.92305 2.97194 7.96027 3.00917 7.99543 3.05053C7.952 2.99469 7.90857 2.93885 7.86514 2.88302C7.90444 2.93472 7.93546 2.98642 7.96234 3.04639C7.93546 2.98021 7.9065 2.91404 7.87962 2.84786C7.90444 2.9099 7.92098 2.96987 7.92925 3.03605C7.91891 2.96367 7.90857 2.88922 7.9003 2.81684C7.92098 3.02158 7.9065 3.23251 7.9065 3.43725C7.9065 3.89221 7.9065 4.34717 7.9065 4.80007C7.9065 5.8258 7.9065 6.85361 7.9065 7.87934C7.9065 8.1275 7.92718 8.38601 7.9003 8.63417C7.91064 8.56179 7.92098 8.48734 7.92925 8.41496C7.91891 8.48113 7.90444 8.54111 7.87962 8.60315C7.9065 8.53697 7.93546 8.47079 7.96234 8.40462C7.93546 8.46252 7.90444 8.51629 7.86514 8.56799C7.90857 8.51215 7.952 8.45632 7.99543 8.40048C7.96027 8.44184 7.92305 8.47907 7.88169 8.51422C7.93752 8.47079 7.99336 8.42737 8.0492 8.38394C7.9975 8.42323 7.9458 8.45425 7.88582 8.48113C7.952 8.45425 8.01818 8.4253 8.08435 8.39841C8.02231 8.42323 7.96234 8.43977 7.89616 8.44805C7.96854 8.43771 8.04299 8.42737 8.11537 8.41909C8.08849 8.42323 8.05954 8.4253 8.03058 8.4253C7.81551 8.42943 7.59837 8.51422 7.44534 8.66726C7.30264 8.80995 7.19304 9.0457 7.20338 9.2525C7.22406 9.69299 7.56735 10.09 8.03058 10.0797C8.43592 10.0714 8.8247 9.92047 9.11216 9.63095C9.39341 9.3497 9.5423 8.97332 9.55885 8.57833C9.56092 8.51009 9.55885 8.44391 9.55885 8.37567C9.55885 7.97447 9.55885 7.57121 9.55885 7.17001C9.55885 6.0264 9.55885 4.88279 9.55885 3.73918C9.55885 3.46413 9.56298 3.18908 9.55885 2.91404C9.55058 2.35154 9.24244 1.78283 8.71923 1.54088C8.48762 1.43334 8.27875 1.37544 8.01818 1.37337C7.98716 1.37337 7.9582 1.37337 7.92718 1.37337C6.9821 1.37337 6.03702 1.37337 5.09194 1.37337C4.20269 1.37337 3.31344 1.37337 2.42627 1.37337C2.00853 1.37337 1.59906 1.52226 1.30127 1.82213C1.0014 2.12199 0.852506 2.52939 0.852506 2.95126C0.852506 3.27387 0.852506 3.59855 0.852506 3.92116C0.852506 5.06891 0.852506 6.21666 0.852506 7.36441C0.852506 7.72631 0.852506 8.08821 0.852506 8.45218C0.852506 8.48113 0.852506 8.51009 0.852506 8.54111C0.854574 8.79961 0.914547 9.01261 1.02002 9.24216C1.26197 9.76537 1.83068 10.0735 2.39318 10.0818C3.22038 10.0921 4.04759 10.0818 4.87479 10.0818C5.86744 10.0818 6.86216 10.0818 7.8548 10.0818C7.91271 10.0818 7.97061 10.0818 8.02852 10.0818C8.46073 10.0818 8.8764 9.70126 8.85572 9.25457C8.83918 8.80374 8.49589 8.4253 8.03058 8.4253ZM8.03058 11.9202C7.27369 11.9202 6.51887 11.9202 5.76197 11.9202C4.72383 11.9202 3.68569 11.9202 2.64754 11.9202C2.56275 11.9202 2.47797 11.9182 2.39318 11.9202C1.72314 11.9306 1.16064 12.3442 0.935227 12.9708C0.821486 13.2851 0.854574 13.6615 0.854574 13.9924C0.854574 15.1008 0.854574 16.2072 0.854574 17.3157C0.854574 17.7872 0.854574 18.2566 0.854574 18.7281C0.854574 18.8378 0.854574 18.9494 0.854574 19.059C0.854574 19.4892 1.01588 19.9255 1.34263 20.2171C1.65076 20.4922 2.02507 20.6287 2.43661 20.6287C2.55862 20.6287 2.67856 20.6287 2.80058 20.6287C3.27829 20.6287 3.75807 20.6287 4.23578 20.6287C5.33596 20.6287 6.43408 20.6287 7.53426 20.6287C7.66868 20.6287 7.80517 20.6287 7.93959 20.6287C8.23325 20.6287 8.5083 20.5749 8.773 20.4363C9.26726 20.1799 9.55885 19.6298 9.56298 19.0838C9.56298 18.9887 9.56298 18.8957 9.56298 18.8005C9.56298 17.7541 9.56298 16.7056 9.56298 15.6592C9.56298 15.136 9.56298 14.6149 9.56298 14.0917C9.56298 13.8518 9.57953 13.6036 9.55678 13.3637C9.52369 12.9832 9.381 12.613 9.09354 12.3483C8.79989 12.0774 8.43385 11.9285 8.03058 11.9202C7.59837 11.912 7.1827 12.307 7.20338 12.7474C7.22406 13.2024 7.56735 13.5643 8.03058 13.5747C8.05954 13.5747 8.08849 13.5767 8.11744 13.5809C8.04506 13.5705 7.97061 13.5602 7.89823 13.5519C7.96441 13.5622 8.02438 13.5767 8.08642 13.6015C8.02025 13.5747 7.95407 13.5457 7.88789 13.5188C7.9458 13.5457 7.99956 13.5767 8.05127 13.616C7.99543 13.5726 7.93959 13.5292 7.88376 13.4857C7.92512 13.5209 7.96234 13.5581 7.9975 13.5995C7.95407 13.5436 7.91064 13.4878 7.86721 13.432C7.9065 13.4837 7.93752 13.5354 7.96441 13.5953C7.93752 13.5292 7.90857 13.463 7.88169 13.3968C7.9065 13.4588 7.92305 13.5188 7.93132 13.585C7.92098 13.5126 7.91064 13.4382 7.90237 13.3658C7.92305 13.5705 7.90857 13.7815 7.90857 13.9862C7.90857 14.4412 7.90857 14.8961 7.90857 15.349C7.90857 16.3747 7.90857 17.4026 7.90857 18.4283C7.90857 18.6764 7.92925 18.9349 7.90237 19.1831C7.91271 19.1107 7.92305 19.0363 7.93132 18.9639C7.92098 19.0301 7.9065 19.0901 7.88169 19.1521C7.90857 19.0859 7.93752 19.0197 7.96441 18.9536C7.93752 19.0115 7.9065 19.0652 7.86721 19.1169C7.91064 19.0611 7.95407 19.0053 7.9975 18.9494C7.96234 18.9908 7.92512 19.028 7.88376 19.0632C7.93959 19.0197 7.99543 18.9763 8.05127 18.9329C7.99956 18.9722 7.94786 19.0032 7.88789 19.0301C7.95407 19.0032 8.02025 18.9742 8.08642 18.9474C8.02438 18.9722 7.96441 18.9887 7.89823 18.997C7.97061 18.9866 8.04506 18.9763 8.11744 18.968C7.91271 18.9887 7.70177 18.9742 7.49704 18.9742C7.04207 18.9742 6.58711 18.9742 6.13422 18.9742C5.10848 18.9742 4.08068 18.9742 3.05494 18.9742C2.80678 18.9742 2.54828 18.9949 2.30012 18.968C2.3725 18.9784 2.44695 18.9887 2.51933 18.997C2.45315 18.9866 2.39318 18.9722 2.33114 18.9474C2.39731 18.9742 2.46349 19.0032 2.52967 19.0301C2.47176 19.0032 2.41799 18.9722 2.36629 18.9329C2.42213 18.9763 2.47797 19.0197 2.5338 19.0632C2.49244 19.028 2.45522 18.9908 2.42006 18.9494C2.46349 19.0053 2.50692 19.0611 2.55035 19.1169C2.51105 19.0652 2.48003 19.0135 2.45315 18.9536C2.48003 19.0197 2.50899 19.0859 2.53587 19.1521C2.51105 19.0901 2.49451 19.0301 2.48624 18.9639C2.49658 19.0363 2.50692 19.1107 2.51519 19.1831C2.49451 18.9784 2.50899 18.7674 2.50899 18.5627C2.50899 18.1077 2.50899 17.6528 2.50899 17.1999C2.50899 16.1741 2.50899 15.1463 2.50899 14.1206C2.50899 13.8724 2.48831 13.6139 2.51519 13.3658C2.50485 13.4382 2.49451 13.5126 2.48624 13.585C2.49658 13.5188 2.51105 13.4588 2.53587 13.3968C2.50899 13.463 2.48003 13.5292 2.45315 13.5953C2.48003 13.5374 2.51105 13.4837 2.55035 13.432C2.50692 13.4878 2.46349 13.5436 2.42006 13.5995C2.45522 13.5581 2.49244 13.5209 2.5338 13.4857C2.47797 13.5292 2.42213 13.5726 2.36629 13.616C2.41799 13.5767 2.46969 13.5457 2.52967 13.5188C2.46349 13.5457 2.39731 13.5747 2.33114 13.6015C2.39318 13.5767 2.45315 13.5602 2.51933 13.5519C2.44695 13.5622 2.3725 13.5726 2.30012 13.5809C2.50485 13.5602 2.71579 13.5747 2.92052 13.5747C3.36514 13.5747 3.80977 13.5747 4.25439 13.5747C5.27599 13.5747 6.29759 13.5747 7.32126 13.5747C7.55908 13.5747 7.79483 13.5747 8.03265 13.5747C8.46487 13.5747 8.88054 13.1941 8.85986 12.7474C8.83918 12.2987 8.49589 11.9202 8.03058 11.9202ZM11.7406 4.64703C12.026 4.64703 12.3093 4.64703 12.5947 4.64703C13.2771 4.64703 13.9617 4.64703 14.6441 4.64703C15.4672 4.64703 16.2902 4.64703 17.1133 4.64703C17.8288 4.64703 18.5423 4.64703 19.2578 4.64703C19.6053 4.64703 19.9527 4.65324 20.3001 4.64703C20.3043 4.64703 20.3105 4.64703 20.3146 4.64703C20.7468 4.64703 21.1625 4.26652 21.1418 3.81983C21.1211 3.37107 20.7778 2.99262 20.3146 2.99262C20.0292 2.99262 19.7459 2.99262 19.4605 2.99262C18.7781 2.99262 18.0935 2.99262 17.4111 2.99262C16.588 2.99262 15.765 2.99262 14.9419 2.99262C14.2264 2.99262 13.5129 2.99262 12.7974 2.99262C12.4499 2.99262 12.1025 2.98642 11.7551 2.99262C11.7509 2.99262 11.7447 2.99262 11.7406 2.99262C11.3084 2.99262 10.8927 3.37314 10.9134 3.81983C10.932 4.26652 11.2774 4.64703 11.7406 4.64703ZM17.0678 6.80604C16.4681 6.80604 15.8684 6.80604 15.2666 6.80604C14.3091 6.80604 13.3537 6.80604 12.3962 6.80604C12.177 6.80604 11.9577 6.80604 11.7385 6.80604C11.3063 6.80604 10.8906 7.18656 10.9113 7.63325C10.932 8.08201 11.2753 8.46045 11.7385 8.46045C12.3383 8.46045 12.938 8.46045 13.5398 8.46045C14.4973 8.46045 15.4527 8.46045 16.4102 8.46045C16.6294 8.46045 16.8486 8.46045 17.0678 8.46045C17.5 8.46045 17.9157 8.07994 17.895 7.63325C17.8764 7.18449 17.5331 6.80604 17.0678 6.80604ZM11.7406 15.1939C12.026 15.1939 12.3093 15.1939 12.5947 15.1939C13.2771 15.1939 13.9617 15.1939 14.6441 15.1939C15.4672 15.1939 16.2902 15.1939 17.1133 15.1939C17.8288 15.1939 18.5423 15.1939 19.2578 15.1939C19.6053 15.1939 19.9527 15.2001 20.3001 15.1939C20.3043 15.1939 20.3105 15.1939 20.3146 15.1939C20.7468 15.1939 21.1625 14.8134 21.1418 14.3667C21.1211 13.9179 20.7778 13.5395 20.3146 13.5395C20.0292 13.5395 19.7459 13.5395 19.4605 13.5395C18.7781 13.5395 18.0935 13.5395 17.4111 13.5395C16.588 13.5395 15.765 13.5395 14.9419 13.5395C14.2264 13.5395 13.5129 13.5395 12.7974 13.5395C12.4499 13.5395 12.1025 13.5333 11.7551 13.5395C11.7509 13.5395 11.7447 13.5395 11.7406 13.5395C11.3084 13.5395 10.8927 13.92 10.9134 14.3667C10.932 14.8155 11.2774 15.1939 11.7406 15.1939ZM17.0678 17.3529C16.4681 17.3529 15.8684 17.3529 15.2666 17.3529C14.3091 17.3529 13.3537 17.3529 12.3962 17.3529C12.177 17.3529 11.9577 17.3529 11.7385 17.3529C11.3063 17.3529 10.8906 17.7334 10.9113 18.1801C10.932 18.6289 11.2753 19.0073 11.7385 19.0073C12.3383 19.0073 12.938 19.0073 13.5398 19.0073C14.4973 19.0073 15.4527 19.0073 16.4102 19.0073C16.6294 19.0073 16.8486 19.0073 17.0678 19.0073C17.5 19.0073 17.9157 18.6268 17.895 18.1801C17.8764 17.7334 17.5331 17.3529 17.0678 17.3529Z" fill="#7E808C"></path>
											</g>
											<defs>
											<clipPath id="clip0_730_817">
											<rect x="0.410156" y="0.411743" width="21.1765" height="21.1765" fill="white"></rect>
											</clipPath>
											</defs>
											</svg>
										</span>
									</li>
									
								</ul>
							</div>
							

							<div>
								<div id="smartwizard" class="form-wizard order-create">
									
									<div class="tab-content">
										<!-- Paso 1: Selección de Menús -->
										<div id="menu" class="tab-pane" role="tabpanel">
											<div>
												<div style="text-align: center; margin-bottom:15px;">
													<span style="font-weight: 600; font-size:16px; color:#444; margin-right:15px;">Cantidad de comenzales:</span>
													<span class="quntity" style=" height: 28px;">
														<!--
														<button data-decrease="">-</button>
														<input data-value="" type="text" value="3">
														<button data-increase="">+</button>-->

														<button id="removeComensal">-</button>
														<span id="comensalCount">1</span>
														<button id="addComensal">+</button>
													</span>
												</div>	
												

												<div class="col-xl-12" >
													<!-- Nav tabs -->
													<div class="default-tab">

														<ul class="nav nav-tabs"  id="comensalTabs"></ul>
														<div class="tab-content" id="comensalTabContent"></div>
													</div>
												</div>
											</div>
										</div>

										<!-- Paso 2: Resumen del Pedido y Extras -->
										<div id="orden" class="tab-pane" role="tabpanel">
											<div >
												<h4>Confirmar orden</h4>
												<div  class="accordion accordion-with-icon" id="resumenComensales">
													<!-- Se rellenará dinámicamente con el resumen de cada comensal -->
												</div>

												<div class="setting-input pl-3 pr-3 pb-2">
													<label class="form-label">Agregar comentarios</label>
													<textarea class="form-control py-3" rows="7" style="height: 70px;"></textarea>
												</div>
												<hr>
												<!-- Extras: Productos de categoría Extras (id=6) -->
												<div class="col-xl-12">
													<div class="card dlab-bg dlab-position">
														<div class="card-header border-0 pb-0">
															<h4 class="cate-title">¿Te provoca algo más?</h4>
														</div>
														<div class="card-body p-0">
															@foreach($extras as $extra)
																<div class="order-check d-flex align-items-center ">
																	<div class="dlab-media">
																		<img src="{{ $extra->imagen }}" alt="">
																	</div>
																	<div class="dlab-info">
																		<div class=" align-items-center justify-content-between">
																			<h4 class="dlab-title"><a href="javascript:void(0);">{{ $extra->nombre }}</a></h4>
																			<span>S/{{ $extra->precio }}</span>
																		</div>
																	</div>
																	<div class="extra-item" data-extra-id="{{ $extra->id }}" data-price="{{ $extra->precio }}" style="min-width: 90px;">
																		<div class="quntity">
																			<button class="extra-decrease p-0" data-extra-id="{{ $extra->id }}">-</button>
																			<input type="text" min="0" value="0" class="extra-qty" data-extra-id="{{ $extra->id }}" name="extras[{{ $extra->id }}][qty]">
																			<button class="extra-increase p-0" data-extra-id="{{ $extra->id }}">+</button>
																		</div>
																		<h4 class="extra-subtotal" style="text-align:right; color: orange;" data-extra-id="{{ $extra->id }}">+ S/ 0.00</h4>
																	</div>
																</div>
															@endforeach
														</div>
													</div>
												</div>

												<div class="card-footer  pt-0 border-0" id="orderTotals">
													<div class="d-flex align-items-center justify-content-between">
														<p>Delivey</p>
														<h4 class="font-w500">+ S/1.00</h4>
													</div>
													<div class="d-flex align-items-center justify-content-between mb-3">
														<h1 class="font-w500">Total</h1>
														<h1 class="font-w500 text-primary"><span id="orderTotal">S/0.00</span></h1>
													</div>
												</div>
											</div>
										</div>

										 <!-- Paso 3: Confirmación -->
										<div id="confirmar" class="tab-pane" role="tabpanel">
											<div class="p-2">
												<h4 class="cate-title">Confirmar datos</h4>
												<div class="card h-auto">
													<div class="card-body">
														<div class="d-flex align-items-center justify-content-between border-bottom flex-wrap">
															<div class="mb-4">
																<h4 class="font-w500"> {{ \Carbon\Carbon::now()->translatedFormat('d F') }}</h4>
																<span> {{ \Carbon\Carbon::now()->translatedFormat('H:m') }} hrs</span>
															</div>
															<div class="orders-img d-flex mb-4">
																<img src="access/images/banner-img/user.png" alt="">
																<!--
																<div>
																	<h6 class="font-w500">Luis Pérez</h6>
																	<span>+51 993761235</span>
																</div>
																-->
															</div>
														</div>
														<div class="row border-bottom pb-2">
															<!--
															<div class="col-xl-6">
																<div class="address-bx mt-3">
																	<span class="d-block mb-2">Tu dirección actual</span>
																	<div class="d-flex  align-items-center justify-content-between mb-2">
																		<h4 class="mb-0">
																			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M20.46 9.63C20.3196 8.16892 19.8032 6.76909 18.9612 5.56682C18.1191 4.36456 16.9801 3.40083 15.655 2.7695C14.3299 2.13816 12.8639 1.86072 11.3997 1.96421C9.93555 2.06769 8.52314 2.54856 7.3 3.36C6.2492 4.06265 5.36706 4.9893 4.71695 6.07339C4.06684 7.15749 3.6649 8.37211 3.54 9.63C3.41749 10.8797 3.57468 12.1409 4.00017 13.3223C4.42567 14.5036 5.1088 15.5755 6 16.46L11.3 21.77C11.393 21.8637 11.5036 21.9381 11.6254 21.9889C11.7473 22.0397 11.878 22.0658 12.01 22.0658C12.142 22.0658 12.2727 22.0397 12.3946 21.9889C12.5164 21.9381 12.627 21.8637 12.72 21.77L18 16.46C18.8912 15.5755 19.5743 14.5036 19.9998 13.3223C20.4253 12.1409 20.5825 10.8797 20.46 9.63ZM16.6 15.05L12 19.65L7.4 15.05C6.72209 14.3721 6.20281 13.5523 5.87947 12.6498C5.55614 11.7472 5.43679 10.7842 5.53 9.83C5.62382 8.86111 5.93177 7.92516 6.43157 7.08985C6.93138 6.25453 7.61056 5.54071 8.42 5C9.48095 4.29524 10.7263 3.9193 12 3.9193C13.2737 3.9193 14.5191 4.29524 15.58 5C16.387 5.53862 17.0647 6.24928 17.5644 7.08094C18.064 7.9126 18.3733 8.84461 18.47 9.81C18.5663 10.7674 18.4484 11.7343 18.125 12.6406C17.8016 13.5468 17.2807 14.3698 16.6 15.05ZM12 6C11.11 6 10.24 6.26392 9.49994 6.75839C8.75992 7.25286 8.18314 7.95566 7.84255 8.77793C7.50195 9.6002 7.41284 10.505 7.58647 11.3779C7.7601 12.2508 8.18869 13.0526 8.81802 13.682C9.44736 14.3113 10.2492 14.7399 11.1221 14.9135C11.995 15.0872 12.8998 14.9981 13.7221 14.6575C14.5443 14.3169 15.2471 13.7401 15.7416 13.0001C16.2361 12.26 16.5 11.39 16.5 10.5C16.4974 9.30734 16.0224 8.16428 15.1791 7.32094C14.3357 6.4776 13.1927 6.00265 12 6ZM12 13C11.5055 13 11.0222 12.8534 10.6111 12.5787C10.2 12.304 9.87952 11.9135 9.6903 11.4567C9.50109 10.9999 9.45158 10.4972 9.54804 10.0123C9.6445 9.52733 9.88261 9.08187 10.2322 8.73224C10.5819 8.38261 11.0273 8.1445 11.5123 8.04804C11.9972 7.95158 12.4999 8.00109 12.9567 8.1903C13.4135 8.37952 13.804 8.69996 14.0787 9.11108C14.3534 9.5222 14.5 10.0056 14.5 10.5C14.5 11.163 14.2366 11.7989 13.7678 12.2678C13.2989 12.7366 12.663 13 12 13Z" fill="var(--primary)"/>
																			</svg>
																			Avenida José Rivaaguero 234, San Miguel
																		</h4>
																		<a href="javascript:void(0);" class="btn btn-outline-primary btn-sm change">Cambiar dirección</a>
																	</div>
																	<p>Frente a una reja de color blando, al lado del banco BCP </p>

																</div>
															</div>-->
															<div class="col-xl-4">
																<div class="d-flex align-items-center justify-content-between mt-3">
																	<div class="Billing-bx mb-3">
																		<div class="billing-title">
																			<h4>Sobre el pago</h4>
																		</div>
																		<div class="row">
																			<div class="col-xl-12">
																				<select class="form-control default-select ms-0 py-4 mb-xl-0 mb-3" style="display: none;">
																					<option><b>Tipo de pago</b></option>
																					<option>Tarjeta</option>
																					<option>Efectivo</option>
																					<option>Yape / Plin</option>
																				</select>
																			</div>
																			<div class="col-xl-6">
																				<div class="mb-3">
																					<input type="Text" class="form-control" placeholder="Vuelto de">
																				</div>
																			</div>
																			<div class="col-xl-6">
																				<select class="form-control default-select ms-0 py-4 mb-xl-0 mb-3" style="display: none;">
																					<option><b>Comprobante pago</b></option>
																					<option>Boleta</option>
																					<option>Factura</option>
																					<option>No</option>
																				</select>
																			</div>
																			<div class="col-xl-12">
																				<select class="form-control default-select ms-0 py-4 mb-xl-0 mb-3" style="display: none;">
																					<option><b>Hora de llegada</b></option>
																					<option>30min (1:00pm)</option>
																					<option>45min (1:15pm)</option>
																					<option>60min (1:30pm)</option>
																					<option>75min (1:45pm)</option>
																					<option>90min (2:00pm)</option>
																					<option>105min (2:15pm)</option>
																					<option>120min (2:30pm)</option>
																					<option>135min (2:45pm)</option>
																				</select>
																			</div>
																		</div>
																	</div>
																</div>
																
															</div>
															<div class="col-xl-2"></div>
														</div>
														<hr style="opacity:0.7" />
														<div class="d-flex align-items-center justify-content-between">
															
															<div id="confirmResumen">
																<h4 class="font-w500 mb-0">Total</h4>
																<!-- Se mostrará el resumen final (se puede clonar el de "orden") -->
																<div class="d-flex align-items-center justify-content-between mb-3">
																	<h1 class="font-w500 text-primary"><span id="confirmTotal">S/0.00</span></h1>
																</div>
															</div>
														</div>
														
														<!-- Formulario para enviar el pedido 
														<form action="{ { route ('pedido .submit') } }" method="POST">-->
														<form action="" method="POST">
															@csrf
															<!-- Incluye inputs ocultos con la información del pedido -->
															<input type="hidden" name="order_data" id="orderData">
															<!--<button type="submit">Confirmar Pedido</button>-->
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
									<ul class="nav nav-wizard" style="height:100% !important;">
										<li><a class="nav-link" href="#menu"> 
											<span>1</span> 
										</a></li>
										<li><a class="nav-link" href="#orden">
											<span>2</span>
										</a></li>
										<li><a class="nav-link" href="#confirmar">
											<span>3</span>
										</a></li>
									</ul>
									
								</div>
							</div>
							
						</div>
					</div>


					<div class="modal fade" id="exampleModalCenter">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div>
									<img src="access/images/oferta.png" style="width: 100%;" alt=""/>
								</div>
								<button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="border-radius: 0px;">Cerrar</button>
							</div>
						</div>
					</div>
					

					<!-- Modal genérico para mostrar info de un producto -->
					<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="position: absolute;right: 10px;top: 10px;background-color: white;height: 20px;width: 20px;border-radius: 20px;"></button>
								<img id="modalImage" src="" style="width:100%; max-height:200px; object-fit:cover;" alt="" />
								<div class="modal-body">
									<h5 class="modal-title" id="modalTitle">Título</h5>
									<p id="modalDescription" class="mt-3"></p>
								</div>
							</div>
						</div>
					</div>


				</div>
            </div>
        </div>

        
		
		<!-- Button trigger modal -->

        <!--**********************************
            Content body end
        ***********************************-->
		
		
		
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

		<!--**********************************
           Support ticket button start
        ***********************************-->
		
        <!--**********************************
           Support ticket button end
        ***********************************-->


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


	
    
	<script>
		$(document).ready(function(){
			// SmartWizard initialize
			$('#exampleModalCenter').modal('show');
			$('#smartwizard').smartWizard(); 
		});
	</script>
	
	<script>

	$('.my-select').selectpicker();

	var swiper = new Swiper(".mySwiper-1", {
		loop:true,
		dots:true,
		//nav:true,
		//autoplay: {delay: 3000,},
		
		navigation: {
		nextEl: ".swiper-button-next-1",
		prevEl: ".swiper-button-prev-1",
		//loop: true
		},
	
		pagination: {
		el: ".swiper-pagination-banner",
		clickable: true,
		},
		mousewheel: false,
		keyboard: false,
	});
	
	
	var swiper = new Swiper(".mySwiper-2", {
		slidesPerView: 5,
		spaceBetween: 20,
		loop:true,
		//autoplay: {delay: 3000,},
		pagination: {
		el: ".swiper-pagination",
		clickable: true,
		},
		breakpoints: {
		360: {
			slidesPerView: 2,
			spaceBetween: 20,
		},
		600: {
			slidesPerView: 3,
			spaceBetween: 20,
		},
		768: {
			slidesPerView: 4,
			spaceBetween: 20,
		},
		1200: {
			slidesPerView: 3,
			spaceBetween: 20,
		},
		1920: {
			slidesPerView: 5,
			spaceBetween: 20,
		},
		
		},
		
	});
	


	$(function() {
		$('[data-decrease]').on('click', decrease);
		$('[data-increase]').click(increase);
		$('[data-value]').change(valueChange);
	});

	function decrease() {
		var value = $(this).parent().find('[data-value]').val();
		if(value > 0) {
			value--;
			$(this).parent().find('[data-value]').val(value);
		}
	}

	function increase() {
		var value = $(this).parent().find('[data-value]').val();
		if(value < 100) {
			value++;
			$(this).parent().find('[data-value]').val(value);
		}
	}

	function valueChange() {
		var value = $(this).val();
		if(value == undefined || isNaN(value) == true || value <= 0) {
			$(this).val(0);
		} else if(value >= 101) {
			$(this).val(100);
		}
	}

		
	$(document).ready(function(){
	$(".plus").click(function(){
		$(this).toggleClass("active");
		
	});
	});
	$(document).ready(function(){
	$(".c-heart").click(function(){
		$(this).toggleClass("active");
		
	});
	});

	// Los datos enviados desde el controlador (productos disponibles para hoy)
	const entradas15 = @json($entradas15);
	const fondos15 = @json($fondos15);
	const entradas20 = @json($entradas20);
	const fondos20 = @json($fondos20);
	const platosCarta = @json($platosCarta);

	let comensalCount = 1;
	const maxComensales = 10;
	const tabContainer = document.getElementById("comensalTabs");
	const tabContent = document.getElementById("comensalTabContent");

	const countEntradas15 = {{ $entradas15->count() }};
    const countFondos15 = {{ $fondos15->count() }};
    const countEntradas20 = {{ $entradas20->count() }};
    const countFondos20 = {{ $fondos20->count() }};

	// Función para crear la pestaña de un comensal
	function createComensalTab(index) {
		const widthPercent = (100 / comensalCount).toFixed(2);
		const name = `COMENSAL ${index + 1}`;

		return `
		<li class="nav-item" role="presentation" style="width: ${widthPercent}%;">
			<button class="nav-link ${index === 0 ? 'active' : ''}" data-bs-toggle="tab" 
			data-bs-target="#comensal${index}" type="button" role="tab">
			${name}
			</button>
		</li>
		`;
	}




  // Función para crear el contenido (selección de menús) para cada comensal
  function createComensalContent(index) {
      return `
          	<div class="tab-pane fade show ${index === 0 ? 'active' : ''}" id="comensal${index}" role="tabpanel">
              	<div class="pt-4">
                  	<ul class="nav nav-pills mb-4 light" style="width: 100%;">
                      	<li class="nav-item" style="width: 33%; text-align: center;">
                          	<a href="#menu15-${index}" class="nav-link active" data-bs-toggle="tab">Menú S/15</a>
                      	</li>
                      	<li class="nav-item" style="width: 33%; text-align: center;">
                          	<a href="#menu20-${index}" class="nav-link" data-bs-toggle="tab">Menú S/20</a>
                      	</li>
					  	<li class="nav-item" style="width: 33%; text-align: center;">
							<a href="#menuCarta-${index}" class="nav-link" data-bs-toggle="tab">A la Carta</a>
						</li>
                  	</ul>
                  	<div class="tab-content">
						<!-- Menú S/15 -->
						<div id="menu15-${index}" class="tab-pane active">
							<h4 class=" mb-0 cate-title">${ countEntradas15 } Entradas</h4>
							<a class="text-primary">Desliza a la derecha <i class="fa-solid fa-angle-right ms-2"></i></a>
							<div class="swiper mySwiper-3" style="margin-bottom:30px;">
								<div class="swiper-wrapper">
									${ renderProductos(entradas15, 'entrada15', index) }
								</div>
								<div class="swiper-pagination"></div>
							</div>
							<h4 class="cate-title">${ countFondos15 } Fondos</h4>
							<a class="text-primary">Desliza a la derecha <i class="fa-solid fa-angle-right ms-2"></i></a>
							<div class="swiper mySwiper-3">
								<div class="swiper-wrapper">
									${ renderProductos(fondos15, 'fondo15', index) }
								</div>
								<div class="swiper-pagination"></div>
							</div>
						</div>
						<!-- Menú S/20 -->
						<div id="menu20-${index}" class="tab-pane">
							<h4 class="cate-title">${ countEntradas20 } Entradas</h4>
							<a class="text-primary">Desliza a la derecha <i class="fa-solid fa-angle-right ms-2"></i></a>
							<div class="swiper mySwiper-3" style="margin-bottom:30px;">
								<div class="swiper-wrapper">
									${ renderProductos(entradas20, 'entrada20', index) }
								</div>
								<div class="swiper-pagination"></div>
							</div>
							<h4 class="cate-title">${ countFondos20 } Fondos</h4>
							<a class="text-primary">Desliza a la derecha <i class="fa-solid fa-angle-right ms-2"></i></a>
							<div class="swiper mySwiper-3">
								<div class="swiper-wrapper">
									${ renderProductos(fondos20, 'fondo20', index) }
								</div>
								<div class="swiper-pagination"></div>
							</div>
						</div>
					  	<!--  Platos a la Carta -->
						<div id="menuCarta-${index}" class="tab-pane">
							<h4 class="cate-title">${platosCarta.length} Platos a la carta</h4>
							<div class="swiper mySwiper-3">
								<div class="swiper-wrapper">
									${ renderProductos(platosCarta, 'carta', index) }
								</div>
								<div class="swiper-pagination"></div>
							</div>
						</div>
                  	</div>
              	</div>
          	</div>`;
  }

  // Función auxiliar para generar las tarjetas de productos en el carrusel
  // typeName es la cadena que identifica el tipo (por ejemplo, 'entrada15', 'fondo15', etc.)
  // comensalIndex es para diferenciar los grupos de radios por comensal
  function renderProductos(productos, typeName, comensalIndex) {
		let type ='';
		if(typeName=='entrada15'||typeName=='entrada20'){
			type ='entrada';
		}else if(typeName=='fondo15'||typeName=='fondo20'){
			type ='fondo';
		}else if(typeName === 'carta') {
			type = 'carta';
		}
      let html = '';
      productos.forEach(prod => {
          html += `
              <div class="swiper-slide">
                  <div class="card dishe-bx">
                      <div class="card-header border-0 pb-0 pt-0 pe-3">
                          <!-- Puedes agregar un badge o icono aquí -->
                      </div>
                      <div class="card-body p-0 text-center" style="cursor:pointer;" 
					  onclick="openProductModal('${prod.id}','${prod.nombre}','${prod.descripcion}','${prod.imagen}')">
                          <img style="width: 100%;" src="${ prod.imagen ? prod.imagen : 'access/images/popular-img/causa.jpg' }" alt="${ prod.nombre }">
                      </div>
                      <div class="border-0 pt-2">
                          <div class="common d-flex justify-content-between">
								<div class="plus c-pointer" style="margin:0 8px;">
									<div class="sub-bx">
										<a href="javascript:void(0);"></a>
									</div>
								</div>
								<!-- Cada input radio es único por comensal y por tipo -->
								<input style="display:none;" type="radio" tipo="${ typeName }[${ comensalIndex }]" name="${ type }[${ comensalIndex }]" value="${ prod.id }">
								<div style="cursor:pointer;" onclick="openProductModal('${prod.id}','${prod.nombre}','${prod.descripcion}','${prod.imagen}')">
									<h5>${ prod.nombre }</h5>
								</div>
                          </div>
                      </div>
                  </div>
              </div>
          `;
      });
      return html;
  }

	// Función que renderiza las pestañas y contenido según el número de comensales
	function renderComensales() {
		tabContainer.innerHTML = "";
		tabContent.innerHTML = "";
		for (let i = 0; i < comensalCount; i++) {
			tabContainer.innerHTML += createComensalTab(i);
			tabContent.innerHTML += createComensalContent(i);
		}
		initSwipers();
		updateOrdenResumen();
	}

	// Inicialización de los sliders (Swiper) para los contenedores con la clase .mySwiper-3
	function initSwipers() {
		document.querySelectorAll('.mySwiper-3').forEach(el => {
			if (el.swiper) {
				el.swiper.destroy(true, true);
			}
			new Swiper(el, {
				slidesPerView: 3,
				spaceBetween: 30,
				autoplay: {
						delay: 5000,
					},
				pagination: { el: ".swiper-pagination", clickable: true },
				breakpoints: {
					250: { slidesPerView: 2, spaceBetween: 10 },
					360: { slidesPerView: 3, spaceBetween: 10 },
					600: { slidesPerView: 3, spaceBetween: 10 },
					768: { slidesPerView: 4, spaceBetween: 20 },
					1200: { slidesPerView: 4, spaceBetween: 20 },
					1400: { slidesPerView: 5, spaceBetween: 20 },
				}
			});
		});
	}

      // ===============================
    // FUNCIONES PARA ACTUALIZAR EL RESUMEN DE PEDIDO (PASO 2)
    // ===============================
    function updateOrdenResumen() {
        let resumenHTML = '';
        let totalMenus = 0;
        // Recorremos cada comensal
        for (let i = 0; i < comensalCount; i++) {
            // Obtenemos las opciones seleccionadas de cada grupo
            let selE15 = document.querySelector(`input[tipo="entrada15[${i}]"]:checked`);
            let selF15 = document.querySelector(`input[tipo="fondo15[${i}]"]:checked`);
            let selE20 = document.querySelector(`input[tipo="entrada20[${i}]"]:checked`);
            let selF20 = document.querySelector(`input[tipo="fondo20[${i}]"]:checked`);

            let menuPrice = 0;
            let menuType = '';
            let entradaName = 'No seleccionado';
            let fondoName = 'No seleccionado';
            // Regla: si se escoge por lo menos un producto del menú S/20 se asigna menú S/20
            if ((selE20 && selF20) || (selE20 && selF15) || (selE15 && selF20)) {
                menuPrice = 20;
                menuType = "Menú S/20.00";
                if (selE20) {
                    entradaName = selE20.parentElement.querySelector('h5').innerText;
                } else if (selE15) {
                    entradaName = selE15.parentElement.querySelector('h5').innerText;
                }
                if (selF20) {
                    fondoName = selF20.parentElement.querySelector('h5').innerText;
                } else if (selF15) {
                    fondoName = selF15.parentElement.querySelector('h5').innerText;
                }
            } else if (selE15 && selF15) {
                menuPrice = 15;
                menuType = "Menú S/15.00";
                entradaName = selE15.parentElement.querySelector('h5').innerText;
                fondoName = selF15.parentElement.querySelector('h5').innerText;
            } else {
                menuType = "Incompleto";
            }
            totalMenus += menuPrice;
            resumenHTML += `
			<div class="accordion-item">
				<div class="accordion-header collapsed rounded-lg" id="accord-${i+1}" data-bs-toggle="collapse" data-bs-target="#collapse${i+1}" aria-controls="collapse${i+1}"   aria-expanded="true"  role="button">
					<i class="la la-user me-2"></i>
					<span class="accordion-header-text" style="padding-left: 5px;">COMENSAL ${i+1} - <b>${menuType}</b></span>
					<span class="accordion-header-indicator"></span>
				</div>
				<div id="collapse${i+1}" class="collapse accordion__body" aria-labelledby="accord-${i+1}" data-bs-parent="#resumenComensales">
					<div class="accordion-body-text">
						<div id="DZ_W_Todo2" class="widget-media dlab-scroll ">
							<ul class="timeline">
								<li>
									<div class="timeline-panel">
										<div class="media me-2">
											<img alt="image" width="50" src="access/images/popular-img/gallina.jpg">
										</div>
										<div class="media-body">
											<span>Entrada: </span><h5 class="mb-1">${entradaName}</h5>
										</div>
									</div>
								</li>
								<li>
									<div class="timeline-panel">
										<div class="media me-2">
											<img alt="image" width="50"  src="access/images/popular-img/brasa.png">
										</div>
										<div class="media-body">
											<span>Fondo: </span><h5 class="mb-1">${fondoName}</h5>
										</div>
									</div>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
			</div>`;
        }
        document.getElementById("resumenComensales").innerHTML = resumenHTML;

        // Extras: calcular el total de extras
        let extrasTotal = 0;
        document.querySelectorAll('.extra-item').forEach(item => {
            let qty = parseInt(item.querySelector('.extra-qty').value) || 0;
            let price = parseFloat(item.getAttribute('data-price')) || 0;
            let subtotal = qty * price;
            extrasTotal += subtotal;
            item.querySelector('.extra-subtotal').innerText = `+ S/ ${subtotal.toFixed(2)}`;
        });

        // Delivery fijo
        const deliveryCost = 1.00;
        const totalOrder = totalMenus + extrasTotal + deliveryCost;
        document.getElementById("orderTotal").innerText = `S/ ${totalOrder.toFixed(2)}`;
        document.getElementById("confirmTotal").innerText = `S/ ${totalOrder.toFixed(2)}`;

        // Se puede guardar el resumen completo (en JSON) en un input oculto para enviarlo con el form
        document.getElementById("orderData").value = JSON.stringify({
            totalMenus: totalMenus,
            extrasTotal: extrasTotal,
            delivery: deliveryCost,
            total: totalOrder
        });
    }
  
  	// Usamos delegación de eventos para atender a los clicks en cualquier elemento con la clase .plus
	$(document).on('click', '.plus', function(e) {
		e.preventDefault();

		// Obtenemos el radio input asociado a este botón 'plus'
		// Suponemos que el input radio está justo después del DIV .plus en la estructura del HTML
		var $radio = $(this).siblings('input[type="radio"]');
		
		// Obtenemos el atributo 'name' del radio para identificar el grupo (por ejemplo, "entrada15[0]")
		var groupName = $radio.attr('name');
		
		// Removemos la clase 'active' de todos los elementos .plus que estén en el mismo grupo
		$('input[name="' + groupName + '"]').siblings('.plus').removeClass('active');
		
		// Agregamos la clase 'active' al botón 'plus' que se clickeó
		$(this).addClass('active');

		// Marcamos el radio correspondiente como seleccionado
		$radio.prop('checked', true);
		updateOrdenResumen();
		
	});

	// Para cambios en los inputs radio en caso de seleccionarse por medios distintos
	$(document).on('change', 'input[type="radio"]', function() {
        updateOrdenResumen();
    });

	// Para cambios en los controles de extras (botones y cambios en cantidad)
	$(document).on('click', '.extra-decrease, .extra-increase', function() {
        let extraId = $(this).data('extra-id');
        let $input = $(`.extra-qty[data-extra-id="${extraId}"]`);
        let current = parseInt($input.val()) || 0;
        if ($(this).hasClass('extra-decrease') && current > 0) {
            $input.val(current - 1);
        } else if ($(this).hasClass('extra-increase')) {
            $input.val(current + 1);
        }
        updateOrdenResumen();
    });
    $(document).on('change', '.extra-qty', function() {
        updateOrdenResumen();
    });

	// Botones para sumar/restar comensales
	document.getElementById("addComensal").addEventListener("click", () => {
		if (comensalCount < maxComensales) {
			comensalCount++;
			document.getElementById("comensalCount").innerText = comensalCount;
			renderComensales();
		}
	});
	document.getElementById("removeComensal").addEventListener("click", () => {
		if (comensalCount > 1) {
			comensalCount--;
			document.getElementById("comensalCount").innerText = comensalCount;
			renderComensales();
		}
	});

	// Re-renderiza en caso de que cambie el tamaño de la ventana
	//window.addEventListener("resize", renderComensales);
	window.addEventListener("DOMContentLoaded", renderComensales);

  
	(function() {
		// Previene el pinch zoom en iOS Safari
		document.addEventListener('gesturestart', function(e) {
			e.preventDefault();
		});

		// Alternativamente, también se puede intentar bloquear el doble toque
		let lastTouchEnd = 0;
		document.addEventListener('touchend', function(event) {
			const now = (new Date()).getTime();
			if (now - lastTouchEnd <= 300) {
				event.preventDefault();
			}
			lastTouchEnd = now;
		}, false);
	})();

	function openProductModal(id, nombre, descripcion, imagen) {
		const modalTitle = document.getElementById('modalTitle');
		const modalDesc  = document.getElementById('modalDescription');
		const modalImg   = document.getElementById('modalImage');

		modalTitle.textContent = nombre;
		modalDesc.textContent  = (descripcion && descripcion !== 'null') ? descripcion : 'Sin descripción adicional.';
		modalImg.src           = imagen ?? 'ruta-de-fallback.png';

		// Abrir modal con Bootstrap 5 
		let modal = new bootstrap.Modal(document.getElementById('productModal'), {});
		modal.show();
	}


  




</script>

</body>
</html>