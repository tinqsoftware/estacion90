

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

    <div class="container mt-0">
        <div class="row align-items-center justify-contain-center">
            <div class="col-xl-12 mt-5">
                <div class="card border-0">
                    <div class="card-body login-bx">
                        <div class="row  mt-5">
                            <div class="col-xl-7 col-md-6 sign text-center">
                                <div >
                                    <img src="/access/images/logo-full.png" style="width: 70%;" class="food-img" alt="">
                                </div>	
                            </div>
                            <div class="col-xl-5 col-md-6 pe-0">
                                <div class="sign-in-your">
                                    <div class="text-center mb-3">
                                        <img src="images/logo-full.png" class="mb-3" alt="">
                                        <h4 class="fs-20 font-w800 text-black">Iniciar sesión</h4>
                                        <span class="dlab-sign-up">Ingresa tus datos</span>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>{{ __('Correo') }}</strong></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>{{ __('Contraseña') }}</strong></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!--
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="mb-3">
                                                <div class="form-check custom-checkbox ms-1">
                                                    <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div>-->
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block shadow">Iniciar sesión</button>
                                        </div>
                                    </form><br/>
                                    <div class="text-center">
                                        <span>¿Deseas crearte una cuenta cliente?<a href="javascript:void(0);" class="text-primary"> Creala aquí</a></span>
                                    </div>
                                        
                                </div>
                            </div>
                        </div>
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
	
	<script src="access/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script>
<!-- Form Steps -->


</body>
</html>