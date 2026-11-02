<?php
require __DIR__ . '/includes/bootstrap.php';

$page = 'home';
require __DIR__ . '/includes/header.php';

$signatures = signature_dishes();
?>

<!-- ============ HERO ============ -->
<section class="relative isolate flex min-h-[100svh] items-end overflow-hidden pt-32 pb-24 lg:items-center lg:pb-16">
  <img src="<?= img('hero-tandoori') ?>" alt="Tandoori chicken with naan and chutneys at Sarla" fetchpriority="high" class="animate-hero-zoom absolute inset-0 -z-20 size-full object-cover object-[65%_center]">
  <div class="absolute inset-0 -z-10 bg-linear-to-r from-ink-950/95 via-ink-950/75 to-ink-950/25"></div>
  <div class="absolute inset-x-0 bottom-0 -z-10 h-56 bg-linear-to-t from-ink-950 to-transparent"></div>

  <div class="mx-auto w-full max-w-[1400px] px-5 sm:px-8 lg:px-10">
    <div class="max-w-2xl">
      <p class="eyebrow eyebrow-line" data-reveal>Sector 62 · Noida · Indian Kitchen &amp; Bar</p>
      <h1 class="script mt-6 text-[3.3rem] sm:text-7xl lg:text-[5.6rem]" data-reveal style="--d:120ms">
        Flavours of India,<br><span class="text-gold-gradient">served with heart.</span>
      </h1>

      <div class="mt-9 flex flex-wrap items-center gap-2.5" data-reveal style="--d:240ms">
        <?php foreach ([['flame', 'Clay Tandoor'], ['glass', 'Full Bar'], ['party', 'Banquets'], ['briefcase', 'Executive Lunch']] as [$ic, $label]): ?>
          <span class="inline-flex items-center gap-2 rounded-md border border-white/10 bg-white/5 px-3 py-2 text-[10px] font-semibold uppercase tracking-[0.2em] text-white/80 backdrop-blur"><?= icon($ic, 'size-3.5 text-gold-400') ?><?= $label ?></span>
        <?php endforeach; ?>
      </div>

      <p class="mt-9 max-w-md border-l-2 border-gold-500/70 pl-4 text-xs font-semibold uppercase leading-relaxed tracking-[0.22em] text-white/70" data-reveal style="--d:320ms">
        Slow-cooked curries, smoky kebabs &amp; a warm welcome — every single day.
      </p>

      <div class="mt-10 flex flex-wrap items-center gap-3" data-reveal style="--d:400ms">
        <a href="book.php" class="btn btn-gold">Book a Table <?= icon('arrow-right', 'size-3.5') ?></a>
        <?= delivery_dropdown('btn btn-outline-gold') ?>
        <a href="menu.php" class="btn btn-maroon">Menu</a>
      </div>
    </div>
  </div>

  <a href="#promise" class="absolute right-8 bottom-10 hidden flex-col items-center gap-3 text-[10px] font-semibold tracking-[0.4em] text-white/50 transition hover:text-gold-400 lg:flex">
    SCROLL
    <span class="relative h-12 w-px overflow-hidden bg-white/15"><span class="animate-scroll-line absolute inset-x-0 top-0 h-1/2 bg-gold-500"></span></span>
  </a>
</section>

