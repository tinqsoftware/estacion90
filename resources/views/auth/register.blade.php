@extends('layouts.app')

@section('content')
<div class="container-fluid auth-container p-0">
    <div class="row g-0 h-100">
        <!-- Left Column - Registration Form -->
        <div class="col-md-6 auth-form-container">
            <div class="auth-form">
                <h1 class="auth-title">Crear Cuenta</h1>
                <p class="auth-subtitle">Ingrese sus datos para registrarse</p>
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Hidden fields for role and status -->
                    <input type="hidden" name="id_rol" value="2">
                    <input type="hidden" name="estado" value="1">
                    
                    <div class="mb-3 mt-4">
                        <label for="name" class="form-label">{{ __('Nombre') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Ingrese su nombre">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="apellido" class="form-label">{{ __('Apellido') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" placeholder="Ingrese su apellido">
                            @error('apellido')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Correo Electronico') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Ingrese su email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="telefono" class="form-label">{{ __('Numero de Telefono') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="tel" placeholder="Ingrese su teléfono">
                            @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Ingrese su contraseña">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme su contraseña">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 auth-btn">
                        <i class="fas fa-user-plus me-2"></i> {{ __('Register') }}
                    </button>
                </form>
                
                <div class="divider-container">
                    <span class="divider-text">O</span>
                </div>
                
                <div class="social-login">
                    <a href="#" class="btn btn-outline-secondary social-btn">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google" class="social-icon">
                        Google
                    </a>
                    <a href="#" class="btn btn-outline-secondary social-btn">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple" class="social-icon">
                        Apple
                    </a>
                </div>
                
                <div class="text-center mt-4">
                    <p class="mb-0">¿Ya tiene una cuenta?</p>
                    <a href="{{ route('login') }}" class="register-link">Iniciar Sesión</a>
                </div>
            </div>
        </div>
        
        <!-- Right Column - Promotional Content -->
        <div class="col-md-6 promo-container">
            <div class="promo-content">
                <div class="promo-text">
                    <p>MEJOR SONIDO</p>
                    <p>MEJOR MÚSICA</p>
                    <p class="highlight">MEJOR EXPERIENCIA</p>
                </div>
                <div class="logo-container">
                    <div class="logo">
                        <i class="fas fa-broadcast-tower me-2"></i>estacion90
                    </div>
                </div>
            </div>
            <div class="circle-overlay"></div>
        </div>
    </div>
</div>
@endsection