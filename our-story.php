<?php
require __DIR__ . '/includes/bootstrap.php';

$page = 'story';
$title = 'Our Story — Sarla, Sector 62 Noida';
$description = 'The story of Sarla — a warm Indian kitchen, bar and banquet inside Hotel Sarla Inn, Sector 62 Noida.';
require __DIR__ . '/includes/header.php';

page_hero('Our story', 'A kitchen built<br>on <span class="text-gold-gradient">warmth.</span>', 'Sarla began with a simple idea: serve the kind of food we grew up eating, with the kind of hospitality we grew up with.', 'interior', 'Our Story');
?>

<!-- Intro -->
<section class="bg-ink-900 py-24 lg:py-32">
  <div class="container-x grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
    <div class="relative order-2 lg:order-1" data-reveal>
      <div class="grid grid-cols-5 grid-rows-6 gap-4">
        <div class="col-span-3 row-span-6 overflow-hidden rounded-xl ring-1 ring-white/10">
          <img src="<?= img('thali') ?>" alt="A traditional thali" loading="lazy" class="size-full min-h-[420px] object-cover">
        </div>
        <div class="col-span-2 row-span-3 overflow-hidden rounded-xl ring-1 ring-white/10">
          <img src="<?= img('curry-spread') ?>" alt="Curries and rice" loading="lazy" class="size-full object-cover">
        </div>
        <div class="col-span-2 row-span-3 grid place-items-center rounded-xl bg-crimson-500 p-5 text-center">
          <div>
            <p class="font-script text-5xl text-white">120+</p>
            <p class="mt-2 text-[9px] font-bold uppercase tracking-[0.25em] text-white/80">Dishes on our menu</p>
          </div>
        </div>
      </div>
    </div>

    <div class="order-1 lg:order-2">
      <p class="eyebrow eyebrow-line" data-reveal>Who we are</p>
      <h2 class="script mt-6 text-5xl sm:text-6xl" data-reveal style="--d:100ms">Home-style food, hotel-grade hospitality.</h2>
      <div class="mt-8 space-y-5 text-[15px] leading-8 text-white/65" data-reveal style="--d:200ms">
        <p>Sarla is the restaurant and bar of Hotel Sarla Inn on Khora Road, Sector 62 — a neighbourhood that never stops working. We wanted to give it a place to slow down: a warm room, a busy tandoor and food that tastes like someone cared.</p>
        <p>Our kitchen cooks the dishes North India loves most — dal makhani simmered overnight, butter chicken finished in white butter, biryani sealed on dum — alongside street-style chaat, South Indian favourites and Indo-Chinese for the cravings that won't wait.</p>
        <p>Whether you are a hotel guest, a team on a lunch break or a family out for Sunday dinner, you'll be welcomed the Indian way: <span class="font-semibold text-gold-400">Atithi Devo Bhava</span> — the guest is god.</p>
      </div>
    </div>
  </div>
</section>

<!-- Stats -->
<section class="border-y border-white/5 bg-ink-950 py-16">
  <div class="container-x grid grid-cols-2 gap-y-12 lg:grid-cols-4 lg:divide-x lg:divide-white/10">
    <?php foreach ([['120', '+', 'Dishes, cooked fresh'], ['25', '+', 'Tandoor specials'], ['150', '', 'Guest banquet capacity'], ['7', '', 'Days a week, lunch & dinner']] as $i => [$num, $suf, $label]): ?>
      <div class="text-center" data-reveal style="--d:<?= $i * 100 ?>ms">
        <p class="font-script text-5xl text-gold-gradient sm:text-6xl"><span data-count="<?= $num ?>"><?= $num ?></span><?= $suf ?></p>
        <p class="mt-3 text-[10px] font-bold uppercase tracking-[0.25em] text-white/45"><?= $label ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Philosophy -->
