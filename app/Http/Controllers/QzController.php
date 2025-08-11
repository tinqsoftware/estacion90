<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QzController extends Controller
{
    /**
     * Return the QZ certificate public content.
     */
    public function certificate()
    {
        $certPath = env('QZ_CERT_PATH') ?: storage_path('app/qz/public-cert.pem');

        if (!file_exists($certPath)) {
            return response('QZ certificate not found. Place it at ' . $certPath . ' or set QZ_CERT_PATH.', 500)
                ->header('Content-Type', 'text/plain');
        }

        $contents = file_get_contents($certPath);
        return response($contents, 200)->header('Content-Type', 'text/plain');
    }

    /**
     * Sign the provided payload using the private key for QZ.
     */
    public function sign(Request $request)
    {
        $keyPath = env('QZ_PRIVATE_KEY_PATH') ?: storage_path('app/qz/private-key.pem');
        $keyPass = env('QZ_PRIVATE_KEY_PASSWORD'); // optional

        if (!file_exists($keyPath)) {
            return response('QZ private key not found. Place it at ' . $keyPath . ' or set QZ_PRIVATE_KEY_PATH.', 500)
                ->header('Content-Type', 'text/plain');
        }

        $privateKeyContent = file_get_contents($keyPath);
        if ($keyPass) {
            $privateKey = openssl_pkey_get_private($privateKeyContent, $keyPass);
        } else {
            $privateKey = openssl_pkey_get_private($privateKeyContent);
        }

        if (!$privateKey) {
            return response('Unable to load QZ private key. Check password/path.', 500)
                ->header('Content-Type', 'text/plain');
        }

        // QZ will send the string to sign; accept common field names or raw body
        $payload = $request->input('request')
            ?? $request->input('toSign')
            ?? $request->getContent();

        if (!is_string($payload) || $payload === '') {
            return response('Invalid sign payload', 400)->header('Content-Type', 'text/plain');
        }

        $signature = '';
        $ok = openssl_sign($payload, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        openssl_free_key($privateKey);

        if (!$ok) {
            return response('Failed to sign payload', 500)->header('Content-Type', 'text/plain');
        }

        return response(base64_encode($signature), 200)->header('Content-Type', 'text/plain');
    }
}