<!-- ============ THE SARLA PROMISE ============ -->
<section id="promise" class="relative bg-ink-950 py-24 lg:py-32">
  <div class="container-x">
    <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:gap-8">
      <p class="eyebrow shrink-0" data-reveal><?= icon('award', 'size-4') ?> The Sarla Promise</p>
      <span class="hidden h-px flex-1 bg-white/10 lg:block"></span>
      <h2 class="script text-4xl lg:text-5xl" data-reveal style="--d:100ms">Taste of Tradition</h2>
    </div>

    <div class="mt-16 grid gap-14 md:grid-cols-3 md:gap-0 md:divide-x md:divide-white/10">
      <div class="md:pr-10" data-reveal>
        <span class="grid size-14 place-items-center rounded-lg border border-gold-500/30 bg-gold-500/10 text-gold-400"><?= icon('flame', 'size-6') ?></span>
        <h3 class="mt-7 text-sm font-bold uppercase tracking-[0.2em] text-gold-400">Clay Tandoor</h3>
        <span class="mt-4 block h-px w-8 bg-white/20"></span>
        <p class="mt-5 text-sm leading-7 text-white/60">Kebabs, tikkas and breads fired fresh in a traditional charcoal tandoor — smoky at the edges, juicy at the heart, and never reheated.</p>
      </div>
      <div class="md:px-10" data-reveal style="--d:120ms">
        <span class="grid size-14 place-items-center rounded-lg bg-crimson-500 text-white shadow-lg shadow-crimson-700/40"><?= icon('chef', 'size-6') ?></span>
        <h3 class="mt-7 text-sm font-bold uppercase tracking-[0.2em] text-crimson-400">Family Recipes</h3>
        <span class="mt-4 block h-px w-8 bg-white/20"></span>
        <ul class="mt-5 space-y-2.5 text-sm text-white/60">
          <?php foreach (['Dal Makhani simmered overnight', 'Masalas roasted & ground in-house', 'No artificial colours, ever', 'Breads made to order, every order'] as $li): ?>
            <li class="flex gap-3"><span class="mt-2 size-1 shrink-0 rounded-full bg-crimson-400"></span><?= $li ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="md:pl-10" data-reveal style="--d:240ms">
        <span class="grid size-14 place-items-center rounded-lg border border-white/15 bg-white/5 text-white"><?= icon('glass', 'size-6') ?></span>
        <h3 class="mt-7 text-sm font-bold uppercase tracking-[0.2em] text-gold-400">Bar &amp; Banquet</h3>
        <span class="mt-4 block h-px w-8 bg-white/20"></span>
        <p class="mt-5 text-sm leading-7 text-white/60">A well-stocked bar to unwind after work, and an elegant banquet space for birthdays, kitty parties and corporate get-togethers.</p>
      </div>
    </div>

    <div class="relative mt-20 overflow-hidden border-t border-white/10 pt-8 [mask-image:linear-gradient(90deg,transparent,#000_10%,#000_90%,transparent)]">
      <div class="animate-marquee flex w-max gap-12 text-[10px] font-bold uppercase tracking-[0.3em] whitespace-nowrap text-white/35">
        <?php for ($r = 0; $r < 2; $r++): foreach (['Clay Tandoor', 'Dal Makhani', 'Dum Biryani', 'Butter Chicken', 'Full Bar', 'Banquets', 'Executive Lunch', 'Sector 62 Noida', 'Open 7 Days'] as $w): ?>
          <span class="flex items-center gap-12"><?= $w ?><span class="text-gold-500/60">✦</span></span>
        <?php endforeach; endfor; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ STORY PREVIEW ============ -->
