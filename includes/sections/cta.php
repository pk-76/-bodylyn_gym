<section class="finalcta grain" aria-labelledby="cta-title">
  <div class="finalcta__media" data-parallax="0.1" aria-hidden="true">
    <?= photo('cta', 'BODYLYN members celebrating together at a community event', ['ratio' => 16 / 9, 'widths' => [800, 1280, 1920], 'sizes' => '100vw']) ?>
  </div>
  <div class="finalcta__shade" aria-hidden="true"></div>
  <div class="wrap finalcta__inner">
    <h2 class="display finalcta__title" id="cta-title" data-reveal>
      <?= lines(['STOP WAITING.', '<em>START TRAINING.</em>']) ?>
    </h2>
    <div data-fade style="--d:.3s">
      <a class="btn btn--lime btn--lg" href="#trial">Book Your Free Trial Session <?= icon('arrow-ur') ?></a>
    </div>
  </div>
</section>
