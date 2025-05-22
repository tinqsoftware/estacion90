<div class="popup-details">
    <div class="row">
        <div class="col-md-6 text-center">
            @if($popup->imagen)
                <img src="{{ asset('storage/' . $popup->imagen) }}" alt="{{ $popup->nombre }}" class="img-fluid mb-3">
            @else
                <div class="no-image p-5 bg-light text-muted">No hay imagen disponible</div>
            @endif
        </div>
        <div class="col-md-6">
            <h3>{{ $popup->nombre }}</h3>
            <hr>
            <p><strong>Fecha de publicación:</strong> {{ \Carbon\Carbon::parse($popup->fecha_visible)->format('d M Y') }}</p>
            
            @if($popup->link)
                <p><strong>Link:</strong> <a href="{{ $popup->link }}" target="_blank">{{ $popup->link }}</a></p>
            @endif
            
            <p><strong>Descripción:</strong></p>
            <div class="description-box p-2 bg-light">
                {{ $popup->descripcion }}
            </div>
            
            <p class="mt-3"><strong>Cantidad por día:</strong> 
                {{ $popup->popupdias->first() ? $popup->popupdias->first()->cantidad : 'No especificado' }}
            </p>
            
            <p><strong>Creado por:</strong> {{ optional($popup->creador)->name }}</p>
            <p><strong>Fecha creación:</strong> {{ $popup->created_at->format('d M Y') }}</p>
        </div>
    </div>
</div>