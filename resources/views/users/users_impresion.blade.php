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
    <meta property="og:image" content="{{ asset('access/images/logo_white.png') }}" />
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- PAGE TITLE HERE -->
    <title>estacion90</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('access/images/logo_white.png') }}" />

    <!-- Stylesheet -->
    <link href="{{ asset('access/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('access/vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('access/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('access/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('access/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css') }}" rel="stylesheet">

    <!-- Global Stylesheet -->
    <link href="{{ asset('access/css/style.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>

          /* --- Reglas SOLO impresora --- */
        @media print {
          @page {
            /* ancho real del papel de la ticketera */
            size: 45mm auto;
            margin: 0;                 /* sin márgenes */
          }
          html, body {
            width: 45mm;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
          }

          /* tipografías y espaciamientos pensados para 203 dpi */
          body { font-size: 12px; line-height: 1.25; }
          .ticket { width: 45mm; padding: 0; margin: 0; }
          .row   { display:block; }
          .mt-0, .mb-0, .pt-0, .pb-0 { margin:0; padding:0; }

          /* Evita que “encuadre” o meta márgenes invisibles */
          * { box-sizing: border-box; }
          img, canvas { max-width: 100%; height: auto; }

          /* Evitar saltos raros */
          .no-break { page-break-inside: avoid; }
        }


        /* Better table visuals */
        #tabla-impresiones {
            width: 100%;
        }
        #tabla-impresiones thead th {
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 1;
            border-bottom: 1px solid #e5e7eb;
        }
        #tabla-impresiones td, #tabla-impresiones th {
            vertical-align: middle;
        }
        .text-truncate-1 {
            max-width: 220px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .actions-cell .btn { min-width: 36px; }
        .card-title { font-weight: 700; }
        
        /* Header like image */
        .impresiones-header {
            background: #fff7ed; /* orange-50 */
            border-bottom: 1px solid #fde7d8;
            padding: 14px 16px !important;
        }
        .impresiones-title { display:flex; align-items:center; gap:10px; margin:0; font-weight:800; }
        .impresiones-title i { color:#f59e0b; }
        .header-right-tools { display:flex; align-items:center; gap:12px; }
        .status-badge { background:#fff1e6; border:1px solid #ffe1cc; color:#7c2d12; font-size:12px; border-radius:6px; padding:6px 10px; font-weight:600; }
        .pending-pill { background:#f97316; color:#fff; border-radius:9999px; padding:6px 10px; font-weight:700; font-size:12px; }

        /* Buttons + money */
        .btn-icon{ width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center; padding:0; }
        .btn-outline-orange{ color:#ea580c; border:1px solid #fdba74; background:transparent; }
        .btn-outline-orange:hover{ background:#fdba74; color:#7c2d12; }
        .btn-outline-soft{ color:#6b7280; border:1px solid #e5e7eb; background:#fff; }
        .btn-outline-soft:hover{ background:#f3f4f6; color:#374151; }
        .money{ display:inline-flex; align-items:center; gap:6px; }
        .money-symbol, .text-money{ color:#16a34a; font-weight:700; }
        
        /* Mobile stacked table */
        @media (max-width: 768px) {
            .table thead { display: none; }
            .table tbody tr {
                display: block;
                margin-bottom: 12px;
                border: 1px solid #e5e7eb;
                border-radius: 10px;
                overflow: hidden;
                background: #fff;
            }
            .table tbody td {
                display: grid;
                grid-template-columns: 38% 62%;
                gap: 6px;
                padding: 10px 12px !important;
                border-bottom: 1px solid #f3f4f6;
            }
            .table tbody td:last-child { border-bottom: 0; }
            .table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #6b7280;
            }
            .actions-cell > .btn-group, .actions-cell > .actions-flex {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <strong>🖨️ Cola De Impresiones (Pendientes)</strong>
                                <small id="lastUpdate">Actualizado: --</small>
                            </div>
                            <div class="card-body p-0">
                                <table class="table mb-0">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Pedido</th>
                                    <th>Generado</th>
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="impTable">
                                    <tr><td colspan="6" class="text-center text-muted p-4">Cargando…</td></tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
            
        </div>
    </div>

    @include('partials.qz-setup')
    
    <!-- Vendor Scripts -->
    <script src="{{ asset('access/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('access/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('access/vendor/swiper/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('access/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('access/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <script>
      /* ===== Conexión QZ ===== */
      async function qzEnsureConnected(){ if(!qz.websocket.isActive()) await qz.websocket.connect(); }
      async function getDefaultPrinter(){ await qzEnsureConnected(); return await qz.printers.getDefault(); }

      /* ===== Util: milímetros a píxeles (203dpi ≈ 8 px/mm) ===== */
      const PX_PER_MM = 203 / 25.4;                  // ≈ 7.99
      const TICKET_MM = 45;                          // ancho del rollo
      const TICKET_PX = Math.round(TICKET_MM * PX_PER_MM); // ≈ 360px

      /* ===== Carga el HTML del ticket en un iframe oculto =====
        Apunta a tu propia vista de impresión. Idealmente esa vista
        solo renderiza el ticket (sin header/sidebar). Si quieres,
        agrega un query ?embed=1 y en la vista ocultas cualquier layout. */
      async function loadTicketInIframe(pedidoId){
        return new Promise((resolve, reject) => {
          const iframe = document.createElement('iframe');
          iframe.style.position = 'fixed';
          iframe.style.left = '-99999px';
          iframe.style.width = TICKET_PX + 'px';  // mismo ancho que renderizaremos
          iframe.style.height = '10px';
          iframe.setAttribute('aria-hidden', 'true');

          // Usa tu misma ruta; si puedes, agrega ?embed=1 para servir SOLO el ticket
          iframe.src = `/despacho/pedido/imprimir/${pedidoId}?embed=1`;

          iframe.onload = () => {
            try {
              const doc = iframe.contentDocument || iframe.contentWindow.document;
              // Busca un contenedor del ticket. Ajusta el selector a tu vista:
              const node = doc.querySelector('.ticket') || doc.body;

              // Asegura el ancho exacto para el render
              node.style.width = TICKET_PX + 'px';
              node.style.margin = '0';
              node.style.padding = '0';
              resolve({ iframe, node });
            } catch (e) { reject(e); }
          };
          iframe.onerror = () => reject(new Error('No se pudo cargar el ticket en iframe'));
          document.body.appendChild(iframe);
        });
      }

      /* ===== Renderiza el ticket a PNG (base64) ===== */
      async function ticketToBase64Png(node){
        const canvas = await html2canvas(node, {
          scale: 2,                    // mejora nitidez en térmicas 203dpi
          useCORS: true,
          backgroundColor: '#ffffff',
          width: TICKET_PX,
          windowWidth: TICKET_PX
        });
        return canvas.toDataURL('image/png').split(',')[1];  // base64 puro
      }

      /* ===== Imprime imagen con QZ a 45mm de ancho ===== */
      async function printPngBase64WithQZ(b64, printerName){
        const cfg = qz.configs.create(printerName, {
          rasterize: true,
          size: { width: TICKET_MM, units: 'mm' },   // ancho físico exacto
          scaleContent: true,
          copies: 1
        });
        const data = [{ type: 'image', format: 'png', data: 'base64,' + b64 }];
        await qz.print(cfg, data);
      }

      /* ===== Marca como impreso en tu API ===== */
      async function marcarImpresa(id){
        const r = await fetch(`/api/impresiones/${id}/marcar-impresa`, {
          method:'POST',
          headers:{
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept':'application/json'
          },
          credentials:'include'
        });
        if(!r.ok) throw new Error('HTTP '+r.status);
        const j = await r.json(); if(!j.ok) throw new Error('No se pudo marcar id '+id);
      }

      /* ===== Obtiene pendientes ===== */
      async function fetchPendientes(limit=5){
        const r = await fetch(`/api/impresiones/pendientes?limit=${limit}`, { credentials:'include' });
        if(!r.ok) throw new Error('HTTP '+r.status);
        const j = await r.json(); return j.items || [];
      }

      /* ===== Imprimir un item de la cola ===== */
      async function imprimirItemCola(it){
        const printer = await getDefaultPrinter();
        if(!printer) throw new Error('No hay impresora por defecto');

        // 1) cargar HTML en iframe oculto
        const { iframe, node } = await loadTicketInIframe(it.pedido_id);
        try {
          // 2) convertir ese HTML (el contenedor .ticket) a PNG base64
          const b64 = await ticketToBase64Png(node);

          // 3) mandar a QZ como imagen
          await printPngBase64WithQZ(b64, printer);

          // 4) marcar impreso y limpiar iframe
          await marcarImpresa(it.id);
        } finally {
          iframe.remove();
        }

        // 5) quitar de la tabla si existe
        const tr = document.querySelector(`tr[data-id="${it.id}"]`);
        if(tr) tr.remove();
      }

      /* ===== UI/cola (igual que ya tenías) ===== */
      const $tbody = document.getElementById('impTable');
      const $stamp = document.getElementById('lastUpdate');

      function rowHtml(it){ return `
        <tr data-id="${it.id}">
          <td>${it.id}</td><td>#${it.pedido_id}</td><td>${it.generado??''}</td>
          <td>${it.cliente??''}</td><td>${it.total??''}</td>
          <td><button class="btn btn-sm btn-outline-primary"
            data-action="imprimir-pendiente" data-id="${it.id}" data-pedido="${it.pedido_id}">Imprimir</button></td>
        </tr>`; }

      async function renderTabla(items){
        $stamp.textContent = 'Actualizado: ' + new Date().toLocaleString();
        $tbody.innerHTML = items.length
          ? items.map(rowHtml).join('')
          : `<tr><td colspan="6" class="text-center text-muted p-4">No hay impresiones pendientes</td></tr>`;
      }

      let busy=false, printedRecently=new Set();
      async function cicloAuto(ms=4000,batch=5){
        if(busy) return; busy=true;
        try{
          const items = await fetchPendientes(batch);
          await renderTabla(items);
          for(const it of items){
            if(printedRecently.has(it.id)) continue;
            try{
              await imprimirItemCola(it);
              printedRecently.add(it.id);
            }catch(e){
              console.error('Error imprimiendo', it.id, e);
            }
          }
          setTimeout(()=>printedRecently.clear(), 60000);
        }catch(e){
          console.error('Autoimpresión', e);
        }finally{
          busy=false;
          setTimeout(()=>cicloAuto(ms,batch), ms);
        }
      }

      document.addEventListener('click', async e=>{
        const btn = e.target.closest('[data-action="imprimir-pendiente"]'); if(!btn) return;
        try{
          await imprimirItemCola({ id:btn.dataset.id, pedido_id:btn.dataset.pedido });
        }catch(err){
          console.error(err);
          alert('No se pudo imprimir: '+(err.message||err));
        }
      });

      window.addEventListener('load', async ()=>{
        try{ await qzEnsureConnected(); cicloAuto(4000,5); }
        catch(e){ console.error('QZ connect:', e); }
      });
    </script>



</body>