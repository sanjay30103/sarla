<?php
require __DIR__ . '/includes/bootstrap.php';

$slots = time_slots();
$occasions = ['None', 'Birthday', 'Anniversary', 'Business meal', 'Date night', 'Family get-together'];
$today = date('Y-m-d');
$maxDate = date('Y-m-d', strtotime('+90 days'));

$errors = [];
$old = ['name' => '', 'phone' => '', 'email' => '', 'date' => $today, 'time' => '', 'guests' => '2', 'occasion' => 'None', 'notes' => ''];

// Pre-select the first lunch slot when arriving from "Book Lunch".
if (($_GET['session'] ?? '') !== '' && isset($slots[$_GET['session']])) {
    $old['time'] = array_key_first($slots[$_GET['session']]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $k => $_) {
        $old[$k] = trim((string) ($_POST[$k] ?? ''));
    }

    $validTimes = array_merge(...array_values(array_map('array_keys', $slots)));

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
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $old['date']) || $old['date'] < $today || $old['date'] > $maxDate) {
        $errors['date'] = 'Please pick a date within the next 90 days.';
    }
    if (!in_array($old['time'], $validTimes, true)) {
        $errors['time'] = 'Please choose a time slot.';
    } elseif ($old['date'] === $today && $old['time'] <= date('H:i')) {
        $errors['time'] = 'That time has already passed today.';
    }
    if (!ctype_digit($old['guests']) || (int) $old['guests'] < 1 || (int) $old['guests'] > 20) {
        $errors['guests'] = 'Please choose the number of guests.';
    }
    if (!in_array($old['occasion'], $occasions, true)) {
        $old['occasion'] = 'None';
    }

    if (!$errors) {
        $ref = 'SRL-' . strtoupper(bin2hex(random_bytes(3)));
        store_csv('bookings.csv', [date('Y-m-d H:i:s'), $ref, $old['name'], $old['phone'], $old['email'], $old['date'], $old['time'], $old['guests'], $old['occasion'], $old['notes']]);
        flash('booking', $old + ['ref' => $ref]);
        header('Location: book.php?confirmed=1');
        exit;
    }
}

$booking = flash('booking');

$page = 'book';
$title = 'Book a Table — Sarla, Sector 62 Noida';
$description = 'Reserve your table at Sarla, Sector 62 Noida — lunch and dinner, all 7 days.';
require __DIR__ . '/includes/header.php';

page_hero('Reservations', 'Book a <span class="text-gold-gradient">Table</span>', 'Lunch with the team or dinner with family — reserve in under a minute and we will have your table ready.', 'fine-dining', 'Book a Table');
?>

