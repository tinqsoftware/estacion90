# Script para generar certificados QZ multi-dominio para desarrollo y produccion
param(
    [string]$OutputDir = "storage\app\qz",
    [string]$DevDomain = "estacion90.test",
    [string]$ProdDomain = "estacion90.pe",
    [string]$Organization = "Estacion90",
    [string]$Country = "PE",
    [int]$ValidDays = 365
)

Write-Host "Generando certificados QZ multi-dominio..." -ForegroundColor Green
Write-Host "Dominios incluidos: $DevDomain, $ProdDomain, localhost" -ForegroundColor Cyan

# Crear directorio si no existe
if (!(Test-Path $OutputDir)) {
    New-Item -ItemType Directory -Path $OutputDir -Force
    Write-Host "Directorio creado: $OutputDir" -ForegroundColor Yellow
}

# Buscar OpenSSL (priorizar Git for Windows)
$opensslPaths = @(
    "C:\Program Files\Git\usr\bin\openssl.exe",
    "C:\Program Files\Git\mingw64\bin\openssl.exe",
    "C:\laragon\bin\apache\httpd-2.4.62\bin\openssl.exe",
    "C:\laragon\bin\openssl\openssl.exe"
)

$opensslPath = $null
foreach ($path in $opensslPaths) {
    if (Test-Path $path) {
        $opensslPath = $path
        Write-Host "OpenSSL encontrado: $path" -ForegroundColor Green
        break
    }
}

if (-not $opensslPath) {
    Write-Host "OpenSSL no encontrado. Instala Git for Windows desde: https://git-scm.com/download/win" -ForegroundColor Red
    exit 1
}