<section class="bg-grid relative isolate overflow-hidden bg-forest-900 py-24 lg:py-32">
  <span aria-hidden="true" class="pointer-events-none absolute top-1/2 -right-16 -z-10 -translate-y-1/2 select-none font-script text-[16rem] leading-none text-white/[0.03] lg:text-[24rem]">Sarla</span>

  <div class="container-x grid grid-cols-1 items-center gap-20 lg:grid-cols-2 lg:gap-16">
    <div>
      <p class="eyebrow eyebrow-line text-white/50" data-reveal>From our kitchen to your table</p>
      <h2 class="script mt-6 text-5xl text-cream sm:text-6xl" data-reveal style="--d:100ms">Rooted in Tradition.<br>Served with Love.</h2>
      <div class="mt-8 space-y-5 text-[15px] leading-8 text-white/65" data-reveal style="--d:200ms">
        <p>Tucked inside Hotel Sarla Inn on Khora Road, Sarla is where Sector 62 comes to eat like it's home. Our recipes travel from the family kitchens of Punjab and Awadh — slow-cooked, generously spiced and finished with care.</p>
        <p>From quick working lunches for the offices next door to long family dinners and evening drinks at the bar, every plate leaves our kitchen the way we would serve it at home.</p>
      </div>

      <blockquote class="mt-9 border-l-2 border-crimson-500 pl-5" data-reveal>
        <p class="font-script text-2xl text-gold-400">“<?= e(SITE['quote']) ?>”</p>
        <footer class="mt-2 flex items-center gap-3 text-[10px] font-semibold uppercase tracking-[0.3em] text-white/40"><span class="h-px w-5 bg-crimson-500"></span>The Sarla Kitchen</footer>
      </blockquote>

      <div class="mt-10 grid gap-4 sm:grid-cols-2" data-reveal>
        <div class="rounded-xl border border-white/10 bg-white/[0.03] p-5">
          <div class="flex items-center gap-3">
            <span class="grid size-9 place-items-center rounded-full border border-gold-500/40 text-gold-400"><?= icon('bowl', 'size-4') ?></span>
            <h3 class="text-[11px] font-bold uppercase tracking-[0.2em] text-white">Dum Cooking</h3>
          </div>
          <p class="mt-3 text-[13px] leading-6 text-white/50">Biryanis and curries sealed and slow-cooked on a low flame, so every grain carries the full depth of its spices.</p>
        </div>
        <div class="rounded-xl border border-white/10 bg-white/[0.03] p-5">
          <div class="flex items-center gap-3">
            <span class="grid size-9 place-items-center rounded-full border border-gold-500/40 text-gold-400"><?= icon('leaf', 'size-4') ?></span>
            <h3 class="text-[11px] font-bold uppercase tracking-[0.2em] text-white">Fresh Masalas</h3>
          </div>
          <p class="mt-3 text-[13px] leading-6 text-white/50">Whole spices roasted and ground in-house every morning — no packaged mixes, just honest flavour.</p>
        </div>
      </div>

      <div class="mt-10 flex flex-wrap gap-3" data-reveal>
        <a href="book.php" class="btn btn-red">Book a Table <?= icon('arrow-right', 'size-3.5') ?></a>
        <a href="our-story.php" class="btn btn-ghost">Our Story</a>
      </div>
    </div>

    <div class="relative mx-auto w-full max-w-lg pb-10" data-reveal style="--d:150ms">
      <div class="relative ml-auto aspect-[4/5] w-[88%] overflow-hidden rounded-xl shadow-2xl shadow-black/50 ring-1 ring-white/10">
        <img src="<?= img('chef') ?>" alt="Chef plating a dish in the Sarla kitchen" loading="lazy" class="size-full object-cover">
        <div class="absolute inset-0 bg-linear-to-t from-forest-950/70 via-transparent to-transparent"></div>
      </div>

      <div class="absolute -top-7 right-2 grid size-24 place-items-center rounded-full bg-crimson-500 text-center shadow-xl ring-4 ring-forest-900">
        <span class="font-script text-4xl leading-none text-white">62</span>
        <span class="-mt-3 text-[8px] font-bold tracking-[0.3em] text-white/80">NOIDA</span>
      </div>

      <div class="absolute top-16 left-0 -rotate-6 rounded-sm bg-crimson-500 px-4 py-2.5 shadow-xl shadow-black/40">
        <p class="flex items-center gap-2 text-[9px] font-bold uppercase tracking-[0.25em] text-white/85"><?= icon('flame', 'size-3') ?> Fresh from the</p>
        <p class="font-script text-lg leading-tight text-white">Clay Tandoor</p>
      </div>

      <div class="absolute bottom-0 left-0 aspect-square w-[42%] overflow-hidden rounded-lg shadow-2xl shadow-black/60 ring-4 ring-forest-900">
        <img src="<?= img('paneer-tikka') ?>" alt="Paneer tikka sizzler" loading="lazy" class="size-full object-cover">
      </div>

      <div class="absolute right-[-6px] bottom-24 grid size-32 place-items-center rounded-full border border-gold-500/30 bg-forest-950/90 p-4 text-center backdrop-blur sm:-right-6 sm:size-36">
        <div>
          <p class="font-script text-[15px] leading-snug text-gold-300">“Atithi Devo Bhava”</p>
          <span class="mx-auto my-2 block h-px w-8 bg-gold-500/40"></span>
          <p class="text-[8px] font-semibold uppercase tracking-[0.25em] text-white/50">The guest is god</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ EXECUTIVE LUNCH ============ -->
