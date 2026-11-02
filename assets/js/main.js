(() => {
  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];

  /* Header background on scroll */
  const header = $('#site-header');
  const onScroll = () => header?.classList.toggle('is-scrolled', window.scrollY > 40);
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });

  /* Mobile menu */
  const mobileMenu = $('#mobile-menu');
  const setMenu = (open) => {
    mobileMenu?.classList.toggle('is-open', open);
    document.documentElement.classList.toggle('overflow-hidden', open);
    $$('[data-menu-toggle]').forEach((b) => b.setAttribute('aria-expanded', String(open)));
  };
  $$('[data-menu-toggle]').forEach((btn) =>
    btn.addEventListener('click', () => setMenu(!mobileMenu.classList.contains('is-open')))
  );
  $$('#mobile-menu a').forEach((a) => a.addEventListener('click', () => setMenu(false)));

  /* Dropdowns */
  const setDropdown = (dd, open) => {
    dd.classList.toggle('is-open', open);
    $('[data-dropdown-trigger]', dd)?.setAttribute('aria-expanded', String(open));
  };
  const closeDropdowns = (except) =>
    $$('[data-dropdown].is-open').forEach((dd) => dd !== except && setDropdown(dd, false));

  $$('[data-dropdown]').forEach((dd) => {
    $('[data-dropdown-trigger]', dd).addEventListener('click', (e) => {
      e.stopPropagation();
      const open = !dd.classList.contains('is-open');
      closeDropdowns(dd);
      setDropdown(dd, open);
    });
  });
  document.addEventListener('click', (e) => {
    if (!e.target.closest('[data-dropdown]')) closeDropdowns();
  });
  document.addEventListener('keydown', (e) => {
    if (e.key !== 'Escape') return;
    closeDropdowns();
    setMenu(false);
  });

  /* Reveal on scroll */
  const revealer = new IntersectionObserver(
    (entries) =>
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-visible');
        revealer.unobserve(entry.target);
      }),
    { rootMargin: '0px 0px -8% 0px' }
  );
  $$('[data-reveal]').forEach((el) => revealer.observe(el));

  /* Live clock + kitchen status (Asia/Kolkata) */
  const hours = window.SARLA?.hours ?? [];
  const toMin = (t) => {
    const [h, m] = t.split(':').map(Number);
    return h * 60 + m;
  };
  const clockFmt = new Intl.DateTimeFormat('en-GB', {
    timeZone: 'Asia/Kolkata',
    hour: '2-digit',
    minute: '2-digit',
    hourCycle: 'h23',
  });

  const tick = () => {
    const parts = Object.fromEntries(clockFmt.formatToParts(new Date()).map((p) => [p.type, p.value]));
    const hhmm = `${parts.hour}:${parts.minute}`;
    const now = toMin(hhmm);
    $$('[data-clock]').forEach((el) => (el.textContent = hhmm));

    let state = 'closed';
    let label = 'Closed';
    let text = '';
    const current = hours.find((s) => now >= toMin(s.open) && now < toMin(s.close));

    if (current && now < toMin(current.last)) {
      state = 'open';
      label = 'Open now';
      text = `${current.name} service in progress`;
    } else if (current) {
      state = 'last';
      label = 'Closing soon';
      text = `Last orders taken · closes ${current.close}`;
    } else {
      const next = hours.find((s) => toMin(s.open) > now);
      text = next ? `${next.name} opens at ${next.open}` : hours[0] ? `Opens tomorrow at ${hours[0].open}` : '';
    }

    $$('[data-status]').forEach((el) => {
      el.dataset.state = state;
      $('[data-status-label]', el).textContent = label;
      $('[data-status-text]', el).textContent = text;
    });
  };
  if ($('[data-clock], [data-status]')) {
    tick();
    setInterval(tick, 15000);
  }

  /* Static build: send booking / contact forms as a WhatsApp message */
  $$('[data-wa-form]').forEach((form) => {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      if (!form.reportValidity()) return;
      const lines = [`Hi Sarla! ${form.dataset.waForm}:`];
      $$('input, select, textarea', form).forEach((field) => {
        if (field.type === 'hidden' || field.name === 'website' || !field.value.trim()) return;
        if (field.type === 'radio' && !field.checked) return;
        const label = $(`label[for="${field.id}"]`)?.textContent.replace('*', '').trim() || field.name;
        const value = field.tagName === 'SELECT' ? field.selectedOptions[0].textContent : field.value.trim();
        lines.push(`${label.charAt(0).toUpperCase() + label.slice(1).toLowerCase()}: ${value}`);
      });
      window.open(`https://wa.me/${window.SARLA.whatsapp}?text=${encodeURIComponent(lines.join('\n'))}`, '_blank', 'noopener');
    });
  });

  /* Menu page: veg filter + active category tab */
  const vegToggle = $('[data-veg-toggle]');
  vegToggle?.addEventListener('change', () => {
    const vegOnly = vegToggle.checked;
    $$('[data-veg="0"]').forEach((el) => (el.hidden = vegOnly));
    $$('[data-menu-cat]').forEach((cat) => {
      const empty = vegOnly && !$('[data-veg="1"]', cat);
      cat.hidden = empty;
      const tab = $(`[data-tab="${cat.id}"]`);
      if (tab) tab.hidden = empty;
    });
  });

  const tabsNav = $('[data-menu-tabs]');
  if (tabsNav) {
    const setActive = (id) => {
      $$('.menu-tab', tabsNav).forEach((t) => t.classList.toggle('is-active', t.dataset.tab === id));
      const active = $(`[data-tab="${id}"]`, tabsNav);
      if (active) {
        tabsNav.scrollTo({ left: active.offsetLeft - tabsNav.clientWidth / 2 + active.clientWidth / 2, behavior: 'smooth' });
      }
    };
    const spy = new IntersectionObserver(
      (entries) => entries.forEach((entry) => entry.isIntersecting && setActive(entry.target.id)),
      { rootMargin: '-35% 0px -60% 0px' }
    );
    $$('[data-menu-cat]').forEach((cat) => spy.observe(cat));
  }
})();
