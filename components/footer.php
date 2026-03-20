<?php
declare(strict_types=1);
?>

<footer class="border-t border-black/5 bg-white">
  <div class="max-w-7xl mx-auto px-4 py-14">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      <div>
        <div class="flex items-center gap-3">
          <span class="w-10 h-10 rounded-xl bg-black overflow-hidden grid place-items-center">
            <img src="assets/logo.png?v=<?= h((string)($assetVer ?? time())) ?>" alt="Secret Doors" class="w-full h-full object-cover" loading="lazy" />
          </span>
          <div>
            <p class="font-semibold text-lg leading-tight"><?= h($config['site_name'] ?? 'Secret Doors') ?></p>
            <p class="text-sm text-black/60">Uși ascunse tip filomuro</p>
          </div>
        </div>
        <p class="mt-4 text-sm text-black/60 max-w-sm">
          Soluții premium pentru integrare elegantă în perete. De la desen la montaj.
        </p>
      </div>

      <div class="text-sm">
        <p class="font-semibold mb-3">Shop</p>
        <div class="space-y-2 text-black/70">
          <a class="block hover:text-black transition-colors" href="produse.php">Produse</a>
          <a class="block hover:text-black transition-colors" href="galerie.php">Galerie</a>
          <a class="block hover:text-black transition-colors" href="produse.php">Colecții</a>
        </div>
      </div>

      <div class="text-sm">
        <p class="font-semibold mb-3">Informații</p>
        <div class="space-y-2 text-black/70">
          <a class="block hover:text-black transition-colors" href="contact.php">Politica de Confidențialitate</a>
          <a class="block hover:text-black transition-colors" href="contact.php">Politica de utilizare Cookie-uri</a>
          <a class="block hover:text-black transition-colors" href="contact.php">Termeni și condiții</a>
        </div>
      </div>

      <div class="text-sm">
        <p class="font-semibold mb-3">About</p>
        <div class="space-y-2 text-black/70">
          <a class="block hover:text-black transition-colors" href="despre.php">Despre noi</a>
          <a class="block hover:text-black transition-colors" href="contact.php">Contact</a>
          <span class="block pt-1 text-black/50">Răspundem rapid la solicitări.</span>
        </div>
      </div>
    </div>

    <div class="mt-10 pt-10 border-t border-black/5 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
      <div class="text-sm text-black/70 max-w-xl">
        Pentru o ofertă personalizată, trimite-ne un mesaj. Îți propunem pași clari pentru integrare.
      </div>
      <a href="contact.php" class="inline-flex items-center justify-center rounded-xl px-5 py-2 border border-black/10 bg-black text-white text-sm font-medium hover:bg-black/90 transition-colors w-full md:w-auto shadow-soft">
        Solicita ofertă
      </a>
    </div>

    <div class="mt-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-3">
      <p class="text-xs text-black/50">© <?= date('Y') ?> <?= h($config['site_name'] ?? 'Secret Doors') ?>. Toate drepturile rezervate.</p>
      <p class="text-xs text-black/50">Design minimalist, orientat pe produs</p>
    </div>
  </div>
</footer>

