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
        <!-- UI-only search & commerce icons (wire-up later). -->
        <div class="hidden lg:flex items-center gap-3">
          <div class="relative w-[230px]">
            <input
              type="search"
              placeholder="Caută"
              aria-label="Caută pe site"
              class="w-full rounded-full border border-black/10 bg-white/70 px-4 py-2 text-sm outline-none focus:border-black/30 focus:ring-0"
            />
            <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-black/60" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M11 19a8 8 0 1 1 0-16 8 8 0 0 1 0 16Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>

          <a href="#" class="inline-flex items-center justify-center w-11 h-11 rounded-xl border border-black/10 bg-white/60 hover:border-black/20 transition-colors" aria-label="Wishlist">
            <svg class="w-5 h-5 text-black/80" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M12 21s-7-4.35-9.33-8.28C.7 9.35 2.2 6.2 5.3 5.4c1.7-.44 3.4.14 4.7 1.45 1.3-1.31 3-1.89 4.7-1.45 3.1.8 4.6 3.95 2.63 7.32C19 16.65 12 21 12 21Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>

          <a href="#" class="inline-flex items-center justify-center w-11 h-11 rounded-xl border border-black/10 bg-white/60 hover:border-black/20 transition-colors" aria-label="Coș">
            <svg class="w-5 h-5 text-black/80" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M6 7h15l-1.5 9h-12L6 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M6 7l-2-2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M9 20a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" fill="currentColor"/>
              <path d="M17 20a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" fill="currentColor"/>
            </svg>
          </a>

          <a href="contact.php" class="inline-flex items-center justify-center w-11 h-11 rounded-xl border border-black/10 bg-white/60 hover:border-black/20 transition-colors" aria-label="Cont">
            <svg class="w-5 h-5 text-black/80" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M20 21a8 8 0 1 0-16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M12 13a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
        </div>

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

