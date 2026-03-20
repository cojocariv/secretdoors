<?php
declare(strict_types=1);

require_once __DIR__ . '/../components/media.php';

$items = get_drive_media_items();
$items = array_slice($items, 0, 48);

function cat_for_index(int $index): string
{
    if ($index <= 8) return 'Uși Filomuro';
    if ($index <= 15) return 'Sisteme & profile';
    return 'Detalii premium';
}

?>

<section class="max-w-7xl mx-auto px-4 py-14">
  <div data-reveal>
    <p class="text-sm font-semibold text-black/60 tracking-wide">Galerie</p>
    <h1 class="mt-2 text-4xl font-semibold tracking-tight">Detalii care merită văzute</h1>
    <p class="mt-3 text-black/65 leading-relaxed max-w-2xl">
      O selecție din imaginile disponibile. Apasă pe o imagine pentru a o deschide în lightbox.
    </p>
  </div>

  <div class="mt-10 flex flex-wrap gap-2">
    <?php
    $cats = ['Toate', 'Uși Filomuro', 'Sisteme & profile', 'Detalii premium'];
    ?>
    <?php foreach ($cats as $cat): ?>
      <button
        type="button"
        class="px-4 py-2 rounded-full border border-black/10 bg-white text-sm font-semibold hover:border-black/20 transition-colors"
        data-gallery-filter="<?= h($cat) ?>"
        <?= $cat === 'Toate' ? 'data-gallery-filter-active="true"' : '' ?>
      >
        <?= h($cat) ?>
      </button>
    <?php endforeach; ?>
  </div>

  <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
    <?php foreach ($items as $it): ?>
      <?php
      $idx = (int)($it['index'] ?? 0);
      $cat = cat_for_index($idx);
      $src = $it['url'] ?? '';
      $filename = $it['filename'] ?? '';
      ?>
      <figure
        class="rounded-3xl border border-black/5 overflow-hidden bg-white shadow-soft hover:border-black/15 transition-colors group reveal"
        data-gallery-item
        data-gallery-category="<?= h($cat) ?>"
      >
        <button
          type="button"
          class="block w-full"
          data-lightbox-src="<?= h($src) ?>"
          data-lightbox-alt="<?= h($filename) ?>"
          data-lightbox-caption="<?= h($cat) ?>"
        >
          <img
            src="<?= h($src) ?>"
            alt="<?= h($filename) ?>"
            class="w-full h-[160px] sm:h-[180px] object-cover transition-transform duration-500 group-hover:scale-[1.04]"
            loading="lazy"
            decoding="async"
          />
        </button>
      </figure>
    <?php endforeach; ?>
  </div>
</section>

<script>
  // Filtrare client-side pentru galerie.
  (function () {
    const root = document.currentScript?.previousElementSibling;
    const filterButtons = Array.from(document.querySelectorAll('[data-gallery-filter]'));
    const items = Array.from(document.querySelectorAll('[data-gallery-item]'));
    if (!filterButtons.length || !items.length) return;

    function setActive(btn) {
      filterButtons.forEach(b => b.classList.remove('bg-black', 'text-white', 'border-black', 'hover:border-black/20'));
      filterButtons.forEach(b => b.setAttribute('data-gallery-filter-active', 'false'));
      btn.classList.add('bg-black', 'text-white', 'border-black');
      btn.setAttribute('data-gallery-filter-active', 'true');
    }

    function applyFilter(cat) {
      items.forEach(it => {
        const itemCat = it.getAttribute('data-gallery-category') || '';
        const show = cat === 'Toate' ? true : itemCat === cat;
        it.style.display = show ? '' : 'none';
      });
    }

    // Apply initial active filter (the HTML marks the default with data-gallery-filter-active="true").
    const initialBtn = filterButtons.find(b => b.getAttribute('data-gallery-filter-active') === 'true') || filterButtons[0];
    if (initialBtn) {
      const initialCat = initialBtn.getAttribute('data-gallery-filter') || 'Toate';
      setActive(initialBtn);
      applyFilter(initialCat);
    }

    filterButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const cat = btn.getAttribute('data-gallery-filter') || 'Toate';
        setActive(btn);
        applyFilter(cat);
      });
    });
  })();
</script>

