<?php
declare(strict_types=1);

// Media (imagini) provenite din Google Drive - mapăm "imageX.jpeg" -> URL direct.

require_once __DIR__ . '/../bootstrap.php';

function ensure_storage_dir_exists(): void
{
    global $config;
    $dir = $config['storage_dir'] ?? (__DIR__ . '/../storage');
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true);
    }
}

function get_drive_cache_path(): string
{
    return storage_path('drive_media_cache.json');
}

function drive_parse_filenames(string $html): array
{
    // Suportă atât imageX.jpeg, cât și IMG_XXXX.JPG / alte denumiri standard.
    preg_match_all('/([A-Za-z0-9_-]+\\.(?:jpeg|jpg|png|webp|gif))/i', $html, $m);
    $all = $m[1] ?? [];
    $seen = [];
    $names = [];

    foreach ($all as $filename) {
        $name = trim((string)$filename);
        if ($name === '') {
            continue;
        }

        // Păstrăm doar fișiere foto utile din folderul partajat.
        if (!preg_match('/^(image\\d+|IMG_\\d+|Image[A-Za-z0-9_-]*)\\.(?:jpeg|jpg|png|webp|gif)$/i', $name)) {
            continue;
        }

        $key = strtolower($name);
        if (isset($seen[$key])) {
            continue;
        }
        $seen[$key] = true;
        $names[] = $name;
    }

    usort($names, function (string $a, string $b) {
        $sa = drive_sort_key_for_filename($a);
        $sb = drive_sort_key_for_filename($b);
        return $sa <=> $sb;
    });

    return $names;
}

function drive_sort_key_for_filename(string $filename): int
{
    if (preg_match('/^image(\\d+)\\./i', $filename, $m)) {
        return (int)$m[1];
    }
    if (preg_match('/^IMG_(\\d+)\\./i', $filename, $m)) {
        return 100000 + (int)$m[1];
    }
    return 200000;
}

function drive_extract_id_near_filename(string $html, string $filename): ?string
{
    $pos = stripos($html, $filename);
    if ($pos === false) {
        return null;
    }

    $start = max(0, $pos - 2500);
    $end = min(strlen($html), $pos + 2500);
    $window = substr($html, $start, $end - $start);
    $localPos = (int)($pos - $start);

    $before = substr($window, 0, max(0, $localPos));
    $after = substr($window, max(0, $localPos));

    preg_match_all('/id=([a-zA-Z0-9_-]{10,})/', $before, $mBefore);
    if (!empty($mBefore[1])) {
        return (string)end($mBefore[1]);
    }

    preg_match_all('/id=([a-zA-Z0-9_-]{10,})/', $after, $mAfter);
    if (!empty($mAfter[1])) {
        return (string)$mAfter[1][0];
    }

    return null;
}

function get_drive_media_items(bool $forceRefresh = false): array
{
    global $config;
    $cacheVersion = 2;

    ensure_storage_dir_exists();
    $cachePath = get_drive_cache_path();
    $ttl = (int)($config['drive_cache_ttl'] ?? (6 * 60 * 60));

    if (!$forceRefresh && is_file($cachePath)) {
        $raw = @file_get_contents($cachePath);
        if (is_string($raw) && $raw !== '') {
            $cached = json_decode($raw, true);
            $cachedVersion = (int)($cached['version'] ?? 1);
            if (
                is_array($cached) &&
                $cachedVersion === $cacheVersion &&
                !empty($cached['fetched_at']) &&
                time() - (int)$cached['fetched_at'] < $ttl
            ) {
                return (array)($cached['items'] ?? []);
            }
        }
    }

    $url = (string)($config['drive_open_url'] ?? '');
    if ($url === '') {
        return [];
    }

    try {
        $html = http_get($url, 30);
    } catch (Throwable $e) {
        return [];
    }

    $filenames = drive_parse_filenames($html);
    $items = [];

    foreach ($filenames as $filename) {
        $id = drive_extract_id_near_filename($html, $filename);
        if (!$id) {
            continue;
        }

        $index = drive_sort_key_for_filename($filename);
        preg_match('/image(\\d+)/i', $filename, $mIndex);
        if (!empty($mIndex[1])) {
            $index = (int)$mIndex[1];
        }

        $items[] = [
            'index' => $index,
            'filename' => $filename,
            'id' => $id,
            'url' => 'https://drive.google.com/uc?export=view&id=' . $id,
        ];
    }

    usort($items, fn($a, $b) => ($a['index'] ?? 0) <=> ($b['index'] ?? 0));

    $payload = [
        'version' => $cacheVersion,
        'fetched_at' => time(),
        'items' => $items,
    ];
    @file_put_contents($cachePath, json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

    return $items;
}

function get_drive_media_image_urls(int $limit = 0, bool $forceRefresh = false): array
{
    $items = get_drive_media_items($forceRefresh);
    if ($limit > 0) {
        $items = array_slice($items, 0, $limit);
    }
    return array_map(fn($it) => $it['url'] ?? '', $items);
}

function get_drive_media_by_filename(string $filename, bool $forceRefresh = false): ?array
{
    $items = get_drive_media_items($forceRefresh);
    foreach ($items as $it) {
        if (($it['filename'] ?? '') === $filename) {
            return $it;
        }
    }
    return null;
}

