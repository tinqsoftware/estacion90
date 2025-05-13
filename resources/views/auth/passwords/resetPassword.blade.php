<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cambiar Contraseña - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            color: #111827;
            line-height: 1.5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }

        .container {
            width: 100%;
            max-width: 400px;
        }

        .form-container {
            background-color: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .icon-container {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .icon-container svg {
            color: #111827;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
            text-align: left;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: border-color 0.15s ease-in-out;
        }

        input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .password-strength-meter {
            height: 4px;
            background-color: #e5e7eb;
            border-radius: 2px;
            margin-top: 0.5rem;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0;
            background-color: #ef4444;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        .password-hint {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.5rem;
        }

        .btn-submit {
            width: 100%;
            padding: 0.75rem;
            background-color: #111827;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
        }

        .btn-submit:hover {
            background-color: #1f2937;
        }

        .btn-submit:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(17, 24, 39, 0.4);
        }

        .back-link {
            font-size: 0.875rem;
            margin-top: 1.5rem;
        }

        .back-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .error {
            border-color: #ef4444 !important;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .weak {
            width: 33%;
            background-color: #ef4444;
        }

        .medium {
            width: 66%;
            background-color: #f59e0b;
        }

        .strong {
            width: 100%;
            background-color: #10b981;
        }
        
        .alert {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
        }
        
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .alert-danger {
            background-color: #fee2e2;
            color: #b91c1c;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <!-- Icono -->
            <div class="icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>
            
            <!-- Título -->
            <h1>Cambiar Contraseña</h1>
            <p class="subtitle">Actualiza tu contraseña para mantener tu cuenta segura</p>
            
            <!-- Mensajes de sesión y errores -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Formulario -->
            <form id="password-form" method="POST" action="{{ route('password.change.submit') }}">
                @csrf
                
                <div class="form-group">
                    <label for="current_password">Contraseña Actual</label>
                    <input type="password" id="current_password" name="current_password" placeholder="Ingresa tu contraseña actual" required class="@error('current_password') error @enderror">
                </div>
                
                <div class="form-group">
                    <label for="password">Nueva Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu nueva contraseña" required class="@error('password') error @enderror">
                    <div class="password-strength-meter">
                        <div class="strength-bar" id="strength-bar"></div>
                    </div>
                    <p class="password-hint">La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, un número y un carácter especial.</p>
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirma tu nueva contraseña" required>
                </div>
                
                <button type="submit" class="btn-submit">Actualizar Contraseña</button>
            </form>
            
            <p class="back-link">¿No quieres cambiar tu contraseña? <a href="{{ url('/') }}">Volver</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const strengthBar = document.getElementById('strength-bar');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const form = document.getElementById('password-form');
            
            // Función para evaluar fortaleza de la contraseña
            function checkPasswordStrength(password) {
                let strength = 0;
                
                // Si la contraseña tiene 8+ caracteres
                if (password.length >= 8) strength += 1;
                
                // Si tiene mayúsculas y minúsculas
                if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength += 1;
                
                // Si tiene números y caracteres especiales
                if (password.match(/[0-9]/) && password.match(/[^a-zA-Z0-9]/)) strength += 1;
                
                return strength;
            }
            
            passwordInput.addEventListener('input', function() {
                const val = passwordInput.value;
                const strength = checkPasswordStrength(val);
                
                // Actualizar la barra de fortaleza según el resultado
                if (val === '') {
                    strengthBar.style.width = '0';
                    strengthBar.className = 'strength-bar';
                } else if (strength === 1) {
                    strengthBar.className = 'strength-bar weak';
                } else if (strength === 2) {
                    strengthBar.className = 'strength-bar medium';
                } else {
                    strengthBar.className = 'strength-bar strong';
                }
            });
            
            // Validación para confirmar que las contraseñas coincidan
            form.addEventListener('submit', function(e) {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    e.preventDefault();
                    alert('Las contraseñas no coinciden');
                    confirmPasswordInput.classList.add('error');
                }
            });
        });
    </script>
</body>
</html>