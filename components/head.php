<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="ro">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="assets/logo.png?v=<?= h((string)($assetVer ?? time())) ?>" type="image/png" sizes="32x32" />
  <link rel="apple-touch-icon" href="assets/logo.png?v=<?= h((string)($assetVer ?? time())) ?>" />
  <?php if (!empty($seo['title'])): ?>
    <title><?= h($seo['title']) ?></title>
  <?php else: ?>
    <title><?= h($config['site_name'] ?? 'Secret Doors') ?></title>
  <?php endif; ?>
  <?php if (!empty($seo['description'])): ?>
    <meta name="description" content="<?= h($seo['description']) ?>" />
  <?php endif; ?>

  <meta property="og:type" content="website" />
  <?php if (!empty($seo['title'])): ?>
    <meta property="og:title" content="<?= h($seo['title']) ?>" />
  <?php endif; ?>
  <?php if (!empty($seo['description'])): ?>
    <meta property="og:description" content="<?= h($seo['description']) ?>" />
  <?php endif; ?>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            // Use Poppins as primary to match the visual language.
            sans: ['Poppins', 'Inter', 'ui-sans-serif', 'system-ui']
          },
          boxShadow: {
            // Keep in sync with `.shadow-soft` from `assets/styles.css`.
            soft: '0 14px 34px rgba(0,0,0,0.12)',
          },
        }
      }
    }
  </script>

  <link rel="stylesheet" href="assets/styles.css?v=<?= h((string)($assetVer ?? time())) ?>" />
</head>
<body class="bg-white text-black antialiased selection:bg-black selection:text-white">

