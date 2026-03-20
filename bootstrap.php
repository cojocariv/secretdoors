<?php
declare(strict_types=1);

// Bootstrap comun pentru paginile site-ului (PHP).

session_start();

date_default_timezone_set('Europe/Bucharest');

$config = require __DIR__ . '/config.php';

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function storage_path(string $relative): string
{
    global $config;
    $base = $config['storage_dir'] ?? (__DIR__ . DIRECTORY_SEPARATOR . 'storage');
    return rtrim($base, "\\/") . DIRECTORY_SEPARATOR . ltrim($relative, "\\/");
}

function http_get(string $url, int $timeoutSeconds = 15): string
{
    // Prefer file_get_contents (simplu). Dacă nu e permis, folosim cURL.
    $ctx = stream_context_create([
        'http' => [
            'timeout' => $timeoutSeconds,
            'header' => "User-Agent: Mozilla/5.0\r\n",
        ],
    ]);

    $html = @file_get_contents($url, false, $ctx);
    if ($html !== false) {
        return (string)$html;
    }

    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $timeoutSeconds,
            CURLOPT_CONNECTTIMEOUT => $timeoutSeconds,
            CURLOPT_HTTPHEADER => ['User-Agent: Mozilla/5.0'],
            CURLOPT_FOLLOWLOCATION => true,
        ]);
        $html = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($html !== false && $code >= 200 && $code < 400) {
            return (string)$html;
        }
    }

    throw new RuntimeException("Nu pot accesa URL: {$url}");
}

