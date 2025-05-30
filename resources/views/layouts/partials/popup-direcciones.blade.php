
<div class="modal fade" id="popupDirecciones" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content p-4">
            <h4 class="text-center">MIS DIRECCIONES</h4>
            <div class="row">
                <div class="col-md-4" id="listaDirecciones">
                    @foreach ($direcciones as $i => $dir)
                        <div class="direccion-item border p-2 mb-2 rounded {{ $dir->id == Auth::user()->id_direccion ? 'active' : '' }}"
                            data-id="{{ $dir->id }}"
                            data-index="{{ $i }}"
                            onclick="seleccionarDireccion(this)">
                        <strong>{{ $i + 1 }}. {{ $dir->tipo_nombre }}, {{ $dir->distrito->nombre }}</strong><br>
                        {{ $dir->direccion }}<br>
                        <small><u>Ref:</u> {{ $dir->referencia }}</small>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-8">
                <div id="mapaDirecciones" style="width: 100%; height: 300px;"></div>
                </div>
            </div>

            <div class="text-center mt-3">
                <button class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary" onclick="guardarDireccionSeleccionada()">Guardar</button>
                <button class="btn btn-info" onclick="abrirAgregarDireccion()">Agregar otra dirección</button>
            </div>
        </div>
    </div>
</div>


<script>



    direcciones = @json($direcciones); // desde backend
    idActual = {{ Auth::user()->id_direccion }};
    seleccionadaId = idActual;
    mapa2;
    marcadores = [];

    function seleccionarDireccion(element) {
        const id = parseInt(element.dataset.id);
        seleccionarDireccionPorId(id);
    }




    function cargarMapaDirecciones() {
        if (mapa2) {
            mapa2.remove();
        }

        mapa2 = L.map('mapaDirecciones', {
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
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapa2);

        marcadores = [];
        const bounds = [];

        direcciones.forEach((dir, i) => {
            const isActual = dir.id === seleccionadaId;

            const icon = L.icon({
                iconUrl: isActual ? 'https://maps.google.com/mapfiles/ms/icons/red-dot.png' : 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                iconSize: isActual ? [35, 35] : [25, 25],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });

            const marker = L.marker([dir.lat, dir.lon], { icon }).addTo(mapa2);
            marker._customId = dir.id;
            marker._index = i;

            marker.bindPopup(`<b>${i + 1}. ${dir.tipo_nombre}</b><br>${dir.direccion}`);

            // Solo abre el popup de la dirección actual
            if (isActual) {
                marker.openPopup();
            }

            // Agrega evento click para cambiar selección al hacer clic en marcador
            marker.on('click', function () {
                seleccionarDireccionPorId(marker._customId);
            });

            marcadores.push(marker);
            bounds.push([dir.lat, dir.lon]);
        });

        if (bounds.length > 0) {
            mapa2.fitBounds(bounds, { padding: [30, 30] });
        }
    }

    function seleccionarDireccionPorId(id) {
        seleccionadaId = id;

        // Actualizar estilo en la lista de la izquierda
        document.querySelectorAll('.direccion-item').forEach(el => {
            el.classList.toggle('active', parseInt(el.dataset.id) === id);
        });

        // Actualizar íconos y popups
        marcadores.forEach(marker => {
            const isSelected = marker._customId === id;

            const icon = L.icon({
                iconUrl: isSelected ? 'https://maps.google.com/mapfiles/ms/icons/red-dot.png' : 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                iconSize: isSelected ? [35, 35] : [25, 25],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });

            marker.setIcon(icon);

            if (isSelected) {
                marker.openPopup();
            }
        });
    }




    $('#popupDirecciones').on('shown.bs.modal', function () {
        setTimeout(cargarMapaDirecciones, 300);
    });

    function guardarDireccionSeleccionada() {
        if (seleccionadaId === idActual) {
            $('#popupDirecciones').modal('hide');
            return;
        }

        $.ajax({
            url: '{{ route("direccion.actualizarPrincipal") }}',
            method: 'POST',
            data: {
                direccion_id: seleccionadaId,
                _token: '{{ csrf_token() }}'
            },
            success: function (res) {
                $('#popupDirecciones').modal('hide');
                // Mostrar mensaje de éxito
                Swal.fire({
                    icon: 'success',
                    title: 'Dirección actualizada',
                    text: 'Tu dirección fue cambiada exitosamente.'
                });
                actualizarDireccionPaso3();
            },
            error: function () {
                Swal.fire('Error', 'No se pudo cambiar la dirección. Intenta nuevamente.', 'error');
            }
        });
    }

    function actualizarDireccionPaso3() {
        $.ajax({
            url: '/partial/header-sidebar',
            method: 'GET',
            success: function (html) {
                $('#auth-container').html(html.authContainer);
            }
        });
    }

    function abrirAgregarDireccion() {
        $('#popupDirecciones').modal('hide');
        $('#modalAgregarDireccion').modal('show');
    }
    
</script>
