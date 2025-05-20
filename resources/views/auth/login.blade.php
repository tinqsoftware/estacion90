@extends('layouts.app')

@section('content')
<div class="container-fluid auth-container p-0">
    <div class="row g-0 h-100">
        <!-- Left Column - Login Form -->
        <div class="col-md-6 auth-form-container">
            <div class="auth-form">
                <h1 class="auth-title">Iniciar Sesión</h1>
                <p class="auth-subtitle">Ingrese sus datos para acceder</p>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3 mt-4">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
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
                        <label for="password" class="form-label">{{ __('Password') }}</label>
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
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ __('Recordarme') }}</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 auth-btn">
                        <i class="fas fa-sign-in-alt me-2"></i> {{ __('Login') }}
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
                
                <div class="text-center mt-3">
                    @if (Route::has('password.request'))
                        <a class="register-link" href="{{ route('password.request') }}">
                            {{ __('Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                </div>
                
                <div class="text-center mt-4">
                    <p class="mb-0">¿Todavía no tiene cuenta?</p>
                    <a href="{{ route('register') }}" class="register-link">Regístrese</a>
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
