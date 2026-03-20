/* global tailwind */

function initMobileNav() {
  const btn = document.querySelector('[data-mobile-nav-button]');
  const panel = document.querySelector('[data-mobile-nav-panel]');
  if (!btn || !panel) return;

  const line1 = btn.querySelector('[data-mobile-nav-line-1]');
  const line2 = btn.querySelector('[data-mobile-nav-line-2]');

  btn.setAttribute('aria-expanded', 'false');

  btn.addEventListener('click', () => {
    const isHidden = panel.classList.contains('hidden');
    panel.classList.toggle('hidden');
    btn.setAttribute('aria-expanded', String(isHidden));

    if (line1 && line2) {
      if (isHidden) {
        // open -> keep as two lines
        line1.style.transform = '';
        line2.style.transform = '';
      } else {
        // close -> reset
        line1.style.transform = '';
        line2.style.transform = '';
      }
    }
  });
}

function initRevealOnScroll() {
  const els = Array.from(document.querySelectorAll('[data-reveal], .reveal'));
  if (els.length === 0) return;

  const io = new IntersectionObserver(
    (entries) => {
      for (const entry of entries) {
        if (!entry.isIntersecting) continue;
        entry.target.classList.add('is-visible');
        io.unobserve(entry.target);
      }
    },
    { threshold: 0.12 }
  );

  els.forEach((el) => {
    if (!el.classList.contains('reveal')) el.classList.add('reveal');
    io.observe(el);
  });
}

function ensureLightbox() {
  let root = document.getElementById('lightbox-root');
  if (root) return root;

  root = document.createElement('div');
  root.id = 'lightbox-root';
  root.className = 'fixed inset-0 z-[100] hidden';
  root.innerHTML = `
    <div class="lb-backdrop absolute inset-0"></div>
    <div class="relative z-[101] h-full w-full flex items-center justify-center p-4">
      <button type="button" class="absolute top-4 right-4 w-11 h-11 rounded-xl bg-white/10 text-white border border-white/20 hover:bg-white/15 transition-colors" data-lightbox-close aria-label="Închide">
        <span aria-hidden="true" class="text-xl leading-none">&times;</span>
      </button>
      <div class="max-w-5xl w-full">
        <img class="w-full h-auto rounded-2xl shadow-soft bg-black/10" alt="" data-lightbox-img />
        <p class="text-center text-white/85 text-sm mt-3" data-lightbox-caption></p>
      </div>
    </div>
  `;
  document.body.appendChild(root);
  return root;
}

function initLightbox() {
  const openers = Array.from(document.querySelectorAll('[data-lightbox-src]'));
  if (openers.length === 0) return;

  const root = ensureLightbox();
  const img = root.querySelector('[data-lightbox-img]');
  const caption = root.querySelector('[data-lightbox-caption]');
  const closeBtn = root.querySelector('[data-lightbox-close]');

  function open(src, alt, cap) {
    img.src = src;
    img.alt = alt || '';
    caption.textContent = cap || '';
    root.classList.remove('hidden');
    root.classList.add('block');
    document.body.style.overflow = 'hidden';
  }

  function close() {
    root.classList.add('hidden');
    root.classList.remove('block');
    document.body.style.overflow = '';
    img.src = '';
  }

  root.addEventListener('click', (e) => {
    // click on backdrop closes
    if (e.target === root.firstChild || e.target?.classList?.contains('lb-backdrop')) close();
  });
  closeBtn.addEventListener('click', close);
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') close();
  });

  openers.forEach((el) => {
    el.addEventListener('click', () => {
      const src = el.getAttribute('data-lightbox-src');
      const alt = el.getAttribute('data-lightbox-alt') || '';
      const cap = el.getAttribute('data-lightbox-caption') || '';
      if (src) open(src, alt, cap);
    });
  });
}

function initProductSliders() {
  const sliders = Array.from(document.querySelectorAll('[data-slider]'));
  sliders.forEach((slider) => {
    const id = slider.getAttribute('id');
    if (!id) return;

    const prev = document.querySelector(`[data-slider-prev-for="${id}"]`);
    const next = document.querySelector(`[data-slider-next-for="${id}"]`);
    if (!prev || !next) return;

    const step = () => Math.max(320, Math.floor(slider.clientWidth * 0.9));

    prev.addEventListener('click', () => {
      slider.scrollBy({ left: -step(), behavior: 'smooth' });
    });
    next.addEventListener('click', () => {
      slider.scrollBy({ left: step(), behavior: 'smooth' });
    });
  });
}

function initAll() {
  initMobileNav();
  initRevealOnScroll();
  initLightbox();
  initProductSliders();
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initAll);
} else {
  initAll();
}

