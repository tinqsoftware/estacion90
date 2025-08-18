<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QzController extends Controller
{
    /**
     * Return the QZ certificate public content.
     */
    public function certificate(Request $request)
    {
        $certPath = env('QZ_CERT_PATH') ?: storage_path('app/qz/public-cert.pem');

        if (!file_exists($certPath) || !is_readable($certPath)) {
            Log::error('[QZ] Certificate missing/unreadable', [
                'path' => $certPath,
                'exists' => file_exists($certPath),
                'readable' => is_readable($certPath),
            ]);
            return response('QZ certificate not found or unreadable at ' . $certPath . '. Set QZ_CERT_PATH or place the PEM file there.', 500)
                ->header('Content-Type', 'text/plain');
        }

        $contents = file_get_contents($certPath);
        if ($request->boolean('download')) {
            return response($contents, 200)
                ->header('Content-Type', 'application/x-pem-file')
                ->header('Content-Disposition', 'attachment; filename="public-cert.pem"');
        }
        return response($contents, 200)->header('Content-Type', 'text/plain');
    }

    /**
     * Sign the provided payload using the private key for QZ.
     */
    public function sign(Request $request)
    {
        $keyPath = env('QZ_PRIVATE_KEY_PATH') ?: storage_path('app/qz/private-key.pem');
        $keyPass = env('QZ_PRIVATE_KEY_PASSWORD'); // optional
        $algoHeader = $request->header('X-QZ-ALGO');
        $algoEnv = env('QZ_SIGN_ALGO', 'SHA256');
        $algoName = strtoupper($algoHeader ?: $algoEnv);
        // Map algorithm name to OpenSSL constant
        $algoConst = match ($algoName) {
            'SHA512', 'SHA-512' => defined('OPENSSL_ALGO_SHA512') ? OPENSSL_ALGO_SHA512 : OPENSSL_ALGO_SHA256,
            default => OPENSSL_ALGO_SHA256,
        };

        if (!file_exists($keyPath) || !is_readable($keyPath)) {
            Log::error('[QZ] Private key missing/unreadable', [
                'path' => $keyPath,
                'exists' => file_exists($keyPath),
                'readable' => is_readable($keyPath),
            ]);
            return response('QZ private key not found or unreadable at ' . $keyPath . '. Set QZ_PRIVATE_KEY_PATH.', 500)
                ->header('Content-Type', 'text/plain');
        }

        $privateKeyContent = file_get_contents($keyPath);
        $privateKey = $keyPass
            ? openssl_pkey_get_private($privateKeyContent, $keyPass)
            : openssl_pkey_get_private($privateKeyContent);

        if (!$privateKey) {
            $err = function_exists('openssl_error_string') ? openssl_error_string() : null;
            Log::error('[QZ] Unable to load private key', [ 'path' => $keyPath, 'openssl_error' => $err ]);
            return response('Unable to load QZ private key. Check password/path.', 500)
                ->header('Content-Type', 'text/plain');
        }

        // QZ will send the string to sign; accept common field names or raw body
        $payload = $request->input('request')
            ?? $request->input('toSign')
            ?? $request->getContent();

        if (!is_string($payload) || $payload === '') {
            Log::warning('[QZ] Sign called with invalid payload');
            return response('Invalid sign payload', 400)->header('Content-Type', 'text/plain');
        }

        $signature = '';
        $ok = openssl_sign($payload, $signature, $privateKey, $algoConst);
        openssl_free_key($privateKey);

        if (!$ok) {
            $err = function_exists('openssl_error_string') ? openssl_error_string() : null;
            Log::error('[QZ] Failed to sign payload', [ 'payload_prefix' => substr($payload, 0, 64), 'algo' => $algoName, 'openssl_error' => $err ]);
            return response('Failed to sign payload', 500)->header('Content-Type', 'text/plain');
        }

        return response(base64_encode($signature), 200)->header('Content-Type', 'text/plain');
    }
}
