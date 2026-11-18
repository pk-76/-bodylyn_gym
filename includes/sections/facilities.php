<section class="sec sec--char facilities" id="facilities" aria-labelledby="fac-title">
  <span class="bgword" aria-hidden="true">FLOOR</span>
  <div class="wrap">
    <header class="sec__head grid12">
      <div class="sec__head-l">
        <p class="eyebrow eyebrow--light">Facilities</p>
        <h2 class="display h2" id="fac-title" data-reveal>
          <?= lines(['A FLOOR BUILT', 'FOR <em>SERIOUS</em>', 'TRAINING.']) ?>
        </h2>
      </div>
      <p class="sec__intro" data-fade>Five thousand square feet of well-planned space. Every zone has a purpose, every machine is maintained, and nothing feels crowded.</p>
    </header>

    <div class="bento">
      <?php foreach (site()['facilities'] as $i => $f): ?>
        <article class="tile bento__tile <?= e($f['class']) ?>" data-fade style="--d:<?= ($i % 3) * .08 ?>s" tabindex="0">
          <div class="tile__img">
            <?= photo($f['key'], $f['alt'], ['ratio' => $f['ratio'], 'widths' => [480, 800, 1100], 'sizes' => '(min-width:1024px) 50vw, 100vw']) ?>
          </div>
          <div class="tile__shade" aria-hidden="true"></div>
          <?php if (!empty($f['big'])): ?>
            <p class="tile__big display" aria-hidden="true"><?= e($f['big']) ?><small><?= e($f['unit']) ?></small></p>
          <?php endif; ?>
          <div class="tile__body">
            <span class="tile__n" aria-hidden="true">0<?= $i + 1 ?></span>
            <h3 class="display"><?= e($f['title']) ?></h3>
            <p><?= e($f['text']) ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
