<?php $c = site(); ?>
<section class="hero grain" id="top" aria-labelledby="hero-title">
  <div class="hero__media" data-parallax="0.08" aria-hidden="true">
    <?= photo('hero', 'Wide view of the BODYLYN GYM training floor with free weights, machines and cardio equipment', ['eager' => true, 'ratio' => 16 / 10, 'widths' => [800, 1280, 1920], 'sizes' => '100vw']) ?>
  </div>
  <div class="hero__shade" aria-hidden="true"></div>
  <span class="bgword bgword--hero" aria-hidden="true">BODYLYN</span>

  <div class="wrap hero__inner">
    <p class="eyebrow eyebrow--light hero__eyebrow" data-fade><?= e($c['name']) ?> · Mango, Jamshedpur</p>

    <h1 class="display hero__title" id="hero-title" data-reveal="hero">
      <?= lines(['BUILD YOUR', '<em>STRONGER</em>', 'SELF.']) ?>
    </h1>

    <div class="hero__row">
      <p class="hero__sub" data-fade style="--d:.35s">
        Train with expert guidance, quality equipment and a motivating fitness environment at <?= e($c['name']) ?>, Jamshedpur.
      </p>
      <div class="hero__cta" data-fade style="--d:.5s">
        <a class="btn btn--lime btn--lg" href="#trial">Book Your Free Trial Session <?= icon('arrow-ur') ?></a>
        <a class="btn btn--ghost btn--lg" href="<?= e(wa_link("Hi BODYLYN GYM! I'd like to join. Please share membership details.")) ?>" target="_blank" rel="noopener">Join BODYLYN</a>
      </div>
    </div>

    <ul class="trust" data-fade style="--d:.65s" aria-label="Why members trust us">
      <li><?= icon('star') ?> <strong><?= e((string) $c['rating']) ?></strong> Google Rating</li>
      <li><strong><?= (int) $c['reviews'] ?>+</strong> Reviews</li>
      <li><strong><?= e($c['sqft']) ?></strong> sq.ft</li>
      <li>Open <strong>5 AM – 11 PM</strong></li>
    </ul>
  </div>

  <a class="scrollcue" href="#about" aria-label="Scroll to explore"><span>Scroll</span><i aria-hidden="true"></i></a>
</section>
