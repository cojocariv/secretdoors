<?php
declare(strict_types=1);

require_once __DIR__ . '/../components/media.php';

$img1 = get_drive_media_by_filename('image9.jpeg') ?? get_drive_media_by_filename('image10.jpeg');
$img1Url = $img1['url'] ?? '';
?>

<section class="max-w-7xl mx-auto px-4 py-14">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
    <div data-reveal>
      <p class="text-sm font-semibold text-black/60 tracking-wide">Despre noi</p>
      <h1 class="mt-2 text-4xl font-semibold tracking-tight">Secret Doors România</h1>
      <p class="mt-4 text-black/70 leading-relaxed max-w-xl">
        Suntem producător de uși ascunse tip filomuro și soluții tehnice pentru integrare elegantă în perete.
        Fiecare detaliu este gândit pentru continuitate vizuală, funcționare fluidă și montaj eficient.
      </p>
      <div class="mt-7 grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="rounded-3xl border border-black/5 bg-white p-5 hover:border-black/15 transition-colors reveal" data-reveal>
          <p class="text-sm font-semibold text-black/60">Focus pe tehnică</p>
          <p class="mt-2 text-xl font-semibold">Mecanisme fiabile</p>
        </div>
        <div class="rounded-3xl border border-black/5 bg-white p-5 hover:border-black/15 transition-colors reveal" data-reveal>
          <p class="text-sm font-semibold text-black/60">Focus pe design</p>
          <p class="mt-2 text-xl font-semibold">Minimalism premium</p>
        </div>
      </div>
      <div class="mt-8 flex flex-col sm:flex-row gap-3">
        <a href="/produse.php" class="inline-flex items-center justify-center rounded-2xl px-7 py-3 bg-black text-white font-semibold hover:bg-black/90 transition-colors shadow-soft">
          Vezi produse
        </a>
        <a href="/contact.php" class="inline-flex items-center justify-center rounded-2xl px-7 py-3 border border-black/10 bg-white text-black font-semibold hover:border-black/20 transition-colors">
          Solicită ofertă
        </a>
      </div>
    </div>

    <div class="rounded-3xl border border-black/5 overflow-hidden shadow-soft reveal" data-reveal>
      <?php if ($img1Url): ?>
        <img src="<?= h($img1Url) ?>" alt="Proces de producție" class="w-full h-[420px] object-cover" loading="lazy" />
      <?php else: ?>
        <div class="w-full h-[420px] bg-gradient-to-br from-gray-900 via-black to-gray-700"></div>
      <?php endif; ?>
    </div>
  </div>

  <div class="mt-14">
    <div data-reveal>
      <p class="text-sm font-semibold text-black/60 tracking-wide">Avantaje competitive</p>
      <h2 class="mt-2 text-2xl font-semibold tracking-tight">De ce Secret Doors</h2>
    </div>

    <div class="mt-7 grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="rounded-3xl border border-black/5 bg-white p-6 hover:border-black/15 transition-colors reveal" data-reveal>
        <p class="text-sm font-semibold text-black/60">Integrare</p>
        <p class="mt-2 text-xl font-semibold">Design invizibil</p>
        <p class="mt-3 text-sm text-black/65 leading-relaxed">Ușa se ascunde, iar peretele rămâne curat și coerent.</p>
      </div>
      <div class="rounded-3xl border border-black/5 bg-white p-6 hover:border-black/15 transition-colors reveal" data-reveal>
        <p class="text-sm font-semibold text-black/60">Calitate</p>
        <p class="mt-2 text-xl font-semibold">Producție controlată</p>
        <p class="mt-3 text-sm text-black/65 leading-relaxed">Mecanisme și materiale gândite pentru durabilitate.</p>
      </div>
      <div class="rounded-3xl border border-black/5 bg-white p-6 hover:border-black/15 transition-colors reveal" data-reveal>
        <p class="text-sm font-semibold text-black/60">Claritate</p>
        <p class="mt-2 text-xl font-semibold">Specificații utile</p>
        <p class="mt-3 text-sm text-black/65 leading-relaxed">Flux tehnic clar pentru verificări și montaj fără stres.</p>
      </div>
    </div>
  </div>

  <div class="mt-14 rounded-3xl bg-black text-white p-6 md:p-10 overflow-hidden relative">
    <div class="absolute inset-0 bg-gradient-to-br from-white/10 via-white/5 to-transparent"></div>
    <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
      <div data-reveal>
        <p class="text-sm font-semibold text-white/70 tracking-wide">Proces</p>
        <h2 class="mt-2 text-3xl font-semibold tracking-tight">De la desen la montaj</h2>
        <p class="mt-4 text-white/75 leading-relaxed max-w-xl">
          Un proces simplu și eficient: primești informațiile necesare, noi producem structura și îți livrăm pentru implementare rapidă.
        </p>
      </div>
      <div class="space-y-4" data-reveal>
        <div class="flex gap-4 rounded-2xl border border-white/15 bg-white/5 p-5 hover:bg-white/8 transition-colors">
          <span class="w-11 h-11 rounded-2xl bg-white text-black font-semibold grid place-items-center">1</span>
          <div>
            <p class="font-semibold">Cerere & specificații</p>
            <p class="text-sm text-white/75 mt-1">Dimensiuni, preferințe și condiții de montaj.</p>
          </div>
        </div>
        <div class="flex gap-4 rounded-2xl border border-white/15 bg-white/5 p-5 hover:bg-white/8 transition-colors">
          <span class="w-11 h-11 rounded-2xl bg-white text-black font-semibold grid place-items-center">2</span>
          <div>
            <p class="font-semibold">Producție</p>
            <p class="text-sm text-white/75 mt-1">Structuri și mecanisme fabricate pentru integrare.</p>
          </div>
        </div>
        <div class="flex gap-4 rounded-2xl border border-white/15 bg-white/5 p-5 hover:bg-white/8 transition-colors">
          <span class="w-11 h-11 rounded-2xl bg-white text-black font-semibold grid place-items-center">3</span>
          <div>
            <p class="font-semibold">Livrare & suport</p>
            <p class="text-sm text-white/75 mt-1">Verificări, reglaje și pași practici pentru montaj.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

