<?php
require __DIR__ . '/includes/bootstrap.php';

$page = 'menu';
$title = 'Menu — Sarla, Sector 62 Noida';
$description = 'Explore the Sarla menu: tandoor kebabs, dal makhani, butter chicken, dum biryani, thalis, South Indian, Indo-Chinese, desserts and drinks.';
require __DIR__ . '/includes/header.php';

$menu = menu();

page_hero('Our menu', 'The Sarla <span class="text-gold-gradient">Menu</span>', 'North Indian classics, tandoor specials, street-style chaat and much more — cooked fresh to order, every service.', 'interior-dark', 'Menu');
?>

<!-- Sticky category bar -->
<div class="sticky top-16 z-30 border-y border-white/5 bg-ink-950/90 backdrop-blur-xl lg:top-24">
  <div class="container-x flex items-center gap-4">
    <nav class="no-scrollbar -mx-1 flex flex-1 gap-2 overflow-x-auto px-1 py-3" data-menu-tabs aria-label="Menu categories">
      <?php foreach ($menu as $cat): ?>
        <a href="#<?= $cat['id'] ?>" class="menu-tab shrink-0 rounded-full border border-white/10 px-4 py-2 text-[10px] font-bold uppercase tracking-[0.18em] whitespace-nowrap text-white/70 transition hover:border-gold-500/50 hover:text-white" data-tab="<?= $cat['id'] ?>"><?= e($cat['title']) ?></a>
      <?php endforeach; ?>
    </nav>
    <label class="flex shrink-0 cursor-pointer items-center gap-2.5 border-l border-white/10 py-3 pl-4 text-[10px] font-bold uppercase tracking-[0.18em] text-white/70 select-none">
      <input type="checkbox" class="peer sr-only" data-veg-toggle>
      <span class="relative h-5 w-9 rounded-full bg-white/15 transition peer-checked:bg-[#22a55b] after:absolute after:top-0.5 after:left-0.5 after:size-4 after:rounded-full after:bg-white after:transition peer-checked:after:translate-x-4"></span>
      <span class="hidden sm:inline">Veg only</span><span class="sm:hidden">Veg</span>
    </label>
  </div>
</div>

<div class="bg-ink-900">
  <div class="container-x">
    <!-- Legend -->
    <div class="flex flex-wrap items-center gap-x-6 gap-y-3 border-b border-white/5 py-6 text-[10px] font-semibold uppercase tracking-[0.2em] text-white/40">
      <span class="flex items-center gap-2"><?= veg_mark(true) ?> Veg</span>
      <span class="flex items-center gap-2"><?= veg_mark(false) ?> Non-veg</span>
      <span class="hidden h-4 w-px bg-white/10 sm:block"></span>
      <span>Prices in ₹ · exclusive of GST</span>
      <span class="sm:ml-auto">Tell us about allergies — we'll adapt</span>
    </div>

    <?php foreach ($menu as $n => $cat): ?>
      <section id="<?= $cat['id'] ?>" class="scroll-mt-36 border-b border-white/5 py-16 last:border-0 lg:scroll-mt-44 lg:py-20" data-menu-cat>
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-[300px_1fr] lg:gap-16">
          <div class="self-start lg:sticky lg:top-48">
            <div class="relative isolate flex aspect-[16/9] items-end overflow-hidden rounded-xl p-6 ring-1 ring-white/10 lg:aspect-[4/5]">
              <?php if ($cat['img']): ?>
                <img src="<?= img($cat['img']) ?>" alt="" loading="lazy" class="absolute inset-0 -z-20 size-full object-cover">
                <div class="absolute inset-0 -z-10 bg-linear-to-t from-ink-950 via-ink-950/40 to-transparent"></div>
              <?php else: ?>
                <div class="bg-grid absolute inset-0 -z-10 bg-crimson-700"></div>
                <span aria-hidden="true" class="absolute -top-6 -right-4 -z-10 font-script text-[9rem] leading-none text-white/10">मीठा</span>
              <?php endif; ?>
              <div>
                <p class="font-mono text-xs font-bold text-gold-400"><?= str_pad((string) ($n + 1), 2, '0', STR_PAD_LEFT) ?> / <?= str_pad((string) count($menu), 2, '0', STR_PAD_LEFT) ?></p>
                <h2 class="script mt-2 text-4xl lg:text-[2.6rem]"><?= e($cat['title']) ?></h2>
              </div>
            </div>
            <p class="mt-5 text-sm leading-7 text-white/50"><?= e($cat['intro']) ?></p>
          </div>

          <div class="grid content-start gap-x-12 md:grid-cols-2">
            <?php foreach ($cat['items'] as $item): ?>
              <article class="border-b border-dashed border-white/10 py-6" data-veg="<?= $item['veg'] ? 1 : 0 ?>">
                <div class="flex items-baseline gap-3">
                  <span class="translate-y-0.5"><?= veg_mark($item['veg']) ?></span>
                  <h3 class="text-[15px] font-semibold text-white"><?= e($item['name']) ?></h3>
                  <span class="min-w-6 flex-1 -translate-y-1 border-b border-dotted border-white/15"></span>
                  <span class="font-mono text-sm font-bold whitespace-nowrap text-gold-400"><?= price($item['price']) ?></span>
                </div>
                <p class="mt-2 pl-[26px] text-[13px] leading-6 text-white/50"><?= e($item['desc']) ?></p>
                <?php if ($item['tags']): ?>
                  <div class="mt-3 flex flex-wrap gap-2 pl-[26px]"><?= dish_tags($item['tags']) ?></div>
                <?php endif; ?>
              </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    <?php endforeach; ?>

    <!-- Order strip -->
    <div class="mb-24 grid items-center gap-6 rounded-2xl border border-gold-500/20 bg-linear-to-r from-gold-500/10 to-transparent p-8 sm:p-10 lg:grid-cols-[1fr_auto]">
      <div>
        <p class="eyebrow"><?= icon('bike', 'size-4') ?> Craving it at home?</p>
        <h2 class="script mt-3 text-4xl">Order for delivery</h2>
        <p class="mt-2 text-sm text-white/55">Hot and fresh to your door across Sector 62 and nearby — on Zomato, Swiggy or directly via WhatsApp.</p>
      </div>
      <div class="flex flex-wrap gap-3">
        <?php foreach (SITE['delivery'] as $d): ?>
          <a href="<?= e($d['url']) ?>" target="_blank" rel="noopener" class="btn btn-ghost"><span class="size-2 rounded-full" style="background:<?= e($d['color']) ?>"></span><?= e($d['name']) ?></a>
        <?php endforeach; ?>
        <a href="<?= e(wa_href('Hi Sarla! I would like to place a delivery order.')) ?>" target="_blank" rel="noopener" class="btn btn-gold"><?= icon('whatsapp', 'size-4') ?> WhatsApp</a>
      </div>
    </div>
  </div>
</div>

<?php cta_band(); ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
