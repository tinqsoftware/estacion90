<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pedido #{{ $pedido['id'] }} - Estación 90</title>
    <style>
    @page {
        size: A5;
        margin: 10mm; /* Añadir margen a la página impresa */
    }
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 15px; /* Aumentado de 15px a 20px */
        font-size: 12px;
        color: #333;
    }
    .ticket {
        width: 100%;
        max-width: 138mm; /* Reducido para compensar los márgenes de página */
        min-height: 190mm; /* Reducido para compensar los márgenes de página */
        margin: 0 auto; /* Centrar el ticket */
    }
    .logo {
        text-align: center;
        margin-bottom: 10px; /* Aumentado de 10px a 15px */
    }
    .logo img {
        max-width: 100px; /* Aumentado un poco */
        height: auto;
    }
    .header {
        text-align: center;
        margin-bottom: 15px; /* Aumentado de 15px a 20px */
        border-bottom: 1px dashed #000;
        padding-bottom: 10px; /* Aumentado de 10px a 15px */
    }
    .header h1 {
        font-size: 18px;
        margin: 5px 0; /* Aumentado de 5px a 8px */
    }
    .header p {
        font-size: 14px;
        margin: 5px 0; /* Aumentado de 5px a 8px */
    }
    .details {
        margin-bottom: 15px; /* Aumentado de 15px a 20px */
    }
    .details div {
        margin-bottom: 5px; /* Aumentado de 5px a 8px */
    }
    .customer {
        border: 1px solid #ddd;
        padding: 10px; /* Aumentado de 10px a 15px */
        margin-bottom: 15px; /* Aumentado de 15px a 20px */
        border-radius: 5px; /* Aumentado de 5px a 8px */
    }
    .items {
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        margin-bottom: 15px; /* Aumentado de 15px a 20px */
        padding: 10px 0; /* Aumentado de 10px a 15px */
    }
    .comensal {
        margin-bottom: 15px; /* Aumentado de 15px a 20px */
    }
    .comensal-name {
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 5px; /* Aumentado de 5px a 8px */
    }
    .item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px; /* Aumentado de 5px a 8px */
        padding-left: 15px;
    }
    .item-details {
        flex-grow: 1;
    }
    .totals {
        text-align: right;
        margin-top: 25px; /* Aumentado de 20px a 25px */
    }
    .delivery {
        margin-bottom: 5px; /* Aumentado de 5px a 8px */
    }
    .total {
        font-weight: bold;
        font-size: 16px;
    }
    .payment {
        border: 1px solid #ddd;
        padding: 10px; /* Aumentado de 10px a 15px */
        margin-bottom: 15px; /* Aumentado de 15px a 20px */
        border-radius: 5px; /* Aumentado de 5px a 8px */
    }
    .footer {
        text-align: center;
        margin-top: 20px; /* Aumentado de 20px a 25px */
        border-top: 1px dashed #000;
        padding-top: 10px; /* Aumentado de 10px a 15px */
        font-size: 11px;
    }
    .row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px; /* Añadido espacio entre filas */
    }
    @media print {
        body {
            padding: 1px; /* Mantenemos algo de padding al imprimir */
            -webkit-print-color-adjust: exact;
        }
        .no-print {
            display: none;
        }
        .ticket {
            margin: 0 auto;
        }
    }
</style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()">Imprimir Ticket</button>
        <button onclick="window.close()">Cerrar</button>
    </div>
    
    <div class="ticket">
        <div class="logo">
            <img src="{{ asset('access/images/logo-full_top.png') }}" alt="Estación 90">
        </div>
        
        <div class="header">
            <h1>ESTACIÓN 90 RESTAURANT</h1>
            <p>Av. Principal 1234, Lima</p>
            <p>Tel: 01 234 5678</p>
            <p>PEDIDO #{{ $pedido['id'] }}</p>
            <p>{{ $pedido['fecha'] }} {{ $pedido['hora_pedido'] }}</p>
        </div>
        
        <div class="customer">
            <div class="row">
                <div><strong>Cliente:</strong> {{ $pedido['nombre_contacto'] }}</div>
                <div><strong>Tel:</strong> {{ $pedido['telefono_contacto'] }}</div>
            </div>
            <div><strong>Dirección:</strong> {{ $pedido['direccion'] }}</div>
            @if($pedido['referencia'])
            <div><strong>Referencia:</strong> {{ $pedido['referencia'] }}</div>
            @endif
            @if($pedido['distrito'])
            <div><strong>Distrito:</strong> {{ $pedido['distrito'] }}</div>
            @endif
        </div>
        
        <div class="items">
            @foreach($pedido['comensales'] as $comensal)
            <div class="comensal">
                <div class="comensal-name">{{ $comensal['nombre'] }}</div>
                @foreach($comensal['items'] as $item)
                <div class="item">
                    <div class="item-details">{{ $item['cantidad'] }}x {{ $item['nombre'] }}</div>
                    <div>S/ {{ number_format($item['subtotal'], 2) }}</div>
                </div>
                @endforeach
                <div style="text-align: right; margin-top: 5px;">
                    <strong>Subtotal: S/ {{ number_format($comensal['total'], 2) }}</strong>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="payment">
            <div class="row">
                <div><strong>Método de pago:</strong></div>
                <div>{{ $pedido['metodo_pago'] }}</div>
            </div>
            @if($pedido['vuelto'])
            <div class="row">
                <div><strong>Vuelto de:</strong></div>
                <div>{{ $pedido['vuelto'] }} soles</div>
            </div>
            @endif
            <div class="row">
                <div><strong>Comprobante:</strong></div>
                <div>{{ $pedido['comprobante'] }}</div>
            </div>
            @if($pedido['tipo_comprobante'])
            <div class="row">
                <div><strong>Tipo:</strong></div>
                <div>{{ $pedido['tipo_comprobante'] }}</div>
            </div>
            @endif
            @if($pedido['documento'])
            <div class="row">
                <div><strong>Documento:</strong></div>
                <div>{{ $pedido['documento'] }}</div>
            </div>
            @endif
        </div>
        
        <div class="totals">
            <div class="delivery">Delivery: S/ 1.00</div>
            <div class="total">TOTAL: S/ {{ number_format($pedido['total'] + 1, 2) }}</div>
        </div>
        
        @if($pedido['comentarios'])
        <div class="details" style="margin-top: 15px; border-top: 1px solid #ddd; padding-top: 10px;">
            <div><strong>Comentarios:</strong></div>
            <div>{{ $pedido['comentarios'] }}</div>
        </div>
        @endif
        
        <div class="footer">
            <p>Hora de entrega aproximada: {{ $pedido['hora_entrega'] }}</p>
            <p>¡Gracias por su preferencia!</p>
            <p>www.estacion90.com</p>
        </div>
    </div>
    
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
                setTimeout(function() {
                    window.close();
                }, 500);
            }, 1000);
        };
    </script>
</body>
</html>