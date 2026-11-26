(() => {
  const $ = (s, c = document) => c.querySelector(s), $$ = (s, c = document) => [...c.querySelectorAll(s)];

  // sticky header + back-to-top
  const header = $('.site-header'), toTop = $('.to-top');
  const onScroll = () => { header.classList.toggle('scrolled', scrollY > 20); toTop.classList.toggle('show', scrollY > 600); };
  addEventListener('scroll', onScroll, { passive: true }); onScroll();

  // mobile menu
  const burger = $('#burger'), nav = $('#nav');
  const setMenu = open => {
    if (open) document.documentElement.style.setProperty('--hdr', header.getBoundingClientRect().bottom + 'px');
    nav.classList.toggle('open', open);
    document.body.classList.toggle('menu-open', open);
    burger.setAttribute('aria-expanded', open);
    burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    // lock scroll on <html>, not <body>: hidden overflow on body would break the sticky header
    document.documentElement.style.overflow = open ? 'hidden' : '';
  };
  burger.addEventListener('click', () => setMenu(!nav.classList.contains('open')));
  // close on: tapping the dimmed page, choosing a link, or Esc
  document.addEventListener('click', e => { if (nav.classList.contains('open') && !nav.contains(e.target) && !burger.contains(e.target)) setMenu(false); });
  $$('a', nav).forEach(a => a.addEventListener('click', () => setMenu(false)));
  addEventListener('keydown', e => { if (e.key === 'Escape' && nav.classList.contains('open')) { setMenu(false); burger.focus(); } });

  // scroll reveal (+ stagger children with data-stagger)
  $$('[data-stagger]').forEach(g => [...g.children].forEach((c, i) => { c.classList.add('reveal'); c.style.transitionDelay = i * 110 + 'ms'; }));
  const io = new IntersectionObserver(es => es.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } }), { threshold: .12 });
  $$('.reveal').forEach(el => io.observe(el));

  // counters: <b data-count="100" data-suffix="%">
  const cio = new IntersectionObserver(es => es.forEach(e => {
    if (!e.isIntersecting) return; cio.unobserve(e.target);
    const el = e.target, end = +el.dataset.count, pre = el.dataset.prefix || '', suf = el.dataset.suffix || '', t0 = performance.now();
    const tick = t => { const p = Math.min((t - t0) / 1600, 1), v = Math.round(end * (1 - Math.pow(1 - p, 3))); el.textContent = pre + v + suf; if (p < 1) requestAnimationFrame(tick); };
    requestAnimationFrame(tick);
  }), { threshold: .5 });
  $$('[data-count]').forEach(el => cio.observe(el));

  // typing rotator in hero
  const rot = $('.rotator');
  if (rot) {
    const words = JSON.parse(rot.dataset.words); let w = 0, i = 0, del = false;
    const type = () => {
      const word = words[w]; rot.textContent = word.slice(0, i);
      if (!del && i === word.length) { del = true; return setTimeout(type, 1800); }
      if (del && i === 0) { del = false; w = (w + 1) % words.length; }
      i += del ? -1 : 1; setTimeout(type, del ? 45 : 90);
    };
    type();
  }

  // tabs
  $$('[data-tabs]').forEach(box => {
    const tabs = $$('.tab', box), panels = $$('.panel', box);
    tabs.forEach((t, i) => t.addEventListener('click', () => {
      tabs.forEach(x => x.classList.toggle('on', x === t));
      panels.forEach((p, j) => p.classList.toggle('on', j === i));
    }));
  });

  // submit: lock the button and show a spinner so nobody double-submits (reset if the user comes back)
  $$('form[action="submit.php"]').forEach(f => f.addEventListener('submit', () => {
    const b = $('button[type=submit]', f); b.dataset.label ??= b.innerHTML;
    b.classList.add('loading'); b.disabled = true; b.firstChild.textContent = 'Submitting… ';
  }));
  addEventListener('pageshow', () => $$('button.loading').forEach(b => { b.classList.remove('loading'); b.disabled = false; b.innerHTML = b.dataset.label; }));

  // preselect loan type from ?loan= (links on the Loans page)
  const want = new URLSearchParams(location.search).get('loan');
  if (want) $$('select[name=loan] option').forEach(o => { if (o.text === want) o.selected = true; });

  // static build (GitHub Pages, no PHP): send the form straight to WhatsApp
  $$('form[data-wa]').forEach(f => f.addEventListener('submit', ev => {
    ev.preventDefault();
    const d = Object.fromEntries(new FormData(f)), partner = d.kind === 'partner';
    const lines = [`*New ${partner ? 'Partner' : 'Loan'} Enquiry – Ensoar Website*`, `Name: ${d.name}`, `Mobile: ${d.phone}`, `${partner ? 'Type' : 'Loan'}: ${d.loan}`, `City: ${d.city}`];
    if (d.amount) lines.push(`Amount: ₹${d.amount}`);
    if (d.income && !partner) lines.push(`Income: ${d.income}`);
    if (d.message) lines.push(`Message: ${d.message}`);
    open(`https://wa.me/${f.dataset.wa}?text=${encodeURIComponent(lines.join('\n'))}`, '_blank');
  }));

  // EMI calculator
  const calc = $('#emi');
  if (calc) {
    const inr = n => '₹' + Math.round(n).toLocaleString('en-IN');
    const pairs = ['amt', 'rate', 'yrs'].map(k => [$(`#${k}`), $(`#${k}-n`)]);
    const fill = r => r.style.setProperty('--p', ((r.value - r.min) / (r.max - r.min) * 100) + '%');
    const run = () => {
      const [P, R, Y] = pairs.map(([r]) => +r.value), r = R / 1200, n = Y * 12;
      const emi = r ? P * r * Math.pow(1 + r, n) / (Math.pow(1 + r, n) - 1) : P / n;
      const total = emi * n, interest = total - P;
      $('#emi-out').textContent = inr(emi);
      $('#p-out').textContent = inr(P); $('#i-out').textContent = inr(interest); $('#t-out').textContent = inr(total);
      $('.donut').style.setProperty('--i', (interest / total * 100) + '%');
    };
    pairs.forEach(([r, n]) => {
      r.addEventListener('input', () => { n.value = r.value; fill(r); run(); });
      n.addEventListener('change', () => { r.value = Math.min(Math.max(+n.value || r.min, r.min), r.max); n.value = r.value; fill(r); run(); });
      fill(r);
    });
    run();
  }
})();
