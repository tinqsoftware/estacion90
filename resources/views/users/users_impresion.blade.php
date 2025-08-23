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

    <script>
async function qzEnsureConnected(){ if(!qz.websocket.isActive()) await qz.websocket.connect(); }
async function getDefaultPrinter(){ await qzEnsureConnected(); return await qz.printers.getDefault(); }

async function printPdfViaBase64(pdfUrl, printerName){
  const resp = await fetch(pdfUrl, { credentials:'include' });
  if(!resp.ok) throw new Error('PDF HTTP '+resp.status);
  const blob = await resp.blob();
  const buf  = await blob.arrayBuffer();
  const bytes = new Uint8Array(buf);
  let bin = ''; for(let i=0;i<bytes.byteLength;i++) bin += String.fromCharCode(bytes[i]);
  const b64 = btoa(bin);
  const cfg  = qz.configs.create(printerName, { rasterize:true });
  const data = [{ type:'pdf', data:'base64,'+b64 }];
  await qz.print(cfg, data);
}

async function marcarImpresa(id){
  const r = await fetch(`/api/impresiones/${id}/marcar-impresa`, {
    method:'POST',
    headers:{ 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
              'Accept':'application/json' },
    credentials:'include'
  });
  if(!r.ok) throw new Error('HTTP '+r.status);
  const j = await r.json(); if(!j.ok) throw new Error('No se pudo marcar id '+id);
}

async function fetchPendientes(limit=5){
  const r = await fetch(`/api/impresiones/pendientes?limit=${limit}`, { credentials:'include' });
  if(!r.ok) throw new Error('HTTP '+r.status);
  const j = await r.json(); return j.items || [];
}

async function printHtmlViaQZ(htmlString, printerName){
  await qzEnsureConnected();
  const cfg  = qz.configs.create(printerName, { rasterize: true });
  const data = [{ type: 'html', format: 'plain', data: htmlString }];
  await qz.print(cfg, data);
}

async function imprimirItemCola(it){
  const printer = await getDefaultPrinter();
  if(!printer) throw new Error('No hay impresora por defecto');

  // Descarga el HTML de la vista (no PDF)
  const resp = await fetch(`/despacho/pedido/imprimir/${it.pedido_id}`, { credentials:'include' });
  if(!resp.ok) throw new Error('HTML HTTP '+resp.status);
  const html = await resp.text();

  await printHtmlViaQZ(html, printer);
  await marcarImpresa(it.id);
}

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
  $stamp.textContent = 'Actualizado: '+ new Date().toLocaleString();
  $tbody.innerHTML = items.length ? items.map(rowHtml).join('') :
    `<tr><td colspan="6" class="text-center text-muted p-4">No hay impresiones pendientes</td></tr>`;
}

let busy=false, printedRecently=new Set();
async function cicloAuto(ms=4000,batch=5){
  if(busy) return; busy=true;
  try{
    const items = await fetchPendientes(batch);
    await renderTabla(items);
    for(const it of items){
      if(printedRecently.has(it.id)) continue;
      try{ await imprimirItemCola(it); printedRecently.add(it.id); }
      catch(e){ console.error('Error imprimiendo', it.id, e); }
    }
    setTimeout(()=>printedRecently.clear(), 60000);
  }catch(e){ console.error('Autoimpresión', e); }
  finally{ busy=false; setTimeout(()=>cicloAuto(ms,batch), ms); }
}

document.addEventListener('click', async e=>{
  const btn = e.target.closest('[data-action="imprimir-pendiente"]'); if(!btn) return;
  try{ await imprimirItemCola({ id:btn.dataset.id, pedido_id:btn.dataset.pedido }); }
  catch(err){ console.error(err); alert('No se pudo imprimir: '+(err.message||err)); }
});

window.addEventListener('load', async ()=>{
  try{ await qzEnsureConnected(); cicloAuto(4000,5); }
  catch(e){ console.error('QZ connect:', e); }
});
</script>


</body>