try {
    # Archivos de salida
    $privateKeyFile = Join-Path $OutputDir "private-key.pem"
    $publicCertFile = Join-Path $OutputDir "public-cert.pem"
    $configFile = Join-Path $OutputDir "multi-domain.conf"
    
    # Crear archivo de configuracion OpenSSL para multiples dominios
    $configContent = @"
[req]
distinguished_name = req_distinguished_name
req_extensions = v3_req
prompt = no

[req_distinguished_name]
C = $Country
O = $Organization
CN = $DevDomain

[v3_req]
basicConstraints = CA:FALSE
keyUsage = nonRepudiation, digitalSignature, keyEncipherment
subjectAltName = @alt_names

[alt_names]
DNS.1 = $DevDomain
DNS.2 = $ProdDomain
DNS.3 = localhost
DNS.4 = 127.0.0.1
IP.1 = 127.0.0.1
IP.2 = ::1
"@
    
    Write-Host "Creando configuracion multi-dominio..." -ForegroundColor Cyan
    Set-Content -Path $configFile -Value $configContent -Encoding UTF8
    
    Write-Host "Generando clave privada RSA 2048 bits..." -ForegroundColor Cyan
    
    # Generar clave privada RSA (formato tradicional para compatibilidad)
    & $opensslPath "genrsa" "-out" $privateKeyFile "2048"
    if ($LASTEXITCODE -ne 0) {
        throw "Error generando clave privada RSA"
    }
    
    Write-Host "Generando certificado autofirmado multi-dominio..." -ForegroundColor Cyan
    
    # Generar certificado autofirmado con multiples dominios
    & $opensslPath "req" "-new" "-x509" "-key" $privateKeyFile "-out" $publicCertFile "-days" $ValidDays.ToString() "-config" $configFile "-extensions" "v3_req"
    if ($LASTEXITCODE -ne 0) {
        throw "Error generando certificado autofirmado"
    }
    
    # Limpiar archivo de configuracion temporal
    Remove-Item $configFile -ErrorAction SilentlyContinue
    
    Write-Host ""
    Write-Host "Certificados multi-dominio generados exitosamente:" -ForegroundColor Green
    Write-Host "  Clave privada: $privateKeyFile" -ForegroundColor White
    Write-Host "  Certificado publico: $publicCertFile" -ForegroundColor White
    
    # Verificaciones de integridad
    Write-Host ""
    Write-Host "Verificando integridad de los certificados..." -ForegroundColor Cyan
    
    # Verificar clave privada
    $keyCheck = & $opensslPath "rsa" "-in" $privateKeyFile "-check" "-noout" 2>&1
    if ($LASTEXITCODE -eq 0) {
        Write-Host "Clave privada valida y consistente" -ForegroundColor Green
    } else {
        Write-Host "Problema con clave privada: $keyCheck" -ForegroundColor Red
    }
    
    # Verificar certificado y mostrar informacion
    Write-Host ""
    Write-Host "Informacion del certificado:" -ForegroundColor Cyan
    $certInfo = & $opensslPath "x509" "-in" $publicCertFile "-text" "-noout"
    
    # Extraer informacion especifica
    $subject = $certInfo | Select-String "Subject:" | ForEach-Object { $_.Line.Trim() }
    $validity = $certInfo | Select-String "Not Before|Not After" | ForEach-Object { $_.Line.Trim() }
    $sanInfo = $certInfo | Select-String "DNS:" | ForEach-Object { $_.Line.Trim() }
    
    Write-Host "  $subject" -ForegroundColor White
    $validity | ForEach-Object { Write-Host "  $_" -ForegroundColor White }
    if ($sanInfo) {
        Write-Host "  Dominios incluidos:" -ForegroundColor Yellow
        $sanInfo | ForEach-Object { Write-Host "    $_" -ForegroundColor White }
    }
    
    # Verificar que la clave privada corresponde al certificado
    Write-Host ""
    Write-Host "Verificando correspondencia certificado-clave..." -ForegroundColor Cyan
    
    $certMod = & $opensslPath "x509" "-noout" "-modulus" "-in" $publicCertFile 2>&1
    $keyMod = & $opensslPath "rsa" "-noout" "-modulus" "-in" $privateKeyFile 2>&1
    
    if ($certMod -eq $keyMod) {
        Write-Host "Certificado y clave privada coinciden perfectamente" -ForegroundColor Green
    } else {
        Write-Host "ADVERTENCIA: Certificado y clave privada no coinciden" -ForegroundColor Red
    }
    
    # Generar fingerprint SHA256
    $fingerprint = & $opensslPath "x509" "-noout" "-fingerprint" "-sha256" "-in" $publicCertFile | ForEach-Object { $_.Replace("SHA256 Fingerprint=", "").Trim() }
    Write-Host "Fingerprint SHA256: $fingerprint" -ForegroundColor Yellow
    
    Write-Host ""
    Write-Host "Certificados listos para usar:" -ForegroundColor Green
    Write-Host "  Desarrollo: http://$DevDomain" -ForegroundColor Cyan
    Write-Host "  Produccion: https://$ProdDomain" -ForegroundColor Cyan
    Write-Host "  Local: http://localhost" -ForegroundColor Cyan
    
    Write-Host ""
    Write-Host "Proximos pasos:" -ForegroundColor Yellow
    Write-Host "  1. Descarga: http://$DevDomain/qz/certificate?download=1" -ForegroundColor White
    Write-Host "  2. Instala en QZ Tray: Advanced -> Trusted Sites -> Add Certificate" -ForegroundColor White
    Write-Host "  3. Reinicia QZ Tray completamente" -ForegroundColor White
    Write-Host "  4. Prueba desde: http://$DevDomain/qz-test" -ForegroundColor White
    Write-Host ""
    Write-Host "El certificado funcionara tanto en desarrollo ($DevDomain) como en produccion ($ProdDomain)" -ForegroundColor Green
    
} catch {
    Write-Host "Error: $_" -ForegroundColor Red
    Write-Host "Verifica que OpenSSL este instalado y funcionando correctamente" -ForegroundColor Yellow
    exit 1
}
