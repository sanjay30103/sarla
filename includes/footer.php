</main>

<footer class="relative isolate overflow-hidden bg-black pt-24 pb-28 sm:pb-10">
  <span aria-hidden="true" class="pointer-events-none absolute inset-x-0 -bottom-[0.18em] -z-10 select-none text-center font-script text-[34vw] leading-none text-white/[0.025] sm:text-[24vw]">Sarla</span>

  <div class="container-x text-center">
    <a href="index.php" class="inline-block" aria-label="Sarla — home"><?= logo('lg') ?></a>
    <p class="mt-6 text-[11px] font-medium uppercase tracking-[0.45em] text-white/40"><?= e(SITE['tagline']) ?></p>
    <p class="mx-auto mt-8 max-w-xl text-sm font-bold uppercase leading-7 tracking-[0.2em] text-white/70">“<?= e(SITE['quote']) ?>”</p>

    <nav class="mt-12 flex flex-wrap items-center justify-center gap-x-8 gap-y-3 text-[11px] font-bold uppercase tracking-[0.2em] text-white/60" aria-label="Footer">
      <?php foreach (nav_items() as [$label, $href]): ?>
        <a href="<?= $href ?>" class="transition hover:text-gold-400"><?= e($label) ?></a>
      <?php endforeach; ?>
      <a href="menu.php#thali" class="transition hover:text-gold-400">Executive Lunch</a>
      <a href="contact.php?topic=Banquet" class="transition hover:text-gold-400">Banquets</a>
    </nav>
    <div class="mt-5 flex flex-wrap items-center justify-center gap-x-8 gap-y-3 text-[11px] font-bold uppercase tracking-[0.2em]">
      <a href="book.php" class="border-b border-gold-500 pb-1 text-gold-500 transition hover:text-gold-300">Book a Table</a>
      <a href="<?= e(SITE['instagram']) ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-white/60 transition hover:text-white"><?= icon('instagram', 'size-3.5') ?> Instagram</a>
      <a href="<?= e(SITE['facebook']) ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-white/60 transition hover:text-white"><?= icon('facebook', 'size-3.5') ?> Facebook</a>
      <a href="<?= e(wa_href()) ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-2 text-white/60 transition hover:text-white"><?= icon('whatsapp', 'size-3.5') ?> WhatsApp</a>
    </div>

    <div class="mt-12 space-y-3 text-xs text-white/45">
      <p class="flex items-center justify-center gap-2"><?= icon('map-pin', 'size-3.5 shrink-0') ?> <?= e(implode(', ', SITE['address'])) ?></p>
      <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-white/60">Open daily · <?= e(hours_summary()) ?></p>
      <p class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2">
        <a href="<?= e(tel_href()) ?>" class="inline-flex items-center gap-2 transition hover:text-gold-400"><?= icon('phone', 'size-3.5') ?> <?= e(SITE['phone']) ?></a>
        <a href="mailto:<?= e(SITE['email']) ?>" class="inline-flex items-center gap-2 break-all transition hover:text-gold-400"><?= icon('mail', 'size-3.5') ?> <?= e(SITE['email']) ?></a>
      </p>
    </div>

    <div class="mx-auto mt-14 flex max-w-3xl flex-col items-center justify-between gap-3 border-t border-white/10 pt-8 text-[10px] font-semibold uppercase tracking-[0.25em] text-white/35 sm:flex-row">
      <p>© <?= date('Y') ?> Sarla · Hotel Sarla Inn, Noida</p>
      <p>Design by <span class="text-white/55"><?= e(SITE['credit']) ?></span></p>
    </div>
  </div>
</footer>

<!-- Floating: WhatsApp -->
<a href="<?= e(wa_href()) ?>" target="_blank" rel="noopener" class="group fixed bottom-5 left-4 z-40 flex items-center gap-3 rounded-full border border-white/10 bg-ink-950/90 p-1.5 shadow-2xl shadow-black/60 backdrop-blur transition hover:border-[#25D366]/50 sm:left-6 sm:pr-6" aria-label="Chat with us on WhatsApp">
  <span class="grid size-11 place-items-center rounded-full bg-[#25D366] text-white transition group-hover:scale-105"><?= icon('whatsapp', 'size-5') ?></span>
  <span class="hidden leading-tight sm:block">
    <span class="block text-[9px] font-bold uppercase tracking-[0.25em] text-gold-500">Chat with us</span>
    <span class="block text-xs font-extrabold uppercase tracking-[0.12em] text-white">On WhatsApp</span>
  </span>
</a>

<?php if ($page !== 'book'): ?>
<!-- Floating: rotating Book-a-Table badge -->
<a href="book.php" class="group fixed right-3 bottom-3 z-40 size-24 sm:right-6 sm:bottom-6 sm:size-28" aria-label="Book a table">
  <svg viewBox="0 0 100 100" class="animate-spin-slow absolute inset-0 size-full rounded-full bg-ink-950/85 shadow-2xl shadow-black/60 backdrop-blur" aria-hidden="true">
    <defs><path id="badge-circle" d="M50,50 m-38,0 a38,38 0 1,1 76,0 a38,38 0 1,1 -76,0"/></defs>
    <text fill="#c9a35c" font-family="Montserrat, sans-serif" font-size="7.4" font-weight="700" letter-spacing="1.6">
      <textPath href="#badge-circle" textLength="236">OPEN 7 DAYS • <?= e(hours_summary(' • ')) ?> •</textPath>
    </text>
  </svg>
  <span class="absolute inset-[24%] grid place-items-center rounded-full bg-gold-500 text-center text-ink-950 shadow-lg transition group-hover:scale-105 group-hover:bg-gold-400">
    <span class="flex flex-col items-center gap-0.5 text-[7px] font-extrabold uppercase leading-tight tracking-[0.12em] sm:text-[8px]"><?= icon('calendar', 'size-3.5') ?>Book a<br>Table</span>
  </span>
</a>
<?php endif; ?>

<script>window.SARLA = <?= json_encode(['hours' => SITE['hours'], 'whatsapp' => SITE['whatsapp']], JSON_UNESCAPED_SLASHES) ?>;</script>
<script src="<?= asset('assets/js/main.js') ?>" defer></script>
</body>
</html>
