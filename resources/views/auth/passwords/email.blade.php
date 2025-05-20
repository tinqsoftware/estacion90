@extends('layouts.app')

@section('content')
<div class="container-fluid auth-container p-0">
    <div class="row g-0 h-100">
        <!-- Left Column - Password Reset Form -->
        <div class="col-md-6 auth-form-container">
            <div class="auth-form">
                <h1 class="auth-title">Recuperar Contraseña</h1>
                <p class="auth-subtitle">Ingrese su correo para recibir el enlace de recuperación</p>
                
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3 mt-4">
                        <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Ingrese su correo electrónico">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 auth-btn">
                        <i class="fas fa-paper-plane me-2"></i> {{ __('Enviar Enlace de Recuperación') }}
                    </button>
                </form>
                
                <div class="divider-container">
                    <span class="divider-text">O</span>
                </div>
                
                <div class="text-center mt-4">
                    <p class="mb-0">¿Recordó su contraseña?</p>
                    <a href="{{ route('login') }}" class="register-link">Iniciar Sesión</a>
                </div>
                
                <div class="text-center mt-3">
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