<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'estacion90') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
    body,
    html {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        height: 100%;
    }

    .navbar {
        background: linear-gradient(135deg, #2c3e50, #4a6491) !important;
        padding: 0.8rem 1rem;
    }

    .navbar-brand {
        color: white !important;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.85) !important;
        font-weight: 500;
        transition: all 0.3s;
    }

    .nav-link:hover {
        color: white !important;
        transform: translateY(-2px);
    }

    .login-btn {
        background-color: transparent;
        border: 2px solid white;
        color: white !important;
        border-radius: 50px;
        padding: 0.375rem 1.5rem;
        transition: all 0.3s;
    }

    .login-btn:hover {
        background-color: white;
        color: #4a6491 !important;
    }

    .register-btn {
        background-color: #e74c3c;
        border: 2px solid #e74c3c;
        color: white !important;
        border-radius: 50px;
        padding: 0.375rem 1.5rem;
        margin-left: 10px;
        transition: all 0.3s;
    }

    .register-btn:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }

    .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
    }

    .dropdown-item {
        padding: 0.75rem 1.5rem;
        transition: all 0.2s;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #4a6491;
    }

    /* Login Page Styles */
    .auth-container {
        min-height: calc(100% - 76px);
    }

    .auth-form-container {
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-form {
        width: 100%;
        max-width: 400px;
        padding: 0 15px;
    }

    .auth-title {
        color: #4a6491;
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .auth-subtitle {
        color: #333;
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .form-control {
        padding: 0.75rem;
        border-radius: 6px;
        border: 1px solid #ddd;
    }

    .form-control:focus {
        border-color: #4a6491;
        box-shadow: 0 0 0 0.25rem rgba(74, 100, 145, 0.25);
    }

    .auth-btn {
        background: linear-gradient(135deg, #2c3e50, #4a6491);
        border: none;
        padding: 0.75rem;
        font-weight: 500;
        border-radius: 6px;
        margin-top: 1rem;
        transition: all 0.3s;
    }

    .auth-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .divider-container {
        position: relative;
        text-align: center;
        margin: 1.5rem 0;
    }

    .divider-text {
        position: relative;
        display: inline-block;
        color: #777;
        background: #fff;
        padding: 0 1rem;
        z-index: 1;
    }

    .divider-container:before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background-color: #ddd;
    }

    .social-login {
        display: flex;
        gap: 10px;
        margin-bottom: 1.5rem;
    }

    .social-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.6rem;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .social-btn:hover {
        background-color: #f1f1f1;
    }

    .social-icon {
        width: 20px;
        height: 20px;
        margin-right: 8px;
    }

    .register-link {
        color: #4a6491;
        text-decoration: none;
        font-weight: 500;
    }

    .register-link:hover {
        text-decoration: underline;
    }

    .promo-container {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #2c3e50, #4a6491);
        color: white;
    }

    .promo-content {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 2rem;
    }

    .promo-text {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 2rem;
    }

    .promo-text p {
        margin-bottom: 0.5rem;
    }

    .promo-text .highlight {
        font-size: 1.8rem;
        font-weight: 700;
        color: #e74c3c;
    }

    .logo-container {
        position: absolute;
        bottom: 2rem;
        right: 2rem;
    }

    .logo {
        font-size: 2rem;
        font-weight: 700;
    }

    .circle-overlay {
        position: absolute;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        border: 40px solid rgba(255, 255, 255, 0.1);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
    }

    @media (max-width: 768px) {
        .promo-container {
            display: none;
        }
    }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-broadcast-tower me-2"></i>{{ config('', 'estacion90') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <!-- Add your navigation links here -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        <!-- ...existing guest links... -->
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user me-2"></i> Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog me-2"></i> Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="reset-password-btn">
                                    <i class="fas fa-key me-2"></i> Resetear Contraseña
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <form id="reset-password-form" action="{{ route('user.reset-password') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>


                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    <!-- Add this script at the end of the body -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resetBtn = document.getElementById('reset-password-btn');
            if (resetBtn) {
                resetBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Se restablecerá tu contraseña a la predeterminada y se cerrará tu sesión actual.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, restablecer',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('reset-password-form').submit();
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>