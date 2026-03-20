<?php
declare(strict_types=1);

require_once __DIR__ . '/../components/contact-data.php';

$contact = get_contact_data();
$companyEmail = $contact['email'] ?? ($config['mail_to'] ?? '');
$companyPhone = $contact['phone_e164'] ?? '';
$companyAddress = $contact['address'] ?? '';

$prefProduct = trim((string)($_GET['product'] ?? ''));

$success = false;
$errors = [];

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $name = trim((string)($_POST['name'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $phone = trim((string)($_POST['phone'] ?? ''));
    $message = trim((string)($_POST['message'] ?? ''));
    $product = trim((string)($_POST['product'] ?? $prefProduct));

    // Honeypot anti-spam.
    $hp = trim((string)($_POST['website'] ?? ''));
    if ($hp !== '') {
        $errors[] = 'Cererea nu a putut fi trimisă.';
    } else {
        if ($name === '') $errors[] = 'Numele este obligatoriu.';
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email invalid.';
        if ($message === '') $errors[] = 'Mesajul este obligatoriu.';
        if (mb_strlen($message) < 10) $errors[] = 'Mesajul pare prea scurt.';
    }

    if (!$errors) {
        $safeName = strip_tags($name);
        $safeEmail = strip_tags($email);
        $safePhone = strip_tags($phone);
        $safeMessage = strip_tags($message);

        $subject = 'Cerere ofertă';
        if ($product !== '') {
            $subject .= ' - ' . $product;
        }

        $body = "Ai primit o cerere nouă de ofertă:\n\n";
        $body .= "Nume: {$safeName}\n";
        $body .= "Email: {$safeEmail}\n";
        $body .= "Telefon: {$safePhone}\n";
        if ($product !== '') {
            $body .= "Produs / Colecție: {$product}\n";
        }
        $body .= "\nMesaj:\n{$safeMessage}\n";

        $fromFallback = (string)($config['mail_from_fallback'] ?? 'no-reply@secretdoors.ro');
        $headers = [];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-Type: text/plain; charset=UTF-8';
        $headers[] = 'From: ' . $fromFallback;
        $headers[] = 'Reply-To: ' . $safeEmail;

        $to = $companyEmail ?: (string)($config['mail_to'] ?? '');
        $ok = false;
        if ($to !== '') {
            $ok = @mail($to, $subject, $body, implode("\r\n", $headers));
        }

        // Fallback la stocare dacă mail-ul e blocat.
        $leadPath = storage_path('leads.jsonl');
        @mkdir(dirname($leadPath), 0775, true);
        $record = [
            'created_at' => date('c'),
            'name' => $safeName,
            'email' => $safeEmail,
            'phone' => $safePhone,
            'product' => $product,
            'message' => $safeMessage,
            'mail_ok' => (bool)$ok,
        ];
        @file_put_contents($leadPath, json_encode($record, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n", FILE_APPEND);

        if ($ok) {
            $success = true;
        } else {
            // Chiar dacă mail() e blocat, considerăm cererea trimisă (s-a salvat local).
            $success = true;
        }
    }
}

$mapsUrl = maps_embed_url($companyAddress);
?>

<section class="max-w-7xl mx-auto px-4 py-14">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
    <div>
      <div data-reveal>
        <p class="text-sm font-semibold text-black/60 tracking-wide">Contact</p>
        <h1 class="mt-2 text-4xl font-semibold tracking-tight">Solicită ofertă</h1>
        <p class="mt-3 text-black/65 leading-relaxed">
          Spune-ne ce ai nevoie. Îți răspundem cu pași clari și recomandări pentru integrare.
        </p>
      </div>

      <?php if ($success): ?>
        <div class="mt-6 rounded-3xl border border-black/10 bg-black text-white p-5 reveal" data-reveal>
          <p class="font-semibold">Cererea a fost trimisă.</p>
          <p class="text-sm text-white/75 mt-2">
            Mulțumim! Dacă mail-ul nu poate fi livrat, cererea rămâne salvată local pentru procesare.
          </p>
        </div>
      <?php endif; ?>

      <?php if (!empty($errors)): ?>
        <div class="mt-6 rounded-3xl border border-red-500/30 bg-red-50 text-red-900 p-5 reveal" data-reveal>
          <p class="font-semibold">Verifică formularul:</p>
          <ul class="mt-2 text-sm space-y-1 list-disc pl-5">
            <?php foreach ($errors as $e): ?>
              <li><?= h($e) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form method="post" action="/contact.php" class="mt-8 rounded-3xl border border-black/5 bg-white p-6 shadow-soft reveal" data-reveal>
        <input type="hidden" name="product" value="<?= h($prefProduct) ?>" />
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="sm:col-span-1">
            <label class="text-sm font-semibold text-black/70">Nume</label>
            <input
              type="text"
              name="name"
              required
              class="mt-2 w-full rounded-2xl border border-black/10 px-4 py-3 text-sm outline-none focus:border-black/30 focus:ring-0"
              placeholder="Ex: Andrei Popescu"
              value="<?= h((string)($_POST['name'] ?? '')) ?>"
            />
          </div>
          <div class="sm:col-span-1">
            <label class="text-sm font-semibold text-black/70">Email</label>
            <input
              type="email"
              name="email"
              required
              class="mt-2 w-full rounded-2xl border border-black/10 px-4 py-3 text-sm outline-none focus:border-black/30 focus:ring-0"
              placeholder="ex: andrei@email.com"
              value="<?= h((string)($_POST['email'] ?? '')) ?>"
            />
          </div>

          <div class="sm:col-span-1">
            <label class="text-sm font-semibold text-black/70">Telefon</label>
            <input
              type="tel"
              name="phone"
              class="mt-2 w-full rounded-2xl border border-black/10 px-4 py-3 text-sm outline-none focus:border-black/30 focus:ring-0"
              placeholder="Ex: +40 740 992 551"
              value="<?= h((string)($_POST['phone'] ?? '')) ?>"
            />
          </div>

          <div class="sm:col-span-1">
            <label class="text-sm font-semibold text-black/70">Produs / colecție</label>
            <input
              type="text"
              name="product_display"
              class="mt-2 w-full rounded-2xl border border-black/10 px-4 py-3 text-sm outline-none focus:border-black/30 focus:ring-0 bg-black/5"
              value="<?= h($prefProduct) ?>"
              readonly
            />
          </div>
        </div>

        <div class="mt-4">
          <label class="text-sm font-semibold text-black/70">Mesaj</label>
          <textarea
            name="message"
            required
            rows="5"
            class="mt-2 w-full rounded-2xl border border-black/10 px-4 py-3 text-sm outline-none focus:border-black/30 focus:ring-0"
            placeholder="Dimensiuni, tip perete, preferințe..."
          ><?= h((string)($_POST['message'] ?? '')) ?></textarea>
        </div>

        <!-- honeypot (anti-spam) -->
        <div class="hidden">
          <label>Website</label>
          <input type="text" name="website" value="" />
        </div>

        <button type="submit" class="mt-6 w-full inline-flex items-center justify-center rounded-2xl px-5 py-3 bg-black text-white text-sm font-semibold hover:bg-black/90 transition-colors shadow-soft">
          Trimiți cererea
        </button>
        <p class="mt-3 text-xs text-black/45 leading-relaxed">
          Prin trimitere confirmi că dorești să fii contactat pentru ofertă. Nu distribuim datele.
        </p>
      </form>
    </div>

    <aside class="lg:sticky lg:top-24">
      <div class="rounded-3xl border border-black/5 bg-white shadow-soft p-6 reveal" data-reveal>
        <p class="text-sm font-semibold text-black/60 tracking-wide">Date companie</p>
        <p class="mt-2 text-xl font-semibold"><?= h($contact['address'] ? 'Localizare & contact' : 'Contact') ?></p>
        <div class="mt-4 space-y-4 text-sm text-black/75">
          <div>
            <p class="text-black/55 font-semibold">Adresă</p>
            <p class="mt-1 leading-relaxed"><?= h($companyAddress ?: '—') ?></p>
          </div>
          <div>
            <p class="text-black/55 font-semibold">Telefon</p>
            <a href="<?= h('tel:' . ($companyPhone ?: '')) ?>" class="mt-1 block hover:text-black/90 transition-colors">
              <?= h($companyPhone ?: '—') ?>
            </a>
          </div>
          <div>
            <p class="text-black/55 font-semibold">Email</p>
            <a href="<?= h('mailto:' . ($companyEmail ?: '')) ?>" class="mt-1 block hover:text-black/90 transition-colors">
              <?= h($companyEmail ?: '—') ?>
            </a>
          </div>
        </div>

        <a
          href="<?= h($contact['whatsapp_url'] ?? '') ?>"
          target="_blank"
          rel="noopener"
          class="mt-6 inline-flex items-center justify-center rounded-2xl px-5 py-2.5 bg-black text-white text-sm font-semibold hover:bg-black/90 transition-colors w-full"
        >
          Discută pe WhatsApp
        </a>
      </div>

      <div class="mt-6 rounded-3xl border border-black/5 overflow-hidden shadow-soft reveal" data-reveal>
        <div class="bg-black text-white p-4">
          <p class="text-sm font-semibold">Google Maps</p>
          <p class="text-xs text-white/70 mt-1">Rute & orientare</p>
        </div>
        <iframe
          src="<?= h($mapsUrl) ?>"
          class="w-full h-[320px]"
          style="border:0"
          loading="lazy"
          allowfullscreen=""
          referrerpolicy="no-referrer-when-downgrade"
          title="Locație"
        ></iframe>
      </div>
    </aside>
  </div>
</section>

