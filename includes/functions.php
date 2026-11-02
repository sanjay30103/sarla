<?php

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/** Asset URL with a cache-busting version based on the file's mtime. */
function asset(string $path): string
{
    $file = BASE_PATH . '/' . $path;
    return $path . (is_file($file) ? '?v=' . filemtime($file) : '');
}

function img(string $name): string
{
    return asset('assets/img/' . $name . '.jpg');
}

function tel_href(): string
{
    return 'tel:' . SITE['phone_href'];
}

function wa_href(string $text = 'Hi Sarla! I would like to know more.'): string
{
    return 'https://wa.me/' . SITE['whatsapp'] . '?text=' . rawurlencode($text);
}

function maps_embed(): string
{
    return 'https://maps.google.com/maps?q=' . rawurlencode(SITE['maps_query']) . '&z=16&output=embed';
}

function maps_directions(): string
{
    return 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode(SITE['maps_query']);
}

function nav_items(): array
{
    return [
        'home'    => ['Home', 'index.php'],
        'menu'    => ['Menu', 'menu.php'],
        'story'   => ['Our Story', 'our-story.php'],
        'contact' => ['Contact', 'contact.php'],
    ];
}

/** "₹349" for ints, "₹399 / ₹699" for half/full strings like "399/699". */
function price(int|string $price): string
{
    if (is_int($price)) {
        return '₹' . number_format($price);
    }
    return implode(' / ', array_map(fn ($p) => '₹' . trim($p), explode('/', $price)));
}

function hours_summary(string $sep = ' & '): string
{
    return implode($sep, array_map(fn ($s) => $s['open'] . '–' . $s['close'], SITE['hours']));
}

/** Bookable slots every 30 min from opening until last order, grouped by session. */
function time_slots(): array
{
    $slots = [];
    foreach (SITE['hours'] as $s) {
        for ($t = strtotime($s['open']); $t <= strtotime($s['last']); $t += 1800) {
            $slots[$s['name']][date('H:i', $t)] = date('g:i A', $t);
        }
    }
    return $slots;
}

/* ---------- Forms ---------- */

function csrf_token(): string
{
    return $_SESSION['csrf'] ??= bin2hex(random_bytes(16));
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . csrf_token() . '">';
}

function csrf_valid(): bool
{
    $token = $_SESSION['csrf'] ?? '';
    return $token !== '' && hash_equals($token, (string) ($_POST['csrf'] ?? ''));
}

/** Set a one-time session value, or read (and clear) it when no value is given. */
function flash(string $key, mixed $value = null): mixed
{
    if ($value !== null) {
        $_SESSION['flash'][$key] = $value;
        return null;
    }
    $stored = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $stored;
}

function store_csv(string $file, array $row): bool
{
    // Neutralise spreadsheet formulas in user input (phone numbers like "+91…" are left alone).
    $row = array_map(fn ($v) => preg_match('/^([=@]|[+\-](?!\d))/', (string) $v) ? "'" . $v : $v, $row);

    $fh = @fopen(BASE_PATH . '/storage/' . $file, 'a');
    if (!$fh) {
        return false;
    }
    flock($fh, LOCK_EX);
    $ok = fputcsv($fh, $row, escape: '') !== false;
    flock($fh, LOCK_UN);
    fclose($fh);
    return $ok;
}

/* ---------- UI helpers ---------- */

