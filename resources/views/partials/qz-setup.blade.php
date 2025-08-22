<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/qz-tray@2.2.4/qz-tray.js"></script>
<script>
  if (qz.security && typeof qz.security.setSignatureAlgorithm === 'function') {
    qz.security.setSignatureAlgorithm('SHA256');
  }
  qz.security.setCertificatePromise(function(resolve, reject){
    fetch('/qz/certificate', { cache:'no-store' })
      .then(r => r.ok ? r.text() : Promise.reject('HTTP '+r.status))
      .then(pem => pem && pem.trim().startsWith('-----BEGIN CERTIFICATE-----') ? resolve(pem) : reject('Invalid PEM'))
      .catch(err => reject('Cert error: '+err));
  });
  qz.security.setSignaturePromise(function(toSign){
    return function(resolve, reject){
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
      .catch(err => reject('Sign error: '+err));
    };
  });

  async function qzEnsureConnected(){
    if (!qz.websocket.isActive()) { await qz.websocket.connect(); }
  }
</script>
