<?php $c = site(); $st = open_status(); ?>
<footer class="footer grain">
  <div class="wrap footer__top">
    <div class="footer__brand">
      <a class="logo" href="#top" aria-label="<?= e($c['name']) ?> — back to top">
        <?= logo_img(56) ?><span class="logo__word"><?= e($c['brand']) ?></span>
      </a>
      <p><?= e($c['tagline']) ?></p>
      <span class="status <?= $st['open'] ? 'is-open' : 'is-closed' ?>" data-open-badge><i aria-hidden="true"></i><span data-open-text><?= e($st['text']) ?></span></span>
    </div>

    <div class="footer__col">
      <h3>Visit</h3>
      <address><?= e($c['address_full']) ?></address>
      <p class="footer__hours">Mon–Sat · 5:00 AM – 11:00 PM<br>Sunday · Closed</p>
    </div>

    <div class="footer__col">
      <h3>Contact</h3>
      <ul>
        <li><a href="<?= e(tel_link()) ?>"><?= e($c['phone_display']) ?></a></li>
        <li><a href="<?= e(wa_link()) ?>" target="_blank" rel="noopener">WhatsApp</a></li>
        <li><a href="<?= e($c['instagram']['url']) ?>" target="_blank" rel="noopener">Instagram <?= e($c['instagram']['handle']) ?></a></li>
      </ul>
    </div>

    <div class="footer__col">
      <h3>Explore</h3>
      <ul>
        <?php foreach ($c['nav'] as [$label, $href]): ?>
          <li><a href="<?= e($href) ?>"><?= e($label) ?></a></li>
        <?php endforeach; ?>
        <li><a href="#trial">Free Trial</a></li>
      </ul>
    </div>
  </div>

  <p class="footer__mega" aria-hidden="true"><?= e($c['brand']) ?></p>

  <div class="wrap footer__bottom">
    <p>© 2026 <?= e($c['name']) ?>, <?= e($c['address']['locality']) ?></p>
    <p>Train with guidance. Build with discipline.</p>
  </div>
</footer>

<!-- Floating elements -->
<a class="wa-float" href="<?= e(wa_link("Hi BODYLYN GYM! I'd like to know more.")) ?>" target="_blank" rel="noopener" aria-label="Chat with BODYLYN GYM on WhatsApp">
  <?= icon('whatsapp') ?>
</a>

<nav class="mbar" aria-label="Quick actions">
  <a href="<?= e(tel_link()) ?>"><?= icon('phone') ?><span>Call</span></a>
  <a href="<?= e(wa_link("Hi BODYLYN GYM! I'd like to know more.")) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>WhatsApp</span></a>
  <a class="mbar__cta" href="#trial"><?= icon('arrow-ur') ?><span>Free Trial</span></a>
</nav>

<div class="cursor" aria-hidden="true" data-cursor></div>