function icon(string $name, string $class = 'size-4'): string
{
    static $paths = [
        'arrow-right' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'arrow-up-right' => '<path d="M7 17 17 7"/><path d="M7 7h10v10"/>',
        'chevron-down' => '<path d="m6 9 6 6 6-6"/>',
        'calendar' => '<rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
        'phone' => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>',
        'mail' => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>',
        'map-pin' => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
        'clock' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
        'users' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>',
        'instagram' => '<rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5h.01"/>',
        'facebook' => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
        'menu' => '<path d="M4 7h16M4 12h16M10 17h10"/>',
        'x' => '<path d="M18 6 6 18M6 6l12 12"/>',
        'external' => '<path d="M15 3h6v6M10 14 21 3M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>',
        'flame' => '<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.07-2.14-.22-4.05 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.15.43-2.29 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>',
        'leaf' => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
        'chef' => '<path d="M17 21a1 1 0 0 0 1-1v-5.35c0-.46.32-.84.73-1.04a4 4 0 0 0-2.13-7.59 5 5 0 0 0-9.19 0 4 4 0 0 0-2.13 7.59c.41.2.72.58.72 1.04V20a1 1 0 0 0 1 1Z"/><path d="M6 17h12"/>',
        'glass' => '<path d="M8 22h8M7 10h10M12 15v7M12 15a5 5 0 0 0 5-5c0-2-.5-4-2-8H9c-1.5 4-2 6-2 8a5 5 0 0 0 5 5Z"/>',
        'utensils' => '<path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2M7 2v20M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>',
        'award' => '<path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6M18 9h1.5a2.5 2.5 0 0 0 0-5H18M4 22h16M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22M18 2H6v7a6 6 0 0 0 12 0V2Z"/>',
        'check' => '<path d="M20 6 9 17l-5-5"/>',
        'bike' => '<circle cx="18.5" cy="17.5" r="3.5"/><circle cx="5.5" cy="17.5" r="3.5"/><circle cx="15" cy="5" r="1"/><path d="M12 17.5V14l-3-3 4-3 2 3h2"/>',
        'message' => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
        'sparkle' => '<path d="M12 3v3M12 18v3M3 12h3M18 12h3M5.6 5.6l2.1 2.1M16.3 16.3l2.1 2.1M5.6 18.4l2.1-2.1M16.3 7.7l2.1-2.1"/>',
        'bowl' => '<path d="M2 12h20a10 10 0 0 1-20 0Z"/><path d="M7 8c0-1.5 1-2 1-3.5M12 8c0-1.5 1-2 1-3.5M17 8c0-1.5 1-2 1-3.5"/>',
        'heart' => '<path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>',
        'party' => '<path d="M5.8 11.3 2 22l10.7-3.79M4 3h.01M22 8h.01M15 2h.01M22 20h.01M22 2l-2.24.75a2.9 2.9 0 0 0-1.96 3.12c.1.86-.57 1.63-1.45 1.63h-.38c-.86 0-1.6.6-1.76 1.44L14 10M22 13l-.82-.33c-.86-.34-1.82.2-1.98 1.11-.11.7-.72 1.22-1.43 1.22H17M11 2l.33.82c.34.86-.2 1.82-1.11 1.98-.7.1-1.22.72-1.22 1.43V7"/><path d="M11 13c1.93 1.93 2.83 4.17 2 5-.83.83-3.07-.07-5-2-1.93-1.93-2.83-4.17-2-5 .83-.83 3.07.07 5 2Z"/>',
        'briefcase' => '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>',
    ];

    if ($name === 'whatsapp') {
        return '<svg viewBox="0 0 24 24" fill="currentColor" class="' . $class . '" aria-hidden="true"><path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.16-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.39-1.47-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.6.13-.14.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.6-.92-2.2-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.21 3.07c.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.7.63.71.22 1.36.19 1.87.12.57-.09 1.76-.72 2-1.41.25-.7.25-1.29.18-1.41-.08-.13-.27-.2-.57-.35m-5.42 7.4h-.01a9.87 9.87 0 0 1-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.37a9.86 9.86 0 0 1-1.51-5.26c0-5.45 4.44-9.88 9.89-9.88 2.64 0 5.12 1.03 6.99 2.9a9.83 9.83 0 0 1 2.89 6.99c0 5.45-4.44 9.88-9.88 9.88m8.41-18.3A11.82 11.82 0 0 0 12.05 0C5.5 0 .16 5.34.16 11.89c0 2.1.55 4.14 1.59 5.95L.06 24l6.3-1.65a11.88 11.88 0 0 0 5.68 1.45h.01c6.55 0 11.89-5.34 11.89-11.89a11.82 11.82 0 0 0-3.48-8.41Z"/></svg>';
    }

    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="' . $class . '" aria-hidden="true">' . ($paths[$name] ?? '') . '</svg>';
}

