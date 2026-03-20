<?php
declare(strict_types=1);

return [
    'site_name' => 'Secret Doors România',
    'site_tagline' => 'Uși ascunse tip filomuro. De la desen la montaj.',
    'drive_open_url' => 'https://drive.google.com/open?id=17UcaB49WUnXUp4ePGBfZ3CWSxeanAM48&usp=drive_fs',
    'drive_cache_ttl' => 6 * 60 * 60, // 6 ore
    'contact_source_url' => 'https://www.secretdoors.ro/',
    'contact_cache_ttl' => 24 * 60 * 60, // 24 ore

    // Fallback-uri dacă scraping-ul eșuează
    'contact_fallback' => [
        'email' => 'sales@secretdoors.ro',
        'phone_raw' => '+40740992551',
        'address' => 'Intr. Calitatii 20, Cod 021199, Sectorul 2, Bucuresti',
    ],

    // Backend formular (mail + fallback la stocare)
    'mail_to' => 'sales@secretdoors.ro',
    'mail_from_fallback' => 'no-reply@secretdoors.ro',

    // Director local pentru cache și lead-uri
    'storage_dir' => __DIR__ . DIRECTORY_SEPARATOR . 'storage',
];

