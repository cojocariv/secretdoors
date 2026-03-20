<?php
declare(strict_types=1);
?>

<header class="sticky top-0 z-50 backdrop-blur bg-white/70 border-b border-black/5">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-center justify-between py-3">
      <a href="index.php" class="group inline-flex items-center gap-3">
        <span class="w-9 h-9 rounded-xl bg-black overflow-hidden grid place-items-center group-hover:rotate-[-6deg] transition-transform">
          <img src="assets/logo.png?v=<?= h((string)($assetVer ?? time())) ?>" alt="Secret Doors" class="w-full h-full object-cover" loading="eager" />
        </span>
        <span class="font-semibold text-base sm:text-lg tracking-tight">
          Secret Doors
        </span>
      </a>

      <nav class="hidden md:flex items-center gap-7 text-sm">
        <a href="produse.php" class="hover:text-black/70 transition-colors">Produse</a>
        <a href="despre.php" class="hover:text-black/70 transition-colors">Despre noi</a>
        <a href="galerie.php" class="hover:text-black/70 transition-colors">Galerie</a>
        <a href="contact.php" class="hover:text-black/70 transition-colors">Contact</a>
      </nav>

      <div class="hidden md:flex items-center gap-3">
        <a href="contact.php" class="inline-flex items-center justify-center rounded-full px-5 py-2 border border-black/10 bg-black text-white text-sm font-medium hover:bg-black/90 transition-colors shadow-soft">
          Solicita oferta
        </a>
      </div>

      <button
        class="md:hidden inline-flex items-center justify-center w-11 h-11 rounded-xl border border-black/10 hover:border-black/20 transition-colors"
        data-mobile-nav-button
        aria-label="Deschide meniu"
        type="button"
      >
        <span class="block w-5 h-[2px] bg-black relative">
          <span class="absolute left-0 top-[-6px] w-5 h-[2px] bg-black" data-mobile-nav-line-1></span>
          <span class="absolute left-0 top-[6px] w-5 h-[2px] bg-black" data-mobile-nav-line-2></span>
        </span>
      </button>
    </div>
  </div>

  <div class="md:hidden hidden border-t border-black/5" data-mobile-nav-panel>
    <div class="max-w-7xl mx-auto px-4 py-3 space-y-2 text-sm">
      <a href="produse.php" class="block py-2 hover:bg-black/5 rounded-xl transition-colors">Produse</a>
      <a href="despre.php" class="block py-2 hover:bg-black/5 rounded-xl transition-colors">Despre noi</a>
      <a href="galerie.php" class="block py-2 hover:bg-black/5 rounded-xl transition-colors">Galerie</a>
      <a href="contact.php" class="block py-2 hover:bg-black/5 rounded-xl transition-colors">Contact</a>
      <a href="contact.php" class="inline-flex items-center justify-center rounded-xl px-4 py-3 border border-black/10 bg-black text-white w-full font-medium hover:bg-black/90 transition-colors shadow-soft">
        Solicita oferta
      </a>
    </div>
  </div>
</header>

