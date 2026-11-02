<?php
require __DIR__ . '/includes/bootstrap.php';

$topics = ['General enquiry', 'Banquet', 'Corporate / bulk order', 'Feedback'];
$errors = [];
$old = ['name' => '', 'phone' => '', 'email' => '', 'topic' => in_array($_GET['topic'] ?? '', $topics, true) ? $_GET['topic'] : $topics[0], 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $k => $_) {
        $old[$k] = trim((string) ($_POST[$k] ?? ''));
    }

    if (!csrf_valid() || !empty($_POST['website'])) {
        $errors['form'] = 'Your session expired. Please submit the form again.';
    }
    if (mb_strlen($old['name']) < 2) {
        $errors['name'] = 'Please enter your name.';
    }
    if (!preg_match('/^\+?[0-9\s-]{10,15}$/', $old['phone'])) {
        $errors['phone'] = 'Please enter a valid phone number.';
    }
    if ($old['email'] !== '' && !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'That email address looks incorrect.';
    }
    if (!in_array($old['topic'], $topics, true)) {
        $old['topic'] = $topics[0];
    }
    if (mb_strlen($old['message']) < 5) {
        $errors['message'] = 'Please write a short message.';
    }

    if (!$errors) {
        store_csv('messages.csv', [date('Y-m-d H:i:s'), $old['name'], $old['phone'], $old['email'], $old['topic'], $old['message']]);
        flash('contact_sent', $old['name']);
        header('Location: contact.php?sent=1#form');
        exit;
    }
}

$sentName = flash('contact_sent');

$page = 'contact';
$title = 'Contact — Sarla, Sector 62 Noida';
$description = 'Contact Sarla in Sector 62, Noida for reservations, banquets, corporate orders and feedback.';
require __DIR__ . '/includes/header.php';

page_hero('Get in touch', 'Let\'s <span class="text-gold-gradient">talk.</span>', 'Questions, banquet plans, a corporate lunch order or feedback — we would love to hear from you.', 'brass-curry', 'Contact');
?>