/** Sarla wordmark: crowned "S" emblem + SARLA lettering. */
function logo(string $size = 'md'): string
{
    static $n = 0;
    $id = 'sarla-gold-' . (++$n);

    [$h, $text] = [
        'sm' => ['h-9', 'text-2xl'],
        'md' => ['h-11 lg:h-12', 'text-[1.75rem] lg:text-[2rem]'],
        'lg' => ['h-16', 'text-5xl'],
    ][$size];

    return <<<HTML
<span class="inline-flex items-center gap-2.5">
  <svg viewBox="0 0 48 58" class="$h w-auto shrink-0 drop-shadow-[0_4px_10px_rgba(0,0,0,0.4)]" aria-hidden="true">
    <defs><linearGradient id="$id" gradientUnits="userSpaceOnUse" x1="0" y1="0" x2="0" y2="58"><stop offset="0" stop-color="#f8e3a3"/><stop offset=".5" stop-color="#d4a84a"/><stop offset="1" stop-color="#9c7024"/></linearGradient></defs>
    <path d="M9 15.5 10.6 5.5l6.6 5.4L24 2.5l6.8 8.4 6.6-5.4L39 15.5Z" fill="url(#$id)"/>
    <circle cx="10.6" cy="4.6" r="1.7" fill="url(#$id)"/><circle cx="24" cy="1.9" r="1.7" fill="url(#$id)"/><circle cx="37.4" cy="4.6" r="1.7" fill="url(#$id)"/>
    <rect x="6" y="17.5" width="36" height="38" rx="2.5" fill="#b3141f" stroke="url(#$id)" stroke-width="2.4"/>
    <path d="M34.5 24.5h-21v11.5h21v13h-21" fill="none" stroke="url(#$id)" stroke-width="4.2" stroke-linecap="square"/>
    <path d="M29.5 29.8h-11M18.5 43.2h11" stroke="url(#$id)" stroke-width="1.5"/>
  </svg>
  <span class="font-display font-bold leading-none tracking-[0.05em] text-gold-gradient $text">SARLA</span>
</span>
HTML;
}

function veg_mark(bool $veg): string
{
    $label = $veg ? 'Vegetarian' : 'Non-vegetarian';
    return '<span class="veg-mark' . ($veg ? '' : ' nonveg') . '" title="' . $label . '"><span class="sr-only">' . $label . '</span></span>';
}

function dish_tags(array $tags): string
{
    $styles = [
        'chef'  => ["Chef's Special", 'border-gold-500/40 bg-gold-500/10 text-gold-300'],
        'best'  => ['Bestseller', 'border-emerald-400/30 bg-emerald-400/10 text-emerald-300'],
        'spicy' => ['Spicy', 'border-crimson-500/40 bg-crimson-500/10 text-crimson-400'],
        'new'   => ['New', 'border-sky-400/30 bg-sky-400/10 text-sky-300'],
    ];
    $out = '';
    foreach ($tags as $tag) {
        [$label, $cls] = $styles[$tag];
        $out .= '<span class="inline-flex items-center rounded border px-2 py-0.5 text-[9px] font-bold uppercase tracking-[0.18em] ' . $cls . '">' . e($label) . '</span>';
    }
    return $out;
}