<section class="bg-grid relative isolate overflow-hidden bg-forest-900 py-24 lg:py-32">
  <span aria-hidden="true" class="pointer-events-none absolute -bottom-20 -left-10 -z-10 select-none font-script text-[18rem] leading-none text-white/[0.03]">Sarla</span>
  <div class="container-x">
    <div class="max-w-2xl">
      <p class="eyebrow eyebrow-line text-white/50" data-reveal>Our philosophy</p>
      <h2 class="script mt-6 text-5xl text-cream sm:text-6xl" data-reveal style="--d:100ms">Three things we never compromise on.</h2>
    </div>
    <div class="mt-16 grid gap-6 md:grid-cols-3">
      <?php foreach ([
          ['leaf', 'Fresh, every day', 'Vegetables bought every morning, paneer made fresh, breads rolled to order. If it is not fresh, it does not leave our kitchen.'],
          ['flame', 'Spices, ground in-house', 'We roast and grind our own garam masala, kitchen king and chaat masalas in small batches — that is where the flavour lives.'],
          ['heart', 'Hospitality first', 'Your water topped up before you ask, a kid-friendly tweak to a dish, a birthday dessert on the house. Small things, done every time.'],
      ] as $i => [$ic, $h, $p]): ?>
        <div class="rounded-xl border border-white/10 bg-white/[0.03] p-8 backdrop-blur" data-reveal style="--d:<?= $i * 120 ?>ms">
          <div class="flex items-center justify-between">
            <span class="grid size-12 place-items-center rounded-full border border-gold-500/40 text-gold-400"><?= icon($ic, 'size-5') ?></span>
            <span class="font-mono text-sm text-white/25">0<?= $i + 1 ?></span>
          </div>
          <h3 class="font-script mt-8 text-3xl text-white"><?= $h ?></h3>
          <p class="mt-4 text-sm leading-7 text-white/55"><?= $p ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Chef -->
<section class="bg-ink-900 py-24 lg:py-32">
  <div class="container-x grid grid-cols-1 items-center gap-16 lg:grid-cols-[1fr_1.1fr]">
    <div class="relative" data-reveal>
      <div class="aspect-[4/5] overflow-hidden rounded-xl ring-1 ring-white/10">
        <img src="<?= img('chef') ?>" alt="Head chef at Sarla" loading="lazy" class="size-full object-cover">
      </div>
      <div class="absolute -right-3 -bottom-6 rounded-lg bg-gold-500 px-6 py-4 text-ink-950 shadow-2xl sm:-right-8">
        <p class="text-[9px] font-bold uppercase tracking-[0.3em]">Head Chef</p>
        <p class="font-script text-2xl">Team Sarla</p>
      </div>
    </div>
    <div>
      <p class="eyebrow eyebrow-line" data-reveal>From the kitchen</p>
      <blockquote class="mt-8" data-reveal style="--d:100ms">
        <p class="font-script text-4xl leading-tight text-white sm:text-5xl">“A dal that has cooked all night tastes different. Guests can't always say why — but they always come back.”</p>
      </blockquote>
      <p class="mt-8 text-[15px] leading-8 text-white/60" data-reveal style="--d:200ms">Our chefs bring years of experience from the kitchens of North India. Their rule is simple: cook every dish the long way. Marinades rest overnight, gravies are built from scratch and the tandoor is fired up before the first guest walks in.</p>
      <div class="mt-10 flex flex-wrap gap-3" data-reveal style="--d:300ms">
        <a href="menu.php" class="btn btn-gold">Explore the Menu <?= icon('arrow-right', 'size-3.5') ?></a>
        <a href="book.php" class="btn btn-ghost">Book a Table</a>
      </div>
    </div>
  </div>
</section>

<!-- Spaces -->
<section class="border-t border-white/5 bg-ink-950 py-24 lg:py-32">
  <div class="container-x">
    <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
      <div>
        <p class="eyebrow eyebrow-line" data-reveal>Our spaces</p>
        <h2 class="script mt-5 text-5xl sm:text-6xl" data-reveal style="--d:100ms">One address, three moods.</h2>
      </div>
    </div>
    <div class="mt-14 grid gap-6 lg:grid-cols-3">
      <?php foreach ([
          ['interior-dark', 'The Restaurant', 'Warm lighting, comfortable seating and an open view of the tandoor. Perfect for family dinners and long lunches.'],
          ['whiskey', 'The Bar', 'A relaxed corner for after-work drinks — cocktails, beers and fine spirits paired with kebabs and bar bites.'],
          ['fine-dining', 'The Banquet', 'A private hall for 20–150 guests with custom menus, décor support and dedicated service for your celebration.'],
      ] as $i => [$im, $h, $p]): ?>
        <article class="card group overflow-hidden" data-reveal style="--d:<?= $i * 120 ?>ms">
          <div class="aspect-[4/3] overflow-hidden">
            <img src="<?= img($im) ?>" alt="<?= $h ?>" loading="lazy" class="size-full object-cover transition duration-700 group-hover:scale-105">
          </div>
          <div class="p-7">
            <h3 class="font-script text-3xl text-white"><?= $h ?></h3>
            <p class="mt-3 text-sm leading-7 text-white/55"><?= $p ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php cta_band(); ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
