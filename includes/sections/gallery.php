<section class="sec sec--char gallery" id="gallery" aria-labelledby="gl-title">
  <div class="wrap">
    <header class="sec__head grid12">
      <div class="sec__head-l">
        <p class="eyebrow eyebrow--light">Gallery</p>
        <h2 class="display h2" id="gl-title" data-reveal>
          <?= lines(['INSIDE', '<em>BODYLYN.</em>']) ?>
        </h2>
      </div>
      <p class="sec__intro" data-fade>Tap any photo to view it full-screen.</p>
    </header>

    <ul class="masonry" data-gallery>
      <?php foreach (site()['gallery'] as $i => $g): ?>
        <li class="masonry__item" style="--ar:<?= (float) $g['ratio'] ?>">
          <button type="button" class="tile gal" data-full="<?= e(photo_url($g['key'], 1600, (float) $g['ratio'])) ?>" data-alt="<?= e($g['alt']) ?>" aria-label="Open photo: <?= e($g['alt']) ?>">
            <span class="tile__img">
              <?= photo($g['key'], $g['alt'], ['ratio' => (float) $g['ratio'], 'widths' => [360, 560, 800], 'sizes' => '(min-width:1024px) 25vw, 50vw']) ?>
            </span>
            <span class="gal__zoom" aria-hidden="true"><?= icon('arrow-ur') ?></span>
          </button>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <dialog class="lightbox" id="lightbox" aria-label="Photo viewer">
    <button class="lightbox__close round" type="button" data-lb-close aria-label="Close viewer"><?= icon('close') ?></button>
    <button class="lightbox__nav lightbox__nav--prev round" type="button" data-lb-prev aria-label="Previous photo"><?= icon('arrow-l') ?></button>
    <figure>
      <img alt="" data-lb-img>
      <figcaption><span data-lb-cap></span><span data-lb-count></span></figcaption>
    </figure>
    <button class="lightbox__nav lightbox__nav--next round" type="button" data-lb-next aria-label="Next photo"><?= icon('arrow-r') ?></button>
  </dialog>
</section>