<section class="bg-ink-900 py-20 lg:py-28">
  <div class="container-x grid grid-cols-1 gap-10 lg:grid-cols-[1.25fr_0.75fr] lg:gap-14">

    <div class="card p-7 shadow-2xl shadow-black/40 sm:p-10" data-reveal>
      <?php if ($booking):
        $when = date('l, j F Y', strtotime($booking['date'])) . ' at ' . date('g:i A', strtotime($booking['time']));
        $waText = "Hi Sarla! I just booked a table.\nRef: {$booking['ref']}\nName: {$booking['name']}\nWhen: {$when}\nGuests: {$booking['guests']}";
      ?>
        <div class="text-center">
          <span class="mx-auto grid size-16 place-items-center rounded-full bg-[#22a55b]/15 text-[#3ccf7a] ring-1 ring-[#22a55b]/40"><?= icon('check', 'size-7') ?></span>
          <p class="mt-6 text-[10px] font-bold uppercase tracking-[0.3em] text-gold-500">Request received</p>
          <h2 class="script mt-3 text-4xl sm:text-5xl">See you soon, <?= e(strtok($booking['name'], ' ')) ?>!</h2>
          <p class="mx-auto mt-4 max-w-md text-sm leading-7 text-white/55">Our team will call you on <span class="text-white"><?= e($booking['phone']) ?></span> to confirm. For instant confirmation, send it to us on WhatsApp.</p>
        </div>

        <dl class="mt-10 grid gap-px overflow-hidden rounded-xl border border-white/10 bg-white/10 sm:grid-cols-2">
          <?php foreach ([['Reference', $booking['ref']], ['Guests', $booking['guests'] . ' ' . ((int) $booking['guests'] === 1 ? 'guest' : 'guests')], ['Date', date('D, j M Y', strtotime($booking['date']))], ['Time', date('g:i A', strtotime($booking['time']))]] as [$k, $v]): ?>
            <div class="bg-ink-800 p-5">
              <dt class="text-[10px] font-bold uppercase tracking-[0.25em] text-white/40"><?= $k ?></dt>
              <dd class="mt-1.5 font-mono text-lg font-bold text-white"><?= e($v) ?></dd>
            </div>
          <?php endforeach; ?>
        </dl>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
          <a href="<?= e(wa_href($waText)) ?>" target="_blank" rel="noopener" class="btn flex-1 bg-[#25D366] text-white hover:bg-[#1fbe5a]"><?= icon('whatsapp', 'size-4') ?> Confirm on WhatsApp</a>
          <a href="book.php" class="btn btn-ghost flex-1">New Booking</a>
        </div>
      <?php else: ?>
        <p class="eyebrow"><?= icon('calendar', 'size-4') ?> Reserve your table</p>
        <h2 class="script mt-3 text-4xl sm:text-5xl">Your details</h2>

        <?php if (isset($errors['form'])): ?>
          <p class="mt-6 rounded-lg border border-crimson-500/40 bg-crimson-500/10 px-4 py-3 text-sm text-crimson-400"><?= e($errors['form']) ?></p>
        <?php endif; ?>

        <form method="post" action="book.php" class="mt-8 grid gap-5 sm:grid-cols-2" <?= STATIC_EXPORT ? 'data-wa-form="Table booking request"' : 'novalidate' ?>>
          <?= csrf_field() ?>
          <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true">

          <div>
            <label for="b-date" class="label">Date *</label>
            <input id="b-date" name="date" type="date" required min="<?= $today ?>" max="<?= $maxDate ?>" value="<?= e($old['date']) ?>" class="field [color-scheme:dark] <?= isset($errors['date']) ? 'has-error' : '' ?>">
            <?php if (isset($errors['date'])): ?><p class="error-text"><?= e($errors['date']) ?></p><?php endif; ?>
          </div>
          <div>
            <label for="b-time" class="label">Time *</label>
            <select id="b-time" name="time" required class="field <?= isset($errors['time']) ? 'has-error' : '' ?>">
              <option value="">Select a time</option>
              <?php foreach ($slots as $session => $times): ?>
                <optgroup label="<?= e($session) ?>">
                  <?php foreach ($times as $value => $label): ?>
                    <option value="<?= $value ?>" <?= $old['time'] === $value ? 'selected' : '' ?>><?= $label ?></option>
                  <?php endforeach; ?>
                </optgroup>
              <?php endforeach; ?>
            </select>
            <?php if (isset($errors['time'])): ?><p class="error-text"><?= e($errors['time']) ?></p><?php endif; ?>
          </div>

          <div class="sm:col-span-2">
            <span class="label">Guests *</span>
            <div class="grid grid-cols-5 gap-2 sm:grid-cols-10">
              <?php for ($g = 1; $g <= 10; $g++): ?>
                <label class="cursor-pointer">
                  <input type="radio" name="guests" value="<?= $g ?>" class="peer sr-only" <?= $old['guests'] === (string) $g ? 'checked' : '' ?>>
                  <span class="grid h-11 place-items-center rounded-lg border border-white/10 bg-ink-900/80 font-mono text-sm text-white/70 transition peer-checked:border-gold-500 peer-checked:bg-gold-500 peer-checked:font-bold peer-checked:text-ink-950 peer-focus-visible:ring-2 peer-focus-visible:ring-gold-500/40 hover:border-gold-500/50"><?= $g ?></span>
                </label>
              <?php endfor; ?>
            </div>
            <p class="mt-2 text-xs text-white/35">More than 10? Pick 10 and mention the count in the notes, or <a href="contact.php?topic=Banquet" class="text-gold-400 underline-offset-4 hover:underline">enquire about banquets</a>.</p>
            <?php if (isset($errors['guests'])): ?><p class="error-text"><?= e($errors['guests']) ?></p><?php endif; ?>
          </div>

          <div>
            <label for="b-name" class="label">Full name *</label>
            <input id="b-name" name="name" type="text" required autocomplete="name" value="<?= e($old['name']) ?>" class="field <?= isset($errors['name']) ? 'has-error' : '' ?>" placeholder="Your name">
            <?php if (isset($errors['name'])): ?><p class="error-text"><?= e($errors['name']) ?></p><?php endif; ?>
          </div>
          <div>
            <label for="b-phone" class="label">Phone *</label>
            <input id="b-phone" name="phone" type="tel" required autocomplete="tel" value="<?= e($old['phone']) ?>" class="field <?= isset($errors['phone']) ? 'has-error' : '' ?>" placeholder="+91 98xxx xxxxx">
            <?php if (isset($errors['phone'])): ?><p class="error-text"><?= e($errors['phone']) ?></p><?php endif; ?>
          </div>
          <div>
            <label for="b-email" class="label">Email</label>
            <input id="b-email" name="email" type="email" autocomplete="email" value="<?= e($old['email']) ?>" class="field <?= isset($errors['email']) ? 'has-error' : '' ?>" placeholder="you@example.com">
            <?php if (isset($errors['email'])): ?><p class="error-text"><?= e($errors['email']) ?></p><?php endif; ?>
          </div>
          <div>
            <label for="b-occasion" class="label">Occasion</label>
            <select id="b-occasion" name="occasion" class="field">
              <?php foreach ($occasions as $o): ?>
                <option <?= $old['occasion'] === $o ? 'selected' : '' ?>><?= e($o) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="sm:col-span-2">
            <label for="b-notes" class="label">Special requests</label>
            <textarea id="b-notes" name="notes" rows="3" class="field resize-y" placeholder="High chair, window seat, allergies, cake arrangement…"><?= e($old['notes']) ?></textarea>
          </div>

          <div class="flex flex-col gap-4 sm:col-span-2 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs text-white/35">We'll call to confirm within 30 minutes during service hours.</p>
            <button type="submit" class="btn btn-gold">Request Booking <?= icon('arrow-right', 'size-3.5') ?></button>
          </div>
        </form>
      <?php endif; ?>
    </div>

    <!-- Side info -->
    <aside class="space-y-5">
      <div class="card p-7" data-reveal style="--d:100ms">
        <p class="flex items-center gap-2.5 text-[10px] font-bold uppercase tracking-[0.25em] text-gold-500"><?= icon('clock', 'size-4') ?> Hours · All 7 days</p>
        <div class="mt-5 space-y-5">
          <?php foreach (SITE['hours'] as $s): ?>
            <div>
              <p class="text-[10px] font-bold uppercase tracking-[0.25em] text-white/40"><?= e($s['name']) ?></p>
              <p class="mt-1 font-mono text-2xl font-bold text-white"><?= $s['open'] ?> – <?= $s['close'] ?></p>
              <p class="text-xs text-white/35">Last order <?= $s['last'] ?></p>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="mt-6 rounded-lg border p-4" data-status data-state="open">
          <p class="flex items-center gap-2.5 text-[11px] font-extrabold uppercase tracking-[0.2em]"><span class="status-dot size-2 rounded-full"></span><span data-status-label>Open</span><span class="ml-auto font-mono text-white/60" data-clock>--:--</span></p>
          <p class="mt-1 text-xs text-white/45" data-status-text>&nbsp;</p>
        </div>
      </div>

      <div class="card p-7" data-reveal style="--d:200ms">
        <p class="flex items-center gap-2.5 text-[10px] font-bold uppercase tracking-[0.25em] text-gold-500"><?= icon('sparkle', 'size-4') ?> Good to know</p>
        <ul class="mt-5 space-y-3.5 text-sm leading-6 text-white/60">
          <?php foreach (['Tables are held for 15 minutes past your booking time.', 'Celebrating? Tell us — we will arrange a cake or décor.', 'Groups above 20 — use our banquet hall for a private experience.', 'Valet parking available for hotel & restaurant guests.'] as $tip): ?>
            <li class="flex gap-3"><?= icon('check', 'size-4 mt-1 shrink-0 text-gold-500') ?><?= $tip ?></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <a href="<?= e(tel_href()) ?>" class="card group flex items-center gap-4 p-6 transition hover:border-gold-500/30" data-reveal style="--d:300ms">
        <span class="grid size-12 place-items-center rounded-full bg-gold-500 text-ink-950"><?= icon('phone', 'size-5') ?></span>
        <span>
          <span class="block text-[10px] font-bold uppercase tracking-[0.25em] text-white/40">Prefer to call?</span>
          <span class="mt-1 block font-mono text-lg font-bold text-white group-hover:text-gold-400"><?= e(SITE['phone']) ?></span>
        </span>
      </a>
    </aside>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
