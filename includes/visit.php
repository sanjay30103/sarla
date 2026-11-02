<section class="border-t border-white/5 bg-ink-900 py-24 lg:py-32">
  <div class="container-x">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_260px]">
      <!-- Opening hours -->
      <div class="card p-7 shadow-2xl shadow-black/40 sm:p-10" data-reveal>
        <div class="flex items-center justify-between gap-4">
          <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-gold-600">Opening hours</p>
          <span class="rounded border border-white/10 bg-white/5 px-2.5 py-1 text-[9px] font-bold uppercase tracking-[0.2em] text-white/50">All 7 days</span>
        </div>

        <?php foreach (SITE['hours'] as $s): ?>
          <div class="mt-8 border-b border-white/5 pb-8">
            <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-white/45"><?= e($s['name']) ?> session</p>
            <p class="mt-3 flex items-center gap-4 font-mono text-5xl font-bold text-white/90 sm:gap-8 sm:text-6xl lg:text-7xl">
              <?= $s['open'] ?> <span class="h-px w-6 bg-white/20 sm:w-10"></span> <?= $s['close'] ?>
            </p>
          </div>
        <?php endforeach; ?>

        <div class="mt-7">
          <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-gold-600">Last order</p>
          <p class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2 text-[10px] font-bold uppercase tracking-[0.2em] text-white/45">
            <span>Lunch <span class="ml-1 font-mono text-sm text-gold-400"><?= SITE['hours'][0]['last'] ?></span></span>
            <span class="text-white/20">·</span>
            <span>Dinner <span class="ml-1 font-mono text-sm text-gold-400"><?= SITE['hours'][1]['last'] ?></span></span>
            <span class="text-white/20">·</span>
            <span>Bar <span class="ml-1 font-mono text-sm text-gold-400"><?= SITE['bar_last_order'] ?></span></span>
          </p>
        </div>
      </div>

      <!-- Live status -->
      <div class="flex flex-col gap-5" data-reveal style="--d:120ms">
        <div>
          <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-white/40">Now in Noida</p>
          <p class="mt-2 font-mono text-5xl font-bold text-white" data-clock>--:--</p>
        </div>
        <div class="rounded-xl border p-5" data-status data-state="open">
          <p class="text-[9px] font-bold uppercase tracking-[0.3em] text-white/45">Kitchen status</p>
          <p class="mt-3 flex items-center gap-2.5 text-xs font-extrabold uppercase tracking-[0.2em]"><span class="status-dot size-2 rounded-full"></span><span data-status-label>Open</span></p>
          <p class="mt-1.5 text-xs text-white/45" data-status-text>&nbsp;</p>
        </div>
        <a href="book.php" class="btn btn-gold mt-auto w-full">Reserve Now <?= icon('arrow-right', 'size-3.5') ?></a>
      </div>
    </div>

    <div class="my-16 h-px bg-white/10"></div>

    <!-- Info cards -->
    <div class="grid gap-5 md:grid-cols-3">
      <div class="card p-7" data-reveal>
        <p class="flex items-center gap-2.5 text-[11px] font-bold uppercase tracking-[0.25em] text-gold-500"><?= icon('users', 'size-4') ?> Walk-ins welcome</p>
        <p class="mt-5 text-sm leading-7 text-white/60">We keep a few tables free for walk-ins every service. Weekend evenings fill quickly — reserve ahead for groups or a window table.</p>
      </div>
      <div class="card p-7" data-reveal style="--d:100ms">
        <p class="flex items-center gap-2.5 text-[11px] font-bold uppercase tracking-[0.25em] text-gold-500"><?= icon('map-pin', 'size-4') ?> Location</p>
        <p class="mt-5 text-sm leading-7 text-white/80"><?= implode('<br>', array_map('e', SITE['address'])) ?></p>
        <p class="mt-3 text-[10px] font-semibold uppercase tracking-[0.2em] text-white/35"><?= e(SITE['landmark']) ?></p>
        <div class="mt-5 space-y-2 text-[11px] font-bold uppercase tracking-[0.2em]">
          <a href="<?= e(maps_directions()) ?>" target="_blank" rel="noopener" class="flex items-center gap-2 text-gold-500 transition hover:text-gold-300">Get directions <?= icon('external', 'size-3') ?></a>
          <a href="<?= e(tel_href()) ?>" class="flex items-center gap-2 text-gold-500 transition hover:text-gold-300"><?= icon('phone', 'size-3') ?> <?= e(SITE['phone']) ?></a>
        </div>
      </div>
      <div class="card flex flex-col p-7" data-reveal style="--d:200ms">
        <p class="flex items-center gap-2.5 text-[11px] font-bold uppercase tracking-[0.25em] text-gold-500"><?= icon('calendar', 'size-4') ?> Reservations</p>
        <p class="mt-5 text-sm leading-7 text-white/60">Reserve your table online in under a minute. For parties above 20 guests, talk to our banquet team.</p>
        <a href="book.php" class="btn btn-gold mt-6 w-full justify-between sm:mt-auto">Book a Table <?= icon('arrow-right', 'size-3.5') ?></a>
      </div>
    </div>

    <!-- Map -->
    <div class="relative mt-16 overflow-hidden rounded-2xl shadow-2xl shadow-black/50 ring-1 ring-white/10" data-reveal>
      <iframe src="<?= e(maps_embed()) ?>" title="Map to Sarla, Sector 62 Noida" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="block h-[380px] w-full border-0 [filter:grayscale(1)_invert(0.9)_contrast(0.9)] lg:h-[440px]"></iframe>
      <div class="pointer-events-none absolute inset-x-0 bottom-0 h-40 bg-linear-to-t from-ink-950/95 to-transparent"></div>
      <div class="absolute inset-x-5 bottom-5 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-end">
        <div>
          <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-white/60">Sarla · Sector 62, Noida</p>
          <p class="mt-1 text-xs text-white/50"><?= e(SITE['address'][0]) ?></p>
        </div>
        <a href="<?= e(maps_directions()) ?>" target="_blank" rel="noopener" class="btn btn-sm border border-white/15 bg-ink-950/80 text-white backdrop-blur hover:border-gold-500/60">Get Directions <?= icon('external', 'size-3') ?></a>
      </div>
    </div>
  </div>
</section>
