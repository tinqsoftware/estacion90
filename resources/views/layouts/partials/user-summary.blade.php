<div class="row">
    <div class="col-8">
        <h5 class="text-primary orders-img">
            <img src="access/images/banner-img/user.png" alt=""> Hola, {{ Auth::user()->name }}
        </h5>
        <p><strong>Teléfono:</strong> {{ Auth::user()->telefono ?? 'No registrado' }}</p>
   </div>
   <div class="col-4">
        <h1 id="reloj-hora" style="font-size: 28px; font-weight: bold;"></h1>
   </div>
</div>
<hr>

@if (is_null(Auth::user()->id_direccion))
    <div class="text-center mb-3" >
        <button type="button" class="btn btn-info" onclick="openAgregarDireccionModal()">
            <i class="fa fa-map-marker-alt"></i> Agregar dirección
        </button>
    </div>
@else
    <div>
        <div class="address-bx mt-3 mb-3">
            <span class="d-block mb-2">Tu dirección actual ({{Auth::user()->direccion->tipo_nombre}})</span>
            <div class="d-flex  align-items-center justify-content-between mb-2">
                <h4 class="mb-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.46 9.63C20.3196 8.16892 19.8032 6.76909 18.9612 5.56682C18.1191 4.36456 16.9801 3.40083 15.655 2.7695C14.3299 2.13816 12.8639 1.86072 11.3997 1.96421C9.93555 2.06769 8.52314 2.54856 7.3 3.36C6.2492 4.06265 5.36706 4.9893 4.71695 6.07339C4.06684 7.15749 3.6649 8.37211 3.54 9.63C3.41749 10.8797 3.57468 12.1409 4.00017 13.3223C4.42567 14.5036 5.1088 15.5755 6 16.46L11.3 21.77C11.393 21.8637 11.5036 21.9381 11.6254 21.9889C11.7473 22.0397 11.878 22.0658 12.01 22.0658C12.142 22.0658 12.2727 22.0397 12.3946 21.9889C12.5164 21.9381 12.627 21.8637 12.72 21.77L18 16.46C18.8912 15.5755 19.5743 14.5036 19.9998 13.3223C20.4253 12.1409 20.5825 10.8797 20.46 9.63ZM16.6 15.05L12 19.65L7.4 15.05C6.72209 14.3721 6.20281 13.5523 5.87947 12.6498C5.55614 11.7472 5.43679 10.7842 5.53 9.83C5.62382 8.86111 5.93177 7.92516 6.43157 7.08985C6.93138 6.25453 7.61056 5.54071 8.42 5C9.48095 4.29524 10.7263 3.9193 12 3.9193C13.2737 3.9193 14.5191 4.29524 15.58 5C16.387 5.53862 17.0647 6.24928 17.5644 7.08094C18.064 7.9126 18.3733 8.84461 18.47 9.81C18.5663 10.7674 18.4484 11.7343 18.125 12.6406C17.8016 13.5468 17.2807 14.3698 16.6 15.05ZM12 6C11.11 6 10.24 6.26392 9.49994 6.75839C8.75992 7.25286 8.18314 7.95566 7.84255 8.77793C7.50195 9.6002 7.41284 10.505 7.58647 11.3779C7.7601 12.2508 8.18869 13.0526 8.81802 13.682C9.44736 14.3113 10.2492 14.7399 11.1221 14.9135C11.995 15.0872 12.8998 14.9981 13.7221 14.6575C14.5443 14.3169 15.2471 13.7401 15.7416 13.0001C16.2361 12.26 16.5 11.39 16.5 10.5C16.4974 9.30734 16.0224 8.16428 15.1791 7.32094C14.3357 6.4776 13.1927 6.00265 12 6ZM12 13C11.5055 13 11.0222 12.8534 10.6111 12.5787C10.2 12.304 9.87952 11.9135 9.6903 11.4567C9.50109 10.9999 9.45158 10.4972 9.54804 10.0123C9.6445 9.52733 9.88261 9.08187 10.2322 8.73224C10.5819 8.38261 11.0273 8.1445 11.5123 8.04804C11.9972 7.95158 12.4999 8.00109 12.9567 8.1903C13.4135 8.37952 13.804 8.69996 14.0787 9.11108C14.3534 9.5222 14.5 10.0056 14.5 10.5C14.5 11.163 14.2366 11.7989 13.7678 12.2678C13.2989 12.7366 12.663 13 12 13Z" fill="var(--primary)"/>
                    </svg>
                    {{Auth::user()->direccion->direccion}},<br/>{{Auth::user()->direccion->distrito->nombre}}
                </h4>
                <button type="button" class="btn btn-outline-primary btn-sm" onclick="abrirPopupDirecciones()">Cambiar<br/>dirección</a>
            </div>
            <p>{{Auth::user()->direccion->referencia}}</p>
            <div id="miniMapa" style="width: 100%; height: 180px;"></div>
        </div>
    </div>

    <script>
        const latu = {{Auth::user()->direccion->lat}};
        const lngu = {{Auth::user()->direccion->lon}};
        setTimeout(() => {
            const miniMapau = L.map('miniMapa', {
                center: [latu, lngu],
                zoom: 15,
                dragging: false,           // deshabilita mover el mapa con el mouse
                scrollWheelZoom: false,    // deshabilita zoom con la rueda del mouse
                doubleClickZoom: false,    // deshabilita zoom con doble clic
                boxZoom: false,            // deshabilita zoom con arrastre de caja
                tap: false,                // deshabilita interacción táctil (en móviles)
                touchZoom: false,          // deshabilita pinch-to-zoom
                zoomControl: true          // muestra los botones de zoom (+/-)
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(miniMapau);
            L.marker([latu, lngu]).addTo(miniMapau);

            // Forzar redimensionamiento del contenedor por si se renderizó oculto
            setTimeout(() => {
                miniMapau.invalidateSize();
            }, 300);
        }, 200);


    </script>
@endif