/** Delivery dropdown (Zomato / Swiggy / WhatsApp / call). */
function delivery_dropdown(string $buttonClass = 'btn btn-outline-gold', string $align = 'left-0'): string
{
    $items = '';
    foreach (SITE['delivery'] as $d) {
        $items .= '<a href="' . e($d['url']) . '" target="_blank" rel="noopener" class="flex items-center gap-3 rounded-lg px-3 py-3 transition hover:bg-white/5">'
            . '<span class="grid size-9 shrink-0 place-items-center rounded-md text-sm font-extrabold text-white" style="background:' . e($d['color']) . '">' . e($d['name'][0]) . '</span>'
            . '<span class="min-w-0 flex-1"><span class="block text-sm font-semibold text-white">' . e($d['name']) . '</span><span class="block text-[11px] text-white/45">' . e($d['note']) . '</span></span>'
            . icon('arrow-up-right', 'size-4 text-white/30') . '</a>';
    }

    $wa = e(wa_href('Hi Sarla! I would like to place a delivery order.'));
    $tel = e(tel_href());
    $phone = e(SITE['phone']);
    $chev = icon('chevron-down', 'dd-chevron size-3.5');
    $waIcon = icon('whatsapp', 'size-4');
    $phoneIcon = icon('phone', 'size-4');
    $bike = icon('bike', 'size-4');

    return <<<HTML
<div class="relative" data-dropdown>
  <button type="button" class="$buttonClass" data-dropdown-trigger aria-expanded="false" aria-haspopup="true">$bike Delivery $chev</button>
  <div class="dropdown-panel absolute $align top-full z-50 mt-3 w-72 rounded-xl border border-white/10 bg-ink-850/95 p-2 text-left shadow-2xl shadow-black/60 backdrop-blur-xl">
    <p class="px-3 pt-2 pb-1 text-[10px] font-semibold uppercase tracking-[0.28em] text-gold-500">Order Sarla at home</p>
    $items
    <div class="my-1 h-px bg-white/10"></div>
    <a href="$wa" target="_blank" rel="noopener" class="flex items-center gap-3 rounded-lg px-3 py-3 transition hover:bg-white/5">
      <span class="grid size-9 shrink-0 place-items-center rounded-md bg-[#25D366] text-white">$waIcon</span>
      <span class="flex-1"><span class="block text-sm font-semibold text-white">Order on WhatsApp</span><span class="block text-[11px] text-white/45">Direct from our kitchen</span></span>
    </a>
    <a href="$tel" class="flex items-center gap-3 rounded-lg px-3 py-3 transition hover:bg-white/5">
      <span class="grid size-9 shrink-0 place-items-center rounded-md bg-gold-500 text-ink-950">$phoneIcon</span>
      <span class="flex-1"><span class="block text-sm font-semibold text-white">Call to order</span><span class="block text-[11px] text-white/45">$phone</span></span>
    </a>
  </div>
</div>
HTML;
}

function page_hero(string $eyebrow, string $titleHtml, string $text, string $image, string $crumb): void
{ ?>
<section class="relative isolate flex min-h-[60vh] items-end overflow-hidden pt-40 pb-16 lg:min-h-[68vh] lg:pb-24">
  <img src="<?= img($image) ?>" alt="" class="animate-hero-zoom absolute inset-0 -z-20 size-full object-cover">
  <div class="absolute inset-0 -z-10 bg-linear-to-t from-ink-900 via-ink-950/75 to-ink-950/45"></div>
  <div class="container-x">
    <nav class="mb-8 flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.3em] text-white/40" data-reveal aria-label="Breadcrumb">
      <a href="index.php" class="transition hover:text-gold-400">Home</a><span>/</span><span class="text-gold-400"><?= e($crumb) ?></span>
    </nav>
    <p class="eyebrow eyebrow-line" data-reveal><?= e($eyebrow) ?></p>
    <h1 class="script mt-5 text-6xl sm:text-7xl lg:text-8xl" data-reveal style="--d:100ms"><?= $titleHtml ?></h1>
    <p class="mt-6 max-w-xl text-[15px] leading-8 text-white/65" data-reveal style="--d:200ms"><?= e($text) ?></p>
  </div>
</section>
<?php }

function cta_band(): void
{ ?>
<section class="relative isolate overflow-hidden py-28 lg:py-36">
  <img src="<?= img('fine-dining') ?>" alt="" loading="lazy" class="absolute inset-0 -z-20 size-full object-cover">
  <div class="absolute inset-0 -z-10 bg-ink-950/80"></div>
  <div class="container-x text-center">
    <p class="eyebrow" data-reveal><?= icon('calendar', 'size-3.5') ?> Reservations open daily</p>
    <h2 class="script mx-auto mt-6 max-w-3xl text-5xl sm:text-6xl lg:text-7xl" data-reveal style="--d:100ms">Your table is <span class="text-gold-gradient">waiting.</span></h2>
    <p class="mx-auto mt-6 max-w-lg text-[15px] leading-8 text-white/60" data-reveal style="--d:200ms">Lunch with the team, dinner with family or drinks after work — reserve in under a minute and we'll keep it ready.</p>
    <div class="mt-10 flex flex-wrap items-center justify-center gap-3" data-reveal style="--d:300ms">
      <a href="book.php" class="btn btn-gold">Book a Table <?= icon('arrow-right', 'size-3.5') ?></a>
      <a href="<?= e(tel_href()) ?>" class="btn btn-ghost"><?= icon('phone', 'size-3.5') ?> <?= e(SITE['phone']) ?></a>
    </div>
  </div>
</section>
<?php }
