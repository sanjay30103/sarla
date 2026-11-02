<?php
/** @var string $page  @var string $title  @var string $description */
$title ??= SITE['title'];
$description ??= 'Sarla is an Indian kitchen & bar in Sector 62, Noida — clay-tandoor kebabs, slow-cooked curries, dum biryani, executive lunch thalis and banquets.';
?>
<!doctype html>
<html lang="en" class="scroll-pt-24">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <title><?= e($title) ?></title>
  <meta name="description" content="<?= e($description) ?>">
  <meta name="theme-color" content="#0a0a0a">
  <meta property="og:title" content="<?= e($title) ?>">
  <meta property="og:description" content="<?= e($description) ?>">
  <meta property="og:type" content="restaurant">
  <meta property="og:image" content="<?= img('hero-tandoori') ?>">
  <link rel="icon" href="<?= asset('assets/img/favicon.svg') ?>" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=JetBrains+Mono:wght@500;700&family=Lobster&family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
  <script>document.documentElement.classList.add('js')</script>
</head>
<body class="min-h-screen overflow-x-hidden">

<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] focus:rounded focus:bg-gold-500 focus:px-4 focus:py-2 focus:text-ink-950">Skip to content</a>

<header id="site-header" class="site-header fixed inset-x-0 top-0 z-50">
  <div class="mx-auto flex h-16 max-w-[1400px] items-center gap-6 px-5 sm:px-8 lg:h-24 lg:px-10">
    <a href="index.php" class="shrink-0" aria-label="Sarla — home"><?= logo('md') ?></a>

    <span class="hidden h-12 w-px bg-white/10 lg:block"></span>

    <nav class="hidden flex-1 items-center justify-center gap-8 lg:flex xl:gap-10" aria-label="Main">
      <?php foreach (nav_items() as $key => [$label, $href]): ?>
        <a href="<?= $href ?>" class="nav-link <?= $page === $key ? 'is-active' : '' ?>" <?= $page === $key ? 'aria-current="page"' : '' ?>><?= e($label) ?></a>
      <?php endforeach; ?>
    </nav>

    <span class="hidden h-8 w-px bg-white/10 lg:block"></span>

    <div class="ml-auto flex items-center gap-3 lg:ml-0">
      <div class="hidden md:block"><?= delivery_dropdown('btn btn-sm btn-outline-gold', 'right-0') ?></div>
      <a href="book.php" class="btn btn-sm btn-gold hidden sm:inline-flex">Book a Table</a>
      <button type="button" class="grid size-11 place-items-center rounded-full border border-white/15 text-gold-400 transition hover:border-gold-500/60 lg:hidden" data-menu-toggle aria-controls="mobile-menu" aria-expanded="false" aria-label="Open menu">
        <?= icon('menu', 'size-5') ?>
      </button>
    </div>
  </div>
</header>

<!-- Mobile menu -->
<div id="mobile-menu" class="mobile-menu fixed inset-0 z-[60] flex flex-col overflow-y-auto bg-ink-950/98 backdrop-blur-xl lg:hidden" role="dialog" aria-modal="true" aria-label="Menu">
  <span aria-hidden="true" class="pointer-events-none absolute -bottom-10 -right-6 select-none font-script text-[11rem] leading-none text-white/[0.03]">Sarla</span>
  <div class="flex h-16 items-center justify-between px-5 sm:px-8">
    <a href="index.php"><?= logo('sm') ?></a>
    <button type="button" class="grid size-11 place-items-center rounded-full border border-white/15 text-white" data-menu-toggle aria-label="Close menu"><?= icon('x', 'size-5') ?></button>
  </div>
  <nav class="flex flex-1 flex-col justify-center gap-2 px-8 py-10" aria-label="Mobile">
    <?php $i = 0; foreach (nav_items() as $key => [$label, $href]): $i++; ?>
      <a href="<?= $href ?>" class="mm-item group flex items-baseline gap-5 py-2" style="--i:<?= $i ?>">
        <span class="font-mono text-xs text-gold-500/70">0<?= $i ?></span>
        <span class="font-script text-5xl <?= $page === $key ? 'text-gold-400' : 'text-white' ?> transition group-hover:text-gold-300"><?= e($label) ?></span>
      </a>
    <?php endforeach; ?>
  </nav>
  <div class="mm-item space-y-3 px-8 pb-6" style="--i:5">
    <a href="book.php" class="btn btn-gold w-full"><?= icon('calendar', 'size-4') ?> Book a Table</a>
    <div class="grid grid-cols-2 gap-3">
      <?php foreach (SITE['delivery'] as $d): ?>
        <a href="<?= e($d['url']) ?>" target="_blank" rel="noopener" class="btn btn-ghost"><span class="size-2 rounded-full" style="background:<?= e($d['color']) ?>"></span><?= e($d['name']) ?></a>
      <?php endforeach; ?>
    </div>
    <a href="<?= e(wa_href('Hi Sarla! I would like to place a delivery order.')) ?>" target="_blank" rel="noopener" class="btn btn-outline-gold w-full"><?= icon('whatsapp', 'size-4') ?> Order on WhatsApp</a>
  </div>
  <div class="mm-item border-t border-white/10 px-8 py-6 text-sm text-white/50" style="--i:6">
    <a href="<?= e(tel_href()) ?>" class="flex items-center gap-3 text-white"><?= icon('phone', 'size-4 text-gold-500') ?> <?= e(SITE['phone']) ?></a>
    <p class="mt-3 flex items-start gap-3"><?= icon('map-pin', 'size-4 mt-0.5 shrink-0 text-gold-500') ?> <?= e(implode(', ', SITE['address'])) ?></p>
  </div>
</div>

<main id="main">
