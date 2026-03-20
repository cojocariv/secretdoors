<?php
declare(strict_types=1);

// $page_view: path către fișierul de conținut
// $seo: array cu title/description

require_once __DIR__ . '/contact-data.php';

$seo = $seo ?? [];
$page_view = $page_view ?? '';

$contact = get_contact_data();
$whatsapp_url = $contact['whatsapp_url'] ?? '';

$assetVer = time();
$cssFile = __DIR__ . '/../assets/styles.css';
if (is_file($cssFile)) {
    $mtime = @filemtime($cssFile);
    if (is_int($mtime) && $mtime > 0) {
        $assetVer = $mtime;
    }
}
?>

<?php
require __DIR__ . '/head.php';
require __DIR__ . '/navbar.php';
?>

<a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 z-[60] bg-black text-white px-4 py-2 rounded-xl">
  Mergi la conținut
</a>

<main id="content">
  <?php if ($page_view && is_file($page_view)) {
      include $page_view;
  } else { ?>
    <section class="max-w-7xl mx-auto px-4 py-16">
      <h1 class="text-2xl font-semibold">Pagină indisponibilă</h1>
    </section>
  <?php } ?>
</main>

<?php require __DIR__ . '/footer.php'; ?>

<?php if ($whatsapp_url !== ''): ?>
  <a
    href="<?= h($whatsapp_url) ?>"
    target="_blank"
    rel="noopener"
    class="fixed right-4 bottom-4 z-[60] w-14 h-14 rounded-2xl bg-black text-white grid place-items-center shadow-soft hover:bg-black/90 transition-colors"
    aria-label="WhatsApp"
    title="WhatsApp"
  >
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <path d="M20.52 3.48A11.86 11.86 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.1.55 4.14 1.6 5.95L0 24l6.27-1.57A12.01 12.01 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.18-1.26-6.25-3.48-8.52Zm-8.52 18.02c-1.77 0-3.46-.5-4.92-1.44l-.35-.22-3.12.78.84-3.03-.23-.37A9.3 9.3 0 0 1 2.99 12c0-5 4.01-9.01 9-9.01 2.42 0 4.7.94 6.4 2.64 1.7 1.7 2.64 3.98 2.64 6.4 0 4.99-4.01 9-9 9Z" fill="currentColor"/>
      <path d="M17.76 14.7c-.2-.1-1.18-.58-1.36-.65-.18-.07-.31-.1-.44.1-.13.2-.5.65-.61.78-.11.13-.22.15-.42.05-.2-.1-.86-.32-1.64-1.01-.6-.54-1.01-1.2-1.13-1.4-.12-.2-.01-.31.09-.41.09-.09.2-.22.3-.33.1-.11.13-.2.2-.33.07-.13.03-.24-.02-.34-.05-.1-.44-1.05-.6-1.43-.16-.39-.32-.33-.44-.33h-.38c-.13 0-.33.05-.5.24-.17.2-.65.63-.65 1.52 0 .9.67 1.77.76 1.9.1.13 1.3 2 3.16 2.8.44.19.79.3 1.06.38.45.14.86.12 1.19.07.36-.05 1.18-.48 1.35-.94.17-.46.17-.86.12-.94-.05-.08-.18-.13-.38-.23Z" fill="currentColor"/>
    </svg>
  </a>
<?php endif; ?>

<script src="assets/app.js?v=<?= h((string)$assetVer) ?>" defer></script>
</body>
</html>

