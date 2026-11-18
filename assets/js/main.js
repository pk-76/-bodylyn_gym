/* ==========================================================================
   BODYLYN GYM — interactions
   Vanilla JS + GSAP/ScrollTrigger (parallax) + Lenis (smooth scroll).
   Everything degrades gracefully if a CDN script fails to load.
   ========================================================================== */
(() => {
  'use strict';

  const $ = (s, c = document) => c.querySelector(s);
  const $$ = (s, c = document) => Array.from(c.querySelectorAll(s));
  const root = document.documentElement;
  const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const finePointer = matchMedia('(hover: hover) and (pointer: fine)').matches;
  const NAV_H = 72;

  /* ---------- Smooth scroll (Lenis) ---------- */
  let lenis = null;
  const scrollTo = (target, opts = {}) => {
    if (lenis) lenis.scrollTo(target, { offset: -(NAV_H - 1), duration: 1.4, ...opts });
    else if (typeof target === 'number') window.scrollTo({ top: target, behavior: reduce ? 'auto' : 'smooth' });
    else target.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'start' });
  };

  const initScroll = () => {
    const hasGsap = window.gsap && window.ScrollTrigger;
    if (hasGsap) gsap.registerPlugin(ScrollTrigger);

    if (window.Lenis && !reduce) {
      lenis = new Lenis({ duration: 1.15, easing: t => Math.min(1, 1.001 - Math.pow(2, -10 * t)), smoothWheel: true });
      if (hasGsap) {
        lenis.on('scroll', ScrollTrigger.update);
        gsap.ticker.add(time => lenis.raf(time * 1000));
        gsap.ticker.lagSmoothing(0);
      } else {
        const raf = t => { lenis.raf(t); requestAnimationFrame(raf); };
        requestAnimationFrame(raf);
      }
    }

    // Parallax
    if (hasGsap && !reduce) {
      $$('[data-parallax]').forEach(el => {
        const s = parseFloat(el.dataset.parallax) || 0.08;
        gsap.fromTo(el, { yPercent: -s * 100 }, {
          yPercent: s * 100, ease: 'none',
          scrollTrigger: { trigger: el.parentElement, start: 'top bottom', end: 'bottom top', scrub: true },
        });
      });
    }
  };

  /* ---------- Anchor links ---------- */
  document.addEventListener('click', e => {
    const a = e.target.closest('a[href^="#"]');
    if (!a) return;
    const id = a.getAttribute('href');
    if (id.length < 2) return;
    const el = document.getElementById(id.slice(1));
    if (!el) return;
    e.preventDefault();
    closeMenu();
    scrollTo(id === '#top' ? 0 : el);
    history.pushState(null, '', id);
  });

  /* ---------- Navbar ---------- */
  const nav = $('[data-nav]');
  const onScroll = () => nav && nav.classList.toggle('is-solid', window.scrollY > 40);
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* ---------- Mobile menu ---------- */
  const burger = $('[data-burger]');
  const menu = $('[data-menu]');
  const setMenu = open => {
    document.body.classList.toggle('menu-open', open);
    burger.setAttribute('aria-expanded', String(open));
    burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    menu.setAttribute('aria-hidden', String(!open));
    $$('a', menu).forEach(a => (a.tabIndex = open ? 0 : -1));
    if (lenis) open ? lenis.stop() : lenis.start();
    else root.style.overflow = open ? 'hidden' : '';
  };
  function closeMenu() { if (burger && document.body.classList.contains('menu-open')) setMenu(false); }
  if (burger && menu) {
    burger.addEventListener('click', () => setMenu(!document.body.classList.contains('menu-open')));
    addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });
    matchMedia('(min-width: 1100px)').addEventListener('change', e => e.matches && closeMenu());
  }

  /* ---------- Reveal on scroll + counters + chart ---------- */
  const countUp = el => {
    const end = parseFloat(el.dataset.count);
    const dec = parseInt(el.dataset.decimals || '0', 10);
    const fmt = el.dataset.format === '1';
    const render = v => {
      const s = v.toFixed(dec);
      el.textContent = fmt ? Number(s).toLocaleString('en-IN') : s;
    };
    if (reduce) return render(end);
    const dur = 1800, t0 = performance.now();
    const ease = t => (t === 1 ? 1 : 1 - Math.pow(2, -10 * t));
    const tick = now => {
      const p = Math.min(1, (now - t0) / dur);
      render(end * ease(p));
      if (p < 1) requestAnimationFrame(tick);
    };
    render(0);
    requestAnimationFrame(tick);
  };

  const io = new IntersectionObserver(entries => {
    entries.forEach(en => {
      if (!en.isIntersecting) return;
      const el = en.target;
      el.classList.add('is-in');
      $$('[data-count]', el).forEach(countUp);
      io.unobserve(el);
    });
  }, { threshold: 0.18, rootMargin: '0px 0px -6% 0px' });
  $$('[data-reveal], [data-fade], [data-chart]').forEach(el => io.observe(el));

  /* ---------- Custom cursor ---------- */
  const cursor = $('[data-cursor]');
  if (cursor && finePointer && !reduce) {
    let x = innerWidth / 2, y = innerHeight / 2, cx = x, cy = y, raf = 0;
    root.classList.add('has-cursor');
    const loop = () => {
      cx += (x - cx) * 0.22; cy += (y - cy) * 0.22;
      cursor.style.transform = `translate3d(${cx}px, ${cy}px, 0)`;
      raf = Math.abs(x - cx) + Math.abs(y - cy) > 0.1 ? requestAnimationFrame(loop) : 0;
    };
    addEventListener('pointermove', e => {
      x = e.clientX; y = e.clientY;
      if (!cursor.classList.contains('is-ready')) { cx = x; cy = y; cursor.classList.add('is-ready'); }
      if (!raf) raf = requestAnimationFrame(loop);
      const t = e.target;
      cursor.classList.toggle('is-hover', !!t.closest('a, button, [role="button"], label, .ba__range, .gal, .tile[tabindex]'));
      cursor.classList.toggle('is-text', !!t.closest('input[type="text"], input[type="tel"]'));
      cursor.classList.toggle('on-light', !!t.closest('.sec--light'));
    }, { passive: true });
    document.addEventListener('pointerleave', () => (cursor.style.opacity = 0));
    document.addEventListener('pointerenter', () => (cursor.style.opacity = ''));
  }

  /* ---------- Before / After sliders ---------- */
  $$('[data-ba]').forEach(ba => {
    const range = $('.ba__range', ba);
    const set = () => ba.style.setProperty('--pos', range.value + '%');
    range.addEventListener('input', set);
    set();
  });

  /* ---------- Reviews carousel ---------- */
  const track = $('[data-track]');
  if (track) {
    const step = () => { const c = track.firstElementChild; return c ? c.getBoundingClientRect().width + 16 : 300; };
    $('[data-prev]')?.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: 'smooth' }));
    $('[data-next]')?.addEventListener('click', () => track.scrollBy({ left: step(), behavior: 'smooth' }));
    track.addEventListener('keydown', e => {
      if (e.key === 'ArrowRight') track.scrollBy({ left: step(), behavior: 'smooth' });
      if (e.key === 'ArrowLeft') track.scrollBy({ left: -step(), behavior: 'smooth' });
    });
    // drag to scroll (mouse)
    let down = false, sx = 0, sl = 0, moved = 0;
    track.addEventListener('pointerdown', e => { if (e.pointerType !== 'mouse') return; down = true; moved = 0; sx = e.clientX; sl = track.scrollLeft; });
    addEventListener('pointermove', e => {
      if (!down) return;
      const dx = e.clientX - sx; moved = Math.abs(dx);
      if (moved > 4) track.classList.add('is-drag');
      track.scrollLeft = sl - dx;
    });
    addEventListener('pointerup', () => { down = false; track.classList.remove('is-drag'); });
  }

  /* ---------- Gallery lightbox ---------- */
  const lb = $('#lightbox');
  if (lb && lb.showModal) {
    const items = $$('[data-gallery] .gal');
    const img = $('[data-lb-img]', lb), cap = $('[data-lb-cap]', lb), cnt = $('[data-lb-count]', lb);
    let idx = 0, opener = null;
    const show = i => {
      idx = (i + items.length) % items.length;
      const b = items[idx];
      img.src = b.dataset.full; img.alt = b.dataset.alt;
      cap.textContent = b.dataset.alt;
      cnt.textContent = `${idx + 1} / ${items.length}`;
    };
    const close = () => lb.close();
    items.forEach((b, i) => b.addEventListener('click', () => {
      opener = b; show(i); lb.showModal(); lenis && lenis.stop();
    }));
    $('[data-lb-close]', lb).addEventListener('click', close);
    $('[data-lb-prev]', lb).addEventListener('click', () => show(idx - 1));
    $('[data-lb-next]', lb).addEventListener('click', () => show(idx + 1));
    lb.addEventListener('click', e => { if (e.target === lb || e.target.tagName === 'FIGURE') close(); });
    lb.addEventListener('keydown', e => {
      if (e.key === 'ArrowRight') show(idx + 1);
      if (e.key === 'ArrowLeft') show(idx - 1);
    });
    lb.addEventListener('close', () => { lenis && lenis.start(); opener && opener.focus(); });
  }

  /* ---------- Open now / Closed now (IST) + today's row + chart "now" ---------- */
  const hoursEl = $('#hours-data');
  if (hoursEl) {
    const H = JSON.parse(hoursEl.textContent);
    const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    const FULL = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const t12 = m => { const h = Math.floor(m / 60), mm = String(m % 60).padStart(2, '0'); return `${h % 12 || 12}:${mm} ${h >= 12 ? 'PM' : 'AM'}`; };

    const nowIST = () => {
      const parts = new Intl.DateTimeFormat('en-GB', { timeZone: H.tz, weekday: 'short', hour: '2-digit', minute: '2-digit', hourCycle: 'h23' }).formatToParts(new Date());
      const get = t => parts.find(p => p.type === t).value;
      return { day: DAYS.indexOf(get('weekday')), min: parseInt(get('hour'), 10) * 60 + parseInt(get('minute'), 10) };
    };

    const update = () => {
      const { day, min } = nowIST();
      const today = H.days[day];
      let open = false, text = '';
      if (today && min >= today[0] && min < today[1]) {
        open = true; text = `Open now · Closes ${t12(today[1])}`;
      } else {
        for (let i = 0; i < 8; i++) {
          const d = (day + i) % 7, r = H.days[d];
          if (!r || (i === 0 && min >= r[0])) continue;
          text = `Closed now · Opens ${i === 0 ? 'today' : i === 1 ? 'tomorrow' : DAYS[d]} ${t12(r[0])}`;
          break;
        }
      }
      $$('[data-open-badge]').forEach(b => {
        b.classList.toggle('is-open', open); b.classList.toggle('is-closed', !open);
        const t = $('[data-open-text]', b); if (t) t.textContent = text;
      });
      $$('.hours tr').forEach(tr => tr.classList.toggle('is-today', tr.dataset.day === FULL[day]));
      $$('.bar').forEach(b => b.classList.toggle('is-now', open && parseInt(b.dataset.hour, 10) === Math.floor(min / 60)));
    };
    update();
    setInterval(update, 60000);
  }

  /* ---------- Free-trial form → WhatsApp ---------- */
  const form = $('#trial-form');
  if (form) {
    const success = $('#trial-success');
    const fName = $('#f-name'), fPhone = $('#f-phone');
    const setErr = (input, msg) => {
      const f = input.closest('.field'), out = $(`[data-err="${input.name}"]`, f);
      f.classList.toggle('has-error', !!msg);
      input.setAttribute('aria-invalid', msg ? 'true' : 'false');
      if (out) out.textContent = msg || '';
    };
    const cleanPhone = v => { const d = v.replace(/\D+/g, ''); const m = d.match(/^(?:91|0)?([6-9]\d{9})$/); return m ? m[1] : ''; };
    [fName, fPhone].forEach(i => i.addEventListener('input', () => setErr(i, '')));

    form.addEventListener('submit', e => {
      e.preventDefault();
      const name = fName.value.trim().replace(/\s+/g, ' ');
      const phone = cleanPhone(fPhone.value);
      let bad = null;
      if (name.length < 2) { setErr(fName, 'Please enter your name.'); bad = bad || fName; } else setErr(fName, '');
      if (!phone) { setErr(fPhone, 'Enter a valid 10-digit mobile number.'); bad = bad || fPhone; } else setErr(fPhone, '');
      if (bad) { bad.focus(); return; }

      const data = new FormData(form);
      const msg = `Hi BODYLYN GYM! I'd like to book a FREE TRIAL.\nName: ${name} | Phone: ${phone} | Goal: ${data.get('goal')} | Preferred time: ${data.get('time')} | Personal training: ${data.get('pt')}`;
      const url = `https://wa.me/${form.dataset.wa}?text=${encodeURIComponent(msg)}`;

      $('[data-name]', success).textContent = name.split(' ')[0];
      $('[data-wa-fallback]', success).href = url;
      form.hidden = true; success.hidden = false; success.focus({ preventScroll: true });
      const w = window.open(url, '_blank', 'noopener');
      if (!w) location.href = url;
    });

    $('[data-form-reset]', success).addEventListener('click', () => { success.hidden = true; form.hidden = false; fName.focus(); });
  }

  /* ---------- Image error fallback ---------- */
  document.addEventListener('error', e => { if (e.target.tagName === 'IMG') e.target.classList.add('img-fail'); }, true);

  /* ---------- Boot ---------- */
  initScroll();
})();
