<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>QZ Test</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.jsdelivr.net/npm/qz-tray@2.2.4/qz-tray.js"></script>

  <script>
    // Fuerza el mismo algoritmo que usa el servidor
    if (qz.security && typeof qz.security.setSignatureAlgorithm === 'function') {
      qz.security.setSignatureAlgorithm('SHA256');
    }

    // 1) Certificado público desde Laravel (usar patrón resolve/reject de 2.2.x)
    qz.security.setCertificatePromise(function(resolve, reject) {
      fetch('/qz/certificate', { cache: 'no-store' })
        .then(r => r.ok ? r.text() : Promise.reject('HTTP '+r.status))
        .then(pem => pem && pem.trim().startsWith('-----BEGIN CERTIFICATE-----')
              ? resolve(pem) : reject('Invalid PEM'))
        .catch(err => reject('Cert error: ' + err));
    });

    // 2) Firma RSA-SHA256 en el servidor (con CSRF)
    qz.security.setSignaturePromise(function(toSign) {
      return function(resolve, reject) {
        fetch('/qz/sign', {
          method: 'POST',
          headers: {
            'Content-Type': 'text/plain',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          credentials: 'same-origin',
          body: (typeof toSign === 'string' ? toSign : String(toSign))
        })
        .then(r => r.ok ? r.text() : Promise.reject('HTTP '+r.status))
        .then(sig => sig && sig.trim() ? resolve(sig.trim()) : reject('Empty signature'))
        .catch(err => reject('Sign error: ' + err));
      };
    });

    async function connectQZ(){
      if (!qz.websocket.isActive()) { await qz.websocket.connect(); }
      console.log('QZ version', await qz.api.getVersion());
    }

    async function printTest(){
      try{
        await connectQZ();
        const def = await qz.printers.getDefault();
        if (!def) return alert('Configura una impresora por defecto en el sistema.');

        const cfg  = qz.configs.create(def, { copies: 1 });
        const data = [{ type:'raw', format:'plain', data:'Test Estacion90 ✅\n' }];
        await qz.print(cfg, data);
        //alert('Enviado a: ' + def);
      }catch(e){
        alert('Error: ' + (e?.message || e));
        console.error(e);
      }
    }
  </script>
</head>
<body>
  <h1>QZ Tray Test</h1>
  <button onclick="connectQZ()">Conectar</button>
  <button onclick="printTest()">Imprimir test</button>
  <p><a href="/qz/info" target="_blank">Diagnóstico /qz/info</a></p>
</body>
</html>
