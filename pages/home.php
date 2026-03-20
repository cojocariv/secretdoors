<?php
declare(strict_types=1);

require_once __DIR__ . '/../components/media.php';
 $productsData = require __DIR__ . '/../data/products.php';

$collections = $productsData['collections'] ?? [];
$products = $productsData['products'] ?? [];

$hero = get_drive_media_by_filename('image15.jpeg') ?? get_drive_media_by_filename('image0.jpeg');
$heroUrl = $hero['url'] ?? '';

// Imaginea pentru secțiunea "Produs" (partea din dreapta) - fișier local din assets.
$featureUrl = 'assets/image14.jpeg';
if (!is_file(__DIR__ . '/../assets/image14.jpeg')) {
    $featureUrl = $heroUrl; // fallback dacă nu există imaginea locală
}

function drive_url_for(string $filename): string
{
    $it = get_drive_media_by_filename($filename);
    return $it['url'] ?? '';
}
?>

<section class="relative min-h-[78vh] flex items-center overflow-hidden">
  <div class="absolute inset-0">
    <?php if ($heroUrl): ?>
      <img src="<?= h($heroUrl) ?>" alt="Uși filomuro" class="w-full h-full object-cover" loading="eager" />
    <?php else: ?>
      <div class="w-full h-full bg-gradient-to-br from-black via-black/70 to-black/20"></div>
    <?php endif; ?>
    <div class="absolute inset-0 bg-black/65"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-4 py-20">
    <div class="max-w-2xl" data-reveal>
      <p class="inline-flex items-center gap-2 text-white/85 text-sm">
        <span class="w-2 h-2 rounded-full bg-white/80"></span>
        Producător direct
      </p>
      <h1 class="mt-4 text-white text-4xl sm:text-5xl font-semibold tracking-tight">
        Uși Filomuro invizibile.
      </h1>
      <p class="mt-5 text-white/85 text-base sm:text-lg leading-relaxed">
        Design minimalist, integrare în perete și mecanisme fiabile. De la desen la montaj.
      </p>

      <div class="mt-8 flex flex-col sm:flex-row gap-3">
        <a href="contact.php" class="inline-flex items-center justify-center rounded-2xl px-7 py-3 bg-white text-black font-semibold shadow-soft hover:bg-black hover:text-white transition-colors">
          Solicită ofertă
        </a>
        <a href="produse.php" class="inline-flex items-center justify-center rounded-2xl px-7 py-3 border border-white/30 bg-white/5 text-white font-semibold hover:bg-white/10 transition-colors">
          Vezi produse
        </a>
      </div>

      <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-3">
        <div class="rounded-2xl border border-white/15 bg-white/5 p-4">
          <p class="text-white font-semibold">Design ascuns</p>
          <p class="text-white/75 text-sm mt-1">Estetică curată, fără compromis.</p>
        </div>
        <div class="rounded-2xl border border-white/15 bg-white/5 p-4">
          <p class="text-white font-semibold">Integrare în perete</p>
          <p class="text-white/75 text-sm mt-1">Pentru zidărie și gips-carton.</p>
        </div>
        <div class="rounded-2xl border border-white/15 bg-white/5 p-4">
          <p class="text-white font-semibold">Calitate premium</p>
          <p class="text-white/75 text-sm mt-1">Producție controlată.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-16">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
    <div data-reveal>
      <p class="text-sm font-semibold text-black/60 tracking-wide">Produs</p>
      <h2 class="mt-2 text-3xl font-semibold tracking-tight">Uși Filomuro, făcute să dispară în arhitectură</h2>
      <p class="mt-4 text-black/70 leading-relaxed">
        Soluțiile Secret Doors sunt gândite pentru continuitate vizuală și funcționare fluidă. Ușa se ascunde, iar spațiul rămâne curat,
        modern și utilizabil.
      </p>

      <div class="mt-8 space-y-4">
        <div class="flex gap-4 items-start rounded-2xl border border-black/5 p-5 hover:border-black/15 transition-colors" data-reveal>
          <span class="w-10 h-10 rounded-xl bg-black text-white grid place-items-center text-sm">01</span>
          <div>
            <p class="font-semibold">Integrare invizibilă</p>
            <p class="text-sm text-black/60 mt-1">Frontul rămâne aproape perfect plan cu peretele.</p>
          </div>
        </div>
        <div class="flex gap-4 items-start rounded-2xl border border-black/5 p-5 hover:border-black/15 transition-colors" data-reveal>
          <span class="w-10 h-10 rounded-xl bg-black text-white grid place-items-center text-sm">02</span>
          <div>
            <p class="font-semibold">Montaj optimizat</p>
            <p class="text-sm text-black/60 mt-1">Flux tehnic clar pentru implementare rapidă.</p>
          </div>
        </div>
        <div class="flex gap-4 items-start rounded-2xl border border-black/5 p-5 hover:border-black/15 transition-colors" data-reveal>
          <span class="w-10 h-10 rounded-xl bg-black text-white grid place-items-center text-sm">03</span>
          <div>
            <p class="font-semibold">Durabilitate</p>
            <p class="text-sm text-black/60 mt-1">Mecanisme gândite pentru utilizare îndelungată.</p>
          </div>
        </div>
      </div>
    </div>

    <div data-reveal class="rounded-3xl border border-black/5 overflow-hidden shadow-soft">
      <?php if ($featureUrl): ?>
        <img src="<?= h($featureUrl) ?>" alt="Detaliu uși filomuro" class="w-full h-[420px] object-cover" loading="lazy" />
      <?php else: ?>
        <div class="w-full h-[420px] bg-gradient-to-br from-black via-black/60 to-gray-900"></div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="bg-black text-white">
  <div class="max-w-7xl mx-auto px-4 py-16">
    <div data-reveal>
      <p class="text-sm font-semibold text-white/70 tracking-wide">Colecții</p>
      <h2 class="mt-2 text-3xl font-semibold tracking-tight">Alege colecția potrivită proiectului tău</h2>
      <p class="mt-3 text-white/70 leading-relaxed max-w-2xl">
        Design minimalist, mecanisme fiabile, integrare în perete. Fiecare colecție are un focus clar.
      </p>
    </div>

    <div class="mt-10 flex items-center justify-between gap-4">
      <div class="text-sm text-white/70">
        Glisează pentru a explora.
      </div>
      <div class="flex gap-2">
        <button
          type="button"
          class="w-11 h-11 rounded-2xl border border-white/20 bg-white/5 hover:bg-white/10 transition-colors"
          aria-label="Precedent"
          data-slider-prev-for="collection-slider"
        >
          <span class="sr-only">Precedent</span>
          <svg class="w-5 h-5 mx-auto" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
        <button
          type="button"
          class="w-11 h-11 rounded-2xl border border-white/20 bg-white/5 hover:bg-white/10 transition-colors"
          aria-label="Următor"
          data-slider-next-for="collection-slider"
        >
          <span class="sr-only">Următor</span>
          <svg class="w-5 h-5 mx-auto" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </div>
    </div>

    <div class="mt-8">
      <div id="collection-slider" data-slider class="flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-3">
        <?php foreach ($collections as $c): ?>
          <?php $url = drive_url_for($c['image'] ?? ''); ?>
          <div class="snap-start w-[280px] sm:w-[320px] shrink-0 rounded-3xl border border-white/15 bg-white/5 overflow-hidden hover:bg-white/7 transition-colors" data-reveal>
            <?php if ($url): ?>
              <img src="<?= h($url) ?>" alt="<?= h($c['title'] ?? 'Colecție') ?>" class="w-full h-[200px] object-cover" loading="lazy" />
            <?php else: ?>
              <div class="w-full h-[200px] bg-gradient-to-br from-white/10 to-white/5"></div>
            <?php endif; ?>
            <div class="p-5">
              <p class="font-semibold text-lg"><?= h($c['title'] ?? '') ?></p>
              <p class="text-sm text-white/70 mt-2"><?= h($c['subtitle'] ?? '') ?></p>
              <a href="produse.php" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold hover:text-white/90 transition-colors">
                Vezi detalii
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <path d="M7 17L17 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M8 7h9v9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="mt-12 grid grid-cols-1 lg:grid-cols-3 gap-4">
      <div class="rounded-3xl border border-white/15 bg-white/5 p-6" data-reveal>
        <p class="text-sm text-white/70">Focus</p>
        <p class="mt-2 text-xl font-semibold">Conversie rapidă</p>
        <p class="mt-2 text-white/70 leading-relaxed text-sm">
          Formular scurt, clar, cu detalii care ne ajută să-ți răspundem la obiect.
        </p>
      </div>
      <div class="rounded-3xl border border-white/15 bg-white/5 p-6" data-reveal>
        <p class="text-sm text-white/70">Execuție</p>
        <p class="mt-2 text-xl font-semibold">Producție controlată</p>
        <p class="mt-2 text-white/70 leading-relaxed text-sm">
          Materiale și mecanisme alese pentru rezistență și fluiditate.
        </p>
      </div>
      <div class="rounded-3xl border border-white/15 bg-white/5 p-6" data-reveal>
        <p class="text-sm text-white/70">UX</p>
        <p class="mt-2 text-xl font-semibold">Interacțiuni moderne</p>
        <p class="mt-2 text-white/70 leading-relaxed text-sm">
          Animații smooth, lightbox și slider pentru o experiență premium.
        </p>
      </div>
    </div>
  </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-16">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
    <div data-reveal>
      <p class="text-sm font-semibold text-black/60 tracking-wide">Acum</p>
      <h2 class="mt-2 text-3xl font-semibold tracking-tight">Ai un proiect? Cere o ofertă în câteva minute.</h2>
      <p class="mt-4 text-black/70 leading-relaxed">
        Spune-ne dimensiunile și preferințele. Noi pregătim specificațiile și pașii de implementare.
      </p>
      <a href="contact.php" class="mt-8 inline-flex items-center justify-center rounded-2xl px-7 py-3 bg-black text-white font-semibold hover:bg-black/90 transition-colors shadow-soft">
        Solicită ofertă
      </a>
      <p class="mt-3 text-sm text-black/50">Răspundem rapid cu claritate și recomandări.</p>
    </div>

    <div class="rounded-3xl border border-black/5 overflow-hidden shadow-soft" data-reveal>
      <?php
      $p = $products[0] ?? null;
      $pUrl = $p ? drive_url_for($p['image'] ?? '') : '';
      ?>
      <?php if ($pUrl): ?>
        <img src="<?= h($pUrl) ?>" alt="Produs premium" class="w-full h-[380px] object-cover" loading="lazy" />
      <?php else: ?>
        <div class="w-full h-[380px] bg-gradient-to-br from-gray-900 via-black to-gray-700"></div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="bg-gray-50 border-t border-black/5">
  <div class="max-w-7xl mx-auto px-4 py-16">
    <div data-reveal>
      <p class="text-sm font-semibold text-black/60 tracking-wide">Testimoniale</p>
      <h2 class="mt-2 text-3xl font-semibold tracking-tight">Ce spun clienții</h2>
      <p class="mt-3 text-black/60 leading-relaxed max-w-2xl">
        Mock testimonials (îți pot înlocui ulterior cu date reale).
      </p>
    </div>

    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-4">
      <?php
      $testimonials = [
          ['name'=>'Arh. Maria P.','text'=>'„Ușa se integrează impecabil. Designul e discret, iar montajul a fost clar și eficient.”'],
          ['name'=>'Andrei S.','text'=>'„Am primit specificații detaliate și un flux de producție foarte organizat. Excelent pentru proiect.”'],
          ['name'=>'Elena T.','text'=>'„Funcționare fluidă și aspect premium. Diferența se simte la fiecare detaliu.”'],
      ];
      ?>
      <?php foreach ($testimonials as $t): ?>
        <div class="rounded-3xl border border-black/5 bg-white p-6 hover:border-black/15 transition-colors reveal" data-reveal>
          <div class="flex items-center justify-between">
            <p class="font-semibold"><?= h($t['name']) ?></p>
            <span class="text-sm text-black/40">★★★★★</span>
          </div>
          <p class="mt-4 text-sm text-black/70 leading-relaxed"><?= h($t['text']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

