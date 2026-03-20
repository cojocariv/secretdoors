<?php
declare(strict_types=1);

require_once __DIR__ . '/../components/media.php';

$it = get_drive_media_by_filename('image14.jpeg', true);

echo "found=" . ((is_array($it) && !empty($it['url'])) ? '1' : '0') . PHP_EOL;
if (is_array($it)) {
    echo "filename=" . ($it['filename'] ?? '') . PHP_EOL;
    echo "id=" . ($it['id'] ?? '') . PHP_EOL;
    echo "url=" . ($it['url'] ?? '') . PHP_EOL;
}

