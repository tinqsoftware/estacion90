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

    <!-- Leaflet CSS and JavaScript -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Estilos para la página de perfil -->
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #333;
    }

    .profile-section {
        display: flex;
        gap: 40px;
        margin-bottom: 40px;
    }

    .profile-image {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .image-placeholder {
        width: 120px;
        height: 120px;
        background-color: #e9e9e9;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .image-placeholder svg {
        width: 80px;
        height: 80px;
        fill: #4a2a71;
    }

    .upload-btn {
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        color: #333;
        transition: background-color 0.3s;
    }

    .upload-btn:hover {
        background-color: #e0e0e0;
    }

    .form-fields {
        flex: 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        align-items: start;
    }

    .field-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .field-group label {
        font-weight: 500;
        color: #333;
        font-size: 14px;
    }

    .field-group input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        background-color: #f9f9f9;
    }

    .save-btn {
        grid-column: span 2;
        background-color: #e0e0e0;
        border: 1px solid #ccc;
        padding: 12px 30px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        justify-self: start;
        margin-top: 10px;
        transition: background-color 0.3s;
    }

    .save-btn:hover {
        background-color: #d0d0d0;
    }

    .address-section {
        margin-bottom: 40px;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    .current-address {
        display: flex;
        gap: 40px;
        margin-bottom: 30px;
    }

    .address-info {
        flex: 1;
    }

    .address-info-title {
        font-size: 16px;
        margin-bottom: 15px;
        color: #333;
        font-weight: bold;
    }

    .address-details {
        display: flex;
        flex-direction: column;
        gap: 8px;
        font-size: 14px;
        color: #555;
    }

    .detail-label {
        font-weight: 500;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
        /* Reduced from 20px to bring map closer to title */
        color: #333;
    }

    .current-address {
        display: flex;
        gap: 20px;
        /* Reduced from 40px to bring map closer to address info */
        margin-bottom: 30px;
        align-items: flex-start;
        /* Aligns items at the top */
    }

    .address-info {
        flex: 0 0 auto;
        /* Prevents address info from expanding */
        width: 30%;
        /* Controls width of address info section */
    }

    .map-container {
        width: 70%;
        /* Makes map take up 70% of the available space */
        height: 220px;
        /* Slightly increased height */
        background-color: #e9e9e9;
        border: 1px solid #ccc;
        border-radius: 4px;
        position: relative;
    }






    .other-addresses-title {
        font-size: 16px;
        margin-bottom: 20px;
        color: #333;
        font-weight: bold;
    }

    .addresses-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .addresses-table th {
        background-color: #f8f8f8;
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        color: #333;
        font-size: 14px;
    }

    .addresses-table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        color: #555;
        font-size: 14px;
    }

    .select-btn {
        background-color: #e0e0e0;
        border: 1px solid #ccc;
        padding: 6px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        transition: background-color 0.3s;
    }

    .select-btn:hover {
        background-color: #d0d0d0;
    }

    .add-address-btn {
        background-color: #e0e0e0;
        border: 1px solid #ccc;
        padding: 12px 24px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .add-address-btn:hover {
        background-color: #d0d0d0;
    }

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .modal-content {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        max-width: 400px;
        width: 90%;
    }

    .modal h3 {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .modal p {
        margin-bottom: 20px;
        color: #555;
        line-height: 1.4;
    }

    .modal-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .modal-btn {
        padding: 10px 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
    }

    .cancel-btn {
        background-color: #f0f0f0;
    }

    .accept-btn {
        background-color: #e0e0e0;
    }

    .link-btn {
        color: #1976d2;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .profile-section {
            flex-direction: column;
            gap: 20px;
        }

        .form-fields {
            grid-template-columns: 1fr;
        }

        .current-address {
            flex-direction: column;
            gap: 20px;
        }

        .current-address {
            flex-direction: column;
            gap: 15px;
        }

        .address-info {
            width: 100%;
        }

        .map-container {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <div id="main-wrapper" class="dlab-overflow">
        @include('partials.header')
        @include('partials.sidebar')

        <div class="content-body">
            <div class="container-fluid">
                <h1>MI PERFIL</h1>

                <div class="profile-section">
                    <div class="profile-image">
                        <div class="image-placeholder" id="image-preview">
                            @if(isset($user->imagen) && !empty($user->imagen))
                            <img src="{{ asset('access/images/popular-img/' . $user->imagen) }}" alt="Imagen de perfil"
                                style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z">
                                </path>
                            </svg>
                            @endif
                        </div>
                        <input type="file" id="imagen-input" name="imagen" accept="image/*" style="display: none;">
                        <button type="button" class="upload-btn" id="trigger-upload">Cargar imagen</button>
                    </div>

                    <form id="profile-form" class="form-fields">
                        @csrf
                        <div class="field-group">
                            <label for="nombres">Nombres</label>
                            <input type="text" id="nombres" name="nombres" value="{{ $user->name ?? '' }}">
                        </div>

                        <div class="field-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" id="apellidos" name="apellidos" value="{{ $user->apellido ?? '' }}">
                        </div>

                        <div class="field-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email ?? '' }}">
                        </div>

                        <div class="field-group">
                            <label for="telefono">Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" value="{{ $user->telefono ?? '' }}">
                        </div>

                        <button type="button" class="save-btn" id="save-profile">Grabar</button>
                    </form>
                </div>

                <div class="address-section">
                    <h2 class="section-title">Mi dirección actual</h2>
                    <div class="current-address">
                        <div class="address-info">
                            <div class="address-details">
                                @if(isset($user->direccion))
                                <div><span class="detail-label">Tipo:</span>
                                    {{ $user->direccion->tipo_nombre ?? 'No definido' }}</div>
                                <div><span class="detail-label">Dirección:</span>
                                    {{ $user->direccion->direccion ?? 'No definido' }}</div>
                                <div><span class="detail-label">Referencia:</span>
                                    {{ $user->direccion->referencia ?? 'No definido' }}</div>
                                <div><span class="detail-label">Distrito:</span>
                                    {{ $user->direccion->distrito->nombre ?? 'No definido' }}</div>
                                @else
                                <div>No tienes dirección predeterminada configurada</div>
                                @endif
                            </div>
                        </div>

                        <div class="map-container" id="workMap"></div>
                    </div>

                    <div class="other-addresses">
                        <h3 class="other-addresses-title">Mis otras direcciones</h3>

                        <table class="addresses-table">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Distrito</th>
                                    <th>Dirección</th>
                                    <th>Referencia</th>
                                    <th>Ver X y Y</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($direcciones) == 0)
                                <tr>
                                    <td colspan="6" style="text-align: center;">No tienes direcciones adicionales</td>
                                </tr>
                                @else
                                @foreach($direcciones as $direccion)
                                <tr>
                                    <td>{{ $direccion->tipo_nombre }}</td>
                                    <td>{{ $direccion->distrito->nombre }}</td>
                                    <td>{{ $direccion->direccion }}</td>
                                    <td>{{ $direccion->referencia }}</td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>

                        <button class="add-address-btn">Agregar nueva dirección</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de confirmación -->
        <div class="modal" id="confirmModal">
            <div class="modal-content">
                <h3>CONFIRMAR CAMBIO DE DIRECCIÓN</h3>
                <p>¿Está seguro que desea cambiar a:<br>
                    Jr Luis 32 (Casa) como su dirección actual ?</p>
                <div class="modal-buttons">
                    <button class="modal-btn cancel-btn" onclick="hideModal()">CANCELAR</button>
                    <button class="modal-btn accept-btn" onclick="acceptChange()">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('trigger-upload').addEventListener('click', function() {
        document.getElementById('imagen-input').click();
    });

    document.getElementById('imagen-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (!file) return;

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            const imagePreview = document.getElementById('image-preview');
            imagePreview.innerHTML =
                `<img src="${e.target.result}" alt="Imagen de perfil" style="width: 100%; height: 100%; object-fit: cover;">`;
        };
        reader.readAsDataURL(file);

        // Upload the image immediately
        const formData = new FormData();
        formData.append('imagen', file);
        formData.append('_token', document.querySelector('input[name="_token"]').value);

        fetch('{{ route("usuarios.upload_image") }}', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al subir la imagen'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema de conexión'
                });
            });
    });

    // Handle form submission
    document.getElementById('save-profile').addEventListener('click', function() {
        const form = document.getElementById('profile-form');
        const formData = new FormData(form);

        fetch('{{ route("usuarios.update_profile") }}', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    let errorMessage = 'Por favor revise los datos ingresados';
                    if (data.errors) {
                        errorMessage = Object.values(data.errors).join('\n');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema de conexión'
                });
            });
    });

    
    document.addEventListener('DOMContentLoaded', function() {
        // Default coordinates (you can replace these with actual coordinates)
        const lat = -12.0464; // Lima, Peru coordinates as example
        const lng = -77.0428;

        // Initialize map
        const workMap = L.map('workMap').setView([lat, lng], 15);

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(workMap);

        // Add marker with popup
        const marker = L.marker([lat, lng]).addTo(workMap);
        marker.bindPopup("<b>Trabajo</b>").openPopup();
    });

    function showModal() {
        document.getElementById('confirmModal').style.display = 'flex';
    }

    function hideModal() {
        document.getElementById('confirmModal').style.display = 'none';
    }

    function acceptChange() {
        alert('Dirección cambiada exitosamente');
        hideModal();
    }

    </script>

    <!-- Required vendors -->
    <script src="{{ asset('access/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('access/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/swiper/js/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard -->
    <script src="{{ asset('access/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('access/js/custom.js') }}"></script>
    <script src="{{ asset('access/js/demo.js') }}"></script>
</body>

</html>