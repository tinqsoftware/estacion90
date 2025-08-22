<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QzController extends Controller
{
    private function certPath(): string {
        return env('QZ_CERT_PATH', public_path('cert/estacion90-local-cert.pem'));
    }
    private function keyPath(): string {
        return env('QZ_PRIVATE_KEY_PATH', storage_path('qz/estacion90-local-key.pem'));
    }

    // Devuelve el certificado público como texto (PEM)
    public function certificate(Request $r) {
        $path = $this->certPath();
        abort_unless(is_readable($path), 500, "QZ certificate not readable: $path");
        return response(file_get_contents($path), 200)->header('Content-Type', 'text/plain');
    }

    // Firma RSA-SHA256 el string que QZ envía (toSign) y devuelve base64
    public function sign(Request $r) {
        $path = $this->keyPath();
        abort_unless(is_readable($path), 500, "QZ private key not readable: $path");

        // QZ envía texto plano en el body; no lo envuelvas en JSON
        $toSign = $r->getContent();
        if (!is_string($toSign) || $toSign === '') {
            return response('Invalid sign payload', 400)->header('Content-Type', 'text/plain');
        }

        $pkey = env('QZ_PRIVATE_KEY_PASSWORD')
            ? openssl_pkey_get_private(file_get_contents($path), env('QZ_PRIVATE_KEY_PASSWORD'))
            : openssl_pkey_get_private(file_get_contents($path));

        if (!$pkey) return response('Unable to load private key', 500)->header('Content-Type', 'text/plain');

        $sig = '';
        $algo = strtoupper(env('QZ_SIGN_ALGO', 'SHA256')) === 'SHA512' ? OPENSSL_ALGO_SHA512 : OPENSSL_ALGO_SHA256;
        $ok  = openssl_sign($toSign, $sig, $pkey, $algo);
        openssl_free_key($pkey);

        if (!$ok) return response('Failed to sign', 500)->header('Content-Type', 'text/plain');

        return response(base64_encode($sig), 200)->header('Content-Type', 'text/plain');
    }

    // Diagnóstico opcional
    public function info() {
        $cert = $this->certPath();
        $key  = $this->keyPath();
        $match = null;

        if (is_readable($cert) && is_readable($key)) {
            $x509 = @openssl_x509_read(file_get_contents($cert));
            $pub  = $x509 ? @openssl_pkey_get_public($x509) : null;
            $pubD = $pub ? @openssl_pkey_get_details($pub) : null;

            $priv = @openssl_pkey_get_private(file_get_contents($key), env('QZ_PRIVATE_KEY_PASSWORD'));
            $priD = $priv ? @openssl_pkey_get_details($priv) : null;

            if (($pubD['type'] ?? null) === OPENSSL_KEYTYPE_RSA && ($priD['type'] ?? null) === OPENSSL_KEYTYPE_RSA) {
                $match = hash('sha256', $pubD['rsa']['n']) === hash('sha256', $priD['rsa']['n']);
            }
        }

        return response()->json([
            'cert_exists' => is_readable($cert),
            'key_exists'  => is_readable($key),
            'match'       => $match,
            'cert_path'   => $cert,
            'key_path'    => $key,
        ]);
    }
}