<section id="form" class="scroll-mt-24 bg-ink-900 py-24 lg:py-32">
  <div class="container-x grid grid-cols-1 gap-12 lg:grid-cols-[0.9fr_1.1fr] lg:gap-16">
    <!-- Contact details -->
    <div>
      <p class="eyebrow eyebrow-line" data-reveal>Contact us</p>
      <h2 class="script mt-5 text-5xl" data-reveal style="--d:100ms">We're just a call away.</h2>

      <div class="mt-10 space-y-4">
        <?php foreach ([
            ['phone', 'Call us', SITE['phone'], tel_href(), false],
            ['whatsapp', 'WhatsApp', 'Chat with us instantly', wa_href(), true],
            ['mail', 'Email', SITE['email'], 'mailto:' . SITE['email'], false],
            ['map-pin', 'Visit us', implode(', ', SITE['address']), maps_directions(), true],
        ] as $i => [$ic, $label, $value, $href, $blank]): ?>
          <a href="<?= e($href) ?>" <?= $blank ? 'target="_blank" rel="noopener"' : '' ?> class="card group flex items-center gap-5 p-5 transition hover:border-gold-500/30" data-reveal style="--d:<?= $i * 80 ?>ms">
            <span class="grid size-12 shrink-0 place-items-center rounded-full border border-gold-500/30 bg-gold-500/10 text-gold-400 transition group-hover:bg-gold-500 group-hover:text-ink-950"><?= icon($ic, 'size-5') ?></span>
            <span class="min-w-0 flex-1">
              <span class="block text-[10px] font-bold uppercase tracking-[0.25em] text-white/40"><?= $label ?></span>
              <span class="mt-1 block text-sm break-words text-white/85"><?= e($value) ?></span>
            </span>
            <?= icon('arrow-up-right', 'size-4 shrink-0 text-white/25 transition group-hover:text-gold-400') ?>
          </a>
        <?php endforeach; ?>
      </div>

      <div class="card mt-4 p-6" data-reveal>
        <p class="flex items-center gap-2.5 text-[10px] font-bold uppercase tracking-[0.25em] text-gold-500"><?= icon('clock', 'size-4') ?> Opening hours · All 7 days</p>
        <div class="mt-4 divide-y divide-white/5 text-sm">
          <?php foreach (SITE['hours'] as $s): ?>
            <p class="flex justify-between py-2.5"><span class="text-white/55"><?= e($s['name']) ?></span><span class="font-mono text-white/90"><?= $s['open'] ?> – <?= $s['close'] ?></span></p>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Form -->
    <div class="card relative p-7 shadow-2xl shadow-black/40 sm:p-10" data-reveal style="--d:150ms">
      <?php if ($sentName): ?>
        <div class="flex min-h-[420px] flex-col items-center justify-center text-center">
          <span class="grid size-16 place-items-center rounded-full bg-[#22a55b]/15 text-[#3ccf7a] ring-1 ring-[#22a55b]/40"><?= icon('check', 'size-7') ?></span>
          <h3 class="script mt-6 text-4xl">Thank you, <?= e(strtok($sentName, ' ')) ?>!</h3>
          <p class="mt-4 max-w-sm text-sm leading-7 text-white/55">Your message has reached our team. We'll get back to you shortly — usually within a few hours.</p>
          <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="index.php" class="btn btn-ghost">Back to Home</a>
            <a href="contact.php#form" class="btn btn-gold">Send Another</a>
          </div>
        </div>
      <?php else: ?>
        <p class="eyebrow"><?= icon('message', 'size-4') ?> Send a message</p>
        <h3 class="script mt-3 text-4xl">How can we help?</h3>

        <?php if (isset($errors['form'])): ?>
          <p class="mt-6 rounded-lg border border-crimson-500/40 bg-crimson-500/10 px-4 py-3 text-sm text-crimson-400"><?= e($errors['form']) ?></p>
        <?php endif; ?>

        <form method="post" action="contact.php#form" class="mt-8 grid gap-5 sm:grid-cols-2" <?= STATIC_EXPORT ? 'data-wa-form="New enquiry"' : 'novalidate' ?>>
          <?= csrf_field() ?>
          <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

          <div>
            <label for="c-name" class="label">Full name *</label>
            <input id="c-name" name="name" type="text" required autocomplete="name" value="<?= e($old['name']) ?>" class="field <?= isset($errors['name']) ? 'has-error' : '' ?>" placeholder="Your name">
            <?php if (isset($errors['name'])): ?><p class="error-text"><?= e($errors['name']) ?></p><?php endif; ?>
          </div>
          <div>
            <label for="c-phone" class="label">Phone *</label>
            <input id="c-phone" name="phone" type="tel" required autocomplete="tel" value="<?= e($old['phone']) ?>" class="field <?= isset($errors['phone']) ? 'has-error' : '' ?>" placeholder="+91 98xxx xxxxx">
            <?php if (isset($errors['phone'])): ?><p class="error-text"><?= e($errors['phone']) ?></p><?php endif; ?>
          </div>
          <div>
            <label for="c-email" class="label">Email</label>
            <input id="c-email" name="email" type="email" autocomplete="email" value="<?= e($old['email']) ?>" class="field <?= isset($errors['email']) ? 'has-error' : '' ?>" placeholder="you@example.com">
            <?php if (isset($errors['email'])): ?><p class="error-text"><?= e($errors['email']) ?></p><?php endif; ?>
          </div>
          <div>
            <label for="c-topic" class="label">Topic</label>
            <select id="c-topic" name="topic" class="field">
              <?php foreach ($topics as $t): ?>
                <option <?= $old['topic'] === $t ? 'selected' : '' ?>><?= e($t) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="sm:col-span-2">
            <label for="c-message" class="label">Message *</label>
            <textarea id="c-message" name="message" rows="5" required class="field resize-y <?= isset($errors['message']) ? 'has-error' : '' ?>" placeholder="Tell us about your event, order or question…"><?= e($old['message']) ?></textarea>
            <?php if (isset($errors['message'])): ?><p class="error-text"><?= e($errors['message']) ?></p><?php endif; ?>
          </div>
          <div class="flex flex-col gap-4 sm:col-span-2 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs text-white/35">We reply within a few hours during service.</p>
            <button type="submit" class="btn btn-gold">Send Message <?= icon('arrow-right', 'size-3.5') ?></button>
          </div>
        </form>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/visit.php'; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
