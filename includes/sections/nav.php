<?php $c = site(); ?>
<a class="skip" href="#main">Skip to content</a>

<header class="nav" id="nav" data-nav>
  <div class="wrap nav__bar">
    <a class="logo" href="#top" aria-label="<?= e($c['name']) ?> — home">
      <?= logo_img(44) ?>
      <span class="logo__word"><?= e($c['brand']) ?></span>
    </a>

    <nav class="nav__links" aria-label="Primary">
      <?php foreach ($c['nav'] as [$label, $href]): ?>
        <a href="<?= e($href) ?>"><?= e($label) ?></a>
      <?php endforeach; ?>
    </nav>

    <div class="nav__right">
      <a class="btn btn--lime btn--sm nav__cta" href="#trial">Book Free Trial</a>
      <button class="burger" type="button" aria-expanded="false" aria-controls="menu" aria-label="Open menu" data-burger>
        <span></span><span></span>
      </button>
    </div>
  </div>
</header>

<div class="menu" id="menu" aria-hidden="true" data-menu>
  <div class="menu__inner wrap">
    <nav class="menu__links" aria-label="Mobile">
      <?php foreach ($c['nav'] as $i => [$label, $href]): ?>
        <a href="<?= e($href) ?>" style="--i:<?= $i ?>" tabindex="-1">
          <span class="menu__n">0<?= $i + 1 ?></span><span class="menu__t"><?= e($label) ?></span>
        </a>
      <?php endforeach; ?>
    </nav>
    <div class="menu__foot">
      <a class="btn btn--lime btn--lg" href="#trial" tabindex="-1">Book Your Free Trial <?= icon('arrow-ur') ?></a>
      <p><?= e($c['phone_display']) ?> · Mon–Sat 5 AM – 11 PM</p>
    </div>
  </div>
</div>