<section class="relative bg-ink-900 py-24 lg:py-32">
  <div class="container-x grid grid-cols-1 items-center gap-14 lg:grid-cols-[1fr_1.05fr] lg:gap-20">
    <div>
      <p class="flex flex-wrap items-center gap-3 text-[11px] font-bold uppercase tracking-[0.25em]" data-reveal>
        <span class="inline-flex items-center gap-2 text-gold-500"><?= icon('clock', 'size-3.5') ?> Mon–Sat · <?= SITE['hours'][0]['open'] ?>–<?= SITE['hours'][0]['close'] ?></span>
        <span class="text-[10px] text-white/35">Last order <?= SITE['hours'][0]['last'] ?></span>
      </p>
      <h2 class="script mt-6 text-5xl sm:text-6xl lg:text-[4.2rem]" data-reveal style="--d:100ms">Executive lunch thali, right in Sector 62.</h2>
      <p class="mt-6 max-w-lg text-[15px] leading-8 text-white/65" data-reveal style="--d:200ms">
        Built for the Sector 62 office crowd — a complete North Indian thali with starter, dal, sabzi, rice, fresh rotis and dessert, served hot in under 20 minutes. Veg <span class="font-semibold text-gold-400">₹349</span> · Non-veg <span class="font-semibold text-gold-400">₹449</span>.
      </p>
      <div class="mt-9 flex flex-wrap gap-3" data-reveal style="--d:300ms">
        <a href="book.php?session=Lunch" class="btn btn-gold">Book Lunch <?= icon('calendar', 'size-3.5') ?></a>
        <a href="menu.php#thali" class="btn btn-ghost">View Thali Menu <?= icon('arrow-right', 'size-3.5') ?></a>
        <a href="<?= e(wa_href('Hi Sarla! I would like to order the executive lunch thali for our office.')) ?>" target="_blank" rel="noopener" class="btn btn-ghost"><?= icon('whatsapp', 'size-3.5') ?> Office Order</a>
      </div>
    </div>

    <div class="space-y-3">
      <?php foreach ([
          ['Starter', 'Hara bhara kebab or chicken tikka (2 pcs).'],
          ['Dal & Sabzi', 'Dal makhani with paneer butter masala, kadhai veg or butter chicken.'],
          ['Rice & Breads', 'Jeera rice with butter naan or tandoori roti, fresh off the tandoor.'],
          ['Meetha', 'Warm gulab jamun or chilled kesar phirni.'],
      ] as $i => [$h, $p]): ?>
        <article class="card group flex gap-5 p-6 transition duration-300 hover:border-gold-500/30 hover:bg-ink-700/80" data-reveal style="--d:<?= $i * 90 ?>ms">
          <span class="mt-1 text-gold-500/80"><?= icon('utensils', 'size-4') ?></span>
          <div class="flex-1">
            <h3 class="font-script text-2xl text-white"><?= $h ?></h3>
            <p class="mt-1 text-sm text-white/55"><?= $p ?></p>
          </div>
          <span class="font-mono text-lg font-bold text-white/80 transition group-hover:text-gold-400">0<?= $i + 1 ?></span>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ SIGNATURE DISHES ============ -->
<section class="relative border-t border-white/5 bg-ink-950 py-24 lg:py-32">
  <div class="container-x">
    <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
      <div>
        <p class="eyebrow eyebrow-line" data-reveal>Chef's signatures</p>
        <h2 class="script mt-5 text-5xl sm:text-6xl" data-reveal style="--d:100ms">Most loved at Sarla</h2>
      </div>
      <a href="menu.php" class="btn btn-ghost self-start sm:self-auto" data-reveal>Full Menu <?= icon('arrow-right', 'size-3.5') ?></a>
    </div>

    <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($signatures as $i => $dish): ?>
        <article class="card group overflow-hidden transition duration-500 hover:-translate-y-1 hover:border-gold-500/25" data-reveal style="--d:<?= ($i % 3) * 100 ?>ms">
          <div class="relative aspect-[4/3] overflow-hidden">
            <img src="<?= img($dish['img']) ?>" alt="<?= e($dish['name']) ?>" loading="lazy" class="size-full object-cover transition duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-linear-to-t from-ink-800 via-transparent to-transparent"></div>
            <div class="absolute top-4 left-4 flex gap-2 rounded bg-ink-950/75 backdrop-blur-sm"><?= dish_tags(array_slice($dish['tags'], 0, 1)) ?></div>
          </div>
          <div class="p-6 pt-4">
            <p class="text-[10px] font-semibold uppercase tracking-[0.25em] text-white/35"><?= e($dish['category']) ?></p>
            <div class="mt-2 flex items-start justify-between gap-4">
              <h3 class="font-script text-[1.7rem] leading-tight text-white"><?= e($dish['name']) ?></h3>
              <span class="mt-1.5 font-mono text-[15px] font-bold text-gold-400"><?= price($dish['price']) ?></span>
            </div>
            <p class="mt-2 text-sm leading-6 text-white/50"><?= e($dish['desc']) ?></p>
            <p class="mt-5 flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.2em] text-white/40"><?= veg_mark($dish['veg']) ?> <?= $dish['veg'] ? 'Vegetarian' : 'Non-Vegetarian' ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ SPACES: BAR & BANQUET ============ -->
