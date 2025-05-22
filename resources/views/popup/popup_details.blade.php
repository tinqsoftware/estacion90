<div class="popup-details">
    <div class="row">
        <div class="col-md-6">
            <h5>Información del Popup</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Nombre:</th>
                    <td>{{ $popup->nombre }}</td>
                </tr>
                <tr>
                    <th>Fecha de publicación:</th>
                    <td>{{ \Carbon\Carbon::parse($popup->fecha_visible)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Veces por día:</th>
                    <td>{{ $popup->veces_dia }}</td>
                </tr>
                <tr>
                    <th>Link:</th>
                    <td>
                        @if($popup->link)
                            <a href="{{ $popup->link }}" target="_blank">{{ $popup->link }}</a>
                        @else
                            <span class="text-muted">No definido</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Creado por:</th>
                    <td>
                        @if($popup->id_user_create)
                            {{ optional($popup->creator)->name ?? 'Usuario no encontrado' }}
                        @else
                            Sin registro
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Fecha de creación:</th>
                    <td>{{ $popup->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6 text-center">
            @if($popup->url_imagen)
                <h5>Imagen</h5>
                <img src="{{ asset($popup->url_imagen) }}" alt="{{ $popup->nombre }}" 
                     class="img-fluid img-thumbnail mt-2" style="max-height: 300px;">
            @else
                <div class="alert alert-info mt-4">
                    <i class="fas fa-info-circle"></i> Este popup no tiene imagen asociada.
                </div>
            @endif
        </div>
    </div>
    
    <div class="text-right mt-4">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    </div>
</div>