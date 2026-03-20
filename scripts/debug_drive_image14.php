<?php
declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

try {
    $html = http_get($config['drive_open_url'], 40);
} catch (Throwable $e) {
    echo "fetch_failed: " . $e->getMessage() . PHP_EOL;
    exit(1);
}

$needle = 'image14.jpeg';
$pos = stripos($html, $needle);

echo "pos=" . ($pos === false ? 'false' : (string)$pos) . PHP_EOL;
if ($pos === false) {
    exit;
}

$start = max(0, $pos - 2500);
$end = min(strlen($html), $pos + 2500);
$window = substr($html, $start, $end - $start);

preg_match_all('/id=([a-zA-Z0-9_-]{10,})/', $window, $m1);
$ids1 = array_values(array_unique($m1[1] ?? []));
echo "ids(id=...)= " . count($ids1) . PHP_EOL;
if (!empty($ids1)) {
    echo implode(',', array_slice($ids1, 0, 25)) . PHP_EOL;
}

preg_match_all('/data-id=([\"\\\']?)([a-zA-Z0-9_-]{10,})\\1/i', $window, $m2);
$ids2 = array_values(array_unique($m2[2] ?? []));
echo "ids(data-id)= " . count($ids2) . PHP_EOL;
if (!empty($ids2)) {
    echo implode(',', array_slice($ids2, 0, 25)) . PHP_EOL;
}

// Try common patterns used by drive URLs.
preg_match_all('/drive\\.google\\.com\\/uc\\?export=view&id=([a-zA-Z0-9_-]{10,})/', $window, $m3);
$ids3 = array_values(array_unique($m3[1] ?? []));
echo "ids(uc export)= " . count($ids3) . PHP_EOL;
if (!empty($ids3)) {
    echo implode(',', array_slice($ids3, 0, 25)) . PHP_EOL;
}