<section class="bg-ink-950 pb-24 lg:pb-32">
  <div class="container-x grid grid-cols-1 gap-6 md:grid-cols-2">
    <?php foreach ([
        ['bar', 'The Bar', 'Unwind after work', 'Crafted cocktails, chilled beers, fine spirits and a bar-bites menu built for long conversations.', 'menu.php#drinks', 'See Drinks'],
        ['interior', 'Banquets', 'Celebrate with us', 'Birthdays, anniversaries, kitty parties and corporate events — with custom menus for 20 to 150 guests.', 'contact.php?topic=Banquet', 'Plan an Event'],
    ] as $i => [$im, $t, $k, $p, $href, $cta]): ?>
      <a href="<?= $href ?>" class="group relative isolate flex min-h-[420px] items-end overflow-hidden rounded-2xl p-8 ring-1 ring-white/10 lg:min-h-[480px] lg:p-10" data-reveal style="--d:<?= $i * 120 ?>ms">
        <img src="<?= img($im) ?>" alt="" loading="lazy" class="absolute inset-0 -z-20 size-full object-cover transition duration-1000 group-hover:scale-105">
        <div class="absolute inset-0 -z-10 bg-linear-to-t from-ink-950 via-ink-950/60 to-ink-950/10"></div>
        <div>
          <p class="eyebrow"><?= $k ?></p>
          <h3 class="script mt-3 text-5xl"><?= $t ?></h3>
          <p class="mt-4 max-w-sm text-sm leading-7 text-white/65"><?= $p ?></p>
          <span class="mt-6 inline-flex items-center gap-2 border-b border-gold-500/60 pb-1 text-[11px] font-bold uppercase tracking-[0.2em] text-gold-400 transition group-hover:gap-4"><?= $cta ?> <?= icon('arrow-right', 'size-3.5') ?></span>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<!-- ============ HOURS & VISIT ============ -->
<?php require __DIR__ . '/includes/visit.php'; ?>

<!-- ============ GALLERY ============ -->
<section class="overflow-hidden bg-ink-950 py-24 lg:py-32">
  <div class="container-x flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
    <div>
      <p class="text-[10px] font-semibold uppercase tracking-[0.3em] text-gold-600" data-reveal>Social media</p>
      <h2 class="script mt-3 text-5xl sm:text-6xl" data-reveal style="--d:100ms">Follow the<br>Journey</h2>
    </div>
    <a href="<?= e(SITE['instagram']) ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-3 self-start rounded-full border border-white/15 px-5 py-3 text-[11px] font-bold uppercase tracking-[0.2em] text-white transition hover:border-gold-500/60 sm:self-auto" data-reveal>
      <?= icon('instagram', 'size-4') ?> <?= e(SITE['instagram_handle']) ?> <?= icon('external', 'size-3 text-white/40') ?>
    </a>
  </div>

  <div class="mt-14 flex w-max animate-marquee gap-4 hover:[animation-play-state:paused]">
    <?php $gallery = ['chef', 'seekh-kebab', 'thali', 'whiskey', 'biryani', 'interior-dark', 'samosa', 'brass-curry', 'curry-spread'];
    for ($r = 0; $r < 2; $r++): foreach ($gallery as $g): ?>
      <a href="<?= e(SITE['instagram']) ?>" target="_blank" rel="noopener" class="block aspect-[4/5] w-56 shrink-0 overflow-hidden rounded-sm sm:w-72" <?= $r ? 'aria-hidden="true" tabindex="-1"' : '' ?>>
        <img src="<?= img($g) ?>" alt="" loading="lazy" class="size-full object-cover grayscale sepia-[.35] transition duration-700 hover:scale-105 hover:grayscale-0 hover:sepia-0">
      </a>
    <?php endforeach; endfor; ?>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
