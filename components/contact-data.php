<?php
declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

function get_contact_cache_path(): string
{
    return storage_path('contact_cache.json');
}

function normalize_phone(string $phoneRaw): string
{
    // Eliminăm caracterele non-numerice, păstrăm + dacă există.
    $phoneRaw = trim($phoneRaw);
    $digits = preg_replace('/\\D+/', '', $phoneRaw) ?? '';
    if ($digits === '') {
        return '';
    }
    if (substr($digits, 0, 2) === '40') {
        return '+'.$digits;
    }
    if (isset($digits[0]) && $digits[0] === '0') {
        return '+40'.ltrim($digits, '0');
    }
    if ($phoneRaw[0] === '+') {
        return '+'.$digits;
    }
    return '+'.$digits;
}

function phone_to_whatsapp(string $phoneE164): string
{
    $digits = preg_replace('/\\D+/', '', $phoneE164) ?? '';
    return 'https://wa.me/' . $digits;
}

function get_contact_data(bool $forceRefresh = false): array
{
    global $config;

    $cachePath = get_contact_cache_path();
    $ttl = (int)($config['contact_cache_ttl'] ?? (24 * 60 * 60));

    if (!$forceRefresh && is_file($cachePath)) {
        $raw = @file_get_contents($cachePath);
        $cached = $raw ? json_decode($raw, true) : null;
        if (is_array($cached) && !empty($cached['fetched_at']) && time() - (int)$cached['fetched_at'] < $ttl) {
            return (array)($cached['data'] ?? []);
        }
    }

    $sourceUrl = (string)($config['contact_source_url'] ?? 'https://www.secretdoors.ro/');

    $email = '';
    $phone = '';
    $address = '';

    try {
        $html = http_get($sourceUrl, 20);

        if (preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\\.[A-Z]{2,}/i', $html, $mEmail)) {
            $email = (string)$mEmail[0];
        }

        // Caut un telefon cu +40 sau 40.
        if (preg_match('/\\+?40\\s?\\d[\\d\\s]{8,12}/', $html, $mPhone)) {
            $phone = normalize_phone((string)$mPhone[0]);
        }

        // Address: fallback heuristic based on "Bucure" text from pagina.
        $text = html_entity_decode(strip_tags($html));
        $pos = stripos($text, 'Bucure');
        if ($pos !== false) {
            $chunk = substr($text, max(0, $pos - 80), 220);
            // Curățăm liniile foarte lungi.
            $chunk = trim(preg_replace('/\\s+/', ' ', $chunk) ?? '');
            // Reduce false positives.
            if (stripos($chunk, 'Intr.') !== false || stripos($chunk, 'Str.') !== false || strlen($chunk) > 18) {
                $address = $chunk;
            }
        }
    } catch (Throwable $e) {
        // Ignorăm, folosim fallback.
    }

    // Fallback dacă scraping-ul nu a reușit.
    $fallback = (array)($config['contact_fallback'] ?? []);
    if ($email === '') {
        $email = (string)($fallback['email'] ?? '');
    }
    if ($phone === '') {
        $phone = (string)($fallback['phone_raw'] ?? '');
        $phone = normalize_phone($phone);
    }
    if ($address === '') {
        $address = (string)($fallback['address'] ?? '');
    }

    $data = [
        'email' => $email,
        'phone_e164' => $phone,
        'address' => $address,
        'whatsapp_url' => phone_to_whatsapp($phone),
    ];

    @mkdir(dirname($cachePath), 0775, true);
    @file_put_contents($cachePath, json_encode(['fetched_at' => time(), 'data' => $data], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

    return $data;
}

function maps_embed_url(string $address): string
{
    $q = urlencode($address);
    return 'https://www.google.com/maps?q=' . $q . '&output=embed';
}

