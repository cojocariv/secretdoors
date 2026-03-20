<?php
declare(strict_types=1);

require_once __DIR__ . '/../components/media.php';
 $productsData = require __DIR__ . '/../data/products.php';

$collections = $productsData['collections'] ?? [];
$products = $productsData['products'] ?? [];

function url_for(string $filename): string
{
    $it = get_drive_media_by_filename($filename);
    return $it['url'] ?? '';
}
?>

<section class="max-w-7xl mx-auto px-4 py-14">
  <div data-reveal>
    <p class="text-sm font-semibold text-black/60 tracking-wide">Produse</p>
    <h1 class="mt-2 text-4xl font-semibold tracking-tight">Colecții și uși filomuro</h1>
    <p class="mt-3 text-black/65 leading-relaxed max-w-2xl">
      Alege un produs, verifică specificațiile și cere ofertă. Îți trimitem recomandări clare pentru integrarea în perete.
    </p>
  </div>

  <div class="mt-12">
    <div class="flex items-center justify-between gap-4">
      <div>
        <p class="text-sm font-semibold text-black/60 tracking-wide">Recomandate</p>
        <h2 class="mt-2 text-2xl font-semibold tracking-tight">O selecție premium</h2>
      </div>
      <div class="flex gap-2">
        <button
          type="button"
          class="w-11 h-11 rounded-2xl border border-black/10 hover:border-black/20 transition-colors bg-white"
          aria-label="Precedent"
          data-slider-prev-for="product-slider"
        >
          <svg class="w-5 h-5 mx-auto" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
        <button
          type="button"
          class="w-11 h-11 rounded-2xl border border-black/10 hover:border-black/20 transition-colors bg-white"
          aria-label="Următor"
          data-slider-next-for="product-slider"
        >
          <svg class="w-5 h-5 mx-auto" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </div>
    </div>

    <div class="mt-6">
      <div id="product-slider" data-slider class="flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-3">
        <?php foreach (array_slice($products, 0, 5) as $p): ?>
          <?php $img = url_for($p['image'] ?? ''); ?>
          <article class="snap-start w-[280px] sm:w-[320px] shrink-0 rounded-3xl border border-black/5 overflow-hidden bg-white shadow-soft hover:border-black/15 transition-colors reveal" data-reveal>
            <div class="relative">
              <?php if ($img): ?>
                <img src="<?= h($img) ?>" alt="<?= h($p['name'] ?? 'Produs') ?>" class="w-full h-[200px] object-cover" loading="lazy" />
              <?php else: ?>
                <div class="w-full h-[200px] bg-gradient-to-br from-gray-900 via-black to-gray-700"></div>
              <?php endif; ?>
              <div class="absolute top-4 left-4 rounded-full bg-white/85 backdrop-blur px-3 py-1 text-xs font-semibold text-black/80">
                <?= h($p['collection'] ?? '') ?>
              </div>
            </div>
            <div class="p-5">
              <h3 class="text-lg font-semibold tracking-tight"><?= h($p['name'] ?? '') ?></h3>
              <p class="mt-2 text-sm text-black/65 leading-relaxed"><?= h($p['description'] ?? '') ?></p>
              <ul class="mt-4 space-y-2 text-sm text-black/70">
                <?php foreach (($p['specs'] ?? []) as $spec): ?>
                  <li class="flex gap-2 items-start">
                    <span class="mt-1 w-2 h-2 rounded-full bg-black/70 shrink-0"></span>
                    <span><?= h($spec) ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
              <a href="contact.php?product=<?= urlencode($p['name'] ?? $p['slug'] ?? 'Solicitare') ?>" class="mt-5 inline-flex items-center justify-center rounded-2xl px-5 py-2.5 bg-black text-white text-sm font-semibold hover:bg-black/90 transition-colors w-full">
                Solicită ofertă
              </a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="mt-14">
    <div data-reveal>
      <p class="text-sm font-semibold text-black/60 tracking-wide">Toate produsele</p>
      <h2 class="mt-2 text-2xl font-semibold tracking-tight">Listă completă</h2>
    </div>

    <div class="mt-7 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
      <?php foreach ($products as $p): ?>
        <?php $img = url_for($p['image'] ?? ''); ?>
        <article class="rounded-3xl border border-black/5 overflow-hidden bg-white shadow-soft hover:border-black/15 transition-colors reveal" data-reveal>
          <div class="relative">
            <?php if ($img): ?>
              <img src="<?= h($img) ?>" alt="<?= h($p['name'] ?? 'Produs') ?>" class="w-full h-[220px] object-cover" loading="lazy" />
            <?php else: ?>
              <div class="w-full h-[220px] bg-gradient-to-br from-gray-900 via-black to-gray-700"></div>
            <?php endif; ?>
            <div class="absolute top-4 left-4 rounded-full bg-white/85 backdrop-blur px-3 py-1 text-xs font-semibold text-black/80">
              <?= h($p['collection'] ?? '') ?>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-semibold tracking-tight"><?= h($p['name'] ?? '') ?></h3>
            <p class="mt-2 text-sm text-black/65 leading-relaxed"><?= h($p['description'] ?? '') ?></p>
            <ul class="mt-4 space-y-2 text-sm text-black/70">
              <?php foreach (($p['specs'] ?? []) as $spec): ?>
                <li class="flex gap-2 items-start">
                  <span class="mt-1 w-2 h-2 rounded-full bg-black/70 shrink-0"></span>
                  <span><?= h($spec) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
            <a href="contact.php?product=<?= urlencode($p['name'] ?? $p['slug'] ?? 'Solicitare') ?>" class="mt-5 inline-flex items-center justify-center rounded-2xl px-5 py-2.5 bg-black text-white text-sm font-semibold hover:bg-black/90 transition-colors w-full">
              Solicită ofertă
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

