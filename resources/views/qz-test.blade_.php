<!DOCTYPE html>
<html>
<head>
    <title>Test QZ Tray - Estación 90</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- QZ Tray script - Verificando carga -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qz-tray/2.2.4/qz-tray.js" 
            integrity="sha512-T5k2OQpRhsT1uWgkC8oLemP6hCysEJ6vD2Ju6sS75+0/90P8IV3N0t8Tt4N+Kk9I+8zIMa+z6BCEq1X0r1y6Ow==" 
            crossorigin="anonymous" 
            referrerpolicy="no-referrer"
            onload="console.log('QZ Script cargado exitosamente')"
            onerror="console.error('Error cargando QZ script')"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .status { font-size: 18px; font-weight: bold; margin: 10px 0; }
        .success { color: green; }
        .error { color: red; }
        .warning { color: orange; }
        .info { color: blue; }
        button { margin: 5px; padding: 10px 15px; font-size: 14px; }
        .btn-alt { background: #ff6b35; color: white; border: none; border-radius: 4px; }
        #output { margin-top: 20px; padding: 15px; border: 1px solid #ccc; background: #f9f9f9; white-space: pre-wrap; max-height: 400px; overflow-y: auto; font-family: monospace; }
        .instructions { background: #e7f3ff; padding: 15px; margin: 10px 0; border-left: 4px solid #0066cc; }
    </style>
</head>
<body>
    <h1>🖨️ Test QZ Tray - Estación 90</h1>
    
    <div class="instructions">
        <strong>📋 INSTRUCCIONES:</strong><br>
        1. Asegúrate de que QZ Tray esté ejecutándose (ícono en bandeja)<br>
        2. Si ves "QZ Tray Demo Cert", necesitas confiar nuestro certificado<br>
        3. Para desarrollo: usa "Modo Inseguro" si hay problemas de certificado
    </div>
    
    <div id="status" class="status">Estado: Iniciando...</div>
    
    <div>
        <button onclick="testConnection()">1. 🔌 Conectar QZ</button>
        <button onclick="testCertificate()">2. 🔐 Probar Certificados</button>
        <button onclick="forceTrustCertificate()">🆕 Forzar Certificado</button>
        <button onclick="testInsecureMode()" class="btn-alt">🔓 Modo Inseguro (Dev)</button>
        <br>
        <button onclick="listPrinters()">3. 🖨️ Listar Impresoras</button>
        <button onclick="testPrint()">4. 📄 Imprimir Prueba</button>
        <button onclick="downloadQzScript()" class="btn-secondary">📥 Descargar QZ Script</button>
        <button onclick="clearOutput()">🗑️ Limpiar</button>
    </div>
    
    <div id="output"></div>

    <script>
        const output = document.getElementById('output');
        const statusEl = document.getElementById('status');
        
        function log(message, type = 'info') {
            const timestamp = new Date().toLocaleTimeString();
            const prefix = type === 'error' ? '❌' : type === 'success' ? '✅' : type === 'warning' ? '⚠️' : 'ℹ️';
            output.textContent += `${timestamp} ${prefix} ${message}\n`;
            output.scrollTop = output.scrollHeight;
            console.log(message);
        }
        
        function updateStatus(msg, type = 'info') {
            statusEl.textContent = 'Estado: ' + msg;
            statusEl.className = 'status ' + type;
        }
        
        function clearOutput() {
            output.textContent = '';
        }
        
        // Función para descargar QZ script localmente
        function downloadQzScript() {
            log('📥 Descargando QZ Tray script...', 'info');
            
            fetch('https://cdn.jsdelivr.net/npm/qz-tray@2.2.4/qz-tray.min.js')
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.text();
                })
                .then(script => {
                    const blob = new Blob([script], { type: 'application/javascript' });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'qz-tray.min.js';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url);
                    
                    log('✅ QZ script descargado. Colócalo en public/js/', 'success');
                    log('💡 Luego cambia el src del script a: /js/qz-tray.min.js', 'info');
                })
                .catch(error => {
                    log('❌ Error descargando script: ' + error.message, 'error');
                    log('💡 Descárgalo manualmente desde: https://github.com/qzind/qz-tray/releases', 'info');
                });
        }
        
        // Configurar QZ Security
        if (window.qz) {
            // Configurar certificado personalizado
            qz.security.setCertificatePromise(function() {
                log('🔐 Obteniendo certificado personalizado desde servidor...');
                return fetch('{{ route("qz.certificate") }}', { 
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'text/plain'
                    }
                })
                .then(resp => {
                    if (!resp.ok) throw new Error(`HTTP ${resp.status}: ${resp.statusText}`);
                    return resp.text();
                })
                .then(cert => {
                    log('✅ Certificado personalizado obtenido (estacion90-qz)', 'success');
                    return cert;
                })
                .catch(err => {
                    log('❌ Error obteniendo certificado: ' + err.message, 'error');
                    throw err;
                });
            });
            
            qz.security.setSignaturePromise(function(toSign) {
                log('✍️ Firmando request con clave privada...');
                return fetch('{{ route("qz.sign") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'text/plain'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ request: toSign })
                })
                .then(resp => {
                    if (!resp.ok) throw new Error(`HTTP ${resp.status}: ${resp.statusText}`);
                    return resp.text();
                })
                .then(signature => {
                    log('✅ Firma generada correctamente', 'success');
                    return signature;
                })
                .catch(err => {
                    log('❌ Error firmando: ' + err.message, 'error');
                    throw err;
                });
            });
            
            log('🔧 QZ Security configurado con certificado personalizado');
        } else {
            log('❌ QZ Tray script no cargado', 'error');
        }
        
        async function testConnection() {
            try {
                updateStatus('Conectando...', 'warning');
                log('🔌 Iniciando conexión a QZ Tray...');
                
                if (!window.qz) {
                    throw new Error('QZ Tray script no está cargado');
                }
                
                // Verificar si QZ está ejecutándose
                log('🔍 Verificando estado de QZ Tray...');
                
                if (qz.websocket.isActive()) {
                    log('✅ QZ ya estaba conectado', 'success');
                } else {
                    log('🔄 Intentando conectar a QZ Tray...');
                    await qz.websocket.connect();
                    log('✅ Conexión establecida exitosamente', 'success');
                }
                
                updateStatus(`Conectado ✅ (v${qz.version})`, 'success');
                log(`📊 QZ Tray versión: ${qz.version}`, 'success');
                log(`🌐 WebSocket activo: ${qz.websocket.isActive()}`, 'success');
                
                // Verificar configuración de seguridad
                log('🔐 Verificando configuración de seguridad...');
                if (qz.security.getCertificatePromise()) {
                    log('✅ Certificado Promise configurado', 'success');
                } else {
                    log('⚠️ Certificado Promise no configurado', 'warning');
                }
                
                if (qz.security.getSignaturePromise()) {
                    log('✅ Signature Promise configurado', 'success');
                } else {
                    log('⚠️ Signature Promise no configurado', 'warning');
                }
                
            } catch (error) {
                updateStatus('Error de conexión ❌', 'error');
                log(`❌ Error conectando: ${error.message}`, 'error');
                
                if (error.message.includes('WebSocket connection')) {
                    log('💡 Solución: Asegúrate de que QZ Tray esté ejecutándose', 'warning');
                    log('   - Busca el ícono de QZ en la bandeja del sistema', 'warning');
                    log('   - Si no está, ejecuta QZ Tray manualmente', 'warning');
                } else if (error.message.includes('certificate')) {
                    log('💡 Problema de certificado detectado', 'warning');
                    log('   - QZ puede estar en modo demo', 'warning');
                    log('   - Necesitas confiar nuestro certificado personalizado', 'warning');
                }
            }
        }
        
        async function testInsecureMode() {
            try {
                log('🔓 Iniciando modo inseguro (desarrollo)...');
                updateStatus('Modo inseguro...', 'warning');
                
                // Limpiar configuración de seguridad
                if (window.qz && qz.security) {
                    qz.security.setCertificatePromise(null);
                    qz.security.setSignaturePromise(null);
                    log('🧹 Configuración de seguridad limpiada');
                }
                
                // Conectar sin seguridad
                if (qz.websocket.isActive()) {
                    await qz.websocket.disconnect();
                    log('🔌 Desconectado para reiniciar sin seguridad');
                }
                
                await qz.websocket.connect();
                log('✅ Conectado en modo inseguro', 'success');
                updateStatus(`Conectado (Inseguro) ✅ v${qz.version}`, 'warning');
                
                // Probar funcionalidad básica
                const printers = await qz.printers.find();
                log(`🖨️ ${printers.length} impresoras encontradas en modo inseguro`, 'success');
                
                log('⚠️ NOTA: Este modo es solo para desarrollo', 'warning');
                log('⚠️ En producción debes usar certificados válidos', 'warning');
                
            } catch (error) {
                log(`❌ Error en modo inseguro: ${error.message}`, 'error');
                updateStatus('Error modo inseguro ❌', 'error');
            }
        }
        
        async function forceTrustCertificate() {
            try {
                log('🔄 Forzando uso de certificado personalizado...');
                
                if (!qz.websocket.isActive()) {
                    log('Conectando primero...');
                    await qz.websocket.connect();
                }
                
                // Obtener nuestro certificado
                const cert = await fetch('{{ route("qz.certificate") }}').then(r => r.text());
                log('📜 Certificado obtenido del servidor', 'success');
                
                // Forzar que QZ use nuestro certificado
                try {
                    await qz.security.setTrustedCertificate(cert);
                    log('✅ Certificado personalizado configurado en QZ', 'success');
                } catch (e) {
                    log('⚠️ setTrustedCertificate no disponible, usando Promise', 'warning');
                }
                
                // Reconfigurar security
                qz.security.setCertificatePromise(() => Promise.resolve(cert));
                log('🔐 Security reconfigurado con certificado personalizado', 'success');
                
                // Test de conexión segura
                const testResult = await qz.websocket.isSecure();
                log(`🔒 Conexión segura: ${testResult}`, testResult ? 'success' : 'warning');
                
            } catch (error) {
                log(`❌ Error configurando certificado: ${error.message}`, 'error');
                log('💡 Prueba: Clic derecho en QZ → Advanced → Trust Certificate', 'warning');
            }
        }
        
        async function testCertificate() {
            try {
                log('Probando endpoints de certificado...');
                
                // Probar certificado
                const certResp = await fetch('{{ route("qz.certificate") }}');
                if (!certResp.ok) throw new Error(`Certificado: HTTP ${certResp.status}`);
                const cert = await certResp.text();
                log(`Certificado obtenido (${cert.length} chars)`, 'success');
                
                // Probar firma
                const signResp = await fetch('{{ route("qz.sign") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ request: 'test-signature-' + Date.now() })
                });
                
                if (!signResp.ok) throw new Error(`Firma: HTTP ${signResp.status}`);
                const signature = await signResp.text();
                log(`Firma obtenida (${signature.length} chars)`, 'success');
                log('✅ Certificados funcionando correctamente', 'success');
                
            } catch (error) {
                log(`Error en certificados: ${error.message}`, 'error');
            }
        }
        
        async function listPrinters() {
            try {
                if (!qz.websocket.isActive()) {
                    log('Conectando primero...');
                    await qz.websocket.connect();
                }
                
                log('Buscando impresoras...');
                const printers = await qz.printers.find();
                const defaultPrinter = await qz.printers.getDefault();
                
                log(`Encontradas ${printers.length} impresoras:`, 'success');
                printers.forEach((printer, i) => {
                    const isDefault = printer === defaultPrinter ? ' 🌟 (por defecto)' : '';
                    log(`  ${i + 1}. ${printer}${isDefault}`);
                });
                
                if (!defaultPrinter) {
                    log('⚠️ No hay impresora por defecto configurada', 'warning');
                }
                
            } catch (error) {
                log(`Error listando impresoras: ${error.message}`, 'error');
            }
        }
        
        async function testPrint() {
            try {
                if (!qz.websocket.isActive()) {
                    log('Conectando primero...');
                    await qz.websocket.connect();
                }
                
                const printer = await qz.printers.getDefault();
                if (!printer) {
                    throw new Error('No hay impresora por defecto configurada');
                }
                
                log(`Enviando página de prueba a: ${printer}`);
                
                const config = qz.configs.create(printer, {
                    copies: 1
                });
                
                const testHtml = `
                    <div style="padding: 20px; font-family: Arial;">
                        <h2>🍴 Test Estación 90</h2>
                        <p><strong>Fecha:</strong> ${new Date().toLocaleString()}</p>
                        <p><strong>Impresora:</strong> ${printer}</p>
                        <p>Esta es una prueba de impresión desde QZ Tray.</p>
                        <hr>
                        <p style="text-align: center;">¡QZ Tray funcionando correctamente! ✅</p>
                    </div>
                `;
                
                const data = [{
                    type: 'html',
                    format: 'plain',
                    data: testHtml
                }];
                
                await qz.print(config, data);
                log('✅ Página de prueba enviada a la impresora', 'success');
                
            } catch (error) {
                log(`Error imprimiendo: ${error.message}`, 'error');
            }
        }
        
        // Auto-test al cargar
        window.addEventListener('load', () => {
            log('🚀 Página de prueba QZ Tray cargada');
            
            // Verificar carga del script QZ
            if (window.qz) {
                log('✅ QZ Tray script cargado correctamente', 'success');
                log('📊 QZ versión disponible: ' + (qz.version || 'desconocida'));
                
                setTimeout(() => {
                    log('🔄 Iniciando auto-test...');
                    testConnection();
                }, 1000);
            } else {
                log('❌ QZ Tray script NO se cargó', 'error');
                log('🔄 Intentando cargar script alternativo...', 'warning');
                loadAlternativeQzScript();
            }
        });
        
        // Función para cargar script QZ alternativo
        function loadAlternativeQzScript() {
            const cdns = [
                'https://cdn.jsdelivr.net/npm/qz-tray@2.2.4/qz-tray.min.js',
                'https://unpkg.com/qz-tray@2.2.4/qz-tray.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/qz-tray/2.2.4/qz-tray.min.js'
            ];
            
            let currentCdn = 0;
            
            function tryNextCdn() {
                if (currentCdn >= cdns.length) {
                    log('❌ Todos los CDNs fallaron', 'error');
                    log('💡 Soluciones posibles:', 'info');
                    log('  1. Verificar conexión a internet', 'info');
                    log('  2. Descargar qz-tray.js manualmente', 'info');
                    log('  3. Usar versión local del script', 'info');
                    return;
                }
                
                const cdnUrl = cdns[currentCdn];
                log(`🔄 Probando CDN ${currentCdn + 1}/${cdns.length}: ${cdnUrl}`, 'warning');
                
                const script = document.createElement('script');
                script.src = cdnUrl;
                script.onload = function() {
                    log(`✅ QZ Script cargado desde CDN ${currentCdn + 1}`, 'success');
                    if (window.qz) {
                        log('✅ QZ Tray ahora disponible', 'success');
                        setTimeout(testConnection, 500);
                    }
                };
                script.onerror = function() {
                    log(`❌ CDN ${currentCdn + 1} falló`, 'error');
                    currentCdn++;
                    setTimeout(tryNextCdn, 500);
                };
                document.head.appendChild(script);
            }
            
            tryNextCdn();
        }
    </script>
</body>
</html>
